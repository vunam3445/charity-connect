<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;
use App\Models\VolunteerEvent;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrganizationNotifyMail;

use Illuminate\Support\Facades\Storage; // Thêm dòng này
use Laravel\Pail\ValueObjects\Origin\Console;

class EventController extends Controller
{
    protected $eventService;
    protected $notificationService;
    public function __construct(EventService $eventService, NotificationService $notificationService)
    {
        $this->eventService = $eventService;
        $this->notificationService = $notificationService;
    }

    // public function createForm()
    // {
    //     try {
    //         return response()->view('event.create', ['organizationId' => auth('organization')->user()->organization_id]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Có lỗi xảy ra khi tải form.'], 500);
    //     }
    // }

    public function create()
    {
        if (!auth('organization')->check()) {
            return redirect('/')->with('error', 'Tổ chức mới có quyền tạo chiến dịch');
        }
        Log::info('=== Starting EventController@create ===');
        Log::info('Request URL: ' . request()->fullUrl());
        Log::info('HTTP Method: ' . request()->method());
        Log::info('User is an organization, attempting to render view: event.create');
        try {
            $organizationId = auth('organization')->user()->organization_id;
            return view('event.create', compact('organizationId'));
        } catch (\Exception $e) {
            Log::error('Error rendering view event.create: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra khi tải form.'], 500);
        }
    }

    public function store(EventRequest $request)
    {
        Log::info('=== Starting EventController@store ===');
        try {
            $data = $request->validated();
            Log::info('Validated data for event creation: ', $data);

            if (!auth('organization')->check()) {
                Log::warning('Unauthorized attempt to create event by non-organization user');
                return response()->json([
                    'success' => false,
                    'error' => 'Chỉ tổ chức mới có thể tạo sự kiện.'
                ], 403);
            }

            $organizationId = auth('organization')->user()->organization_id;
            Log::info('Organization ID from auth: ' . $organizationId);

            if (!$organizationId) {
                Log::error('Organization ID is null for authenticated user');
                return response()->json([
                    'success' => false,
                    'error' => 'Không tìm thấy mã tổ chức của người dùng.'
                ], 500);
            }

            $imagePaths = [];
            if ($request->hasFile('images')) {
                $disk = Storage::disk('public');
                if (!$disk->exists('events')) {
                    $disk->makeDirectory('events');
                    Log::info('Created directory: public/events');
                }

                foreach ($request->file('images') as $image) {
                    $originalName = $image->getClientOriginalName();
                    $path = $image->storeAs('images', $originalName, 'public');
                    Log::info('Stored image path: ' . $path);
                    $imagePaths[] = $path;
                }
            } else {
                Log::info('No images uploaded');
            }

            $data['images'] = $imagePaths;
            $data['organization_id'] = $organizationId; // Gán organization_id từ auth
            Log::info('Data sent to service: ', $data);

            $event = $this->eventService->create($data);

            return response()->json([
                'success' => true,
                'message' => 'Tạo chiến dịch thành công!',
                'event_id' => $event->event_id
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating event: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json([
                'success' => false,
                'error' => 'Có lỗi xảy ra khi tạo chiến dịch. Chi tiết: ' . $e->getMessage()
            ], 500);
        }
    }

    public function unregister(Event $event, Request $request)
    {
        try {
            $volunteerId = $this->getVolunteerId();
            if (!$volunteerId) {
                return redirect()->route('login.form')
                    ->with('error', 'Bạn cần đăng nhập với tư cách tình nguyện viên.');
            }

            $this->eventService->unregisterVolunteer($event->event_id, $volunteerId);

            return redirect()->route('event.show', $event->event_id)
                ->with('success', 'Hủy tham gia sự kiện thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi hủy tham gia sự kiện: ' . $e->getMessage());
            return redirect()->route('event.index', $event->event_id)
                ->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $event = $this->eventService->findById($id);
            return view('event.edit', compact('event'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không tìm thấy sự kiện để chỉnh sửa.');
        }
    }

    public function update(EventRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $data['images'] = $request->file('images');
            $event = $this->eventService->update($id, $data);
            return redirect()->route('event.show', $event->event_id)
                ->with('success', 'Sự kiện đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'Có lỗi xảy ra khi cập nhật sự kiện: ' . $e->getMessage()])
                ->withInput();
        }
    }


    public function register(Event $event, Request $request)
    {
        try {
            // Kiểm tra session
            if (!Auth('volunteer')->check()) {
                return redirect()->route('login.form')
                    ->with('error', 'Bạn cần đăng nhập với tư cách tình nguyện viên để đăng ký tham gia sự kiện.');
            }

            // Lấy volunteer_id từ session
            $volunteerId = Auth('volunteer')->user()->volunteer_id;

            // Kiểm tra xem volunteer_id có tồn tại không
            if (!$volunteerId) {
                return redirect()->route('event.show', $event->event_id)
                    ->with('error', 'Tài khoản của bạn không phải là tình nguyện viên. Vui lòng đăng ký làm tình nguyện viên trước.');
            }

            // Kiểm tra xem sự kiện có hợp lệ để đăng ký không
            if ($event->status !== 'active' || $event->approved !== 'approved' || $event->quantity_now >= $event->max_quantity) {
                return redirect()->route('event.show', $event->event_id)
                    ->with('error', 'Sự kiện không thể đăng ký do trạng thái, phê duyệt hoặc đã đủ số lượng.');
            }

            // Kiểm tra xem đã đăng ký sự kiện này chưa
            $alreadyRegistered = VolunteerEvent::where('event_id', $event->event_id)
                ->where('volunteer_id', $volunteerId)
                ->exists();

            if ($alreadyRegistered) {
                return redirect()->route('event.show', $event->event_id)
                    ->with('error', 'Bạn đã đăng ký sự kiện này.');
            }

            // Lấy danh sách sự kiện đã đăng ký của tình nguyện viên
            $registeredEvents = VolunteerEvent::where('volunteer_id', $volunteerId)
                ->with('event')
                ->get();

            Log::info('Registered events for volunteer ' . $volunteerId . ': ' . $registeredEvents->toJson());

            // Kiểm tra xung đột thời gian
            $currentEventStartDate = \Carbon\Carbon::parse($event->start_date);
            $currentEventEndDate = $event->end_date ? \Carbon\Carbon::parse($event->end_date) : $currentEventStartDate;

            foreach ($registeredEvents as $registeredEvent) {
                if (!$registeredEvent->event || !$registeredEvent->event->start_date) {
                    Log::warning('Sự kiện đã đăng ký không có thông tin hoặc start_date: ' . json_encode($registeredEvent));
                    continue;
                }

                $registeredEventStartDate = \Carbon\Carbon::parse($registeredEvent->event->start_date);
                $registeredEventEndDate = $registeredEvent->event->end_date
                    ? \Carbon\Carbon::parse($registeredEvent->event->end_date)
                    : $registeredEventStartDate;

                // Kiểm tra xung đột thời gian
                if (
                    $currentEventStartDate->between($registeredEventStartDate, $registeredEventEndDate) ||
                    $currentEventEndDate->between($registeredEventStartDate, $registeredEventEndDate) ||
                    $registeredEventStartDate->between($currentEventStartDate, $currentEventEndDate)
                ) {
                    return redirect()->route('event.show', $event->event_id)
                        ->with('error', 'Bạn đã đăng ký một sự kiện khác diễn ra trong khoảng thời gian từ ' .
                            $registeredEventStartDate->format('d/m/Y') . ' đến ' .
                            $registeredEventEndDate->format('d/m/Y') . '. Vui lòng chọn sự kiện khác.');
                }
            }

            // Kiểm tra thời hạn đăng ký
            $deadlineDate = \Carbon\Carbon::parse($event->start_date)->subDays(2);
            $currentDate = \Carbon\Carbon::now();
            if ($currentDate->gt($deadlineDate)) {
                return redirect()->route('event.show', $event->event_id)
                    ->with('error', 'Đã quá thời hạn đăng ký sự kiện (trước 2 ngày bắt đầu).');
            }

            // Gọi service để đăng ký
            $this->eventService->registerVolunteer($event->event_id, $volunteerId);

            return redirect()->route('event.show', $event->event_id)
                ->with('success', 'Đăng ký tham gia chiến dịch thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi đăng ký tham gia sự kiện: ' . $e->getMessage());
            return redirect()->route('event.show', $event->event_id)
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function destroy(Event $event, Request $request)
    {
        try {
            $organizationId = Auth::user()->organization_id ?? '0a95205f-1ca7-3ab3-a476-4af8897b61d7';

            // Kiểm tra quyền: Chỉ tổ chức tạo sự kiện mới được xóa
            if ($event->organization_id !== $organizationId) {
                return redirect()->route('event.show', $event->event_id)
                    ->with('error', 'Bạn không có quyền xóa sự kiện này.');
            }

            // Truyền event_id chứ không phải object vào service
            $this->eventService->delete($event->event_id);

            return redirect()->route('event.index') // Sửa 'event.index' thành 'events.index' nếu đúng route
                ->with('success', 'Sự kiện đã được xóa thành công!');
        } catch (\Exception $e) {
            Log::error('Lỗi khi xóa sự kiện: ' . $e->getMessage());
            return redirect()->route('event.show', $event->event_id)
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // duyệt event
    public function approve($id)
    {
        $event = $this->eventService->approve($id);

        if (!is_object($event)) {
            return redirect()->back()->with('error', 'Không tìm thấy sự kiện để duyệt.');
        }

        Mail::to($event->organization->email)->send(new OrganizationNotifyMail(
            "🎉 Sự kiện \"{$event->name}\" đã được phê duyệt!",
            "Sau khi xem xét kỹ lưỡng, sự kiện \"{$event->name}\" của bạn đã được phê duyệt. 💖 Hãy cùng nhau lan tỏa yêu thương và hành động vì cộng đồng nhé!"
        ));

        $this->notificationService->sendToOneOrganization([
            'organization_id' => $event->organization_id,
            'title' => "🎉 Sự kiện \"{$event->name}\" đã được phê duyệt!",
            'content' => "Sau khi xem xét kỹ lưỡng, sự kiện \"{$event->name}\" của bạn đã được phê duyệt. 💖 Hãy cùng nhau lan tỏa yêu thương và xây dựng một thế giới tràn đầy tình thương và sự sẻ chia nhé!"
        ]);

        return redirect()->back()->with('success', 'Duyệt sự kiện thành công.');
    }


    public function reject(Request $request, $id)
    {
        $request->validate([
            'note' => 'required|string|max:255',
        ]);

        $note = $request->input('note');

        if (empty($note)) {
            return redirect()->back()->with('error', 'Vui lòng nhập lý do từ chối.');
        }

        $event = $this->eventService->reject($note, $id);

        if (!is_object($event)) {
            return redirect()->back()->with('error', 'Không tìm thấy sự kiện để từ chối.');
        }

        Mail::to($event->organization->email)->send(new OrganizationNotifyMail(
            "❌ Sự kiện \"{$event->name}\" không được phê duyệt",
            "Sự kiện \"{$event->name}\" không được phê duyệt do: {$note}. 🌱 Hãy tiếp tục cố gắng và mang đến những chiến dịch ý nghĩa hơn trong tương lai!"
        ));

        $this->notificationService->sendToOneOrganization([
            'organization_id' => $event->organization_id,
            'title' => "❌ Sự kiện \"{$event->name}\" không được phê duyệt",
            'content' => "Sau khi xem xét, sự kiện \"{$event->name}\" không được phê duyệt do: {$note}. 🌱 Mong rằng tổ chức sẽ mang đến những chiến dịch ý nghĩa và nhân văn hơn trong tương lai để lan tỏa điều tích cực đến cộng đồng!"
        ]);

        return redirect()->back()->with('success', 'Từ chối sự kiện thành công.');
    }

    public function indexAdmin()
    {
        $events = $this->eventService->getApprove();
        return view('admin.events.content', compact('events'));
        // return $events;
    }

    public function adminProfile($id)
    {
        $event = $this->eventService->adminProfile($id);
        return view('admin.events.detail', compact('event'));
        // return $events;
    }

    public function getPendingEvents()
    {
        $events = $this->eventService->getPendingEvents();

        return view('admin.events.content', compact('events'));
    }

    public function getRejected()
    {
        $events = $this->eventService->getRejected();
        return view('admin.events.content', compact('events'));
    }

    // lấy thông tin chi tiết event user 
    public function profile($id)
    {
        $event = $this->eventService->getEventById($id);
        return $event;
    }
    public function index()
    {
        $events = Event::whereIn('approved', ['approved', 'done'])
            ->orderByDesc('created_at')
            ->limit(9)
            ->get();

        return view('event.index', compact('events'));
    }


    public function loadMore(Request $request)
    {
        $offset = $request->query('offset', 0);
        $status = $request->query('status'); // '', 'active', 'ended'
        $result = $this->eventService->loadMoreEvents($offset, $status);

        return response()->json($result);
    }


    public function show($id)
    {
        Log::info('Accessing show method with id: ' . $id);
        Log::info('Session ID: ' . session()->getId());

        $event = $this->eventService->getEventById($id);
        if (!$event) {
            Log::warning('Event not found with id: ' . $id);
            abort(404);
        }

        $relatedEvents = $this->eventService->suggestion($event->organization_id, $event->event_id);
        $hasResult = \App\Models\Result::where('event_id', $event->event_id)->exists();

        return view('event.show', compact('event', 'relatedEvents', 'hasResult'));
    }


    protected function getVolunteerId()
    {
        if (session('user_type') !== 'volunteer' || !session('user_id')) {
            return null;
        }
        return session('user_id');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        if (empty($keyword)) {
            return redirect()->back()->with('error', 'Vui lòng nhập từ khóa tìm kiếm.');
        }

        $events = $this->eventService->search($keyword);
        if ($events->isEmpty()) {
            return redirect()->back()->with('error', 'Không tìm thấy tổ chức nào.');
        }
        return view('admin.events.content', compact('events'));
    }

    public function completeEvent($id)
    {
        try {
            $event = $this->eventService->completeEvent($id);
            return response()->json([
                'success' => true,
                'message' => 'Sự kiện đã được hoàn thành.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi hoàn thành sự kiện: ' . $e->getMessage()
            ], 500);
        }
    }
    public function myEvents(Request $request)
    {
        try {
            Log::info('MyEvents API called');
            $user = auth('volunteer')->user();

            if (!$user) {
                Log::warning('User not authenticated for myEvents API');
                return response()->json(['error' => 'Bạn chưa đăng nhập với tư cách tình nguyện viên'], 401);
            }

            $volunteerId = $user->volunteer_id;
            Log::info('Getting events for volunteer: ' . $volunteerId);
            $events = $this->eventService->getEventByVolunteer($volunteerId, 'active');

            // Trích xuất dữ liệu từ pivot
            $formattedEvents = $events->map(function ($volunteerEvent) {
                $event = $volunteerEvent->event;

                return [
                    'id'     => $event->event_id,
                    'title'  => $event->name,
                    'start'  => optional($event->start_date)->toDateString(),
                    'end'    => optional($event->end_date)->toDateString(),
                    'status' => $volunteerEvent->status ?? null,
                ];
            });

            Log::info('Returning ' . $formattedEvents->count() . ' events for calendar');
            return response()->json($formattedEvents);
        } catch (\Exception $e) {
            Log::error('Lỗi khi lấy sự kiện của tình nguyện viên: ' . $e->getMessage());
            return response()->json(['error' => 'Đã xảy ra lỗi khi lấy danh sách sự kiện.'], 500);
        }
    }

    public function getRegisteredEvents($volunteerId)
    {
        try {
            Log::info('EventController::getRegisteredEvents called with volunteerId: ' . $volunteerId);

            // Kiểm tra xem user có đăng nhập không
            $user = auth('volunteer')->user();
            if (!$user) {
                Log::warning('User not authenticated');
                return response()->json(['error' => 'Bạn chưa đăng nhập với tư cách tình nguyện viên'], 401);
            }

            // Kiểm tra quyền truy cập (chỉ được xem sự kiện của chính mình)
            if ($user->volunteer_id != $volunteerId) {
                Log::warning('User trying to access events of another volunteer');
                return response()->json(['error' => 'Bạn không có quyền truy cập thông tin này'], 403);
            }

            // Lấy danh sách sự kiện đã đăng ký
            $events = $this->eventService->getRegisteredEvents($volunteerId);

            Log::info('Found ' . count($events) . ' registered events for volunteer ' . $volunteerId);

            return response()->json([
                'success' => true,
                'data' => $events
            ]);
        } catch (\Exception $e) {
            Log::error('Error in EventController::getRegisteredEvents: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'error' => 'Đã xảy ra lỗi khi lấy danh sách sự kiện đã đăng ký.'
            ], 500);
        }
    }
}
