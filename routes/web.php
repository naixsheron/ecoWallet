<?php

use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\CodeController;
use App\Http\Controllers\Backend\GoldController;
use App\Http\Controllers\Backend\MoneyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SidebarLinksController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/gold-eco', [SidebarLinksController::class, 'goldEco'])->name('gold-eco');
// Route::get('/book', [SidebarLinksController::class, 'books'])->name('book');
// Route::get('/money', [SidebarLinksController::class, 'moneyEco'])->name('money');
// Route::get('/code', [SidebarLinksController::class, 'codeHome'])->name('code');
Route::get('/crypto', [SidebarLinksController::class, 'criptoEco'])->name('crypto');
Route::get('/land', [SidebarLinksController::class, 'landEco'])->name('land');
Route::resource('book', BookController::class);
Route::resource('gold', GoldController::class);
Route::resource('money', MoneyController::class);
Route::resource('code', CodeController::class);





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
