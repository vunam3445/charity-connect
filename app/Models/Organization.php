<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'organization_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 'email', 'password' // thêm các cột cần thiết nếu có
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function events()
    {
        return $this->hasMany(Event::class, 'organization_id', 'organization_id');
    }

public function followers()
{
    return $this->hasMany(Follow::class, 'organization_id');
}
}
