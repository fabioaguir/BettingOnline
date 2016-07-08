<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCotacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cotacoes', function(Blueprint $table)
		{
			$table->foreign('modalidade_id', 'fk_cotacoes_modalidade1')->references('id')->on('modalidade')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('partidas_id', 'fk_cotacoes_partidas1')->references('id')->on('partidas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'fk_cotacoes_status1')->references('id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cotacoes', function(Blueprint $table)
		{
			$table->dropForeign('fk_cotacoes_modalidade1');
			$table->dropForeign('fk_cotacoes_partidas1');
			$table->dropForeign('fk_cotacoes_status1');
		});
	}

}
