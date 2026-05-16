<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class Student extends Authenticatable
{
    //
     use HasFactory, Notifiable, HasApiTokens;
    protected $fillable = [
        'student_uid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'state',
        'city',
        'zipcode',
        'password',
    ];

    public function studentDetails()
    {
        return $this->hasMany(StudentDetail::class);
    }

//    public function guardian()
//     {
//         return $this->belongsToMany(Guardian::class,  'student_id', 'guardian_id');
//     }

public function guardian()
{
    return $this->belongsTo(Guardian::class, 'guardian_id');
}
}
