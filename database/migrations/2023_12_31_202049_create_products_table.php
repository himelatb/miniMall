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
            $table->string('product_code');
            $table->string('group_code');
            $table->string('product_color');
            $table->string('color_family');
            $table->float('product_price');
            $table->float('product_discount')->nullable();
            $table->float('final_price');
            $table->string('discount_type')->nullable();
            $table->string('product_video')->nullable();
            $table->string('product_image')->nullable();
            $table->text('description');
            $table->text('wash_care')->nullable();
            $table->text('keywords');
            $table->string('material');
            $table->string('size')->nullable();
            $table->string('height')->nullable();
            $table->string('width')->nullable();
            $table->string('sleeve')->nullable();
            $table->string('weight')->nullable();
            $table->string('fit')->nullable();
            $table->string('pattern')->nullable();
            $table->string('occasion')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->enum('is_featured', ['No', 'Yes'])->nullable()->default("No");
            $table->tinyInteger('status');
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
