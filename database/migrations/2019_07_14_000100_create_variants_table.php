<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->unsignedInteger('price');
            $table->unsignedInteger('delivery_cost');
            $table->unsignedInteger('stock')->nullable();
            $table->string('option1', 255)->nullable();
            $table->string('option2', 255)->nullable();
            $table->string('option3', 255)->nullable();
            $table->uuid('product_id');
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('variants');
    }
}
