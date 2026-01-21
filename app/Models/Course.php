<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //

     /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'course_name',
        'slug',
        'course_code',
        'course_description',
        'course_duration',
        'course_fee',
        'course_level',
        'start_date',
        'end_date',
        'status',
        'is_featured',
        'instructor_id',
        'thumbnail_image',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'course_fee' => 'decimal:2',
        'course_duration' => 'integer',
    ];

    /**
     * Default attribute values.
     */
    protected $attributes = [
        'is_featured' => false,
        'status' => 'Inactive',
    ];

    /**
     * Relationship: Course belongs to an Instructor
     */
    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

}
