<?php

namespace App\Http\Controllers;

use App\Models\Magazijn;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoorraadBeheerController extends Controller
{
    /**
     * `GET /magazijn/voorraad` — de voorraad per product bijwerken.
     *
     * Alleen de Administrator komt hier (Gate `magazijn.voorraad-bijwerken`).
     */
    public function index(): View
    {
        $magazijnregels = Magazijn::with('product')
            ->orderBy('Id')
            ->get();

        return view('magazijn.voorraad', compact('magazijnregels'));
    }

    /**
     * `PUT /magazijn/voorraad/{magazijn}` — één voorraadregel opslaan.
     */
    public function update(Request $request, Magazijn $magazijn): RedirectResponse
    {
        $gegevens = $request->validate([
            'AantalAanwezig' => ['nullable', 'integer', 'min:0'],
        ]);

        $magazijn->update($gegevens);

        return redirect()
            ->route('magazijn.voorraad')
            ->with('status', __('De voorraad van :product is bijgewerkt.', ['product' => $magazijn->product?->Naam ?? '?']));
    }
}
