<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'name',
        'marks',
        'status',
        'duration',
        'course_id',
        'batch_id',
        'start_date',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'marks'    => 'float',
        'duration' => 'integer',
    ];

    // Relationships
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

public function mcqs()
{
    return $this->belongsToMany(Mcq::class, 'quiz_mcqs', 'quiz_id', 'mcq_id');
}

}