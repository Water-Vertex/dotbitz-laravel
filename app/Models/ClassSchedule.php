<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    //
    protected $fillable = [
        'course_id',
        'instructor_id',
        'start_time',
        'end_time',
        'meeting_link',
        'duration',
        'status',
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
