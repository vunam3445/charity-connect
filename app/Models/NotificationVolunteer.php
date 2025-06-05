<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationVolunteer extends Model
{
    use HasFactory;

    protected $table = 'notification_volunteer';
    protected $primaryKey = 'notification_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['notification_id', 'volunteer_id', 'title', 'content'];

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id', 'volunteer_id');
    }
}
