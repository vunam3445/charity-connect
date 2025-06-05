<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
class UpdateEventStatus extends Command
{
    protected $signature = 'events:update-status';
    protected $description = 'Cập nhật trạng thái sự kiện: inactive, open, completed và gửi thông báo';

    public function handle()
    {
        $today = Carbon::now();
        $targetDate = $today->copy()->addDays(2)->startOfDay();

        // 1. Cập nhật sự kiện từ active sang inactive/cancel trước 2 ngày bắt đầu
        $events = Event::where('status', 'active')
            ->whereDate('start_date', $targetDate)
            ->get();

        foreach ($events as $event) {
            if($event->quantity_now >= $event->min_quantity){
                $event->status = 'inactive';
                $event->save();
                Log::info('Sự kiện '.$event->name.' đã được cập nhật trạng thái thành inactive (khóa đăng ký)');
            }else{
                $event->status = 'cancel';
                $event->note = 'Sự kiện đã bị hủy do không đủ người tham gia';
                $event->save();
                Log::info('Sự kiện '.$event->name.' đã được cập nhật trạng thái thành cancel do không đủ người tham gia');
            }
        }

        // 2. Cập nhật sự kiện từ inactive sang open vào ngày bắt đầu
        $eventsToOpen = Event::where('status', 'inactive')
            ->whereDate('start_date', $today)
            ->get();

        foreach ($eventsToOpen as $event) {
            $event->status = 'open';
            $event->save();
            Log::info('Sự kiện '.$event->name.' đã được cập nhật trạng thái thành open');
        }

        // 3. TỰ ĐỘNG CHUYỂN SANG COMPLETED KHI ĐẾN NGÀY KẾT THÚC
        $eventsToComplete = Event::whereIn('status', ['open', 'active', 'inactive'])
            ->where('end_date', '<=', $today)
            ->get();

        foreach ($eventsToComplete as $event) {
            $event->status = 'completed';
            $event->save();
            Log::info('Sự kiện '.$event->name.' đã được tự động cập nhật trạng thái thành completed');
            
            // Gửi thông báo đến tình nguyện viên về việc sự kiện đã kết thúc
            $volunteers = $event->volunteers;
            foreach ($volunteers as $volunteer) {
                Notification::create([
                    'notification_id' => \Illuminate\Support\Str::uuid(),
                    'title' => '🎉 Sự kiện "' . $event->name . '" đã kết thúc!',
                    'content' => 'Cảm ơn bạn đã tham gia sự kiện "'.$event->name.'". Hãy chờ đợi kết quả và chia sẻ từ ban tổ chức nhé!',
                    'event_id' => $event->event_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            Log::info('Đã gửi thông báo kết thúc sự kiện cho '.$event->name);
        }

        // 4. Gửi thông báo đến các sự kiện sẽ bắt đầu vào ngày mai
        $notifyDate = $today->copy()->addDay()->startOfDay();
        $eventsTomorrow = Event::where('approved', 'approved')
            ->whereDate('start_date', $notifyDate)
            ->get();

        foreach ($eventsTomorrow as $event) {
            $volunteers = $event->volunteers;
            foreach ($volunteers as $volunteer) {
                Notification::create([
                    'notification_id' => \Illuminate\Support\Str::uuid(),
                    'title' => '⏰ Còn 1 ngày nữa sự kiện ' . $event->name . ' sẽ bắt đầu!',
                    'content' => 'Hãy chuẩn bị thật tốt tâm thế và tinh thần thiện nguyện để đồng hành cùng chiến dịch "'.$event->name.'" nhé! Mọi sự sẵn sàng đều là khởi đầu của thành công!',
                    'event_id' => $event->event_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            Log::info('Đã gửi thông báo nhắc nhở cho sự kiện '.$event->name.' bắt đầu vào ngày mai.');
        }
    }
}
