<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductFeaturesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('product_features', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('product_id')->unsigned();
				$table->string('item');
				$table->string('value');
				$table->timestamps();
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('product_features');
	}
}
