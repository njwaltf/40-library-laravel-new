<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use App\Models\User;
use App\Models\Category;
use Illuminate\Routing\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Count the number of users where role is admin
        $adminCount = User::where('role', 'admin')->count();
        $librarianCount = User::where('role', 'librarian')->count();
        $memberCount = User::where('role', 'member')->count();

        // book count
        $bookCount = Book::count();

        // category count
        $categoryCount = Category::count();
        // user count
        $userCount = User::count();

        // count booking Dipinjam
        $bookingCount = Booking::where('status', 'Dipinjam')->count();
        // count booking Dikembalkan Terlambat
        $lateBookingCount = Booking::where('status', 'Dikembalikan Terlambat')->count();

        // 5 latest booking
        $latestBookings = Booking::latest()->take(5)->get();

        return view('dashboard.admin.admin-dashboard', [
            'title' => 'Dashboard',
            'adminCount' => $adminCount,
            'librarianCount' => $librarianCount,
            'memberCount' => $memberCount,
            'bookCount' => $bookCount,
            'categoryCount' => $categoryCount,
            'userCount' => $userCount,
            'bookingCount' => $bookingCount,
            'lateBookingCount' => $lateBookingCount,
            'latestBookings' => $latestBookings
        ]);
    }
    public function bookingStatistics()
    {
        // Query to fetch booking counts by status
        $bookingStatistics = Booking::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Return the booking statistics as JSON
        return response()->json($bookingStatistics);
    }
}
