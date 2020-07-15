<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('amount');
            $table->uuid('order_id');
            $table->string('transactionable_id', 255)->unique();
            $table->string('transactionable_type', 255);
            $table->timestamps();

            $table
                ->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
