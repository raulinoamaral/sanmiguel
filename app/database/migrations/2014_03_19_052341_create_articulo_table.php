<?php

use Illuminate\Database\Migrations\Migration;

class CreateArticuloTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articulo', function($table)
		{
			$table->increments('id');
			$table->string('code')->unique();
			$table->string('name');
			$table->string('short_description');
			$table->string('long_description');
			$table->string('price');
			$table->integer('categoria_id')->unsigned();
			$table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('CASCADE');
			$table->integer('subcategoria_id')->unsigned();
			$table->foreign('subcategoria_id')->references('id')->on('subcategoria')->onDelete('CASCADE');
			$table->integer('moneda_id')->unsigned();
			$table->foreign('moneda_id')->references('id')->on('moneda');
			$table->timestamps();
			$table->string('slug')->unique();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articulo');
	}

}