<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\SecurityController;
use App\Utils\CryptoModel;
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
    return view('welcome');
});

Route::post('/login', [SecurityController::class, 'login'])->name('login');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::prefix('book')->group(function () {
        Route::post('/consult', [BookController::class, 'Consult'])->name('book.consult');
    });
});

Route::get('/tmp', function () {
    return CryptoModel::crypto("1234");
});
