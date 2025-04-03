@extends('layouts.app')

@section('content')
<h2>Projekt: {{ $project->naziv }}</h2>

<p><strong>Opis:</strong> {{ $project->opis }}</p>
<p><strong>Cijena:</strong> {{ $project->cijena }} €</p>
<p><strong>Obavljeni poslovi:</strong> {{ $project->obavljeni_poslovi }}</p>
<p><strong>Početak:</strong> {{ $project->datum_pocetka }}</p>
<p><strong>Završetak:</strong> {{ $project->datum_zavrsetka }}</p>

<h3>Članovi tima:</h3>
<ul>
    @foreach ($project->clanovi as $clan)
        <li>{{ $clan->name }} ({{ $clan->email }})</li>
    @endforeach
</ul>

@if (auth()->id() === $project->user_id)
    <h4>Dodaj člana</h4>
    <form method="POST" action="{{ route('projekti.dodajClana', $project) }}">
        @csrf
        <select name="user_id" required>
            @foreach ($korisnici as $korisnik)
                <option value="{{ $korisnik->id }}">{{ $korisnik->name }}</option>
            @endforeach
        </select>
        <button type="submit">Dodaj</button>
    </form>

    <a href="{{ route('projekti.edit', $project) }}">✏️ Uredi</a>

    <form method="POST" action="{{ route('projekti.destroy', $project) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Jeste li sigurni?')">🗑 Obriši</button>
    </form>
@endif

<a href="{{ route('projekti.index') }}">⬅️ Natrag na popis</a>
@endsection
