@extends('layouts.app')

@section('content')
    <div class="topbar">
        <div class="brand">
            <span class="eyebrow">Administracja</span>
            <h1>Edytuj uzytkownika</h1>
            <p>Aktualizujesz dane konta: {{ $user->name }}.</p>
        </div>
        <a href="{{ route('users.index') }}" class="button button-secondary">Lista uzytkownikow</a>
    </div>

    @if ($errors->any())
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card" style="padding:28px;">
        <form method="POST" action="{{ route('users.update', $user) }}">
            @method('PUT')
            @include('users._form', ['submitLabel' => 'Zapisz zmiany'])
        </form>
    </div>
@endsection
