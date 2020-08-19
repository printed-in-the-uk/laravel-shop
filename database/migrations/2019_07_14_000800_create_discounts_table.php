<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->unsignedInteger('percent');
            $table->unsignedInteger('maximum')->nullable();
            $table->unsignedInteger('limit')->nullable();
            $table->uuid('variant_id')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            $table
                ->foreign('variant_id')
                ->references('id')
                ->on('variants')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
