<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Result;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;
    protected $primaryKey = 'event_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'organization_id');
    }

    public function volunteers()
    {
        return $this->belongsToMany(Volunteer::class, 'volunteer_event', 'event_id', 'volunteer_id')
            ->withPivot('status', 'created_at', 'updated_at')
            ->withTimestamps();
    }

    protected $fillable = [
        'event_id', 'organization_id', 'name', 'description', 'start_date', 'end_date',
        'location', 'min_quantity', 'max_quantity', 'quantity_now', 'note', 'status',
        'approved', 'image'
    ];

    protected $casts = [
        'images' => 'array', // Cast cột images thành mảng
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function results()
    {
        return $this->hasOne(Result::class, 'event_id', 'event_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'event_id', 'event_id');
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'event_id', 'event_id');
    }

    public function result()
    {
        return $this->hasMany(Result::class, 'event_id', 'event_id');
    }

    protected static function booted()
    {
        static::creating(function ($event) {
            if (empty($event->event_id)) {
                $event->event_id = (string) Str::uuid();
            }
        });
    }
}
