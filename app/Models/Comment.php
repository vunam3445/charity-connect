<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'result_id', 'volunteer_id', 'name', 'content'
    ];

    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id', 'result_id');
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'volunteer_id', 'volunteer_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'result_id', 'result_id');
    }
}
