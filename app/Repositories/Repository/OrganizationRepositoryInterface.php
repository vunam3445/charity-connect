<?php 
namespace App\Repositories\Repository;

use App\Repositories\Contracts\ManagementActionsRepositoryInterface;
use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\Contracts\QrRepositoryInterface;

interface OrganizationRepositoryInterface extends BaseRepositoryInterface, ManagementActionsRepositoryInterface, QrRepositoryInterface
{
    public function getAll();
    public function findById(string $id);
    public function getPending();
    public function getApproved();
    public function getRejected();
    public function approve(string $id);
    public function reject(string $note,string $id);
    public function createQrcode(array $data): string;
    public function search(string $keyword);
    public function getEventPeding(string $organizationId);
    public function getEventRejected(string $organizationId);
}