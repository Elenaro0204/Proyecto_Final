<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Solo agregar si no existe
            if (!Schema::hasColumn('users', 'bio')) {
                $table->text('bio')->nullable()->after('avatar_url');
            }

            if (!Schema::hasColumn('users', 'twitter')) {
                $table->string('twitter')->nullable()->after('bio');
            }

            if (!Schema::hasColumn('users', 'instagram')) {
                $table->string('instagram')->nullable()->after('twitter');
            }

            if (!Schema::hasColumn('users', 'birthdate')) {
                $table->date('birthdate')->nullable()->after('instagram');
            }
        });
    }

     public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'bio')) {
                $table->dropColumn('bio');
            }

            if (Schema::hasColumn('users', 'twitter')) {
                $table->dropColumn('twitter');
            }

            if (Schema::hasColumn('users', 'instagram')) {
                $table->dropColumn('instagram');
            }

            if (Schema::hasColumn('users', 'birthdate')) {
                $table->dropColumn('birthdate');
            }
        });
    }
};
