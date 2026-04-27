<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuery extends Model
{
    //
     protected $fillable = [
        'full_name',
        'email',
        'phone',
        'course_id',
        'message',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function assigned()
    {
        // Relationship name 'assigned' as you requested
        return $this->hasOne(AssignAssessment::class, 'appointment_id');
    }
    // In AssessmentAttempt.php Model
public function guest()
{
    return $this->belongsTo(AssessmentQuery::class, 'guest_id', 'email');
}
}
