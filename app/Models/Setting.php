<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'favicon', 'main_logo', 'footer_logo',
        'facebook', 'twitter', 'linkedin', 'instagram', 'pintrest', 'youtube',
        'email', 'about', 'site_title',
        'meta_title', 'meta_tags', 'meta_desc', 'meta_keywords',
        'head_tags', 'body_tags',
        'phone', 'address',
    ];

    public static function getSettings(): self
    {
        return static::first() ?? new static();
    }
}
