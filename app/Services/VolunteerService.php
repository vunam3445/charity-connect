<?php

namespace App\Services;

use App\Repositories\Repository\VolunteerRepositoryInterface;
use App\Http\DTOs\Requests\TopVolunteerRequest;
use Carbon\Carbon;

class VolunteerService
{
    protected $volunteerRepo;

    public function __construct(VolunteerRepositoryInterface $volunteerRepo)
    {
        $this->volunteerRepo = $volunteerRepo;
    }
    // lấy thông tin profile của tình nguyện viên
    public function getProfile(string $id)
    {
        return $this->volunteerRepo->findById($id);
    }

    // lấy top tình nguyện viên trong tháng vừa qua
    public function getTopVolunteersLastMonth(int $limit = 3)
    {
        return $this->volunteerRepo->getTopVolunteersLastMonth($limit);
    }

    // VolunteerService.php
    public function getProfileWithEvents(string $id)
    {
        return $this->volunteerRepo->findByIdWithEvents($id);
    }

    
}
