<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('sub_menus', function (Blueprint $table) {
				$table->increments('id');
				$table->string('name');
				$table->string('link');
				$table->integer('menu_header_id')->unsigned();
				$table->timestamps();
				$table->foreign('menu_header_id')->references('id')->on('menu_headers')->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('sub_menus');
	}
}
