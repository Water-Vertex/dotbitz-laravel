<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    protected $table = 'course_instructor';

    protected $fillable = [
        'course_id',
        'instructor_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
