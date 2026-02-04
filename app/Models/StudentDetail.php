<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDetail extends Model
{
    //
     protected $fillable = [
        'student_id',
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'is_current',
        'description',
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
