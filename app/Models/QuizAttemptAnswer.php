<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttemptAnswer extends Model
{
    protected $table = 'quiz_attempt_answers';

    protected $fillable = [
        'quiz_attempt_id',
        'mcq_id',
        'student_answer',
    ];

    public function attempt()
    {
        return $this->belongsTo(QuizAttempt::class, 'quiz_attempt_id');
    }

 public function mcq()
{
    return $this->belongsTo(Mcq::class, 'mcq_id', 'id');
}
}