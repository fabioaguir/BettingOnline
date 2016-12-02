<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePessoasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pessoas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome')->nullable();
			$table->string('usuario')->nullable();
			$table->string('senha')->nullable();
			$table->integer('codigo');
			$table->integer('status_id')->nullable()->index('fk_pessoas_status_vendedor_idx');
			$table->integer('estorno_id')->nullable()->index('fk_pessoas_estorno_vendedor1_idx');
			$table->integer('area_id')->nullable()->index('fk_pessoas_areas1_idx');
			$table->integer('tipo_pessoa_id')->nullable()->index('fk_pessoas_tipo_pessoa1_idx');
			$table->integer('chipe_id')->nullable()->index('fk_chipes_pessoa1_idx');
			$table->integer('impressora_id')->nullable()->index('fk_impressoras_pessoa1_idx');
			$table->integer('tablet_id')->nullable()->index('fk_tablets_pessoa1_idx');
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
		Schema::drop('pessoas');
	}

}
