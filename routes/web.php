<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MpesaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [BookController::class, 'welcome'])->name('welcome');


Route::get('/add-book', [BookController::class, 'create'])->name('book.create');
Route::post('/add-book', [BookController::class, 'store'])->name('book.store')->middleware('auth');

Route::get('/books/{id}', [BookController::class, 'book'])->name('book');

Route::get('/cart', [BookController::class, 'cart'])->name('cart');

//Route::get('/cart/add/{id}', [BookController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::get('/cart/add/{id}', [BookController::class, 'addToCart'])->name('cart.add');

//Route::post('/transaction/new/{cart_total}/{user_id}', [MpesaController::class, 'stkSimulation'])->name('book.pay')->middleware('auth');
Route::post('/transaction/new/{bookId}/{bookPrice}', [MpesaController::class, 'stkSimulation'])->name('book.pay');

Route::get('/transactions', [BookController::class, 'transactions'])->name('transactions')->middleware('auth');
Route::get('/payments', [BookController::class, 'payments'])->name('payments');
Route::get('/download', [BookController::class, 'download'])->name('download')->middleware(['auth','download']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin', function () {
    return view('dashboard');
});




Route::get('/confirmation', function () {
    return view('books.confirmation');
});




Route::get('/admin/{any?}', function () {
    return view('dashboard');
});

//->where('any', '.*')->middleware('auth');