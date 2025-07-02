<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RegisterVendorController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::resource('hotels', HotelController::class);
    Route::resource('rooms', RoomController::class);
     Route::get('/vendor/profile', [App\Http\Controllers\VendorController::class, 'profile'])->name('vendor.profile');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('hotels', App\Http\Controllers\AdminHotelController::class);
    Route::resource('rooms', App\Http\Controllers\AdminRoomController::class);
     Route::get('vendors/export', [VendorController::class, 'exportExcelvendor'])->name('vendor.export');
     Route::get('/vendors', [VendorController::class, 'index'])->name('admin.vendors.index');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/bookings/create/{room}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
  
});


Route::get('/register/vendor', [RegisterVendorController::class, 'showForm'])->name('register.vendor');
Route::post('/register/vendor', [RegisterVendorController::class, 'register']);
Route::get('/admin/rooms/export/pdf', [AdminRoomController::class, 'exportPdf'])->name('admin.rooms.export.pdf');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');
Route::get('/pilih-hotel', [HotelController::class, 'listForUser'])->name('hotels.user');
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/export/pdf', [\App\Http\Controllers\BookingController::class, 'exportPdf'])->name('bookings.export.pdf');
Route::get('/bookings/pdf/{id}', [\App\Http\Controllers\BookingController::class, 'downloadSingle'])->name('bookings.pdf.single');
Route::put('/vendor/profile', [VendorController::class, 'update'])->name('vendor.update');
Route::get('/admin/vendors', [VendorController::class, 'listVendors'])->name('admin.vendors.index');
Route::get('/admin/vendors/{id}', [VendorController::class, 'showVendor'])->name('admin.vendor.show');
Route::patch('/admin/vendors/{id}/status', [VendorController::class, 'updateStatus'])->name('admin.vendor.status.update');
