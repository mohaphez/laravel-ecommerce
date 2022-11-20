<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_discount_codes', function (Blueprint $table) {
            $table->increments('id');
				$table->string('code')->unique();
				$table->integer('type');
				$table->bigInteger('price');
				$table->dateTime('expire_at');
				$table->boolean('status');
				$table->timestamps();
				$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_discount_codes');
    }
}
