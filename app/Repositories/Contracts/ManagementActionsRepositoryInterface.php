<?php 
namespace App\Repositories\Contracts;

interface ManagementActionsRepositoryInterface
{
    public function getApproved();
    public function getPending();
    public function getRejected();
    public function approve(string $id);
    public function reject(string $note,string $id);
}
