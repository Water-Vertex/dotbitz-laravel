<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $table = 'quiz_attempts';

    protected $fillable = [
        'student_id',
        'quiz_id',
        'status',
        'obtained_marks',
        'remarks',
        'is_checked',
        'is_overdue',
        'is_reattempt',

    ];

    public function student()
{
    return $this->belongsTo(Student::class, 'student_id');
}


    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers()
    {
        return $this->hasMany(QuizAttemptAnswer::class);
    }
}
