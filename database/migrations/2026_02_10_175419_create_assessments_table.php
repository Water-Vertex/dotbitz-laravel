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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');            // Correct answer(s) (comma separated if multiple)
            $table->json('options');           // JSON array of options
            $table->unsignedBigInteger('course_id');
            $table->enum('assessment_type', ['mcqs', 'q-a']);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_single')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
