<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizMcq extends Model
{
    
    protected $fillable = [
        'quiz_id',
        'mcq_id',
        ];
        
        public function course()
    {
        return $this->belongsTo(Course::class);
    }
}