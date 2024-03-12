<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [MovieController::class, 'index'])->name('home');
    Route::get('/home', [MovieController::class, 'index'])->name('home');
});


Route::middleware('auth')->prefix('/movies')->name('movies.')->group(function () {
    Route::get('/new', [MovieController::class, 'new'])->name('new');
    Route::get('/{id}', [MovieController::class, 'show'])->name('show');
    Route::post('/store', [MovieController::class, 'store'])->name('store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
