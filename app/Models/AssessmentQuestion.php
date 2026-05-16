<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentQuestion extends Model
{
    //
    protected $fillable = [
        'assessment_id',
        'question',
        'answer',
        'options',
         'assessment_type',
        'status',
        'is_single',
        'marks',
    ];
    protected $casts = [
    'options' => 'array',
    'is_single' => 'boolean',
];
}
