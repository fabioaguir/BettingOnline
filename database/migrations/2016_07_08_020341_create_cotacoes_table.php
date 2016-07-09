<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCotacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cotacoes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('valor', 10)->nullable();
			$table->integer('partida_id')->nullable()->index('fk_cotacoes_partidas1_idx');
			$table->integer('modalidade_id')->nullable()->index('fk_cotacoes_modalidade1_idx');
			$table->integer('status_id')->nullable()->index('fk_cotacoes_status1_idx');
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
		Schema::drop('cotacoes');
	}

}
