<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feedback extends Model
{
    use HasFactory;

 

    // Khóa chính của bảng
    protected $primaryKey = 'feedback_id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Các cột có thể truy cập và thay đổi
    protected $fillable = ['event_id', 'volunteer_id', 'content'];

    // Quan hệ với Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    // Quan hệ với Volunteer
    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id', 'volunteer_id');
    }
}
