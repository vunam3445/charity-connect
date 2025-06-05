<?php

namespace App\Repositories\Contracts;

interface UnregisterVolunteerInterface
{
    public function unregisterVolunteer(string $eventId, string $volunteerId);
    
}