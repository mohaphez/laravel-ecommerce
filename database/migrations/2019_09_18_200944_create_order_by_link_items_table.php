<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderByLinkItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_by_link_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('orderByLink_id');
            $table->text('link');
            $table->integer('number');
            $table->string('description');
            $table->string('img')->nullable();
            $table->text('title')->nullable();
            $table->integer('status')->default(0);
            $table->bigInteger('cost')->nullable();
            $table->bigInteger('unitPrice')->nullable();
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
        Schema::dropIfExists('order_by_link_items');
    }
}
