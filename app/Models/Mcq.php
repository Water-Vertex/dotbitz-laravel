<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    protected $table = 'mcqs';
    protected $primaryKey = 'msq_id';
    public $timestamps = true;


    protected $fillable = [
        'question',
        'answer',
        'options',
        'course_id',
        'status',
        'issingle'
    ];

    protected $casts = [
        'options' => 'array',
        'issingle' => 'boolean'
    ];

    /**
     * ✅ Relationship with Course
     * Make sure this doesn't cause circular loading
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
