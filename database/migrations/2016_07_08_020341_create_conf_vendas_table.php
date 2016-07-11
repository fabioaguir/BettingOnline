<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfVendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('conf_vendas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('limite_vendas', 10)->nullable();
			$table->decimal('comissao', 10)->nullable();
			$table->decimal('cotacao', 10)->nullable();
			$table->integer('tipo_cotacao_id')->nullable()->index('fk_conf_vendas_tipo_cotacao1_idx');
			$table->integer('vendedor_id')->nullable()->index('fk_conf_vendas_vendedor1_idx');
			$table->integer('status_id')->nullable()->index('fk_conf_vendas_status1_idx');
			$table->timestamps();
			$table->integer('venda_id')->nullable()->index('fk_conf_vendas_vendas1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('conf_vendas');
	}

}
