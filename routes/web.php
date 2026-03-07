<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EskulController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// Route Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route Admin dengan Middleware
Route::middleware(['auth.admin:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User Management Routes
    Route::get('/admin/user', [AdminController::class, 'userIndex'])->name('admin.user');
    Route::post('/admin/user', [AdminController::class, 'userStore'])->name('admin.user.store');
    Route::put('/admin/user/{id}', [AdminController::class, 'userUpdate'])->name('admin.user.update');
    Route::delete('/admin/user/{id}', [AdminController::class, 'userDestroy'])->name('admin.user.destroy');

    // Eskul Management Routes
    Route::get('/admin/eskul', [AdminController::class, 'eskulIndex'])->name('admin.eskul');
    Route::post('/admin/eskul', [AdminController::class, 'eskulStore'])->name('admin.eskul.store');
    Route::put('/admin/eskul/{id}', [AdminController::class, 'eskulUpdate'])->name('admin.eskul.update');
    Route::delete('/admin/eskul/{id}', [AdminController::class, 'eskulDestroy'])->name('admin.eskul.destroy');

    // Fasilitas Management Routes
    Route::get('/admin/fasilitas', [AdminController::class, 'fasilitasIndex'])->name('admin.fasilitas');
    Route::post('/admin/fasilitas', [AdminController::class, 'fasilitasStore'])->name('admin.fasilitas.store');
    Route::put('/admin/fasilitas/{id}', [AdminController::class, 'fasilitasUpdate'])->name('admin.fasilitas.update');
    Route::delete('/admin/fasilitas/{id}', [AdminController::class, 'fasilitasDestroy'])->name('admin.fasilitas.destroy');

    // Prestasi Management Routes
    Route::get('/admin/prestasi', [AdminController::class, 'prestasiIndex'])->name('admin.prestasi');
    Route::post('/admin/prestasi', [AdminController::class, 'prestasiStore'])->name('admin.prestasi.store');
    Route::put('/admin/prestasi/{id}', [AdminController::class, 'prestasiUpdate'])->name('admin.prestasi.update');
    Route::delete('/admin/prestasi/{id}', [AdminController::class, 'prestasiDestroy'])->name('admin.prestasi.destroy');

    // Profil Management Routes
    Route::get('/admin/profil', [AdminController::class, 'profilIndex'])->name('admin.profil');
    Route::post('/admin/profil', [AdminController::class, 'profilStore'])->name('admin.profil.store');
    Route::put('/admin/profil/{id}', [AdminController::class, 'profilUpdate'])->name('admin.profil.update');
    Route::delete('/admin/profil/{id}', [AdminController::class, 'profilDestroy'])->name('admin.profil.destroy');
    
    // Pesan Management Routes
    Route::get('/admin/pesan', [AdminController::class, 'pesanIndex'])->name('admin.pesan');
    Route::get('/admin/pesan/{id}', [AdminController::class, 'pesanShow'])->name('admin.pesan.show');
    Route::put('/admin/pesan/{id}', [AdminController::class, 'pesanUpdate'])->name('admin.pesan.update');
    Route::delete('/admin/pesan/{id}', [AdminController::class, 'pesanDestroy'])->name('admin.pesan.destroy');
    
    // History Image Management Routes
    Route::delete('/admin/history-images/{id}', [AdminController::class, 'historyImageDestroy'])->name('admin.history-images.destroy');
});

Route::get('/sambutan', [ProfilController::class, 'sambutan'])->name('profil.sambutan');

Route::get('/visi-misi', [ProfilController::class, 'vm'])->name('profil.vm');

Route::get('/struktur-organisasi', [ProfilController::class, 'struktur'])->name('profil.struktur'); 

Route::get('/profil', [ProfilController::class, 'dashboard'])->name('profil.dashboard');

Route::get('/profil/{slug}', [ProfilController::class, 'menu'])->name('profil.menu');

Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas.index');

Route::get('/eskul', [EskulController::class, 'index'])->name('eskul.index');

Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');

Route::get('/pesan', [App\Http\Controllers\PesanController::class, 'index'])->name('pesan.index');
Route::post('/pesan', [App\Http\Controllers\PesanController::class, 'store'])->name('pesan.store');
