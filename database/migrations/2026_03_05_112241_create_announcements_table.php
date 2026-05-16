<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('message');
            $table->enum('announced_by', ['admin', 'instructor'])->default('admin');
            $table->unsignedBigInteger('announced_by_id'); // admin id ya instructor id
            $table->enum('status', ['draft', 'sent', 'scheduled'])->default('draft');
            $table->enum('priority', ['low', 'normal', 'high'])->default('normal');
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};