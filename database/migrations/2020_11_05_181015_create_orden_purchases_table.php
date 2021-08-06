<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_purchases', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('iduser')->unsigned();;
            $table->foreign('iduser')->references('id')->on('users');
            $table->integer('cantidad');
            $table->decimal('total');
            $table->decimal('fee')->nullable()->default(10);
            $table->string('idtransacion')->nullable()->comment('ID de la transacion');
            $table->enum('status', [0, 1, 2, 3])->default(0)->comment('0 - En Espera, 1 - Completada, 2 - Rechazada, 3 - Cancelada');
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
        Schema::dropIfExists('orden_services');
    }
}
