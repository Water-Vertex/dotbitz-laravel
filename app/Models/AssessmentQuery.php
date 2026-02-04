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
}
