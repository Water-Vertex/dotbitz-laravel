<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'message',
        'announced_by',
        'announced_by_id',
        'status',
        'priority',
        'target_type',
        'course_id',
        'batch_id',
        'target_instructor_ids',
        'scheduled_at',
        'sent_at',
    ];

    protected $casts = [
        'scheduled_at'          => 'datetime',
        'sent_at'               => 'datetime',
        'target_instructor_ids' => 'array',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    
}