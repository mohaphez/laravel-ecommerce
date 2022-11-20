<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCommentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('product_comments', function (Blueprint $table) {
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->integer('reply_user_id')->unsigned()->nullable();
				$table->integer('product_id')->unsigned();
				$table->string('title');
				$table->text('comment');
				$table->text('reply_comment')->nullable();
				$table->boolean('status');
				$table->integer('like');
				$table->boolean('read')->default(0);
				$table->timestamps();
				$table->softDeletes();
				$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
				$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
				$table->foreign('reply_user_id')->references('id')->on('users')->onDelete('cascade');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('product_comments');
	}
}
