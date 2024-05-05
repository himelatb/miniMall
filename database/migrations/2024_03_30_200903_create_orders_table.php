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
            $table->integer('user_id');
            $table->integer('billing_id');
            $table->integer('shipping_id');
            $table->string('total');
            $table->string('coupon_code')->nullable();
            $table->float('coupon_amount')->nullable();
            $table->enum('status', ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'])->default('Pending');
            $table->float('payment_method');
            $table->float('delivery_charge')->nullable();
            $table->string('couier_name')->nullable();
            $table->string('tracking_id')->nullable();
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
