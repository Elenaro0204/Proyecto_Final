<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar_url')->nullable()->after('password');
            $table->string('nickname')->nullable()->after('avatar_url');
            $table->text('bio')->nullable()->after('nickname');
            $table->string('favorito_personaje')->nullable()->after('bio');
            $table->string('favorito_comic')->nullable()->after('favorito_personaje');
            $table->string('pais')->nullable()->after('favorito_comic');
            $table->date('fecha_nacimiento')->nullable()->after('pais');
            $table->string('banner_url')->nullable()->after('fecha_nacimiento');
            $table->string('theme')->default('default')->after('banner_url');
            $table->integer('nivel')->default(1)->after('theme');
            $table->integer('puntos')->default(0)->after('nivel');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'avatar_url', 'nickname', 'bio', 'favorito_personaje',
                'favorito_comic', 'pais', 'fecha_nacimiento', 'banner_url',
                'theme', 'nivel', 'puntos'
            ]);
        });
    }
};
