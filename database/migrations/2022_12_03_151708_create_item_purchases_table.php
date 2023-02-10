<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_purchases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('item_name_id')->unsigned();
            $table->double('item_quantity');
            $table->bigInteger('created_by')->unsigned();
            $table->double('Purchase_Rate');
            $table->double('Sales_Rates');
            $table->date('purchase_date');
            $table->timestamps();
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
        Schema::dropIfExists('item_purchases');
    }
}
