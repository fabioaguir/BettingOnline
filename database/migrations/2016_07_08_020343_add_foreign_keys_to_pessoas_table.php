<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPessoasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pessoas', function(Blueprint $table)
		{
			$table->foreign('area_id', 'fk_pessoas_areas1')->references('id')->on('areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('estorno_id', 'fk_pessoas_estorno_vendedor1')->references('id')->on('estorno_vendedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'fk_pessoas_status_vendedor')->references('id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_pessoa_id', 'fk_pessoas_tipo_pessoa1')->references('id')->on('tipo_pessoas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pessoas', function(Blueprint $table)
		{
			$table->dropForeign('fk_pessoas_areas1');
			$table->dropForeign('fk_pessoas_estorno_vendedor1');
			$table->dropForeign('fk_pessoas_status_vendedor');
			$table->dropForeign('fk_pessoas_tipo_pessoa1');
		});
	}

}
