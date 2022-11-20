<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCodesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('discount_codes', function (Blueprint $table) {
				$table->increments('id');
				$table->string('code')->unique();
				$table->integer('type');
				$table->bigInteger('price');
				$table->dateTime('expire_at');
				$table->boolean('status');
				$table->integer('user_id')->nullable()->unsigned();
				$table->integer('order_id')->nullable()->unsigned();

				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
				$table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
		Schema::dropIfExists('discount_codes');
	}
}
