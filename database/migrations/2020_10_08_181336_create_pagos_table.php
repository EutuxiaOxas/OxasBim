<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('orden_id');
            $table->integer('monto');
            $table->date('fecha');
            $table->foreignId('id_banco_emisor');
            $table->foreignId('id_banco_receptor');
            $table->text('referencia');
            $table->string('titular_cuenta');
            $table->string('documento_identidad_titular');
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
        Schema::dropIfExists('pagos');
    }
}
