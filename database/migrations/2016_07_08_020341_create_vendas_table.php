<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('seq')->nullable();
			$table->date('data')->nullable();
			$table->text('obs', 65535)->nullable();
			$table->decimal('valor_total', 10)->nullable();
			$table->decimal('retorno', 10)->nullable();
			$table->integer('status_v_id')->index('fk_vendas_status_vendas1_idx');
			$table->integer('premiacao_id')->index('fk_vendas_premiacoes1_idx');
			$table->integer('tipo_aposta_id')->index('fk_vendas_tipo_apostas1_idx');
			$table->integer('conf_venda_id')->index('fk_vendas_conf_vendas1_dx');
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
		Schema::drop('vendas');
	}

}
