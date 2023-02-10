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
            $table->date('payment_from_date');
            $table->date('payment_to_date');
            $table->string('from_morning_evening');
            $table->string('to_morning_evening');
            $table->date('deduct_from_date');
            $table->date('deduct_to_date');
            $table->date('entry_date');
            $table->string('deduct_morning_evening');
            $table->double('payment');
            $table->double('deduct_payment');
            $table->double('total');
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('item_name_id')->unsigned();
            $table->double('item_quantity');
            $table->string('customer_photo');
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('item_name_id')->references('id')->on('item_purchases')->onDelete('cascade');
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
