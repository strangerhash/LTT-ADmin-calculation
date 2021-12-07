<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFundDepositTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fund_deposit', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('amount', 50)->nullable();
			$table->string('payment_method', 50)->nullable();
			$table->tinyInteger('status')->default('1');
			$table->timestamp('date_created')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
			//$table->dateTime('date_completed')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fund_deposit');
	}

}
