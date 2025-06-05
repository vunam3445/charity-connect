<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Guid\Guid;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Result;
use App\Services\ResultService;
use App\Services\NotificationService;

class ResultController extends Controller
{
    protected $resultService;
    protected $notificationService;

    public function __construct(ResultService $resultService, NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
        $this->resultService = $resultService;
        $this->middleware(function ($request, $next) {
            if (!auth('organization')->check()) {
                return redirect()->route('login')->with('error', 'Bạn cần đăng nhập với tư cách tổ chức.');
            }
            return $next($request);
        })->except(['index', 'show', 'showByEvent', 'loadMore']);
    }

    public function create($id)
    {
        $event = Event::findOrFail($id);

        $organizationId = auth('organization')->user()->organization_id;
        $events = Event::where('organization_id', $organizationId)->get();

        if (!$event) {
            abort(404, 'Event not found');
        }

        return view('contents.result_create', compact('event', 'events'));
    }

    public function store(Request $request)
    {
        try {
            $organizationId = auth('organization')->user()->organization_id;
            $event = Event::where('event_id', $request->event_id)
                ->where('organization_id', $organizationId)
                ->first();

            if (!$event) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Bạn không có quyền thêm kết quả cho sự kiện này.'
                    ], 403);
                }
                abort(403, 'Bạn không có quyền thêm kết quả cho sự kiện này.');
            }

            $result_id = Guid::uuid4()->toString();

            $result = new Result();
            $result->result_id = $result_id;
            $result->event_id = $event->event_id;
            $result->content = $request->content;

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                $imagePaths = [];

                foreach ($images as $image) {
                    $originalName = $image->getClientOriginalName();
                    $path = $image->move('images', $originalName);
                    $imagePaths[] = 'images/' . $path->getFilename();
                }

                $result->images = implode(';', $imagePaths);
            }

            $result->save();

            $this->notificationService->sendNotificationNewResult($event->event_id, 'Kết quả mới cho sự kiện ' . $event->name);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kết quả đã được tạo thành công!',
                    'redirect' => route('result.show', $result_id)
                ]);
            }

            return redirect()->route('result.show', $result_id)
                ->with('success', 'Kết quả đã được tạo thành công!');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $result = Result::findOrFail($id);
        $eventId = $result->event_id;
        $result->delete();
        return redirect()->route('view.results')->with('success', 'Kết quả đã được xóa thành công!');
    }

    public function edit($id)
    {
        $result = Result::findOrFail($id);

        // Kiểm tra tổ chức hiện tại có phải chủ sở hữu event/result không
        $organizationId = auth('organization')->user()->organization_id;
        if ($result->event->organization_id !== $organizationId) {
            abort(403, 'Bạn không có quyền chỉnh sửa kết quả này.');
        }

        return view('contents.result_edit', compact('result'));
    }

    public function update(Request $request, $id)
    {
        $result = Result::findOrFail($id);

        $result->content = $request->content;

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagePaths = [];

            foreach ($images as $image) {
                $originalName = $image->getClientOriginalName();
                $path = $image->move('images', $originalName);
                $imagePaths[] = 'images/' . $path->getFilename();
            }

            $result->images = implode(';', $imagePaths);
        }

        $result->save();

        return redirect()->route('view.results', $result->result_id)->with('success', 'Kết quả đã được cập nhật thành công!');
    }

    public function index()
    {
        $results = $this->resultService->getLatestLimited(9);
        $hasMore = count($results) === 9;

        return view('result.index', compact('results', 'hasMore'));
    }

    public function loadMore(Request $request)
    {
        $offset = $request->query('offset', 0);
        $resultData = $this->resultService->loadMoreResults($offset);

        return response()->json($resultData);
    }

    public function show($id)
    {
        $result = $this->resultService->getResultById($id);
        return view('result.show', compact('result'));
    }

    public function showByEvent($event_id)
    {
        $result = \App\Models\Result::where('event_id', $event_id)->with('event')->first();

        if (!$result) {
            return view('result.not_found'); // hoặc redirect nếu thích
        }

        return view('result.show', compact('result'));
    }
}
