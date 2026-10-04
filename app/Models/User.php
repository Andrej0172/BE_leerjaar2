<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'rolenum'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /** De rol zonder enige magazijntoegang. */
    public const ROL_GEBRUIKER = 'Gebruiker';

    /** De rol uit de user stories: mag het magazijn bekijken. */
    public const ROL_MAGAZIJNMEDEWERKER = 'Magazijnmedewerker';

    /** De rol met alle rechten, inclusief schrijven en beheren. */
    public const ROL_ADMINISTRATOR = 'Administrator';

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Of deze gebruiker een van de genoemde rollen heeft.
     */
    public function heeftRol(string ...$rollen): bool
    {
        return in_array($this->rolenum, $rollen, true);
    }

    /**
     * Magazijnmedewerker én Administrator mogen het magazijn zien.
     */
    public function magMagazijnZien(): bool
    {
        return $this->heeftRol(self::ROL_MAGAZIJNMEDEWERKER, self::ROL_ADMINISTRATOR);
    }

    /**
     * Alleen de Administrator mag voorraad bijwerken en gebruikers beheren.
     */
    public function isAdministrator(): bool
    {
        return $this->heeftRol(self::ROL_ADMINISTRATOR);
    }
}
