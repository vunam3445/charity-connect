<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerEvent extends Model
{
    use HasFactory;

    protected $table = 'volunteer_event'; // bảng đang dùng (không phải volunteer_events số nhiều)

    protected $fillable = [
        'event_id',
        'volunteer_id',
        'status',
    ];


    /**
     * Relationship: VolunteerEvent belongs to an Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    /**
     * Relationship: VolunteerEvent belongs to a Volunteer
     */
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id', 'volunteer_id');
    }
}
