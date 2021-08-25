<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidationCryptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidation_cryptos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('iduser')->unsigned();
            $table->foreign('iduser')->references('id')->on('users');
            $table->double('total')->default(0);
            $table->double('monto_bruto')->nullable()->default(0);
            $table->double('feed')->nullable()->default(0);
            $table->string('hash')->nullable();
            $table->string('wallet_used')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('liquidation_cryptos');
    }
}
