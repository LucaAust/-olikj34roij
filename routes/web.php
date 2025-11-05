<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello');
});

Route::get('/check-name', function () {
    return response()->json([
    'name' => config('app.name'),
    ]);
});

Route::get('/benutzer/{id}', function ($id) {
    return "Benutzer ID: " . $id;
});

Route::get('/profil/{name?}', function ($name = 'Gast') {
    return "Profil von: " . $name;
});

// Nur zahlen für number erlaubt, ein /bestellung/abc würde einen 404 werfen
Route::get('/bestellung/{nummer}', function ($nummer) {
    return "Bestellnummer: " . $nummer;
})->where('nummer', '[0-9]+');


// Route::resource('listings', ListingController::class);
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');; // Route zum Anzeigen des Formulars
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store'); // Route zum Verarbeiten der Formulardaten
Route::get('/listings', [ListingController::class, 'index'])->name('listings.index');
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');  // Formular anzeigen
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');    // Daten aktualisieren
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');

Route::get('login', [UserController::class, 'login']);
Route::resource('user', UserController::class);