<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\applicationController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/mpesa/stkpush/response', [MpesaController::class, 'resdata'])->name('stkpush.response');



Route::post('/addCategory', [applicationController::class, 'addCategory']);
Route::get('/getCategories', [applicationController::class, 'getCategories']);
Route::patch('/updateCategory/{id}', [applicationController::class, 'updateCategory']);
Route::post('/deleteCategory/{id}', [applicationController::class, 'deleteCategory']);

Route::post('/addItem', [applicationController::class, 'addItem']);
Route::get('/getItems', [applicationController::class, 'getItems']);
Route::patch('/updateItems/{id}', [applicationController::class, 'updateItems']);
Route::post('/deleteItem/{id}', [applicationController::class, 'deleteItems']);
Route::get('/downloadItem/{id}', [applicationController::class, 'downloadItem'])->name('downloadItem');

Route::get('/getItems/{category}', [applicationController::class, 'getItemsCategory'])->name('itemCategory');

Route::get('/getMyItem', [applicationController::class, 'getItemsCategoryy'])->name('itemCategoryy');


Route::get('/getItemss', [applicationController::class, 'getItemCategory'])->name('itemCategories');

Route::get('/transactions', [BookController::class, 'transactions'])->name('transactions');
Route::post('/deleteTransaction/{id}', [BookController::class, 'deleteTransaction'])->name('deleteTransaction');

