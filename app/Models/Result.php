<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;
    protected $table = 'results';
    protected $primaryKey = 'result_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'event_id');
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'result_id', 'result_id');
    }
}
