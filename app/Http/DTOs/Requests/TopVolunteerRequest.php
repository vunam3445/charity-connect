<?php
// app/DTOs/TopVolunteerDTO.php
namespace App\Http\DTOs\Requests;

class TopVolunteerRequest
{
    public function __construct(
        public string $volunteer_id,
        public int $participation_count,
        public int $quarter,
        public int $year,
    ) {}
}
