<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Status column ko update karo — responded add karo
        \DB::statement("ALTER TABLE support_tickets MODIFY COLUMN status ENUM('pending','in_review','responded','resolved','closed') DEFAULT 'pending'");
    }

    public function down(): void
    {
        \DB::statement("ALTER TABLE support_tickets MODIFY COLUMN status ENUM('pending','in_review','resolved','closed') DEFAULT 'pending'");
    }
};