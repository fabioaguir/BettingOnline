<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTimesAltaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('times_alta', function(Blueprint $table)
		{
			$table->foreign('time_id', 'fk_times_alta_times1')->references('id')->on('times')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('times_alta', function(Blueprint $table)
		{
			$table->dropForeign('fk_times_alta_times1');
		});
	}

}
