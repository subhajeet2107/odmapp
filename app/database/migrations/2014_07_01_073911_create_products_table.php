<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category');
			$table->string('brand');
			$table->string('model');
			$table->string('code');
			$table->string('tonnage');
			$table->string('starmodel');
			$table->string('segment');
			$table->integer('mrp');
			$table->integer('dp');
			$table->integer('srp');
			$table->string('sheet_name');
			$table->unsignedInteger('sheet_id');
			$table->foreign('sheet_id')->references('id')->on('sheets');
			
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
		Schema::dropIfExists('products');
	}

}
