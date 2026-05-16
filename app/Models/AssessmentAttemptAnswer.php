<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AssessmentAttemptAnswer extends Model
{
    protected $fillable = 
    ['assessment_attempt_id', 
    'question_id',
     'student_answer', 
     'is_correct'];

   
    public function question()
    {
        return $this->belongsTo(AssessmentQuestion::class, 'question_id');
    }
}