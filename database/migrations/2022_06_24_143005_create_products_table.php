<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_slug');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->string('product_price');
            $table->string('quantity');
            $table->string('product_image')->nullable();
            $table->string('sku')->nullable();
            $table->string('discount')->nullable()->comment('%');
            $table->string('after_discount');
            $table->integer('color_id')->nullable();
            $table->integer('size_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('status')->nullable()->default('0')->comment('1=publish, 0=unpublish');
            $table->tinyInteger('tending')->nullable()->default('0')->comment('1=tending, 0=un-tending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}