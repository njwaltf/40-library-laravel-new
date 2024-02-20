<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();
        // Filter by status
        if ($request->filled('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }
        // Search by booking code
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $query->where('booking_code', $keyword);
        }
        // Retrieve paginated bookings
        $bookings = $query->where('user_id', auth()->user()->id)->paginate(10);
        return view('dashboard.member.booking.index', [
            'title' => 'Daftar Peminjaman',
            'bookings' => $bookings
        ]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'user_id' => ['required', 'exists:users,id'],
            // 'book_at' => ['required', 'date'],
            'status' => ['required'],
        ]);
        // Generate booking code
        $validatedData['booking_code'] = Booking::generateBookingCode(8);
        // generate book_at
        $validatedData['book_at'] = Carbon::now();
        // Set expired date
        // $validatedData['expired_date'] = Carbon::now()->addDays(7);
        // Decrement stock of the booked book
        // $book = Book::find($validatedData['book_id']);
        // $book->decrement('stock');
        // Create booking record
        Booking::create($validatedData);
        return redirect('/bookings')->with('success', 'Peminjaman berhasil diajukan!');
    }
    public function show(Request $request)
    {
        return view('dashboard.member.booking.show', [
            'title' => 'Detail Peminjaman',
            'bookings' => Booking::where([
                'id' => $request->id,
                'user_id' => auth()->user()->id
            ])->get()
        ]);
    }
}
