<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModalidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modalidades', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 155)->nullable();
			$table->decimal('limite_cotacao', 10)->nullable();
			$table->boolean('t_casa')->nullable();
			$table->boolean('t_fora')->nullable();
			$table->boolean('t_empate')->nullable();
			$table->integer('status_id')->nullable()->index('fk_modalidade_status1_idx');
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
		Schema::drop('modalidade');
	}

}
