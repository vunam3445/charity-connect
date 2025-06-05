<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Follow extends Model
{
     protected $table = 'follows';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'volunteer_id', 'organization_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
