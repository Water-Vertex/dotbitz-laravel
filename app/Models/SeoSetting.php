<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        'home_meta_title', 'home_meta_description', 'home_meta_keywords', 
        'home_meta_tags', 'home_title', 'home_page_schema',
        'about_meta_title', 'about_meta_description', 'about_meta_keywords',
        'about_meta_tags', 'about_title', 'about_page_schema',
        'contact_meta_title', 'contact_meta_description', 'contact_meta_keywords',
        'contact_meta_tags', 'contact_title', 'contact_page_schema',
        'service_meta_title', 'service_meta_description', 'service_meta_keywords',
        'service_meta_tags', 'service_title', 'service_page_schema',
        'course_meta_title', 'course_meta_description', 'course_meta_keywords',
        'course_meta_tags', 'course_page_schema',
        'faq_meta_title', 'faq_meta_description', 'faq_meta_keywords', 'faq_meta_tags',
    ];

    protected $casts = [
        'home_page_schema'    => 'array',
        'about_page_schema'   => 'array',
        'contact_page_schema' => 'array',
        'service_page_schema' => 'array',
        'course_page_schema'  => 'array',
    ];

    public static function getSettings(): self
    {
        return static::first() ?? new static();
    }
}