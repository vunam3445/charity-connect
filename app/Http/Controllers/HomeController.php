<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Result;
use Illuminate\Http\Request;
use App\Services\VolunteerService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $volunteerService;


    public function __construct(VolunteerService $volunteerService)
    {
        $this->volunteerService = $volunteerService;
    }

    public function index()
    {
        $userId = session('user_id');
        $userType = session('user_type');

        $events = Event::where('approved', 'approved') // chỉ lấy những event đã duyệt
            ->where('status', 'active') // chỉ lấy những event đang hoạt động
            ->orderByDesc('updated_at')      // mới nhất trước
            ->take(12)
            ->get();


        $results = Result::with('event')->latest()->take(12)->get();
        $topVolunteers = $this->volunteerService->getTopVolunteersLastMonth(3);

        // Sự kiện sắp diễn ra
        $upcomingEvents = Event::whereBetween('start_date', [Carbon::now(), Carbon::now()->addDays(5)])
            ->where('approved', 'approved')
            ->where('status', 'active')
            ->orderByDesc('start_date')
            ->limit(9)
            ->get();

        // Sự kiện từ các tổ chức đang follow (nếu là tình nguyện viên)
        $followedEvents = collect();
        if ($userType === 'volunteer' && $userId) {
            $followedOrgIds = DB::table('follows')
                ->where('volunteer_id', $userId)
                ->pluck('organization_id');

            $followedEvents = Event::whereIn('organization_id', $followedOrgIds)
                ->where('approved', 'approved')
                ->where('status', 'active')
                ->orderByDesc('updated_at')
                ->limit(9)
                ->get();
        }


        return view('home', compact(
            'events',
            'results',
            'topVolunteers',
            'upcomingEvents',
            'followedEvents'
        ));
    }

    public function indexAdmin()
    {
        return view('admin.admin');
    }
}
