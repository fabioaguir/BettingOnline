<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPartidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('partidas', function(Blueprint $table)
		{
			$table->foreign('campeonatos_id', 'fk_partidas_campeonatos1')->references('id')->on('campeonatos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'fk_partidas_status1')->references('id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('time_casa', 'fk_partidas_times1')->references('id')->on('times')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('time_fora', 'fk_partidas_times2')->references('id')->on('times')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('partidas', function(Blueprint $table)
		{
			$table->dropForeign('fk_partidas_campeonatos1');
			$table->dropForeign('fk_partidas_status1');
			$table->dropForeign('fk_partidas_times1');
			$table->dropForeign('fk_partidas_times2');
		});
	}

}
