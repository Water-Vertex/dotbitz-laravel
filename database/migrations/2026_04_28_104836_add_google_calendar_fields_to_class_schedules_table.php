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
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->string('google_event_id')->nullable()->after('note');
            $table->text('google_calendar_link')->nullable()->after('google_event_id');
            $table->timestamp('last_synced_at')->nullable()->after('google_calendar_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_schedules', function (Blueprint $table) {
            $table->dropColumn(['google_event_id', 'google_calendar_link', 'last_synced_at']);
        });
    }
};