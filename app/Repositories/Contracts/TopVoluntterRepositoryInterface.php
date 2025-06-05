<?php
namespace App\Repositories\Contracts;
use Illuminate\Support\Collection;
use App\Http\DTOs\Requests\TopVolunteerRequest;

interface TopVoluntterRepositoryInterface 
{
    public function getTopVolunteersLastMonth(int $limit = 3);   

}
