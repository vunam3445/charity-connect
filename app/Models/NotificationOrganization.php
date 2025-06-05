<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationOrganization extends Model
{
    use HasFactory;

    protected $table = 'notifications_organization';
    protected $primaryKey = 'notification_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['notification_id', 'organization_id', 'title', 'content'];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'organization_id');
    }
}
