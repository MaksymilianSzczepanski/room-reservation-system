<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the dashboard after login.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        return view('home', [
            'stats' => [
                'users' => User::count(),
                'rooms' => Room::count(),
                'reservations' => Reservation::count(),
            ],
            'upcomingReservations' => Reservation::with(['room', 'user'])
                ->orderBy('date')
                ->orderBy('start_time')
                ->take(5)
                ->get(),
        ]);
    }
}
