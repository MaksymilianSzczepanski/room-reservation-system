@csrf

<div style="display:grid;gap:18px;">
    <div>
        <label for="name" style="display:block;margin-bottom:8px;font-size:0.95rem;color:var(--muted);">Imie i nazwisko</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $user->name ?? '') }}"
            required
            style="width:100%;padding:14px 16px;border-radius:16px;border:1px solid var(--line);background:#fff;"
        >
    </div>

    <div>
        <label for="email" style="display:block;margin-bottom:8px;font-size:0.95rem;color:var(--muted);">Email</label>
        <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email', $user->email ?? '') }}"
            required
            style="width:100%;padding:14px 16px;border-radius:16px;border:1px solid var(--line);background:#fff;"
        >
    </div>

    <div>
        <label for="role_id" style="display:block;margin-bottom:8px;font-size:0.95rem;color:var(--muted);">Rola</label>
        <select
            id="role_id"
            name="role_id"
            required
            style="width:100%;padding:14px 16px;border-radius:16px;border:1px solid var(--line);background:#fff;"
        >
            <option value="">Wybierz role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ (string) old('role_id', $user->role_id ?? '') === (string) $role->id ? 'selected' : '' }}>
                    {{ $role->role_name }}
                </option>
            @endforeach
        </select>
    </div>

    <div style="display:grid;grid-template-columns:repeat(2, minmax(0, 1fr));gap:18px;">
        <div>
            <label for="password" style="display:block;margin-bottom:8px;font-size:0.95rem;color:var(--muted);">
                {{ isset($user) ? 'Nowe haslo' : 'Haslo' }}
            </label>
            <input
                id="password"
                name="password"
                type="password"
                {{ isset($user) ? '' : 'required' }}
                style="width:100%;padding:14px 16px;border-radius:16px;border:1px solid var(--line);background:#fff;"
            >
        </div>

        <div>
            <label for="password_confirmation" style="display:block;margin-bottom:8px;font-size:0.95rem;color:var(--muted);">Powtorz haslo</label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                {{ isset($user) ? '' : 'required' }}
                style="width:100%;padding:14px 16px;border-radius:16px;border:1px solid var(--line);background:#fff;"
            >
        </div>
    </div>

    @if (isset($user))
        <div style="color:var(--muted);font-size:0.92rem;">
            Zostaw pola hasla puste, jesli nie chcesz go zmieniac.
        </div>
    @endif

    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <button type="submit" class="button-primary">{{ $submitLabel }}</button>
        <a href="{{ route('users.index') }}" class="button button-secondary">Wroc do listy</a>
    </div>
</div>
