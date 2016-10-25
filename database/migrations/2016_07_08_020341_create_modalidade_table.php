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
			$table->boolean('vitoria_casa')->nullable();
			$table->boolean('vitoria_fora')->nullable();
			$table->boolean('empate')->nullable();
			$table->integer('gols_casa')->nullable();
			$table->integer('gols_fora')->nullable();
			$table->integer('tipo_inducao_id')->nullable()->index('fk_modalidades_tipos_indicoes');;
			$table->integer('gols_inducao')->nullable();
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
