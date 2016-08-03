<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateParametrosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('parametros', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome_banca', 100)->nullable();
			$table->boolean('status')->nullable();
			$table->string('mensagen_rodape')->nullable();
			$table->text('limite_premiacao', 16777215)->nullable();
			$table->text('limite_vendas', 16777215)->nullable();
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
		Schema::drop('parametros');
	}

}
