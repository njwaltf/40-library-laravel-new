<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class UserBookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Apply search
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $query->search($keyword);
        }

        // Apply category filter
        if ($request->filled('category')) {
            $categoryId = $request->input('category');
            $query->FilterByCategory($categoryId);
        }

        // Get paginated results
        $books = $query->orderBy('title', 'asc')->paginate(10);
        return view('dashboard.member.book.index', [
            'title' => 'Daftar Buku',
            'books' => $books,
            'categories' => Category::all()
        ]);
    }
    public function show(Request $request)
    {
        return view('dashboard.member.book.show', [
            'books' => Book::where('id', $request->id)->get(),
            'title' => 'Detail Buku'
        ]);
    }
}
