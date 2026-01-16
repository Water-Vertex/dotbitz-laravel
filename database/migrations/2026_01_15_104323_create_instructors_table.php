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
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('instructor_uid',50)->nullable()->unique();
            $table->string('first_name',100)->nullable();
            $table->string('last_name',100)->nullable();
            $table->string('user_name',100)->nullable();
            $table->string('email',50)->nullable()->unique();
            $table->string('phone',20)->nullable()->unique();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('address',255)->nullable();
            $table->string('state',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('zipcode',255)->nullable();
            $table->string('work_experience',50)->nullable();
            $table->string('salary',50)->nullable();
            $table->string('password',255)->nullable();
            $table->string('status',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructors');
    }
};
