<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Leverancier extends Model
{
    protected $table = 'leverancier';

    protected $primaryKey = 'Id';

    public const CREATED_AT = 'DatumAangemaakt';
    public const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'ContactPersoon',
        'LeverancierNummer',
        'Mobiel',
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
     * De producten die deze levert, inclusief leveringsregels.
     */
    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'productperleverancier', 'LeverancierId', 'ProductId')
            ->withPivot(['DatumLevering', 'Aantal', 'DatumEerstVolgendeLevering']);
    }
}
