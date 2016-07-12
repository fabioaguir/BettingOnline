<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartidasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('partidas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('data')->nullable();
			$table->time('hora')->nullable();
			$table->integer('time_casa_id')->nullable()->index('fk_partidas_times1_idx');
			$table->integer('time_fora_id')->nullable()->index('fk_partidas_times2_idx');
			$table->integer('status_id')->nullable()->index('fk_partidas_status1_idx');
			$table->integer('campeonato_id')->nullable()->index('fk_partidas_campeonatos1_idx');
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
		Schema::drop('partidas');
	}

}
