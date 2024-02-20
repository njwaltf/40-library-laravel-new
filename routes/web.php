<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DontHaveAccess;
use App\Http\Controllers\LibrarianDashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\UserBookController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\UserController;
use Database\Seeders\ApplySeeder;
use Illuminate\Support\Facades\Route;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// guest route
Route::middleware(['guest'])->group(function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
    Route::get('/apply', [ApplyController::class, 'index1']);
    Route::post('/apply', [ApplyController::class, 'store']);
});

Route::get('/home', function () {
    return redirect('/');
});

// error route
Route::get('/you-dont-have-access', [DontHaveAccess::class, 'index'])->name('you-dont-have-access');

// Route::resource('/bookings-management', BookingController::class);

// Route::middleware('userAccess:librarian')->group(function () {
//     Route::resource('/bookings-management', BookingController::class);
// Route::get('/pdf/export-booking/', [BookingController::class, 'exportBookingPDF']);
// });
// auth route

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // profile all user
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile-edit');
    Route::post('/profile/edit/{id}', [ProfileController::class, 'update']);
    // admin route
    Route::get('/dashboard-admin', [AdminDashboardController::class, 'index'])->middleware('userAccess:admin');
    Route::get('/api/booking/statistics', [AdminDashboardController::class, 'bookingStatistics']);
    // user model
    Route::get('/users-management', [UserController::class, 'index'])->middleware('userAccess:admin')->name('users-management');
    Route::get('/users-management/{id}', [UserController::class, 'show'])->middleware('userAccess:admin');
    Route::get('/users-management-create', [UserController::class, 'create'])->middleware('userAccess:admin');
    Route::post('/users-management-create', [UserController::class, 'store'])->middleware('userAccess:admin');
    Route::get('/users-management/{id}/edit', [UserController::class, 'edit'])->middleware('userAccess:admin');
    Route::post('/users-management-delete/{id}', [UserController::class, 'destroy'])->middleware('userAccess:admin');
    Route::post('/users-management-edit', [UserController::class, 'update'])->middleware('userAccess:admin');
    Route::get('/applies-management', [ApplyController::class, 'index'])->middleware('userAccess:admin');
    Route::resource('/applies-management', ApplyController::class)->middleware('userAccess:admin');
    // book model
    Route::resource('/books-management', BookController::class)->middleware('userAccess:admin');
    Route::resource('/categories-management', CategoryController::class)->middleware('userAccess:admin');
    // Route::resource('/bookings-management', BookingController::class)->middleware(['userAccess:admin', 'userAccess:librarian']);
    // export
    Route::get('/qr/export-booking/{id}', [BookingController::class, 'exportPDF']);
    Route::get('/export/invoice/{id}', [BookingController::class, 'generateInvoice']);

    // Route::resource('/bookings-management', BookingController::class)->middleware('userAccess:librarian');
    Route::resource('/bookings-management', BookingController::class);
    // pdf
    Route::get('/pdf/export-booking/', [BookingController::class, 'exportBookingPDF']);
    Route::get('/pdf/export-book/', [BookController::class, 'exportBookPDF']);
    Route::get('/pdf/export-user/', [UserController::class, 'exportUserPDF']);
    Route::get('/pdf/export-category/', [CategoryController::class, 'exportCategoryPDF']);

    // excel
    // excel
    Route::get('excel/export-book/', [BookController::class, 'exportBooks']);
    Route::get('excel/export-booking/', [BookingController::class, 'exportBookings']);
    Route::get('excel/export-user/', [UserController::class, 'exportUsers']);
    Route::get('excel/export-category/', [CategoryController::class, 'exportCategories']);
    // Route::get('excel/export-forfeit/', [ForfeitController::class, 'exportForfeits']);
    Route::get('/qr/scanner', [QRController::class, 'index'])->name('qr-scanner');

    Route::get('/pdf/export-booking/', [BookingController::class, 'exportBookingPDF']);

    // member route
    Route::get('/dashboard-member', [DashboardController::class, 'index'])->middleware('userAccess:member');
    Route::get('/books', [UserBookController::class, 'index'])->middleware('userAccess:member');
    Route::get('/books/{id}', [UserBookController::class, 'show'])->middleware('userAccess:member');
    // booking member
    Route::post('/bookings', [UserBookingController::class, 'store'])->middleware('userAccess:member');
    Route::get('/bookings', [UserBookingController::class, 'index'])->middleware('userAccess:member');
    Route::get('/bookings/{id}', [UserBookingController::class, 'show'])->middleware('userAccess:member');

    // librarian route
    Route::get('/dashboard-librarian', [LibrarianDashboardController::class, 'index'])->middleware('userAccess:librarian');
});
