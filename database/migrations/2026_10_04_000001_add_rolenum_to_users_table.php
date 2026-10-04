<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * De rol van de gebruiker toevoegen.
     *
     * De opdracht kent drie rollen in `users.rolenum`: Gebruiker,
     * Magazijnmedewerker en Administrator. Nieuwe accounts beginnen als
     * Magazijnmedewerker, dat is de rol uit de user stories.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rolenum', 30)->default('Magazijnmedewerker')->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rolenum');
        });
    }
};
