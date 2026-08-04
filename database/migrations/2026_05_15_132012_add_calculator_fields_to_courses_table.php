<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->integer('classes_per_week')->nullable()->after('course_duration');
            $table->integer('total_classes')->nullable()->after('classes_per_week');
            $table->string('course_hours')->nullable()->after('total_classes');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['classes_per_week', 'total_classes', 'course_hours']);
        });
    }
};