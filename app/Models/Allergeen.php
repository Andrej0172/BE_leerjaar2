<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergeen extends Model
{
    protected $table = 'allergeen';

    protected $primaryKey = 'Id';

    public const CREATED_AT = 'DatumAangemaakt';
    public const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'Naam',
        'Omschrijving',
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
     * De producten waarin dit allergeen voorkomt.
     */
    public function producten(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'productperallergeen', 'AllergeenId', 'ProductId');
    }
}
