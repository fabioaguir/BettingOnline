<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVendedorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vendedor', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome')->nullable();
			$table->string('usuario')->nullable();
			$table->string('senha')->nullable();
			$table->integer('status_id')->nullable()->index('fk_vendedor_status_vendedor_idx');
			$table->integer('estorno_id')->nullable()->index('fk_vendedor_estorno_vendedor1_idx');
			$table->integer('area_id')->nullable()->index('fk_vendedor_areas1_idx');
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
		Schema::drop('vendedor');
	}

}
