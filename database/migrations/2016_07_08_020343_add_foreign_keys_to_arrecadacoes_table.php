<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArrecadacoesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arrecadacoes', function(Blueprint $table)
		{
			$table->foreign('user_id', 'fk_arrecadacoes_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('arrecadador_id', 'fk_arrecadacoes_pessoas1')->references('id')->on('pessoas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('arrecadacoes', function(Blueprint $table)
		{
			$table->dropForeign('fk_arrecadacoes_pessoas1');
		});
	}

}
