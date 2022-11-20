<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('settings', function (Blueprint $table) {
				$table->increments('id');
				$table->string('perfix')->nullable();
				$table->string('name')->nullable();
				$table->string('logo')->nullable();
				$table->string('keyword')->nullable();
				$table->string('description')->nullable();
				$table->string('disable_message')->nullable();
				$table->string('admin_email')->nullable();
				$table->string('contact_email')->nullable();
				$table->string('contact_number')->nullable();
				$table->string('contact_address')->nullable();
				$table->text('google_code')->nullable();
				$table->text('alexa_code')->nullable();
				$table->text('analytics_code')->nullable();
				$table->text('setad_code')->nullable();
				$table->text('etemad_code')->nullable();
				$table->text('senf_code')->nullable();
				$table->string('about')->nullable();
				$table->string('roles')->nullable();
				$table->string('faq')->nullable();
				$table->string('agency')->nullable();
				$table->string('telegram')->nullable();
				$table->string('instagram')->nullable();
				$table->string('aparat')->nullable();
				$table->boolean('status')->nullable();
				$table->text('theme')->nullable();
				$table->string('tel_bot_api')->nullable();
				$table->string('channel_id')->nullable();
				$table->boolean('app_status')->nullable();
				$table->string('app_error')->nullable();
				$table->string('app_version')->nullable();
				$table->date('expiretime')->nullable();
				$table->date('domain')->nullable();
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('settings');
	}
}
