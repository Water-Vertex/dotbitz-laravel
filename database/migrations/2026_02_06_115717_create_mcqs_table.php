<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');            // Correct answer(s) (comma separated if multiple)
            $table->json('options');           // JSON array of options
            $table->unsignedBigInteger('course_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_single')->default(true); // single or multiple correct answer
            $table->timestamps();

            // Optional foreign key
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mcqs');
    }
};
