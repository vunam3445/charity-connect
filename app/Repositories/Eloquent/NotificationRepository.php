<?php

namespace App\Repositories\Eloquent;

use App\Models\Notification;
use App\Models\NotificationAll;
use App\Models\NotificationOrganization;
use App\Models\NotificationVolunteer;
use App\Models\VolunteerEvent;
use App\Repositories\Repository\NotificationRepositoryInterface;
use Illuminate\Support\Str;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function sendToAllVolunteers(array $data)
    {
        $notification = NotificationAll::create([
            'notification_id' => Str::uuid(),
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
        return $notification;
    }

    public function sendToAllOrganizations(array $data)
    {
        return NotificationOrganization::create([
            'notification_id' => Str::uuid(),
            'organization_id' => null,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
    }

    public function sendToOneOrganization(string $organizationId, array $data)
    {
        return NotificationOrganization::create([
            'notification_id' => Str::uuid(),
            'organization_id' => $organizationId,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);
    }

    public function sendToEventVolunteers(string $eventId, array $data)
    {
        $notification = Notification::create([
            'notification_id' => Str::uuid(),
            'event_id' => $eventId,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        $volunteerIds = VolunteerEvent::where('event_id', $eventId)->pluck('volunteer_id');

        foreach ($volunteerIds as $volunteerId) {
            NotificationVolunteer::create([
                'notification_id' => $notification->notification_id,
                'volunteer_id' => $volunteerId,
            ]);
        }

        return $notification;
    }

    public function getNotificationsForVolunteer(string $volunteerId)
    {
        return Notification::whereHas('volunteers', function ($q) use ($volunteerId) {
            $q->where('volunteer_id', $volunteerId);
        })->latest()->get();
    }

    public function getNotificationsSentByOrganization(string $organizationId)
    {
        return NotificationOrganization::where('organization_id', $organizationId)->latest()->get();
    }

    public function getAllNotificationsSentByAdmin()
    {
        return NotificationAll::latest()->get();
    }
}
