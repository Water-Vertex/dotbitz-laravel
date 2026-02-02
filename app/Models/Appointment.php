<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'phone',
        'course_id',
        'appointment_date',
        'appointment_time',
        'message',
    ];
}
