<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class LeveringInformatieController extends Controller
{
    /**
     * `GET /magazijn/product/{product}/levering` — Levering Informatie.
     *
     * Leveranciersgegevens staan boven de tabel, alle leverdata eronder en die
     * leveringen lopen op datum oplopend. Een product zonder voorraad krijgt de
     * melding uit de user story met de eerstvolgende verwachte levering; de
     * view stuurt na 4 seconden automatisch terug naar het overzicht.
     */
    public function show(Product $product): View
    {
        $product->load(['magazijn', 'leveringen.leverancier', 'leveranciers']);

        $leveringen = $product->leveringen
            ->sortBy('DatumLevering')
            ->values();

        $eerstvolgendeLevering = $leveringen
            ->first(fn ($levering) => $levering->DatumEerstVolgendeLevering !== null)
            ?->DatumEerstVolgendeLevering;

        // De exacte melding uit de user story, inclusief datumnotatie d-m-Y.
        $geenVoorraadMelding = sprintf(
            'Er is van dit product op dit moment geen voorraad aanwezig, de verwachte eerstvolgende levering is: %s',
            $eerstvolgendeLevering?->format('d-m-Y') ?? 'onbekend'
        );

        return view('magazijn.levering', [
            'product' => $product,
            'leveranciers' => $product->leveranciers,
            'leveringen' => $leveringen,
            'heeftVoorraad' => (bool) $product->magazijn?->heeftVoorraad(),
            'eerstvolgendeLevering' => $eerstvolgendeLevering,
            'geenVoorraadMelding' => $geenVoorraadMelding,
        ]);
    }
}
