<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('street1', 255);
            $table->string('street2', 255)->nullable();
            $table->string('locality', 255)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('postal_code', 255)->nullable();
            $table->char('country', 2);
            $table->string('email', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
