@extends('layouts.app')

@section('content')
<h2>Moji projekti (kao voditelj)</h2>
<ul>
    @foreach ($vodeni as $projekt)
        <li>
            <a href="{{ route('projekti.show', $projekt) }}">{{ $projekt->naziv }}</a>
        </li>
    @endforeach
</ul>

<h2>Projekti na kojima sam član</h2>
<ul>
    @foreach ($clanstva as $projekt)
        <li>
            <a href="{{ route('projekti.show', $projekt) }}">{{ $projekt->naziv }}</a>
        </li>
    @endforeach
</ul>

<a href="{{ route('projekti.create') }}">➕ Novi projekt</a>
@endsection
