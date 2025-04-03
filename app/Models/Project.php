<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'naziv',
        'opis',
        'cijena',
        'obavljeni_poslovi',
        'datum_pocetka',
        'datum_zavrsetka',
        'user_id',
    ];

    /**
     * Korisnik koji je voditelj projekta.
     */
    public function voditelj()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Korisnici koji su članovi projektnog tima.
     */
    public function clanovi()
    {
        return $this->belongsToMany(User::class);
    }
}
