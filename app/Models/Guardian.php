<?php

namespace App\Models;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guardian extends Authenticatable
{
    //
    use HasApiTokens, Notifiable;
    protected $fillable = [

        'student_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'relationship',
        // 'date_of_birth',
        'gender',
        'address',
        'state',
        'city',
        'zipcode',
        'password',
    ];

     public function students()
    {
        return $this->belongsToMany(Student::class,  'guardian_id', 'student_id');
    }

}
