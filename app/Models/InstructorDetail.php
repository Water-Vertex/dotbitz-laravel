<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorDetail extends Model
{
    //
    protected $fillable = [
        'instructor_id',
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'is_current',
        'description'
    ];
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
