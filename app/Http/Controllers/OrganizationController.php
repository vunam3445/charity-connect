<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\QrRequest;
use Illuminate\Http\Request;
use App\Services\OrganizationService;
use App\Models\Organization;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\NotificationService;
use App\Models\Event;
use App\Models\Result;
use App\Models\Notification;
use App\Models\VolunteerEvent;
use App\Models\Follow;
use Illuminate\Support\Str;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrganizationNotifyMail;

class OrganizationController extends Controller
{
    protected $organizationService;
    protected $notificationService;

    public function __construct(OrganizationService $organizationService, NotificationService $notificationService)
    {
        $this->organizationService = $organizationService;
        $this->notificationService = $notificationService;
    }
    // lấy thông tin profile của tổ chức cho admin
    public function profile(string $id)
    {


        $organization = $this->organizationService->getProfile($id);

        return View('admin.organization.detail', compact('organization'));
        // return $organization;
    }

    // lấy thông tin profile của tổ chức cho user
    public function index(string $id)
    {
        $organization = $this->organizationService->getProfile($id);

        $events = Event::where('organization_id', $id)->get();
        $results = Result::whereHas('event', function ($query) use ($id) {
            $query->where('organization_id', $id);
        })->with('event')->get();

        return view('organization.profile', compact('organization', 'events', 'results'));
    }


    // lấy danh sách tổ chức đang chờ duyệt
    public function getPending()
    {
        $organizations = $this->organizationService->getPendingOrganizations();

        return view('admin.organization.content', compact('organizations'));
    }

    // duyệt tổ chức
    public function approve($id)
    {
        $organization = $this->organizationService->approve($id, true);

        Mail::to($organization->email)->send(new OrganizationNotifyMail(
            '🎉 Tổ chức của bạn đã được phê duyệt!',
            "Xin chúc mừng {$organization->name}, tổ chức của bạn đã chính thức được phê duyệt. Hãy bắt đầu lan tỏa yêu thương bằng cách tạo ra những chiến dịch thật ý nghĩa nhé! 💪"
        ));

        $this->notificationService->sendWelcomeNotificationToApprovedOrganization($organization->organization_id);

        return View('admin.organization.detail', compact('organization'));
    }

    // từ chối tổ chức
    public function reject(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|max:255',
        ]);
        $note = $request->input('note');
        // Lưu lý do từ chối vào cơ sở dữ liệu
        $organization = Organization::find($id);
        if (!$organization) {
            return redirect()->back()->with('error', 'Không tìm thấy tổ chức.');
        }

        Mail::to($organization->email)->send(new OrganizationNotifyMail(
            'Tổ chức của bạn không được phê duyệt!',
            "Xin chào {$organization->name}, tổ chức của bạn đã không đủ điều kiện để phê duyệt. Hãy bắt đầu lan tỏa yêu thương bằng cách tạo tài khoản khác nhé! 💪"
        ));
        // Gửi thông báo cho tổ chức về lý do từ chối

        $result = $this->organizationService->reject($note, $id);

        return redirect()->back()->with('success', 'Từ chối tổ chức thành công.');
    }
    // lấy danh sách tổ chức đã duyệt
    public function getApproved()
    {
        $organizations = $this->organizationService->getApprovedOrganizations();

        return view('admin.organization.content', compact('organizations'));
    }

    // lấy danh sách tổ chức đã bị từ chối
    public function getRejected()
    {
        $organizations = $this->organizationService->getRejectedOrganizations();

        return view('admin.organization.content', compact('organizations'));
    }

    public function uploadCover(Request $request, $id)
    {
        $request->validate([
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $organization = Organization::find($id);

        if (!$organization) {
            return redirect()->back()->with('error', 'Không tìm thấy tổ chức.');
        }

        // Xóa ảnh cũ nếu có
        if ($organization->cover && File::exists(public_path($organization->cover))) {
            File::delete(public_path($organization->cover));
        }

        $file = $request->file('cover_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);

        $organization->cover = $filename;
        $organization->save();

        return redirect()->back()->with('success', 'Ảnh bìa đã được cập nhật!');
    }

    public function uploadAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar_image' => 'required|image|mimes:jpeg,png,jpg|max:5120', // 5MB
        ]);

        $organization = Organization::find($id);

        if (!$organization) {
            return redirect()->back()->with('error', 'Không tìm thấy tổ chức.');
        }

        // Xóa ảnh avatar cũ nếu có
        if ($organization->avatar && File::exists(public_path('images/' . $organization->avatar))) {
            File::delete(public_path('images/' . $organization->avatar));
        }

        $file = $request->file('avatar_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $filename);

        $organization->avatar = $filename;
        $organization->save();

        return redirect()->back()->with('success', 'Ảnh đại diện đã được cập nhật!');
    }

    public function dashboard(Request $request)
    {
        $tab = $request->query('tab', 'events');

        $organizationId = auth('organization')->user()->organization_id;
        $eventsPending = $this->organizationService->getEventPeding($organizationId);
        $eventsRejected = $this->organizationService->getEventRejected($organizationId);
        $allEvents = Event::where('organization_id', $organizationId)->get();
        $events = Event::where('organization_id', $organizationId)->get();
        $results = Result::whereHas('event', fn($q) => $q->where('organization_id', $organizationId))->with('event')->get();
        $notifications = Notification::whereIn('event_id', $events->pluck('event_id'))->with('event')->get();
        $rejectedEvents = $allEvents->where('approved', 'rejected');

        return view('organization.dashboard', compact('tab', 'events', 'rejectedEvents', 'results', 'notifications',
            'eventsPending', 'eventsRejected'));
    }

    public function list()
    {
        $organizations = Organization::where('approved', 'approved')->get();
        return view('organization.list', compact('organizations'));
    }

    public function detailOrganization(string $id)
    {
        $organization = $this->organizationService->getProfile($id);
        $events = Event::where('organization_id', $id)->get();

        $results = Result::whereHas('event', function ($query) use ($id) {
            $query->where('organization_id', $id);
        })->with('event')->get();

        $volunteer = auth('volunteer')->user();
        $hasFollowed = false;

        if ($volunteer) {
            $hasFollowed = Follow::where('volunteer_id', $volunteer->volunteer_id)
                ->where('organization_id', $id)
                ->exists();
        }

        return view('organization.detail', compact('organization', 'events', 'results', 'hasFollowed'));
    }

    public function follow(string $organization_id)
    {
        $volunteer = auth('volunteer')->user();

        if (!$volunteer) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để theo dõi.');
        }

        // Kiểm tra xem đã follow chưa
        $exists = Follow::where('volunteer_id', $volunteer->volunteer_id)
            ->where('organization_id', $organization_id)
            ->exists();

        if (!$exists) {
            Follow::create([
                'volunteer_id' => $volunteer->volunteer_id,
                'organization_id' => $organization_id,
                // id tự tạo UUID trong model boot()
            ]);
        }

        return redirect()->back()->with('success', 'Đã theo dõi tổ chức.');
    }

    public function unfollow(string $organization_id)
    {
        $volunteer = auth('volunteer')->user();

        if (!$volunteer) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để hủy theo dõi.');
        }

        // Tìm bản ghi follow rồi xóa
        Follow::where('volunteer_id', $volunteer->volunteer_id)
            ->where('organization_id', $organization_id)
            ->delete();

        return redirect()->back()->with('success', 'Bạn đã hủy theo dõi tổ chức.');
    }


    public function viewEvents($id)
    {
        $event = Event::with('volunteers')->findOrFail($id);

        // Tách chuỗi ảnh thành mảng
        if ($event->images) {
            $event->images = array_map('trim', explode(';', $event->images));
        } else {
            $event->images = [];
        }

        // Đếm số tình nguyện viên chưa điểm danh (ví dụ status = 'absent')
        $notCheckedInCount = VolunteerEvent::where('event_id', $id)
            ->where('status', 'registered')
            ->count();

        // Đếm số tình nguyện viên đã điểm danh (ví dụ status = 'present')
        $checkedInCount = VolunteerEvent::where('event_id', $id)
            ->where('status', 'completed')
            ->count();

        return view('organization.showEvent', compact('event', 'notCheckedInCount', 'checkedInCount'));
    }

    public function viewResults($id)
    {
        try {
            $result = Result::with(['event', 'event.organization', 'event.volunteers'])->findOrFail($id);

            $event = $result->event;

            $canEdit = false;
            if (auth('organization')->check()) {
                $organizationId = auth('organization')->user()->organization_id;
                $canEdit = ($organizationId == $event->organization_id);
            }

            $images = [];
            if (!empty($result->images)) {
                if (is_string($result->images)) {
                    $images = array_filter(explode(';', $result->images));
                } elseif (is_array($result->images)) {
                    $images = $result->images;
                }
            }
            $totalAttendees = 0;
            if ($event->volunteers && is_object($event->volunteers)) {
                $totalAttendees = $event->volunteers->where('completed', true)->count();
            }
            $totalComments = \App\Models\Comment::where('result_id', $result->result_id)->count();
            $duration = \Carbon\Carbon::parse($event->start_date)->diffInDays(\Carbon\Carbon::parse($event->end_date)) + 1;

            return view('organization.showResult', compact(
                'result',
                'event',
                'images',
                'canEdit',
                'totalAttendees',
                'totalComments',
                'duration'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }


    // Tạo mã QR cho sự kiện
    public function createQrcode(QrRequest $request)
    {

        Log::info('Create QR code request data: ', $request->all());

        $data = $request->validated();

        try {
            $qrcode = $this->organizationService->createQrcode($data);
            return response()->json(['qrcode' => $qrcode], 200);
        } catch (\Exception $e) {
            Log::error('Lỗi tạo mã QR: ' . $e->getMessage());
            return response()->json(['error' => 'Lỗi tạo mã QR: ' . $e->getMessage()], 500);
        }
    }


    public function removeVolunteer($event_id, $volunteer_id)
    {
        VolunteerEvent::where('event_id', $event_id)
            ->where('volunteer_id', $volunteer_id)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (empty($keyword)) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
        }

        $organizations = $this->organizationService->search($keyword);
        if ($organizations->isEmpty()) {
            return redirect()->back()->with('error', 'Không tìm thấy tổ chức nào.');
        }
        return view('admin.organization.content', compact('organizations'));
    }
}
