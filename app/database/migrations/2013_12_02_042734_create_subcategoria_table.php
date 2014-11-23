<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubcategoriaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subcategoria', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->integer('categoria_id')->unsigned();
			$table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('CASCADE');
			$table->timestamps();
			$table->string('slug')->unique();
			$table->string('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subcategoria');
	}

}
