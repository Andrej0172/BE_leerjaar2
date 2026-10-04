<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GebruikerBeheerController extends Controller
{
    /**
     * `GET /gebruikers` — de rollen van de gebruikers beheren.
     *
     * Alleen de Administrator komt hier (Gate `gebruiker.beheren`).
     */
    public function index(): View
    {
        $gebruikers = User::orderBy('email')->get();

        return view('gebruikers.beheer', compact('gebruikers'));
    }

    /**
     * `PATCH /gebruikers/{user}/rol` — de rol van één gebruiker wijzigen.
     */
    public function wijzigRol(Request $request, User $user): RedirectResponse
    {
        $gegevens = $request->validate([
            'rolenum' => ['required', 'string', Rule::in([
                User::ROL_GEBRUIKER,
                User::ROL_MAGAZIJNMEDEWERKER,
                User::ROL_ADMINISTRATOR,
            ])],
        ]);

        $user->update($gegevens);

        return redirect()
            ->route('gebruiker.index')
            ->with('status', __('De rol van :name is gewijzigd naar :rol.', [
                'name' => $user->name,
                'rol' => $user->rolenum,
            ]));
    }
}
