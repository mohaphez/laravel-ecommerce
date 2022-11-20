<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('orders', function (Blueprint $table) {
				$table->increments('id');
				$table->string('code');
				$table->integer('user_id')->unsigned();
				$table->string('name');
				$table->string('phone');
				$table->integer('address_id')->unsigned();
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
	public function down() {
		Schema::dropIfExists('orders');
	}
}
