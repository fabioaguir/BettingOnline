<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArrecadacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrecadacoes', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->nullable()->index('fk_arrecadacoes_users1_idx');
			$table->integer('arrecadador_id')->nullable()->index('fk_arrecadacoes_pessoas1_idx');
			$table->integer('vendedor_id')->nullable()->index('fk_arrecadacoes_pessoas2_idx');
			$table->decimal('valor', 10)->nullable();
			$table->date('data')->nullable();
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
		Schema::drop('arrecadacoes');
	}

}
