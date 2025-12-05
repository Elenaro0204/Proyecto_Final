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
        Schema::create('foro_reports', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla foros
            $table->foreignId('foro_id')
                ->constrained('foros')
                ->onDelete('cascade');

            // Usuario que reporta
            $table->foreignId('reported_by')
                ->constrained('users')
                ->onDelete('cascade');

            // ¿Se resolvió el reporte?
            $table->boolean('resolved')->default(false);

            // Fecha límite para revisar el reporte
            $table->timestamp('deadline')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('foro_reports');

        Schema::enableForeignKeyConstraints();
    }
};
