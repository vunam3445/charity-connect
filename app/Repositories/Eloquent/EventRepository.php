<?php

namespace App\Repositories\Eloquent;

use App\Models\Event;
use App\Models\VolunteerEvent;
use App\Repositories\Repository\EventRepositoryInterface;
use Illuminate\Support\Facades\Log;

class EventRepository implements EventRepositoryInterface
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function getAll()
    {
        return $this->event->orderBy('created_at', 'desc')->paginate(10);
    }

    public function findById(string $id)
    {
        return $this->event->with('organization:organization_id,username,representative,email,phone,address,website')
            ->findOrFail($id);
    }

    public function getPending()
    {
        return $this->event->with('organization:organization_id,username')
            ->where('approved', 'pending')
            ->paginate(10);
    }

    public function getApproved()
    {
        return $this->event->with('organization:organization_id,username')
            ->where('approved', 'approved')
            ->paginate(10);
    }

    public function getRejected()
    {
        return $this->event->with('organization:organization_id,username')
            ->where('approved', 'rejected')
            ->paginate(10);
    }

    public function approve(string $id)
    {
        $event = $this->event->findOrFail($id);
        $event->approved = 'approved';
        $event->save();
        return $event;
    }
    public function reject(string $note, string $id)
    {
        $event = $this->event->findOrFail($id);
        $event->approved = 'rejected';
        $event->note = $note;
        $event->save();
        return $event;
    }

    public function getLatestLimited(int $limit)
    {
        return $this->event->orderBy('created_at', 'desc')->take($limit)->get();
    }


    public function suggestion(string $organizationId, string $currentEventId, int $limit = 4)
    {
        return $this->event->where('organization_id', $organizationId)
            ->where('event_id', '!=', $currentEventId)
            ->where('approved', 'approved')
            ->orderBy('created_at', 'desc')
            ->take($limit)
            ->get();
    }

    public function create(array $data)
    {
        // Kiểm tra các trường bắt buộc
        $requiredFields = ['name', 'description', 'start_date', 'location', 'min_quantity', 'max_quantity', 'organization_id'];
        foreach ($requiredFields as $field) {
            if (!isset($data[$field])) {
                Log::error("Missing required field: {$field}");
                throw new \InvalidArgumentException("Thiếu trường bắt buộc: {$field}");
            }
        }

        $event = new $this->event;
        $event->name = $data['name'];
        $event->description = $data['description'];
        $event->start_date = $data['start_date'];
        $event->end_date = $data['end_date'] ?? null;
        $event->location = $data['location'];
        $event->min_quantity = $data['min_quantity'];
        $event->max_quantity = $data['max_quantity'];
        $event->quantity_now = 0;
        $event->status = 'active';
        $event->approved = 'pending';
        $event->organization_id = $data['organization_id'];

        // Xử lý ảnh
        if (isset($data['images']) && !empty($data['images'])) {

            $imageNames = [];
            foreach ($data['images'] as $image) {
                Log::error("Image: {$image}");
                $imageNames[] = $image;
            }
            $event->images = implode(';', $imageNames);
        } else {

            $event->images = null;
        }

        try {
            $event->save();

            return $event;
        } catch (\Exception $e) {

            throw $e;
        }
    }

    public function update($id, array $data)
    {
        Log::info('=== Starting EventRepository@update ===');
        Log::info('Updating event with ID: ' . $id);

        $event = $this->event->findOrFail($id);
        $event->name = $data['name'];
        $event->description = $data['description'];
        $event->start_date = $data['start_date'];
        $event->end_date = $data['end_date'];
        $event->location = $data['location'];
        $event->min_quantity = $data['min_quantity'];
        $event->max_quantity = $data['max_quantity'];
        $event->organization_id = $data['organization_id'];

        if (isset($data['images']) && count($data['images']) > 0) {
            Log::info('Processing uploaded images for update: ' . count($data['images']) . ' files');
            $imageNames = $event->images ? (is_array($event->images) ? $event->images : json_decode($event->images, true)) : [];
            foreach ($data['images'] as $image) {
                Log::info('Processing image: ' . $image->getClientOriginalName());
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $imageNames[] = $imageName;
            }
            $event->images = json_encode($imageNames);
        }
        $event->save();
        return $event;
    }



    public function delete($id)
    {
        $event = $this->event->findOrFail($id);

        if ($event->images) {
            $images = json_decode($event->images, true) ?? [$event->images];
            foreach ($images as $image) {
                $imagePath = public_path('images/' . $image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                    Log::info('Deleted image: ' . $imagePath);
                }
            }
        }

        $event->delete();
        return true;
    }

    public function registerVolunteer(string $eventId, string $volunteerId)
    {
        $event = $this->event->findOrFail($eventId);

        if ($event->volunteers()->wherePivot('volunteer_id', $volunteerId)->exists()) {
            throw new \Exception('Bạn đã đăng ký sự kiện này.');
        }

        if ($event->quantity_now >= $event->max_quantity) {
            throw new \Exception('Sự kiện đã đủ số lượng tham gia.');
        }

        if ($event->status !== 'active') {
            throw new \Exception('Sự kiện hiện không hoạt động.');
        }

        if ($event->approved !== 'approved') {
            throw new \Exception('Sự kiện chưa được duyệt.');
        }

        $event->volunteers()->attach($volunteerId, [
            'status' => 'registered',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $event->increment('quantity_now');
        Log::info('Volunteer ' . $volunteerId . ' registered for event ' . $eventId);

        return true;
    }

    public function unregisterVolunteer(string $eventId, string $volunteerId)
    {
        Log::info('Attempting to unregister volunteer ' . $volunteerId . ' from event ' . $eventId);
        $event = $this->event->findOrFail($eventId);

        if (!$event->volunteers()->wherePivot('volunteer_id', $volunteerId)->exists()) {
            Log::warning('Volunteer ' . $volunteerId . ' not found in event ' . $eventId);
            throw new \Exception('Bạn chưa đăng ký tham gia sự kiện này.');
        }

        $event->volunteers()->detach($volunteerId);
        $event->decrement('quantity_now');
        Log::info('Volunteer ' . $volunteerId . ' successfully unregistered from event ' . $eventId);

        return true;
    }

    public function search(string $keyword)
    {
        return $this->event->where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orWhere('location', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function completeEvent(string $id)
    {
        $event = Event::findOrFail($id);
        $event->status = 'completed';
        $event->save();
        return $event;
    }

    public function getEventByVolunteer(string $volunteerId, string $status = 'active')
    {
        return VolunteerEvent::where('volunteer_id', $volunteerId)
            ->whereHas('event', function ($query) use ($status) {
                $query->where('status', $status); // Chỉ lấy sự kiện đang active
            })
            ->with(['event' => function ($query) {
                $query->with(['organization', 'volunteers']);
            }])
            ->get();
    }



    public function getRegisteredEvents($volunteerId)
    {
        Log::info('EventRepository::getRegisteredEvents called with volunteerId: ' . $volunteerId);

        try {
            $query = $this->event->whereHas('volunteers', function ($query) use ($volunteerId) {
                $query->where('volunteer_event.volunteer_id', $volunteerId);
            })->with(['organization']);
            $events = $query->get();
            return $events;
        } catch (\Exception $e) {

            throw $e;
        }
    }
}
