<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGolsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('gols', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->time('minutos')->nullable();
			$table->integer('partida_id')->nullable()->index('fk_gols_partidas1_idx');
			$table->integer('time_id')->nullable()->index('fk_gols_times1_idx');
			$table->integer('tempo_id')->nullable()->index('fk_gols_tempo1_idx');
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
		Schema::drop('gols');
	}

}
