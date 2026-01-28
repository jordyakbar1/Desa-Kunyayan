<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\KadesController;
use App\Http\Controllers\Admin\BeritaController;
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


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', [StatisticController::class, 'home'])->name('admin.home');
    Route::get('/admin/stats/edit', [StatisticController::class, 'edit'])->name('admin.stats.edit');
    Route::post('/admin/stats/update', [StatisticController::class, 'update'])->name('admin.stats.update');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('kades', KadesController::class);
        Route::resource('berita',BeritaController::class);
    });
});

// Corrected named routes
Route::get('/', [HomeController::class, 'home'])->name('welcome'); 
Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard'); 
Route::get('/home', [HomeController::class, 'home'])->name('home'); 
Route::get('/berita', [HomeController::class, 'berita_index'])->name('berita.index');
Route::get('/berita/{id}', [HomeController::class, 'berita'])->name('berita.show'); 
Route::get('/profil', [HomeController::class, 'profile'])->name('profil'); 

Route::get('/infografis', function () {
    return view('infografis');
})->name('infografis');
 // Correctly chained to Route::get()


Route::get('/mitigasi', function () {
    return view('mitigasi');
})->name('mitigasi'); // Correctly chained to Route::get()






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
