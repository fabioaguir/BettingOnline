<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToConfVendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('conf_vendas', function(Blueprint $table)
		{
			$table->foreign('tipo_cotacao_id', 'fk_conf_vendas_tipo_cotacao1')->references('id')->on('tipo_cotacao')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('vendas_id', 'fk_conf_vendas_vendas1')->references('id')->on('vendas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('vendedor_id', 'fk_conf_vendas_vendedor1')->references('id')->on('vendedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('conf_vendas', function(Blueprint $table)
		{
			$table->dropForeign('fk_conf_vendas_tipo_cotacao1');
			$table->dropForeign('fk_conf_vendas_vendas1');
			$table->dropForeign('fk_conf_vendas_vendedor1');
		});
	}

}