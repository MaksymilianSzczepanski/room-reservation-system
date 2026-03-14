@extends('layouts.app')

@section('content')
    <div class="topbar">
        <div class="brand">
            <span class="eyebrow">Administracja</span>
            <h1>Zarzadzanie uzytkownikami</h1>
            <p>Dodawaj, edytuj i usuwaj konta w systemie rezerwacji sal.</p>
        </div>

        <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <a href="{{ route('home') }}" class="button button-secondary">Dashboard</a>
            <a href="{{ route('users.create') }}" class="button button-primary">Dodaj uzytkownika</a>
        </div>
    </div>

    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif

    @if (session('error'))
        <div class="flash flash-error">{{ session('error') }}</div>
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

    <div class="card" style="padding:16px;overflow:hidden;">
        <div style="display:grid;gap:12px;">
            @forelse ($users as $managedUser)
                <div style="display:grid;grid-template-columns:minmax(0, 2fr) minmax(0, 1.2fr) auto;gap:16px;align-items:center;padding:18px;border-radius:18px;background:rgba(255,255,255,0.62);border:1px solid var(--line);">
                    <div>
                        <strong style="display:block;font-size:1.05rem;">{{ $managedUser->name }}</strong>
                        <span style="display:block;color:var(--muted);">{{ $managedUser->email }}</span>
                    </div>

                    <div>
                        <span class="eyebrow">Rola</span>
                        <div style="margin-top:6px;">{{ optional($managedUser->role)->role_name ?? 'Brak roli' }}</div>
                    </div>

                    <div style="display:flex;gap:10px;flex-wrap:wrap;justify-content:flex-end;">
                        <a href="{{ route('users.edit', $managedUser) }}" class="button button-secondary">Edytuj</a>

                        <form method="POST" action="{{ route('users.destroy', $managedUser) }}" onsubmit="return confirm('Usunac tego uzytkownika?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" style="background:rgba(125,51,36,0.12);color:var(--accent-dark);border:1px solid rgba(125,51,36,0.16);">
                                Usun
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div style="padding:28px;border-radius:18px;background:rgba(255,255,255,0.62);border:1px dashed var(--line);color:var(--muted);">
                    Brak uzytkownikow do wyswietlenia.
                </div>
            @endforelse
        </div>
    </div>

    @if ($users->hasPages())
        <div style="display:flex;justify-content:space-between;align-items:center;gap:16px;margin-top:16px;">
            <div style="color:var(--muted);">
                Strona {{ $users->currentPage() }} z {{ $users->lastPage() }}
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;">
                @if ($users->onFirstPage())
                    <span class="button button-secondary" style="opacity:0.5;pointer-events:none;">Poprzednia</span>
                @else
                    <a href="{{ $users->previousPageUrl() }}" class="button button-secondary">Poprzednia</a>
                @endif

                @if ($users->hasMorePages())
                    <a href="{{ $users->nextPageUrl() }}" class="button button-secondary">Nastepna</a>
                @else
                    <span class="button button-secondary" style="opacity:0.5;pointer-events:none;">Nastepna</span>
                @endif
            </div>
        </div>
    @endif

    <style>
        @media (max-width: 860px) {
            div[style*="grid-template-columns:minmax(0, 2fr) minmax(0, 1.2fr) auto"] {
                grid-template-columns: 1fr !important;
            }
        }
    </style>
@endsection
