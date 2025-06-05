<?php

namespace App\Repositories\Repository;

use App\Repositories\Contracts\ManagementActionsRepositoryInterface;
use App\Repositories\Contracts\BaseRepositoryInterface;

interface EventRepositoryInterface extends BaseRepositoryInterface, ManagementActionsRepositoryInterface
{
    public function getAll();
    public function findById(string $id);
    public function getPending();
    public function getApproved();
    public function getRejected();
    public function approve(string $id);
    public function reject(string $note,string $id);

    public function create(array $data);
    public function update(string $id, array $data);
    public function delete(string $id);

    public function registerVolunteer(string $eventId, string $volunteerId);

    public  function unregisterVolunteer(string $evendId, string $volunteerId);

    public function getLatestLimited(int $limit);

    public function suggestion(string $organizationId, string $currentEventId, int $limit = 4);
    public function search(string $keyword);
    public function completeEvent(string $id);
    public function getEventByVolunteer(string $volunteerId, string $status = 'activce');

    public function getRegisteredEvents( string $volunteerId);

}
