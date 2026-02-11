<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'course_id',
        'title',
        'assignment_file',
        'due_date',
        'uploaded_at',
        'total_marks',
    ];

     public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
