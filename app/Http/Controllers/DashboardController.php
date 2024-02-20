<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.member.member-dashboard', [
            'title' => 'Dashboard',
            'bookings' => Booking::where('user_id', auth()->user()->id)->count(),
            'bookingsDPJ' => Booking::where([
                'user_id' => auth()->user()->id,
                'status' => 'Dipinjam'
            ])->count(),
            'bookingsDone' => Booking::where([
                'user_id' => auth()->user()->id,
                'status' => 'Dikembalikan'
            ])->count(),
            'latestBookings' => Booking::where('user_id', auth()->user()->id)->latest()->take(5)->get()
        ]);
    }
}
