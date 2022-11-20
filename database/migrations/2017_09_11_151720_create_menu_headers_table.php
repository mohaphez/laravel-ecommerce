<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuHeadersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('menu_headers', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('link');
				$table->integer('menu_id')->unsigned();
				$table->timestamps();
				$table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('menu_headers');
	}
}
