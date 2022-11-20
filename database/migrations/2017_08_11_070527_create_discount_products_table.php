<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('discount_products', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('type');
				$table->bigInteger('price');
				$table->bigInteger('tprice');
				$table->integer('product_id')->unsigned();
				$table->dateTime('started_at');
				$table->dateTime('finished_at');
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
		Schema::dropIfExists('discount_products');
	}
}
