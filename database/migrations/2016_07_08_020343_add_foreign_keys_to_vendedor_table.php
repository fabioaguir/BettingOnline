<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVendedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('vendedor', function(Blueprint $table)
		{
			$table->foreign('areas_id', 'fk_vendedor_areas1')->references('id')->on('areas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('estorno_id', 'fk_vendedor_estorno_vendedor1')->references('id')->on('estorno_vendedor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('status_id', 'fk_vendedor_status_vendedor')->references('id')->on('status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('vendedor', function(Blueprint $table)
		{
			$table->dropForeign('fk_vendedor_areas1');
			$table->dropForeign('fk_vendedor_estorno_vendedor1');
			$table->dropForeign('fk_vendedor_status_vendedor');
		});
	}

}
