<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToModalidadeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('modalidades', function(Blueprint $table)
		{
			$table->foreign('status_id', 'fk_modalidade_status1')->references('id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_inducao_id', 'fk_modalidades_tipos_indicoes')->references('id')->on('tipos_inducoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('modalidade', function(Blueprint $table)
		{
			$table->dropForeign('fk_modalidade_status1');
			$table->dropForeign('fk_modalidades_tipos_indicoes');
		});
	}

}
