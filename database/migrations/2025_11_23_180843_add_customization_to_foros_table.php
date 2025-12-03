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
        Schema::table('foros', function (Blueprint $table) {
            $table->string('color_fondo')->nullable();
            $table->string('color_titulo')->nullable();
            $table->string('imagen')->nullable();
            $table->enum('visibilidad', ['publico', 'privado'])->default('publico');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foros', function (Blueprint $table) {
            $table->dropColumn(['color_fondo', 'color_titulo', 'imagen', 'visibilidad']);
        });
    }
};
