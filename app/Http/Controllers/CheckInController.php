<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckInController extends Controller
{
    public function checkIn(Request $request)
    {
        try {
            // Lấy event_id từ QR code
            $event_id = $request->event_id;
            
            // Lấy volunteer_id từ phiên đăng nhập
            $volunteer_id = auth('volunteer')->id();
            
            if (!$volunteer_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vui lòng đăng nhập để điểm danh'
                ], 401);
            }

            // Kiểm tra sự kiện tồn tại
            $event = Event::findOrFail($event_id);
            
            // Kiểm tra tình nguyện viên tồn tại
            $volunteer = Volunteer::findOrFail($volunteer_id);

            // Kiểm tra tình nguyện viên đã đăng ký sự kiện chưa
            $registration = DB::table('volunteer_event')
                ->where('event_id', $event_id)
                ->where('volunteer_id', $volunteer_id)
                ->first();

            if (!$registration) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn chưa đăng ký tham gia sự kiện này'
                ], 400);
            }

            // Kiểm tra đã điểm danh chưa
            if ($registration->status === 'completed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Bạn đã điểm danh sự kiện này rồi'
                ], 400);
            }

            // Cập nhật trạng thái điểm danh
            DB::table('volunteer_event')
                ->where('event_id', $event_id)
                ->where('volunteer_id', $volunteer_id)
                ->update([
                    'status' => 'completed',
                    'updated_at' => now()
                ]);
            // Cộng 100 điểm cho tình nguyện viên khi điểm danh thành công
            $volunteer->point = $volunteer->point + 100;
            $volunteer->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Điểm danh thành công',
                'event_name' => $event->name
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
} 