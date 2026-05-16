<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Testing\Fluent\Concerns\Has;
use Laravel\Sanctum\HasApiTokens;

class Instructor extends Authenticatable
{
    //
    use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'instructor_uid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'phone',
        'gender',
        'address',
        'state',
        'city',
        'zipcode',
        'work_experience',
        'salary',
        'status',
        'password'
    ];

    public function details()
    {
        return $this->hasMany(InstructorDetail::class,'instructor_id');
    }
    // public function courses()
    // {
    //     return $this->hasMany(Course::class);
    // }

    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }
    public function courses()
{
    return $this->belongsToMany(Course::class, 'course_instructor', 'instructor_id', 'course_id');
}

// public function courses()
//     {
//         return $this->hasMany(Course::class, 'instructor_id');
//     }

    // CourseInstructor pivot se bhi courses (agar course_instructor table use ho)
    public function assignedCourses()
    {
        return $this->belongsToMany(Course::class, 'course_instructor', 'instructor_id', 'course_id');
    }


    public function getFullNameAttribute(): string
    {
        return trim(($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }
    public function getTotalStudentsAttribute(): int
    {
        return CoursesByStudent::whereIn('course_id', $this->courses->pluck('id'))->count();
    }
}
