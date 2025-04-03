<!DOCTYPE html>
<html>
<head>
    <title>Projekti</title>
    <meta charset="utf-8">
</head>
<body>
    @auth
        <p>Prijavljeni ste kao: {{ auth()->user()->name }}</p>
        <a href="{{ route('dashboard') }}">🏠 Početna</a>
        <a href="{{ route('projekti.index') }}">📁 Projekti</a>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit">🚪 Odjava</button>
        </form>
    @endauth

    <hr>

    @yield('content')
</body>
</html>
