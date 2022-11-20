<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('product_images', function (Blueprint $table) {
				$table->increments('id');
				$table->text('link')->nullable();
				$table->string('description')->nullable();
				$table->integer('product_id')->unsigned();
				$table->string('color')->nullable();
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('product_images');
	}
}
