<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;

class MagazijnOverzichtController extends Controller
{
    /**
     * `GET /magazijn` — Overzicht Magazijn Jamin.
     *
     * Standaard gesorteerd op barcode oplopend, met de voorraadregel van het
     * product erbij zodat we in één oogopslag de verpakkingseenheid en het
     * aantal aanwezig kunnen tonen.
     */
    public function index(): View
    {
        $producten = Product::query()
            ->with('magazijn')
            ->orderBy('Barcode')
            ->get();

        return view('magazijn.overzicht', compact('producten'));
    }
}
