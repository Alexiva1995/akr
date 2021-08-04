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
        Schema::create('crypto__values', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('iduser')->unsigned();
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
        Schema::dropIfExists('crypto__values');
    }
}
