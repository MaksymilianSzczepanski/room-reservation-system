@extends('layouts.app')

@section('content')
    <div class="topbar">
        <div class="brand">
            <span class="eyebrow">Administracja</span>
            <h1>Dodaj uzytkownika</h1>
            <p>Utworz nowe konto i od razu przypisz mu role w systemie.</p>
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
        <form method="POST" action="{{ route('users.store') }}">
            @include('users._form', ['submitLabel' => 'Zapisz uzytkownika'])
        </form>
    </div>
@endsection
