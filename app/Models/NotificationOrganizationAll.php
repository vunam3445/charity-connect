<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationOrganizationAll extends Model
{
    use HasFactory;

    protected $table = 'notifications_organization_all';
    protected $primaryKey = 'notification_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['notification_id', 'title', 'content'];
}
