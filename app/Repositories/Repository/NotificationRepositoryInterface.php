<?php

namespace App\Repositories\Repository;

interface NotificationRepositoryInterface
{
    public function sendToAllVolunteers(array $data);
    public function sendToAllOrganizations(array $data);
    public function sendToOneOrganization(string $organizationId, array $data);
    public function sendToEventVolunteers(string $eventId, array $data);

    public function getNotificationsForVolunteer(string $volunteerId);
    public function getNotificationsSentByOrganization(string $organizationId);
    public function getAllNotificationsSentByAdmin();
}
