<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCurriculum extends Model
{
    protected $fillable = [
    'course_id',
    'title',
    'description',
    'duration',
    'sorting_order',
];



public function course()
{
    return $this->belongsTo(Course::class);
}
}

