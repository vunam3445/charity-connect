<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\NotificationOrganizationAll;
use App\Models\NotificationAll;
use App\Models\Notification;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    // API ROUTES ===========================
    public function sendToAllVolunteers(Request $request)
    {
        $this->notificationService->sendToAllVolunteers($request->title, $request->content);
        return response()->json(['message' => 'Gửi thành công đến tất cả tình nguyện viên.']);
    }

    public function sendToAllOrganizations(Request $request)
    {
        $this->notificationService->sendToAllOrganizations($request->title, $request->content);
        return response()->json(['message' => 'Gửi thành công đến tất cả tổ chức.']);
    }

    public function sendToOneOrganization(Request $request)
    {
        $this->notificationService->sendToOneOrganization($request->organization_id, $request->title, $request->content);
        return response()->json(['message' => 'Gửi thành công đến tổ chức.']);
    }

    public function sendToEventVolunteers(Request $request)
    {
        $this->notificationService->sendToEventVolunteers($request->event_id, $request->title, $request->content);
        return response()->json(['message' => 'Gửi thành công đến tình nguyện viên trong sự kiện.']);
    }

    // WEB ROUTES ===========================
    public function sendAdminView()
    {
        $organizations = \App\Models\Organization::all(['organization_id', 'username']);
        $events = \App\Models\Event::all(['event_id', 'name']);
        return view('admin.notifications.send', compact('organizations', 'events'));
    }


    public function sendAsAdmin(Request $request)
    {
        $request->validate([
            'target' => 'required|in:all,all_organizations,one_organization,event_volunteers',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        try {
            $data = [
                'title' => $request->title,
                'content' => $request->content,
            ];

            switch ($request->target) {
                case 'all':
                    $this->notificationService->sendToAllVolunteers($data);
                    break;

                case 'all_organizations':
                    $this->notificationService->sendToAllOrganizationsGlobal($data); // sửa lại dùng đúng hàm
                    break;

                case 'one_organization':
                    $request->validate(['target_id' => 'required|string']);
                    $data['organization_id'] = $request->target_id;
                    $this->notificationService->sendToOneOrganization($data);
                    break;

                case 'event_volunteers':
                    $request->validate(['target_id' => 'required|string']);
                    $data['event_id'] = $request->target_id;
                    $this->notificationService->sendToEventVolunteers($data);
                    break;
            }


            return redirect()->route('notification.admin.send')
                ->with('status', 'success')
                ->with('message', 'Gửi thông báo thành công!');
        } catch (\Exception $e) {
            return redirect()->route('notification.admin.send')
                ->with('status', 'error')
                ->with('message', 'Gửi thất bại: ' . $e->getMessage());
        }
    }

    public function sendOrganizationView()
    {
        $organizationId = auth('organization')->user()->organization_id;

        $events = Event::where('organization_id', $organizationId)
            ->where('approved', 'approved')
            ->get();

        return view('organization.notifications.send', compact('events'));
    }


    public function sendAsOrganization(Request $request)
    {
        $request->validate([
            'event_id' => 'required|string',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $this->notificationService->sendToEventVolunteers($request->event_id, $request->title, $request->content);

        return redirect()->back()->with('success', 'Tổ chức gửi thông báo thành công!');
    }

    public function received()
    {
        $user = Auth::user();

        if ($user && $user->role === 'volunteer') {
            $notifications = $this->notificationService->getAllReceivedForVolunteer($user->volunteer_id);
        } elseif ($user && $user->role === 'organization') {
            $notifications = $this->notificationService->getAllReceivedForOrganization($user->organization_id);
        } else {
            return redirect()->route('login')->with('error', 'Bạn chưa đăng nhập hoặc không có quyền truy cập.');
        }

        return view('notifications.received', compact('notifications'));
    }



    public function viewSentNotifications()
    {
        $all = NotificationAll::all(); // Toàn hệ thống (Volunteer)
        $orgs = NotificationOrganizationAll::all(); // Toàn bộ tổ chức
        $events = Notification::with('event')->get(); // Sự kiện cụ thể
        $specificOrgs = $this->notificationService->getSentNotificationsToSpecificOrganizations(); // ✅ thêm dòng này

        return view('admin.notifications.view', [
            'allNotifications' => $all,
            'organizationNotifications' => $orgs,
            'eventNotifications' => $events,
            'specificOrgNotifications' => $specificOrgs, // ✅ truyền sang view
        ]);
    }


    public function sendEventView()
    {
        $orgId = auth('organization')->user()->organization_id;
        $events = \App\Models\Event::where('organization_id', $orgId)
            ->where('approved', 'approved')
            ->get(['event_id', 'name']);
        return view('organization.notifications.send', compact('events'));
    }


    public function sendEvent(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,event_id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $this->notificationService->sendEventNotificationByOrganization(
            $request->event_id,
            $request->title,
            $request->content
        );

        return back()->with('success', 'Gửi thông báo thành công!');
    }

    public function viewSentEvent()
    {
        $orgId = auth('organization')->user()->organization_id;
        $eventIds = \App\Models\Event::where('organization_id', $orgId)->pluck('event_id');

        $notifications = \App\Models\Notification::whereIn('event_id', $eventIds)
            ->orderByDesc('created_at')
            ->get();

        return view('organization.notifications.view', compact('notifications'));
    }

    public function markAsRead(Request $request)
    {
        $notificationId = $request->input('notification_id');

        if (auth('volunteer')->check()) {
            $volunteerId = auth('volunteer')->id();

            // Nếu là system notification
            if ($request->input('type') === 'system') {
                DB::table('notification_all_reads')->updateOrInsert(
                    ['notification_id' => $notificationId, 'volunteer_id' => $volunteerId],
                    ['is_read' => true]
                );
            }

            // Nếu là event notification
            elseif ($request->input('type') === 'event') {
                DB::table('notification_reads')->updateOrInsert(
                    ['notification_id' => $notificationId, 'volunteer_id' => $volunteerId],
                    ['is_read' => true]
                );
            }

            // Nếu là personal notification: cập nhật trực tiếp
            elseif ($request->input('type') === 'personal') {
                DB::table('notification_volunteer')
                    ->where('notification_id', $notificationId)
                    ->where('volunteer_id', $volunteerId)
                    ->update(['is_read' => true]);
            }
        } elseif (auth('organization')->check()) {
            $organizationId = auth('organization')->id();

            if ($request->input('type') === 'system') {
                DB::table('notification_all_reads')->updateOrInsert(
                    ['notification_id' => $notificationId, 'organization_id' => $organizationId],
                    ['is_read' => true]
                );
            } elseif ($request->input('type') === 'global') {
                DB::table('notifications_organization_reads')->updateOrInsert(
                    ['notification_id' => $notificationId, 'organization_id' => $organizationId],
                    ['is_read' => true]
                );
            } elseif ($request->input('type') === 'personal') {
                DB::table('notifications_organization')
                    ->where('notification_id', $notificationId)
                    ->where('organization_id', $organizationId)
                    ->update(['is_read' => true]);
            }
        }

        return response()->json(['message' => 'Đã đánh dấu đã đọc']);
    }
    public function markAllAsRead()
    {
        if (auth('volunteer')->check()) {
            $volunteerId = auth('volunteer')->id();

            // Lấy top notifications
            $topNotifications = $this->notificationService->getTopNotificationsForCurrentUser();

            foreach ($topNotifications as $noti) {
                if (!empty($noti->event_id)) {
                    DB::table('notification_reads')->updateOrInsert(
                        ['notification_id' => $noti->notification_id, 'volunteer_id' => $volunteerId],
                        ['is_read' => true]
                    );
                } elseif ($noti->type === 'personal') {
                    DB::table('notification_volunteer')->where('id', $noti->notification_id)->update(['is_read' => true]);
                } else {
                    DB::table('notification_all_reads')->updateOrInsert(
                        ['notification_id' => $noti->notification_id, 'volunteer_id' => $volunteerId],
                        ['is_read' => true]
                    );
                }
            }
        } elseif (auth('organization')->check()) {
            $organizationId = auth('organization')->id();
            $topNotifications = $this->notificationService->getTopNotificationsForCurrentUser();

            foreach ($topNotifications as $noti) {
                switch ($noti->type) {
                    case 'personal':
                        DB::table('notifications_organization')
                            ->where('id', $noti->notification_id)
                            ->where('organization_id', $organizationId)
                            ->update(['is_read' => true]);
                        break;

                    case 'global':
                        DB::table('notifications_organization_reads')->updateOrInsert(
                            ['notification_id' => $noti->notification_id, 'organization_id' => $organizationId],
                            ['is_read' => true]
                        );
                        break;

                    case 'system':
                    default:
                        DB::table('notification_all_reads')->updateOrInsert(
                            ['notification_id' => $noti->notification_id, 'organization_id' => $organizationId],
                            ['is_read' => true]
                        );
                        break;
                }
            }
        }

        return response()->json(['message' => 'Tất cả đã được đánh dấu là đã đọc']);
    }

    public function viewSystem()
    {
        $allNotifications = NotificationAll::orderByDesc('created_at')->get(); // Lấy theo thời gian mới nhất trước
        return view('admin.notifications.system', compact('allNotifications'));
    }

    public function viewOrganizationAll()
    {
        $organizationNotifications = NotificationOrganizationAll::orderByDesc('created_at')->get();
        return view('admin.notifications.organization_all', compact('organizationNotifications'));
    }

    public function viewOrganizationSpecific()
    {
        $specificOrgNotifications = $this->notificationService->getSentNotificationsToSpecificOrganizations();
        return view('admin.notifications.organization_specific', compact('specificOrgNotifications'));
    }

    public function viewEventSpecific()
    {
        $eventNotifications = Notification::with('event')->orderByDesc('created_at')->get();
        return view('admin.notifications.event_specific', compact('eventNotifications'));
    }

    public function getUnreadCount()
    {
        $count = $this->notificationService->getUnreadNotificationCount();
        return response()->json(['unread_count' => $count]);
    }
}
