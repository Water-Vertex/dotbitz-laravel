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
        'age_limit',
        'start_date',
        'end_date',
        'status',
        'is_featured',
        'instructor_id',
        'thumbnail_image',
        'benefits',

        'short_description',
         'meta_title', 
         'meta_description', 
         'meta_keyword',
    'meta_tags',
     'focus_keyword',
      'page_schema',
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

        /**
        * Relationship: Course has many Class Schedules
        */
    public function classSchedules()
    {
        return $this->hasMany(ClassSchedule::class);
    }


    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

     public function announcements()
    {
        return $this->hasMany(Announcement::class);
    }

    public function assessmentQueries()
    {
        return $this->hasMany(AssessmentQuery::class);
    }

    public function instructors()
{
    return $this->belongsToMany(Instructor::class, 'course_instructor', 'course_id', 'instructor_id');
}

public function curriculums()
    {
        return $this->hasMany(CourseCurriculum::class)->orderBy('sorting_order');
    }
}
