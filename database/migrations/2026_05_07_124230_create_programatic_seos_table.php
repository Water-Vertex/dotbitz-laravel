<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programatic_seos', function (Blueprint $table) {
            $table->id();
            $table->text('focus_keyword')->nullable();
            $table->text('content')->nullable();
            $table->text('image')->nullable();
            $table->text('image_alt')->nullable();
            $table->text('h1_heading')->nullable();
            $table->text('faqs')->nullable();
            $table->text('section_content_left')->nullable();
            $table->text('section_content_right')->nullable();
            $table->text('image_left')->nullable();
            $table->text('image_right')->nullable();
            $table->text('image_left_alt')->nullable();
            $table->text('image_right_alt')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programatic_seos');
    }
};