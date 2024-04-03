<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\PopularController;
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

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/list', [MovieController::class, 'index'])->name('list');
    Route::post('/list', [MovieController::class, 'reset'])->name('reset');
});


Route::middleware('auth')->prefix('/content')->name('movies.')->group(function () {
    Route::get('/new', [MovieController::class, 'new'])->name('new');
    Route::get('/show/{id}', [MovieController::class, 'show'])->name('show');
    Route::get('/showTMDB/{id}/{type}', [MovieController::class, 'showTMDB'])->name('showTMDB');
    Route::post('/store', [MovieController::class, 'store'])->name('store');
    Route::delete('/destroy', [MovieController::class, 'destroy'])->name('destroy');

    Route::get('/now_playing', [PopularController::class, 'nowPlaying'])->name('playing');
    Route::get('/popular', [PopularController::class, 'popular'])->name('popular');
    Route::get('/top_rated', [PopularController::class, 'topRated'])->name('top');
    Route::get('/upcoming', [PopularController::class, 'upcoming'])->name('upcoming');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
