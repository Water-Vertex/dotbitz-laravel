<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    //
    protected $fillable = [

        'student_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'relationship',
        'date_of_birth',
        'gender',
        'address',
        'state',
        'city',
        'zipcode',
        'password',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
