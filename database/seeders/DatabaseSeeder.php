<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * De inlogaccounts uit de opdracht aanmaken.
     *
     * Het wachtwoord is overal `password`, zodat je in kunt loggen om de
     * schermen (en de rechten van elke rol) te bekijken.
     */
    public function run(): void
    {
        $accounts = [
            ['name' => 'Magazijnmedewerker Jamin', 'email' => 'magazijn@jamin.nl', 'rolenum' => User::ROL_MAGAZIJNMEDEWERKER],
            ['name' => 'Administrator Jamin', 'email' => 'admin@jamin.nl', 'rolenum' => User::ROL_ADMINISTRATOR],
            ['name' => 'Gebruiker Jamin', 'email' => 'gebruiker@jamin.nl', 'rolenum' => User::ROL_GEBRUIKER],
            ['name' => 'Test Magazijnmedewerker', 'email' => 'test@example.com', 'rolenum' => User::ROL_MAGAZIJNMEDEWERKER],
        ];

        foreach ($accounts as $account) {
            User::firstOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'rolenum' => $account['rolenum'],
                    'password' => 'password',
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
