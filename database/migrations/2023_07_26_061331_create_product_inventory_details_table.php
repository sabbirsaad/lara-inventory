<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInventoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventory_details', function (Blueprint $table) {
            $table->id('inventory_details_id');
            $table->unsignedBigInteger('product_inventory_id');
            $table->unsignedBigInteger('product_id');
            $table->double('purchase_price', 8, 2);
            $table->integer('quantity');
            $table->double('sub_total');
            $table->timestamps();

            $table->foreign('product_inventory_id')->references('product_inventory_id')->on('product_inventories');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_inventory_details');
    }
}
