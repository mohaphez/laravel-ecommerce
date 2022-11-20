<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('addresses', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->string('name', 40);
				$table->unsignedInteger('province_id');
				$table->unsignedInteger('city_id');
				$table->string('address');
				$table->string('codeposti', 10);
				$table->softDeletes();
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
				$table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');
				$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('addresses');
	}
}
