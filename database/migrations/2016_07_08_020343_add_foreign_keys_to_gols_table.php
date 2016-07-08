<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('gols', function(Blueprint $table)
		{
			$table->foreign('partida_id', 'fk_gols_partidas1')->references('id')->on('partidas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tempo_id', 'fk_gols_tempo1')->references('id')->on('tempos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('time_id', 'fk_gols_times1')->references('id')->on('times')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('gols', function(Blueprint $table)
		{
			$table->dropForeign('fk_gols_partidas1');
			$table->dropForeign('fk_gols_tempo1');
			$table->dropForeign('fk_gols_times1');
		});
	}

}
