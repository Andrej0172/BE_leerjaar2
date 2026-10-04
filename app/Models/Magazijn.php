<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Magazijn extends Model
{
    protected $table = 'magazijn';

    protected $primaryKey = 'Id';

    public const CREATED_AT = 'DatumAangemaakt';
    public const UPDATED_AT = 'DatumGewijzigd';

    protected $fillable = [
        'ProductId',
        'VerpakkingsEenheid',
        'AantalAanwezig',
        'IsActief',
        'Opmerkingen',
    ];

    protected function casts(): array
    {
        return [
            'VerpakkingsEenheid' => 'decimal:2',
            'AantalAanwezig' => 'integer',
            'IsActief' => 'boolean',
        ];
    }

    /**
     * Het product waarop deze voorraadregel betrekking heeft.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    /**
     * Of er daadwerkelijk voorraad op het schap staat.
     */
    public function heeftVoorraad(): bool
    {
        return $this->AantalAanwezig !== null && $this->AantalAanwezig > 0;
    }
}
