<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AssessmentAttempt extends Model
{
    protected $fillable = [
        'student_id',
        'assign_assessment_id',
        'status',
        'obtained_marks',
        'remarks'
    ];

    public function answers()
    {
        return $this->hasMany(AssessmentAttemptAnswer::class, 'assessment_attempt_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function assignAssessment()
    {
        return $this->belongsTo(AssignAssessment::class, 'assign_assessment_id');
    }

}
