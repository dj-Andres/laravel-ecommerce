<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('shopping_id');
            $table->foreign('shopping_id')->references('id')->on('purchases');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');     
            $table->integer('cantidad');
            $table->decimal('price',12,2);
            

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
        Schema::dropIfExists('purchase_details');
    }
}
