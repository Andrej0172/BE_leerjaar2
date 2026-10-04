<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class AllergenenOverzichtController extends Controller
{
    /**
     * `GET /magazijn/product/{product}/allergenen` — Overzicht Allergenen.
     *
     * Naam en barcode van het product staan boven de tabel, de allergenen
     * eronder gesorteerd op naam oplopend. Een product zonder allergenen krijgt
     * de melding uit de user story en keert na 4 seconden terug naar het
     * overzicht.
     */
    public function show(Product $product): View
    {
        $allergenen = $product->allergenen()
            ->orderBy('Naam')
            ->get();

        return view('magazijn.allergenen', [
            'product' => $product,
            'allergenen' => $allergenen,
            'geenAllergenenMelding' => 'In dit product zitten geen stoffen die een allergische reactie kunnen veroorzaken',
        ]);
    }
}
