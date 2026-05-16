<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'user_type', 'course_id',
        'rating', 'review', 'reviewer_name', 'status',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}