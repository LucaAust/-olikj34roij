<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get holt daten aus DB
        // latest() ist eine Kurzform für orderBy('created_at', 'desc')
        $listings = Listing::latest()->get();
        return view('listings.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        // Validierung der Formulardaten
        $request->validate([
            'name' => 'required',
            'beschreibung' => 'required',
            'preis' => 'required|numeric',
        ]);

        // Neues Listing in der Datenbank speichern
        Listing::create([
            'customer_id' => auth()->id(),
            'name' => $request->name,
            'beschreibung' => $request->beschreibung,
            'preis' => $request->preis
        ]);

        // Benutzer zur Übersichtsseite weiterleiten
        return redirect('/listings');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing) {
        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing) {
        // Listing $listing: Holt das Listing anhand der ID aus der Datenbank (Route Model Binding).
        return view('listings.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing) {
        # Überprüft die Formulardaten (name, beschreibung, preis)
        $request->validate([
            'name' => 'required',
            'beschreibung' => 'required',
            'preis' => 'required|numeric',
        ]);

        $listing->update($request->only(['name', 'beschreibung', 'preis']));

        return redirect('/listings/' . $listing->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/listings');
    }
    
}
