<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignAssessment extends Model
{
    protected $fillable = [
        'appointment_id',
        'assessment_id',
        'time_to_complete',
        'total_marks',
        'obtain_marks',
        'remarks',
        'status'
    ];
    public function assessment_query()
    {
        return $this->belongsTo(AssessmentQuery::class, 'appointment_id');
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function attempt()
{
    return $this->hasOne(AssessmentAttempt::class, 'assign_assessment_id');
}

}
