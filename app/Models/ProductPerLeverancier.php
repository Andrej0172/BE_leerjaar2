<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPerLeverancier extends Model
{
    protected $table = 'productperleverancier';

    protected $primaryKey = 'Id';

    public const CREATED_AT = 'DatumAangemaakt';
    public const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'ProductId',
        'LeverancierId',
        'DatumLevering',
        'Aantal',
        'DatumEerstVolgendeLevering',
        'IsActief',
        'Opmerkingen',
    ];

    protected function casts(): array
    {
        return [
            'DatumLevering' => 'date:Y-m-d',
            'DatumEerstVolgendeLevering' => 'date:Y-m-d',
            'Aantal' => 'integer',
            'IsActief' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    public function leverancier(): BelongsTo
    {
        return $this->belongsTo(Leverancier::class, 'LeverancierId', 'Id');
    }
}
