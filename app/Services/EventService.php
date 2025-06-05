<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Repositories\Repository\EventRepositoryInterface;


class EventService
{


    public function __construct(protected EventRepositoryInterface $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function create(array $data)
    {
        return $this->eventRepo->create($data);
    }



    public function update(string $id, array $data)
    {
        return $this->eventRepo->update($id, $data);
    }

    public function delete(string $id)
    {
        return $this->eventRepo->delete($id);
    }

    public function registerVolunteer(string $eventid, string $volunteerid)
    {
        return $this->eventRepo->registerVolunteer($eventid, $volunteerid);
    }

    public function unregisterVolunteer(string $eventid, string $volunteerid)
    {
        return $this->eventRepo->unregisterVolunteer($eventid, $volunteerid);
    }

    // lấy danh sách event chưa được duyệt
    public function getPendingEvents()
    {
        return $this->eventRepo->getPending();
    }

    // duyệt event 
    public function approve(string $id)
    {
        return $this->eventRepo->approve($id); // ĐÃ GỌI save() bên trong rồi
    }

    public function reject(string $note, string $id)
    {
        return $this->eventRepo->reject($note, $id); // ĐÃ GỌI save() bên trong rồi
    }


    // lấy danh sách event 
    public function getAllEvents()
    {
        return $this->eventRepo->getAll();
    }

    // lấy danh sách event đã được duyệt
    public function getApprove()
    {
        return $this->eventRepo->getApproved();
    }

    // lấy danh sách event đã bị từ chối
    public function getRejected()
    {
        return $this->eventRepo->getRejected();
    }
    // lấy thông tin chi tiết event
    public function getEventById($id)
    {
        return $this->eventRepo->findById($id);
    }

    public function findById($id)
    {
        return $this->eventRepo->findById($id);
    }

    // Lấy 9 sự kiện mới nhất (dùng cho trang index)
    public function getLatestLimited($limit = 9)
    {
        return Event::where('approved', 'approved') // chỉ lấy event đã duyệt
            ->orderByDesc('created_at')
            ->limit($limit)
            ->get();
    }


    // Lấy thêm nhiều sự kiện theo offset và điều kiện
    public function loadMoreEvents($offset, $status = null, $limit = 9)
    {
        $query = Event::where('approved', 'approved') // chỉ lấy event đã duyệt
            ->orderBy('created_at', 'desc');

        if ($status === 'active') {
            $query->where('status', 'active');
        } elseif ($status === 'ended') {
            $query->where('status', 'end');
        }

        $total = $query->count();
        $events = $query->skip($offset)->take($limit)->get();
        $hasMore = ($offset + $limit) < $total;

        return ['events' => $events, 'hasMore' => $hasMore];
    }
    public function adminProfile($id)
    {
        return $this->eventRepo->findById($id);
    }


    public function suggestion(string $organizationId, string $currentEventId, int $limit = 4)
    {
        return $this->eventRepo->suggestion($organizationId, $currentEventId, $limit);
    }

    public function search(string $keyword)
    {
        return $this->eventRepo->search($keyword);
    }

    public function completeEvent($id)
    {
        return $this->eventRepo->completeEvent($id);
    }

    public function getEventByVolunteer($volunteerId, $status = 'active')
    {
        return $this->eventRepo->getEventByVolunteer($volunteerId, $status);
    }

    public function getRegisteredEvents(string $volunteerId)
    {
        Log::info('EventService::getRegisteredEvents called with volunteerId: ' . $volunteerId);

        try {
            $events = $this->eventRepo->getRegisteredEvents($volunteerId);

            return $events;
        } catch (\Exception $e) {
    
            throw $e;
        }
    }

}
