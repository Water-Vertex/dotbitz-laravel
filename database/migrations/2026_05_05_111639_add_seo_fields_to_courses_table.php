<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
             $table->text('meta_title')->nullable()->after('short_description');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->text('meta_keyword')->nullable()->after('meta_description');
            $table->text('meta_tags')->nullable()->after('meta_keyword');
            $table->string('focus_keyword')->nullable()->after('meta_tags');
            $table->longText('page_schema')->nullable()->after('focus_keyword');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
                $table->dropColumn([
                'meta_title',
                'meta_description',
                'meta_keyword',
                'meta_tags',
                'focus_keyword',
                'page_schema'
            ]);
        });
    }
};
