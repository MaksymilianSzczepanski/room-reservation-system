@extends('layouts.app')

@section('content')
    <div class="topbar">
        <div class="brand">
            <span class="eyebrow">Room Reservation System</span>
            <h1>Logowanie do systemu rezerwacji sal</h1>
            <p>Zaloguj sie, aby zarzadzac salami, uzytkownikami i rezerwacjami w jednym miejscu.</p>
        </div>
        <span class="status">Sesje uzytkownikow aktywne</span>
    </div>

    <div class="card" style="display:grid;grid-template-columns:1.1fr .9fr;overflow:hidden;">
        <div style="padding:40px;display:flex;flex-direction:column;justify-content:space-between;gap:28px;background:linear-gradient(160deg, rgba(125,51,36,0.94), rgba(194,97,57,0.88));color:#fffaf4;">
            <div>
                <div class="eyebrow" style="color:rgba(255,250,244,0.8);">Dostep dla zespolu</div>
                <h2 style="margin:10px 0 12px;font-size:clamp(2rem,4vw,3.4rem);line-height:0.95;">Szybki start bez dodatkowych pakietow auth.</h2>
                <p style="margin:0;max-width:34ch;line-height:1.6;color:rgba(255,250,244,0.84);">
                    Mechanizm logowania dziala na sesjach Laravel i chroni panel aplikacji po stronie web.
                </p>
            </div>

            <div style="display:grid;gap:12px;">
                <div style="padding:16px 18px;border-radius:18px;background:rgba(255,250,244,0.14);">
                    <strong style="display:block;margin-bottom:6px;">Domyslne konto testowe</strong>
                    <span style="display:block;opacity:0.9;">admin@example.com</span>
                    <span style="display:block;opacity:0.9;">haslo: password</span>
                </div>
                <div style="font-size:0.95rem;color:rgba(255,250,244,0.76);">
                    Po zalogowaniu trafisz do prostego dashboardu z podsumowaniem danych.
                </div>
            </div>
        </div>

        <div style="padding:40px;background:var(--panel-strong);">
            @if (session('status'))
                <div class="flash">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" style="display:grid;gap:18px;">
                @csrf

                <div>
                    <label for="email" style="display:block;margin-bottom:8px;font-size:0.95rem;color:var(--muted);">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        style="width:100%;padding:14px 16px;border-radius:16px;border:1px solid var(--line);background:#fff;"
                    >
                </div>

                <div>
                    <label for="password" style="display:block;margin-bottom:8px;font-size:0.95rem;color:var(--muted);">Haslo</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        style="width:100%;padding:14px 16px;border-radius:16px;border:1px solid var(--line);background:#fff;"
                    >
                </div>

                <label style="display:flex;align-items:center;gap:10px;font-size:0.95rem;color:var(--muted);">
                    <input name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}>
                    Zapamietaj mnie
                </label>

                <button type="submit" class="button-primary">Zaloguj sie</button>
            </form>
        </div>
    </div>

    <style>
        @media (max-width: 920px) {
            .card[style*="grid-template-columns"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
