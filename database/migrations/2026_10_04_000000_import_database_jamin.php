<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Het geleverde createscript van de Jamin-database uitvoeren.
     *
     * Het script maakt zelf de zes magazijntabellen (DROP/CREATE IF NOT EXISTS)
     * en vult ze met de beginsituatie. Er staan geen statements in voor de
     * users-tabel van Laravel, dus die blijft ongemoeid.
     */
    public function up(): void
    {
        $script = file_get_contents(database_path('migrations/Database_jamin.sql'));

        if ($script === false) {
            throw new RuntimeException('Createscript Database_jamin.sql kon niet gelezen worden.');
        }

        DB::unprepared($script);
    }

    /**
     * De tabellen uit het createscript weer weghalen.
     */
    public function down(): void
    {
        foreach (['ProductPerLeverancier', 'ProductPerAllergeen', 'Magazijn', 'Leverancier', 'Allergeen', 'Product'] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
