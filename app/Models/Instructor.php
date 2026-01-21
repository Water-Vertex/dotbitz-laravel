<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    //
    protected $fillable = [
        'instructor_uid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'phone',
        'gender',
        'address',
        'state',
        'city',
        'zipcode',
        'work_experience',
        'salary',
        'status',
        'password'
    ];

    public function details()
    {
        return $this->hasMany(InstructorDetail::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
