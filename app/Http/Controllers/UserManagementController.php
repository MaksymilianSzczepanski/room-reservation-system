<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => User::with('role')
                ->orderBy('name')
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::orderBy('role_name')->get(),
        ]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        return redirect()
            ->route('users.index')
            ->with('status', 'Uzytkownik zostal dodany.');
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::orderBy('role_name')->get(),
        ]);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'role_id' => ['required', 'exists:roles,id'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role_id' => $validated['role_id'],
        ]);

        if (! empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('status', 'Dane uzytkownika zostaly zaktualizowane.');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('users.index')
                ->with('error', 'Nie mozesz usunac aktualnie zalogowanego konta.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('status', 'Uzytkownik zostal usuniety.');
    }
}
