<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductPerAllergeen extends Model
{
    protected $table = 'productperallergeen';

    protected $primaryKey = 'Id';

    public const CREATED_AT = 'DatumAangemaakt';
    public const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'ProductId',
        'AllergeenId',
        'IsActief',
        'Opmerkingen',
    ];

    protected function casts(): array
    {
        return [
            'IsActief' => 'boolean',
        ];
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    public function allergeen(): BelongsTo
    {
        return $this->belongsTo(Allergeen::class, 'AllergeenId', 'Id');
    }
}
