<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            $table->string('home_focus_keyword')->nullable()->after('home_page_schema');
            $table->string('about_focus_keyword')->nullable()->after('about_page_schema');
            $table->string('contact_focus_keyword')->nullable()->after('contact_page_schema');
            $table->string('service_focus_keyword')->nullable()->after('service_page_schema');
            $table->string('course_focus_keyword')->nullable()->after('course_page_schema');
            $table->string('faq_focus_keyword')->nullable()->after('faq_meta_tags');
        });
    }

    public function down()
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            $table->dropColumn([
                'home_focus_keyword',
                'about_focus_keyword',
                'contact_focus_keyword',
                'service_focus_keyword',
                'course_focus_keyword',
                'faq_focus_keyword'
            ]);
        });
    }
};