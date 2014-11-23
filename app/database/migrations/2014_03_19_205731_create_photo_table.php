<?php

use Illuminate\Database\Migrations\Migration;

class CreatePhotoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photo', function($table)
		{
			$table->increments('id');
			$table->string('path');
			$table->string('filename');
			$table->integer('position');
			$table->string('description');
			$table->integer('articulo_id')->unsigned();
			$table->foreign('articulo_id')->references('id')->on('articulo')->onDelete('CASCADE');
			$table->boolean('resultados');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('photo');
	}

}