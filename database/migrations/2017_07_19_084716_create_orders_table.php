<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id');
            $table->date('order_date');
            $table->integer('fk_client_id')->unsigned()->nullable();
            $table->foreign('fk_client_id')->references('id')->on('clients');
            $table->integer('fk_product_id')->unsigned();
            $table->foreign('fk_product_id')->references('id')->on('products');
            $table->integer('sq_feets');
            $table->integer('fk_tax_id')->unsigned();
            $table->foreign('fk_tax_id')->references('id')->on('taxes');
            $table->integer('estimated_rate');
            $table->integer('balance_estimate')->default(0);
            $table->integer('balance_sq_feets')->default(0);
            $table->string('approval');
            $table->integer('fk_user_created_id')->unsigned();
            $table->foreign('fk_user_created_id')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
}
