<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');
            $table->string('last_name');
            $table->string('fullname');
            $table->longtext('dni')->nullable();
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();      
            $table->date('age')->nullable();             
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('whatsapp');
            $table->string('password');
            $table->string('address')->nullable();
            $table->double('wallet')->default(0);
            $table->enum('admin', [0, 1])->default(0)->comment('permite saber si un usuario es admin o no');
            $table->enum('status', [0, 1, 2])->default(0)->comment('0 - inactivo, 1 - activo, 2 - eliminado');
            $table->enum('verify', [0, 1])->default(0)->comment('permite saber si un usuario esta verificado o no');
            $table->bigInteger('referred_id')->default(1)->comment('ID del usuario patrocinador');
            $table->bigInteger('binary_id')->default(1)->comment('ID del usuario binario');
            $table->enum('binary_side', ['I', 'D'])->nullable()->comment('Permite saber si esta en la derecha o izquierda en el binario');
            $table->enum('binary_side_register', ['I', 'D'])->default('I')->comment('Permite saber porque lado va a registrar a un nuevo usuario');
            $table->boolean('reinvertir_comision')->default(false);
            $table->boolean('reinvertir_capital')->default(false); 
            $table->longtext('wallet_address')->nullable();
            $table->longtext('photoDB')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
