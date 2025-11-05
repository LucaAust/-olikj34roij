<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * $fillable schützt vor Mass Assignment Attacks(Dies erlaubt alle Felder und kann zu Datenbankmanipulationen durch Angreifer führen).
     * Erlaubt nur die definierten Felder für Massenbearbeitung über create() oder update().
     */
    protected $fillable = ['name', 'email', 'password', 'plz', 'ort', 'strasse', 'hausnummer', 'telefonnummer'];

    // Ein Customer kann mehrere Listings haben
    public function listings() {
        return $this->hasMany(Listing::class);
    }

    // Ein Customer kann mehrere Listings favorisieren
    public function favorites() {
        return $this->belongsToMany(Listing::class, 'favorites');
    }
}
