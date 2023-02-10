<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_sales', function (Blueprint $table) {
            $table->id();
            $table->string('PayFromDT');
            $table->string('PayToDT');
            $table->double('Payment_Rate');
            $table->string('DeductFromDT');
            $table->string('DeductToDT');
            $table->string('Deduct_Rate');
            $table->string('Total_DT');
            $table->double('Total_Rate');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('item_name_id')->unsigned();
            $table->double('itemQuantity');
            $table->string('CustPhoto');
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('item_name_id')->references('id')->on('item_names')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_sales');
    }
}
