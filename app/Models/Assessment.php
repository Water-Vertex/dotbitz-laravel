<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    //
    protected $fillable = [
    'question',
    'answer',
    'options',
    'course_id',
    'assessment_type',
    'status',
    'is_single',
];
protected $casts = [
    'options' => 'array',
    'is_single' => 'boolean',
];
public function course()
{
    return $this->belongsTo(Course::class);
}
}
