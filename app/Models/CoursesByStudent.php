<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoursesByStudent extends Model
{
    //
     protected $fillable = [
        'course_id',
        'student_id',
        'enrolled_at',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'enrolled_at'  => 'datetime',
        'completed_at' => 'datetime',
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
