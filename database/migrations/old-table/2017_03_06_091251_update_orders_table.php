<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function ($table){
            $table->timestamps('recordInsertedDate');
            $table->string('payu_trans');
            $table->string('payu_status');
            $table->string('payu_txnid');
            $table->string('payu_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_orders', function($table){
            $table->dropColumn('payu_trans','payu_status','payu_txnid','payu_amount');
        });
    }
}
