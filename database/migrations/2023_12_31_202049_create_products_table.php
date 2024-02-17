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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('product_name')->default('generic product');
            $table->string('product_code')->nullable();
            $table->string('group_code')->nullable();
            $table->string('product_color')->nullable();
            $table->string('color_family')->nullable();
            $table->float('product_price');
            $table->float('product_discount')->nullable();
            $table->float('final_price')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('product_video')->nullable();
            $table->text('description')->nullable();
            $table->text('wash_care')->nullable();
            $table->text('keywords')->nullable();
            $table->string('material')->nullable();
            $table->string('sleeve')->nullable();
            $table->string('weight')->nullable();
            $table->string('fit')->nullable();
            $table->string('pattern')->nullable();
            $table->string('occasion')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('is_featured', ['No', 'Yes'])->nullable()->default("No");
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
