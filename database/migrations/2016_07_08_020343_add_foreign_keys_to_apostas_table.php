<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToApostasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('apostas', function(Blueprint $table)
		{
			$table->foreign('cotacao_id', 'fk_apostas_cotacoes1')->references('id')->on('cotacoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('partida_id', 'fk_apostas_partidas1')->references('id')->on('partidas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('venda_id', 'fk_apostas_vendas1')->references('id')->on('vendas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('apostas', function(Blueprint $table)
		{
			$table->dropForeign('fk_apostas_cotacoes1');
			$table->dropForeign('fk_apostas_partidas1');
			$table->dropForeign('fk_apostas_vendas1');
		});
	}

}
