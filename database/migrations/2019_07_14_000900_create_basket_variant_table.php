<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketVariantTable extends Migration
{
    public function up()
    {
        Schema::create('basket_variant', function (Blueprint $table) {
            $table->uuid('basket_id');
            $table->uuid('variant_id');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('price');
            $table->unsignedInteger('delivery_cost')->nullable();
            $table->timestamps();

            $table->primary(['basket_id', 'variant_id']);

            $table
                ->foreign('basket_id')
                ->references('id')
                ->on('baskets')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('variant_id')
                ->references('id')
                ->on('variants')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::dropIfExists('basket_variant');
    }
}
