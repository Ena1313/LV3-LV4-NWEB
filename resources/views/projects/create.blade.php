@extends('layouts.app')

@section('content')
<h2>Kreiraj novi projekt</h2>

<form method="POST" action="{{ route('projekti.store') }}">
    @csrf

    <label>Naziv:</label>
    <input type="text" name="naziv" required>

    <label>Opis:</label>
    <textarea name="opis"></textarea>

    <label>Cijena:</label>
    <input type="number" name="cijena" step="0.01" required>

    <label>Obavljeni poslovi:</label>
    <textarea name="obavljeni_poslovi"></textarea>

    <label>Datum početka:</label>
    <input type="date" name="datum_pocetka" required>

    <label>Datum završetka:</label>
    <input type="date" name="datum_zavrsetka" required>

    <button type="submit">Spremi</button>
</form>
@endsection
