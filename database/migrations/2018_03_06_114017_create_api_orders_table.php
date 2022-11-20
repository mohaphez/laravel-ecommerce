<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('phone');
            $table->string('address_id');
            $table->text('cart');
            $table->string('status');
            $table->integer('send_method');
            $table->bigInteger('price');
            $table->integer('pay_method');
            $table->boolean('pay_status');
            $table->string('payment_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_orders');
    }
}
