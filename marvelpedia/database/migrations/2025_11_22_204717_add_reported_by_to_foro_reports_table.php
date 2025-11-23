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

            $table->foreignId('foro_id')
                ->constrained('foros')
                ->onDelete('cascade'); // Si se borra el foro, se borran sus reportes

            $table->foreignId('reported_by')
                ->constrained('users')
                ->onDelete('cascade'); // Si se borra el usuario, se borran sus reportes

            $table->boolean('resolved')->default(false);
            $table->timestamp('deadline')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('foro_reports', function (Blueprint $table) {
            //
        });
    }
};
