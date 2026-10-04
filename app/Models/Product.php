<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    /**
     * De createscript-tabellen heten in MySQL kleine letters en hebben een
     * eigen primaire sleutel (`Id`) plus Nederlandse datumkolommen.
     */
    protected $table = 'product';

    protected $primaryKey = 'Id';

    public const CREATED_AT = 'DatumAangemaakt';
    public const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'Barcode',
        'IsActief',
        'Opmerkingen',
    ];

    protected function casts(): array
    {
        return [
            'IsActief' => 'boolean',
        ];
    }

    /**
     * De voorraadregel van dit product (één regel per product).
     */
    public function magazijn(): HasOne
    {
        return $this->hasOne(Magazijn::class, 'ProductId', 'Id');
    }

    /**
     * De allergenen die via de koppeltabel aan dit product hangen.
     */
    public function allergenen(): BelongsToMany
    {
        return $this->belongsToMany(Allergeen::class, 'productperallergeen', 'ProductId', 'AllergeenId');
    }

    /**
     * De leveranciers met de bijbehorende leveringen (koppeltabel).
     */
    public function leveranciers(): BelongsToMany
    {
        return $this->belongsToMany(Leverancier::class, 'productperleverancier', 'ProductId', 'LeverancierId');
    }

    /**
     * Alle losse leveringsregels van dit product.
     */
    public function leveringen(): HasMany
    {
        return $this->hasMany(ProductPerLeverancier::class, 'ProductId', 'Id');
    }
}
