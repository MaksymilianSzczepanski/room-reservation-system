@extends('layouts.app')

@section('content')
    <div class="topbar">
        <div class="brand">
            <span class="eyebrow">Panel glowny</span>
            <h1>Witaj, {{ auth()->user()->name }}</h1>
            <p>Masz aktywna sesje i dostep do podstawowego panelu systemu rezerwacji sal.</p>
        </div>

        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            @can('manage-users')
                <a href="{{ route('users.index') }}" class="button button-secondary">Uzytkownicy</a>
            @endcan

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="button-secondary">Wyloguj</button>
            </form>
        </div>
    </div>

    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif

    <div style="display:grid;grid-template-columns:repeat(3, minmax(0, 1fr));gap:18px;margin-bottom:18px;">
        <div class="card" style="padding:24px;">
            <div class="eyebrow">Uzytkownicy</div>
            <div style="font-size:2.4rem;margin:8px 0 4px;">{{ $stats['users'] }}</div>
            <div style="color:var(--muted);">Liczba kont w systemie.</div>
        </div>
        <div class="card" style="padding:24px;">
            <div class="eyebrow">Sale</div>
            <div style="font-size:2.4rem;margin:8px 0 4px;">{{ $stats['rooms'] }}</div>
            <div style="color:var(--muted);">Dostepne pomieszczenia do rezerwacji.</div>
        </div>
        <div class="card" style="padding:24px;">
            <div class="eyebrow">Rezerwacje</div>
            <div style="font-size:2.4rem;margin:8px 0 4px;">{{ $stats['reservations'] }}</div>
            <div style="color:var(--muted);">Wszystkie zapisane rezerwacje.</div>
        </div>
    </div>

    <div class="card" style="padding:24px;">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-bottom:18px;">
            <div>
                <div class="eyebrow">Najblizsze rezerwacje</div>
                <h2 style="margin:8px 0 0;font-size:1.6rem;">Podglad danych startowych</h2>
            </div>
            <span class="status">Zalogowano poprawnie</span>
        </div>

        @if ($upcomingReservations->isEmpty())
            <div style="padding:24px;border-radius:18px;background:rgba(255,255,255,0.62);border:1px dashed var(--line);color:var(--muted);">
                Brak rezerwacji w bazie. Mechanizm logowania dziala, a panel jest gotowy pod dalsza rozbudowe.
            </div>
        @else
            <div style="display:grid;gap:12px;">
                @foreach ($upcomingReservations as $reservation)
                    <div style="display:flex;justify-content:space-between;gap:16px;padding:16px 18px;border-radius:18px;background:rgba(255,255,255,0.62);border:1px solid var(--line);">
                        <div>
                            <strong style="display:block;">{{ optional($reservation->room)->name ?? 'Sala bez nazwy' }}</strong>
                            <span style="color:var(--muted);">
                                {{ optional($reservation->user)->name ?? 'Nieznany uzytkownik' }} - {{ $reservation->date->format('Y-m-d') }}
                            </span>
                        </div>
                        <div style="text-align:right;">
                            <strong>{{ $reservation->start_time }} - {{ $reservation->end_time }}</strong>
                            <div style="color:var(--muted);text-transform:capitalize;">{{ $reservation->status }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        @media (max-width: 860px) {
            div[style*="grid-template-columns:repeat(3"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
