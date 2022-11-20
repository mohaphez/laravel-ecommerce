<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('baners', function (Blueprint $table) {
				$table->increments('id');
				$table->string('link');
				$table->string('url')->nullable();
				$table->string('alt')->nullable();
				$table->string('title')->nullable();
				$table->integer('position');
				$table->boolean('status')->default(1);
				$table->softDeletes();
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('baners');
	}
}
