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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 100)->unique();
            $table->foreignId('guardian_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('student_id')->constrained()->onDelete('cascade')->nullable();
            $table->decimal('sub_amount', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->string('status', 50); // e.g., 'pending', 'completed', 'canceled'
            $table->dateTime('ordered_at')->nullable();
            $table->boolean('is_financeed')->default(false);
            $table->string('finance_id', 100)->nullable();
            $table->string('finance_provider', 100)->nullable();
            $table->decimal('discount', 10, 2)->nullable();
            $table->string('coupon_code', 50)->nullable();
            $table->string('payment_method', 50); // e.g., 'credit_card', 'paypal', 'bank_transfer'
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
