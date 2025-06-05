<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAll extends Model
{
    use HasFactory;

    protected $table = 'notifications_all';
    protected $primaryKey = 'notification_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['notification_id', 'title', 'content'];
}
