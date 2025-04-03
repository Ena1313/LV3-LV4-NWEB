@extends('layouts.app')

@section('content')
    <h2>Dobrodošao, {{ auth()->user()->name }}</h2>

    <a href="{{ route('projekti.create') }}">➕ Kreiraj novi projekt</a>

    <h3>Moji projekti kao voditelj:</h3>
    <ul>
        @forelse ($vodeniProjekti as $projekt)
            <li>
                <a href="{{ route('projekti.show', $projekt) }}">{{ $projekt->naziv }}</a>
            </li>
        @empty
            <li>Još niste dodali nijedan projekt.</li>
        @endforelse
    </ul>

    <h3>Projekti na kojima sam član:</h3>
    <ul>
        @forelse ($clanProjekti as $projekt)
            <li>
                <a href="{{ route('projekti.show', $projekt) }}">{{ $projekt->naziv }}</a>
            </li>
        @empty
            <li>Niste član nijednog projekta.</li>
        @endforelse
    </ul>
@endsection
