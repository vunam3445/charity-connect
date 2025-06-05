<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\NotificationAll;
use App\Models\NotificationOrganization;
use App\Models\NotificationVolunteer;
use App\Models\VolunteerEvent;
use App\Repositories\Repository\NotificationRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Organization;
use Illuminate\Support\Carbon;
use App\Models\NotificationOrganizationAll;

class NotificationService
{
    protected $notificationRepo;

    public function __construct(NotificationRepositoryInterface $notificationRepo)
    {
        $this->notificationRepo = $notificationRepo;
    }

    public function sendToAllVolunteers(array $data)
    {
        return DB::transaction(function () use ($data) {
            $notification = NotificationAll::create([
                'notification_id' => Str::uuid(),
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
            return $notification;
        });
    }

    public function sendToAllOrganizations(array $data)
    {
        return DB::transaction(function () use ($data) {
            $organizations = Organization::all();
            foreach ($organizations as $org) {
                NotificationOrganization::create([
                    'notification_id' => Str::uuid(),
                    'organization_id' => $org->organization_id,
                    'title' => $data['title'],
                    'content' => $data['content'],
                ]);
            }
        });
    }

    public function sendToOneOrganization(array $data)
    {
        return DB::transaction(function () use ($data) {
            $notification = NotificationOrganization::create([
                'notification_id' => Str::uuid(),
                'organization_id' => $data['organization_id'],
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
            return $notification;
        });
    }

    public function sendToEventVolunteers(array $data)
    {
        return DB::transaction(function () use ($data) {
            $notification = Notification::create([
                'notification_id' => Str::uuid(),
                'event_id' => $data['event_id'],
                'title' => $data['title'],
                'content' => $data['content'],
            ]);

            $volunteerIds = VolunteerEvent::where('event_id', $data['event_id'])->pluck('volunteer_id');

            foreach ($volunteerIds as $vid) {
                NotificationVolunteer::create([
                    'notification_id' => $notification->notification_id,
                    'volunteer_id' => $vid,
                    'title' => $notification->title,
                    'content' => $notification->content,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            return $notification;
        });
    }

    public function getReceivedNotificationsForVolunteer(string $volunteerId)
    {
        $eventNotis = Notification::join('notification_volunteer as nv', 'notifications.notification_id', '=', 'nv.notification_id')
            ->where('nv.volunteer_id', $volunteerId)
            ->select('notifications.title', 'notifications.content', 'notifications.created_at')
            ->get();

        $systemNotis = NotificationAll::select('title', 'content', 'created_at')->get();

        return $eventNotis->merge($systemNotis)->sortByDesc('created_at');
    }

    public function getSentNotificationsByAdmin()
    {
        $all = NotificationAll::all(); // tất cả volunteer
        $orgs = NotificationOrganizationAll::all(); // tất cả tổ chức
        $events = Notification::with('event')->get(); // thông báo theo sự kiện

        return compact('all', 'orgs', 'events');
    }

    public function getSentNotificationsByOrganization($organizationId)
    {
        return NotificationOrganization::where('organization_id', $organizationId)->get();
    }


    public function sendToAllOrganizationsGlobal(array $data)
    {
        return DB::transaction(function () use ($data) {
            return NotificationOrganizationAll::create([
                'notification_id' => Str::uuid(),
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
        });
    }

    public function sendWelcomeNotificationToVolunteer($volunteerId)
    {
        return \App\Models\NotificationVolunteer::create([
            'notification_id' => Str::uuid(),
            'volunteer_id' => $volunteerId,
            'title' => 'Chào mừng bạn đến với cộng đồng thiện nguyện!',
            'content' => 'Cảm ơn bạn đã chung tay tham gia thiện nguyện. Hãy theo dõi các sự kiện và góp sức vì cộng đồng!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function sendWelcomeNotificationToApprovedOrganization($organizationId)
    {
        return \App\Models\NotificationOrganization::create([
            'notification_id' => Str::uuid(),
            'organization_id' => $organizationId,
            'title' => 'Tổ chức của bạn đã được phê duyệt!',
            'content' => 'Hãy cùng tạo những sự kiện thiện nguyện ý nghĩa nhé!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Gửi thông báo khi sự kiện được phê duyệt
    public function sendNotificationEventApproved($event)
    {
        return \App\Models\NotificationOrganization::create([
            'notification_id' => Str::uuid(),
            'organization_id' => $event->organization_id,
            'title' => 'Sự kiện của bạn đã được phê duyệt!',
            'content' => "Sự kiện \"{$event->name}\" đã được phê duyệt. Hãy chuẩn bị cho chiến dịch!",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Gửi thông báo khi sự kiện bị từ chối
    public function sendNotificationEventRejected($event)
    {
        return \App\Models\NotificationOrganization::create([
            'notification_id' => Str::uuid(),
            'organization_id' => $event->organization_id,
            'title' => 'Sự kiện của bạn đã bị từ chối',
            'content' => "Rất tiếc, sự kiện \"{$event->name}\" đã bị từ chối. Hãy kiểm tra và gửi lại nếu cần.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function sendNotificationNewResult(string $eventId, string $resultTitle)
    {
        return DB::transaction(function () use ($eventId, $resultTitle) {
            $notification = Notification::create([
                'notification_id' => Str::uuid(),
                'event_id' => $eventId,
                'title' => 'Có kết quả mới từ sự kiện!',
                'content' => 'Sự kiện bạn tham gia đã có kết quả: "' . $resultTitle . '". Hãy xem ngay nhé!',
            ]);

            $volunteerIds = VolunteerEvent::where('event_id', $eventId)->pluck('volunteer_id');

            foreach ($volunteerIds as $vid) {
                NotificationVolunteer::create([
                    'notification_id' => $notification->notification_id,
                    'volunteer_id' => $vid,
                    'title' => $notification->title,
                    'content' => $notification->content,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $notification;
        });
    }

    public function sendEventNotificationByOrganization(string $eventId, string $title, string $content)
    {
        return DB::transaction(function () use ($eventId, $title, $content) {
            // Tạo thông báo
            $notification = Notification::create([
                'notification_id' => Str::uuid(),
                'event_id' => $eventId,
                'title' => $title,
                'content' => $content,
            ]);

            // Lấy danh sách volunteer của sự kiện
            $volunteers = VolunteerEvent::where('event_id', $eventId)->pluck('volunteer_id');

            // Gửi thông báo
            foreach ($volunteers as $vid) {
                NotificationVolunteer::create([
                    'notification_id' => $notification->notification_id,
                    'volunteer_id' => $vid,
                    'title' => $title,
                    'content' => $content,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $notification;
        });
    }

    public function getSentNotificationsToSpecificOrganizations()
    {
        return \App\Models\NotificationOrganization::with('organization')
            ->orderByDesc('created_at')
            ->get();
    }

    // Lấy thông báo cho volunteer (từ tất cả nguồn liên quan)
    public function getAllReceivedForVolunteer(string $volunteerId)
    {
        $eventIds = VolunteerEvent::where('volunteer_id', $volunteerId)->pluck('event_id');

        $systemNotis = NotificationAll::select(
            DB::raw('NULL as event_id'),
            'title',
            'content',
            'created_at'
        )->toBase(); // <<< Thêm toBase()

        $personalNotis = NotificationVolunteer::where('volunteer_id', $volunteerId)
            ->select(DB::raw('NULL as event_id'), 'title', 'content', 'created_at')
            ->toBase(); // <<< Thêm toBase()

        $eventNotis = Notification::whereIn('event_id', $eventIds)
            ->select('event_id', 'title', 'content', 'created_at')
            ->toBase(); // <<< Thêm toBase()

        return $systemNotis
            ->unionAll($personalNotis)
            ->unionAll($eventNotis)
            ->orderByDesc('created_at')  // áp dụng sorting đúng
            ->get();
    }


    // Lấy thông báo cho tổ chức
    public function getAllReceivedForOrganization(string $organizationId)
    {
        // Global thông báo cho tất cả tổ chức
        $globalNotis = NotificationOrganizationAll::select('title', 'content', 'created_at');

        // Cá nhân tổ chức
        $personalNotis = NotificationOrganization::where('organization_id', $organizationId)
            ->select('title', 'content', 'created_at');

        // Có thể thêm NotificationAll nếu muốn chung toàn hệ thống
        $systemNotis = NotificationAll::select('title', 'content', 'created_at');

        // Gộp
        return $globalNotis->unionAll($personalNotis)->unionAll($systemNotis)->orderByDesc('created_at')->get();
    }

    // NotificationService.php

    public function getTopNotificationsForCurrentUser()
    {
        if (auth('volunteer')->check()) {
            $volunteerId = auth('volunteer')->id();

            // 1. System notifications (notifications_all)
            $system = DB::table('notifications_all as n')
                ->leftJoin('notification_all_reads as r', function ($join) use ($volunteerId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.volunteer_id', $volunteerId);
                })
                ->select(
                    'n.notification_id',
                    DB::raw('NULL as event_id'),
                    'n.title',
                    'n.content',
                    'n.created_at',
                    DB::raw('COALESCE(r.is_read, 0) as is_read'),
                    DB::raw("'system' as type")
                );

            // 2. Personal notifications (notification_volunteer)
            $personal = DB::table('notification_volunteer as n')
                ->where('n.volunteer_id', $volunteerId)
                ->select(
                    'n.id as notification_id',            // Dùng ID auto increment
                    DB::raw('NULL as event_id'),
                    'n.title',
                    'n.content',
                    'n.created_at',
                    'n.is_read',
                    DB::raw("'personal' as type")
                );

            // 3. Event-based notifications (notifications)
            $eventIds = VolunteerEvent::where('volunteer_id', $volunteerId)->pluck('event_id');

            $event = DB::table('notifications as n')
                ->whereIn('n.event_id', $eventIds)
                ->leftJoin('notification_reads as r', function ($join) use ($volunteerId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.volunteer_id', $volunteerId);
                })
                ->select(
                    'n.notification_id',
                    'n.event_id',
                    'n.title',
                    'n.content',
                    'n.created_at',
                    DB::raw('COALESCE(r.is_read, 0) as is_read'),
                    DB::raw("'event' as type")
                );

            return $system
                ->unionAll($personal)
                ->unionAll($event)
                ->orderByDesc('created_at')
                ->limit(20)
                ->get();
        }

        if (auth('organization')->check()) {
            $organizationId = auth('organization')->id();

            // 1. Global notifications for all organizations
            $global = DB::table('notifications_organization_all as n')
                ->leftJoin('notifications_organization_reads as r', function ($join) use ($organizationId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.organization_id', $organizationId);
                })
                ->select(
                    'n.notification_id',
                    DB::raw('NULL as event_id'),
                    'n.title',
                    'n.content',
                    'n.created_at',
                    DB::raw('COALESCE(r.is_read, 0) as is_read'),
                    DB::raw("'global' as type")
                );

            // 2. Personal notifications to organization
            $personal = DB::table('notifications_organization as n')
                ->where('n.organization_id', $organizationId)
                ->select(
                    'n.notification_id',
                    DB::raw('NULL as event_id'),
                    'n.title',
                    'n.content',
                    'n.created_at',
                    'n.is_read',
                    DB::raw("'personal' as type")
                );

            // 3. System-wide (shared) notifications_all
            $system = DB::table('notifications_all as n')
                ->leftJoin('notification_all_reads as r', function ($join) use ($organizationId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.organization_id', $organizationId);
                })
                ->select(
                    'n.notification_id',
                    DB::raw('NULL as event_id'),
                    'n.title',
                    'n.content',
                    'n.created_at',
                    DB::raw('COALESCE(r.is_read, 0) as is_read'),
                    DB::raw("'system' as type")
                );

            return $global
                ->unionAll($personal)
                ->unionAll($system)
                ->orderByDesc('created_at')
                ->limit(20)
                ->get();
        }

        return collect();
    }

    // Method để đếm số thông báo chưa đọc 
    public function getUnreadNotificationCount()
    {
        if (auth('volunteer')->check()) {
            $volunteerId = auth('volunteer')->id();

            // 1. System notifications chưa đọc
            $systemUnread = DB::table('notifications_all as n')
                ->leftJoin('notification_all_reads as r', function ($join) use ($volunteerId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.volunteer_id', $volunteerId);
                })
                ->whereNull('r.notification_id')
                ->count();

            // 2. Personal notifications chưa đọc  
            $personalUnread = DB::table('notification_volunteer')
                ->where('volunteer_id', $volunteerId)
                ->where('is_read', false)
                ->count();

            // 3. Event notifications chưa đọc
            $eventIds = VolunteerEvent::where('volunteer_id', $volunteerId)->pluck('event_id');
            $eventUnread = DB::table('notifications as n')
                ->whereIn('n.event_id', $eventIds)
                ->leftJoin('notification_reads as r', function ($join) use ($volunteerId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.volunteer_id', $volunteerId);
                })
                ->whereNull('r.notification_id')
                ->count();

            return $systemUnread + $personalUnread + $eventUnread;
        }

        if (auth('organization')->check()) {
            $organizationId = auth('organization')->id();

            // 1. Global notifications chưa đọc
            $globalUnread = DB::table('notifications_organization_all as n')
                ->leftJoin('notifications_organization_reads as r', function ($join) use ($organizationId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.organization_id', $organizationId);
                })
                ->whereNull('r.notification_id')
                ->count();

            // 2. Personal notifications chưa đọc
            $personalUnread = DB::table('notifications_organization')
                ->where('organization_id', $organizationId)
                ->where('is_read', false)
                ->count();

            // 3. System notifications chưa đọc
            $systemUnread = DB::table('notifications_all as n')
                ->leftJoin('notification_all_reads as r', function ($join) use ($organizationId) {
                    $join->on('n.notification_id', '=', 'r.notification_id')
                        ->where('r.organization_id', $organizationId);
                })
                ->whereNull('r.notification_id')
                ->count();

            return $globalUnread + $personalUnread + $systemUnread;
        }

        return 0;
    }
}
