<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();

            // Relación con el foro
            $table->foreignId('foro_id')->constrained('foros')->onDelete('cascade');

            // Usuario que lo escribió
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Contenido del mensaje
            $table->text('contenido');

            $table->foreignId('parent_id')->nullable()->constrained('mensajes')->onDelete('cascade');

            // Opciones de moderación y edición
            $table->boolean('editado')->default(false);
            $table->timestamp('editado_en')->nullable();

            $table->boolean('eliminado')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensajes');
    }
};
