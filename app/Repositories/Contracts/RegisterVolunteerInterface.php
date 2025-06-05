<?php

namespace App\Repositories\Contracts;

interface RegisterVolunteerInterface
{
    public function registerVolunteer(string $eventId, string $volunteerId);
    public function getRegisteredEvents($volunteerId);
}