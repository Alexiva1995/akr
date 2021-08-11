<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptoValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('Crypto_Value', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('iduser')->unsigned();
            $table->bigInteger('liquidation_crypto_id')->unsigned()->nullable();
            $table->foreign('liquidation_crypto_id')->references('id')->on('liquidation_cryptos');
            $table->integer('cantidad');
            $table->enum('status', [0, 1])->default(0)->comment('0 - En Espera, 1 - Pagado');
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
        Schema::dropIfExists('Crypto_Value');
    }
}