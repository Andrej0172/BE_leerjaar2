<?php

use App\Http\Controllers\AllergenenOverzichtController;
use App\Http\Controllers\GebruikerBeheerController;
use App\Http\Controllers\LeveringInformatieController;
use App\Http\Controllers\MagazijnOverzichtController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoorraadBeheerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    /*
     * Leesrecht op het magazijn: Magazijnmedewerker en Administrator.
     * De gebruiker zonder recht krijgt hier een 403, ook via de URL.
     */
    Route::middleware('can:magazijn.bekijken')->group(function () {
        Route::get('/magazijn', [MagazijnOverzichtController::class, 'index'])
            ->name('magazijn.index');

        Route::get('/magazijn/product/{product}/levering', [LeveringInformatieController::class, 'show'])
            ->name('magazijn.levering');

        Route::get('/magazijn/product/{product}/allergenen', [AllergenenOverzichtController::class, 'show'])
            ->name('magazijn.allergenen');
    });

    /*
     * Schrijfrechten: alleen de Administrator.
     */
    Route::middleware('can:magazijn.voorraad-bijwerken')->group(function () {
        Route::get('/magazijn/voorraad', [VoorraadBeheerController::class, 'index'])
            ->name('magazijn.voorraad');

        Route::put('/magazijn/voorraad/{magazijn}', [VoorraadBeheerController::class, 'update'])
            ->name('magazijn.voorraad.bijwerken');
    });

    Route::middleware('can:gebruiker.beheren')->group(function () {
        Route::get('/gebruikers', [GebruikerBeheerController::class, 'index'])
            ->name('gebruiker.index');

        Route::patch('/gebruikers/{user}/rol', [GebruikerBeheerController::class, 'wijzigRol'])
            ->name('gebruiker.rol');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
