<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CrearTablaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->double('precio');
            $table->dateTime('fecha_compra');
            $table->binary('estado')->nullable();
            $table->string('comentarios')->nullable();
            $table->foreignId('categoria_id')->constrained('categoria');
            $table->foreignId('sucursal_id')->constrained('sucursal');
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('created_at')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('producto');
    }
}
