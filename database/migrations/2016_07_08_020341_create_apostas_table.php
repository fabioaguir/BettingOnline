<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateApostasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apostas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('venda_id')->index('fk_apostas_vendas1_idx');
			$table->integer('partida_id')->index('fk_apostas_partidas1_idx');
			$table->integer('cotacao_id')->index('fk_apostas_cotacoes1_idx');
			$table->integer('premiada');
			$table->decimal('valor', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apostas');
	}

}
