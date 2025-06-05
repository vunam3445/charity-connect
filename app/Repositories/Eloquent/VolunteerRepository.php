<?php
// app/Repositories/Eloquent/VolunteerRepository.php
namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Log;
use App\Repositories\Repository\VolunteerRepositoryInterface;
use Illuminate\Support\Collection;

class VolunteerRepository implements VolunteerRepositoryInterface
{
    public function findById(string $id)
    {
        return Volunteer::findOrFail($id);
    }
    public function reject(string $note, string $id)
    {
        
    }
    public function getAll()
    {
        return Volunteer::orderBy('created_at', 'desc')->paginate(10);
    }
    public function getPending()
    {
        return Volunteer::where('approved', 'pending')->paginate(10);
    }
    public function getApproved()
    {
        return Volunteer::where('approved', 'approved')->paginate(10);
    }
    public function getRejected()
    {
        return Volunteer::where('approved', 'rejected')->paginate(10);
    }
    public function approve(string $id)
    {
        $volunteer = Volunteer::findOrFail($id);
        $volunteer->approved = 'approved';
        $volunteer->save();
        return $volunteer;
    }

public function getTopVolunteersLastMonth(int $limit = 3)
{
    $now = Carbon::now();

    $startDate = $now->copy()->subMonthNoOverflow()->startOfMonth();
    $endDate = $now->copy()->subMonthNoOverflow()->endOfMonth();

    return DB::table('volunteer_event as ve')
        ->join('volunteers as v', 'v.volunteer_id', '=', 've.volunteer_id')
        ->select(
            'v.volunteer_id',
            'v.username',
            'v.avatar',
            DB::raw('COUNT(ve.id) as participation_count')
        )
        ->where('ve.status', 'completed')
        ->whereBetween('ve.updated_at', [$startDate, $endDate])
        ->groupBy('v.volunteer_id', 'v.username', 'v.avatar')
        ->orderByDesc('participation_count')
        ->limit($limit)
        ->get();
}


    // VolunteerRepository.php
    public function findByIdWithEvents(string $id)
    {
        return Volunteer::with(['events'])->findOrFail($id);
    }

    public function search(string $keyword)
    {
        return Volunteer::where('username', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->orWhere('phone', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
