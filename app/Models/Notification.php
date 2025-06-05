<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    protected $primaryKey = 'notification_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['notification_id', 'event_id', 'title', 'content'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'notification_volunteer', 'notification_id', 'volunteer_id')->withTimestamps();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'organization_id');
    }
}
