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
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('en_name')->nullable();
            $table->string('code');
            $table->text('description');
            $table->bigInteger('price');
            $table->bigInteger('purchase_price')->default(0);
            $table->bigInteger('marketer_price')->default(0);
            $table->string('brand');
            $table->integer('available_num');
            $table->boolean('status');
            $table->boolean('color');
            $table->boolean('suggest')->default(false);
            $table->integer('vat')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('subcategory_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->text('seo_description');
            $table->text('seo_keyword');
            $table->integer('user_id')->unsigned();
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('product_items')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
