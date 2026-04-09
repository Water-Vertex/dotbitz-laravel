<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //
    protected $fillable = [

    'course_id',
    'assessment_title',
    'total_marks',
];
protected $casts = [
    'options' => 'array',
    'is_single' => 'boolean',
];
public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function questions()
    {
        return $this->hasMany(AssessmentQuestion::class);
    }
}
