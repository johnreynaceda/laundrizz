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
        Schema::create('transaction_order_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_transaction_id');
            $table->foreignId('catalog_id');
            $table->foreignId('catalog_service_id');
            $table->integer('quantity');
            $table->double('weight');
             $table->double('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_order_forms');
    }
};
