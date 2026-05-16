<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentAttempt extends Model
{
    protected $table = 'assignment_attempts';

    protected $fillable = [
        'assignment_id',
        'student_id',
        'doc_file',
        'submitted_at',
        'marks',
        'remarks',
        'is_late',
    ];

    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
