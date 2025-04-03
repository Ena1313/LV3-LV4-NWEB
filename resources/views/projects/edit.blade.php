@extends('layouts.app')

@section('content')
<h2>Uredi projekt</h2>

<form method="POST" action="{{ route('projekti.update', $project) }}">
    @csrf
    @method('PUT')

    @if (auth()->id() === $project->user_id)
        <label>Naziv:</label>
        <input type="text" name="naziv" value="{{ $project->naziv }}" required>

        <label>Opis:</label>
        <textarea name="opis">{{ $project->opis }}</textarea>

        <label>Cijena:</label>
        <input type="number" name="cijena" value="{{ $project->cijena }}" step="0.01" required>

        <label>Datum početka:</label>
        <input type="date" name="datum_pocetka" value="{{ $project->datum_pocetka }}" required>

        <label>Datum završetka:</label>
        <input type="date" name="datum_zavrsetka" value="{{ $project->datum_zavrsetka }}" required>
    @endif

    <label>Obavljeni poslovi:</label>
    <textarea name="obavljeni_poslovi">{{ $project->obavljeni_poslovi }}</textarea>

    <button type="submit">Spremi izmjene</button>
</form>

<a href="{{ route('projekti.show', $project) }}">⬅️ Natrag</a>
@endsection
