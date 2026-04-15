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
        'batch_id',
        'start_date',
        'active_status',
        'description',
    ];

     public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function batch()
{
    return $this->belongsTo(Batch::class);
}

public function attempts()
{
    return $this->hasMany(AssignmentAttempt::class);
}
}
