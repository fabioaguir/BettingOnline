<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vendas', function(Blueprint $table)
		{
			$table->foreign('premiacoes_id', 'fk_vendas_premiacoes1')->references('id')->on('premiacoes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_v_id', 'fk_vendas_status_vendas1')->references('id')->on('status_vendas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_aposta_id', 'fk_vendas_tipo_apostas1')->references('id')->on('tipo_apostas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('vendas', function(Blueprint $table)
		{
			$table->dropForeign('fk_vendas_premiacoes1');
			$table->dropForeign('fk_vendas_status_vendas1');
			$table->dropForeign('fk_vendas_tipo_apostas1');
		});
	}

}
