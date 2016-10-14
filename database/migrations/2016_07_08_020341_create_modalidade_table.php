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
			$table->boolean('vitoria_casa');
			$table->boolean('vitoria_fora');
			$table->boolean('empate');
			$table->integer('gols_casa');
			$table->integer('gols_fora');
			$table->integer('tipo_inducao_id');
			$table->foreign('tipo_inducao_id')->references('id')->on('tipos_inducoes');
			$table->integer('gols_inducao');
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
