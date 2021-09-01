<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inversions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('iduser')->unsigned();;
            $table->foreign('iduser')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('orden_id')->unsigned();
            $table->foreign('orden_id')->references('id')->on('orden_purchases')->onUpdate('cascade')->onDelete('cascade');
            $table->double('invertido');
            $table->double('ganacia');
            $table->tinyInteger('status')->default(1)->comment('1 - activo , 2 - culminada');
            $table->double('max_ganancia')->nullable();
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
        Schema::dropIfExists('inversions');
    }
}