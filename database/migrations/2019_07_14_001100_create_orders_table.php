<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('basket_id');
            $table->uuid('billing_address_id');
            $table->uuid('delivery_address_id');
            $table->string('paymentable_id')->unique();
            $table->string('paymentable_type');
            $table->timestamps();

            $table
                ->foreign('basket_id')
                ->references('id')
                ->on('baskets')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('billing_address_id')
                ->references('id')
                ->on('addresses')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('delivery_address_id')
                ->references('id')
                ->on('addresses')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
