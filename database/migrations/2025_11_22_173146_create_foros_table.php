<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('foros', function (Blueprint $table) {
            $table->id();

            // Usuario que creó el foro
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Categoría opcional
            $table->string('categoria')->nullable();

            // Datos principales
            $table->string('titulo');
            $table->text('descripcion')->nullable();

            // Estado (abierto/cerrado)
            $table->enum('estado', ['abierto', 'cerrado'])->default('abierto');

            // Métricas
            $table->unsignedInteger('num_mensajes')->default(0);
            $table->timestamp('ultima_actividad')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('foros');

        Schema::enableForeignKeyConstraints();
    }
};
