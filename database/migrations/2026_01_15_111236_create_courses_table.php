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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name',255);
            $table->string('slug',255);
            $table->string('course_code',255);
            $table->text('course_description')->nullable();
            $table->integer('course_duration')->nullable(); // duration in hours
            $table->decimal('course_fee', 8, 2)->nullable();
            $table->string('course_level',100)->nullable(); // e.g., Beginner, Intermediate, Advanced
            $table->string('start_date',50)->nullable();
            $table->string('end_date',50)->nullable();
            $table->string('status',50)->nullable(); // e.g., Active, Inactive
            $table->boolean('is_featured')->default(false);
            $table->foreignId('instructor_id')->constrained()->onDelete('cascade');
            $table->string('thumbnail_image',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
