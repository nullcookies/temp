<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderId');
            $table->string('product');
            $table->string('varient',150);
            $table->string('customerName',100);
            $table->string('customerPhone',100);
            $table->string('customerEmail',200);
            $table->string('customerAddress',200);
            $table->string('customerCity',200);
            $table->string('customerPostCode',200);
            $table->string('customerState',200);
            $table->string('shippingName',200);
            $table->string('shippingEmail',200);
            $table->string('shippingPhone',200);
            $table->string('shippingAddress',255);
            $table->string('shippingCity',200);
            $table->string('shippingState',200);
            $table->string('shippingPostCode',200);
            $table->integer('productId');
            $table->integer('varientId');
            $table->integer('quantity');            
            $table->enum('status',['enable','disable']);       
            $table->integer('userId');
            $table->string('orderAmount',100);
            $table->string('productAmount',100);
            $table->string('productSellingPrice',100);
            $table->string('shippingCharge',100);
            $table->enum('paymentType',['prepaid','cod']);
            $table->string('signedManifest',150);
            $table->string('txnId',250);
            $table->text('paymentData',250);
            $table->text('returnComment',250);
            $table->tinyInteger('returnStatus');
            $table->integer('approveRejectBy');
            $table->DateTime('orderDate'); 
            $table->timestamps('recordInsertedDate');
            $table->string('payu_trans');
            $table->string('payu_status');
            $table->string('payu_txnid');
            $table->string('payu_amount');            
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
        Schema::drop('product_orders');
    }
}
