<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderByLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_by_links', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('address_id');
            $table->string('phone');
            $table->integer('sendType');
            $table->integer('optionType');
            $table->integer('status')->default(0);
            $table->integer('payStatus')->default(0);
            $table->bigInteger('cost')->default(0);
            $table->integer('discount')->default(0);
            $table->string('trackingCode');
            $table->string("payment_id")->nullable();
            $table->bigInteger('postCost')->default(0);
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
        Schema::dropIfExists('order_by_links');
    }
}
