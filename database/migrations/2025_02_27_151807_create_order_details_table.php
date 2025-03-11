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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_transaction_id');
            $table->string('reference_number')->unique();
            $table->double('total_amount');
            $table->time('estimated_time');
            $table->string('proof_of_payment')->nullable();
            $table->boolean('payment_rejected')->default(false);
            $table->longText('comment')->nullable();
            $table->string('order_type')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_processing')->default(false);
            $table->boolean('is_ready')->default(false);
            $table->boolean('is_complete')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
