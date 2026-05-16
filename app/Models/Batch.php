<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'course_id',
        'instructor_id',
        'start_date',
        'end_date',
        'description',
        'students',
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

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function coursesByStudents()
    {
        return $this->hasMany(CoursesByStudent::class);
    }


}
