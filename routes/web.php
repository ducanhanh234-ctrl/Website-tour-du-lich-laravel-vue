<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::middleware('auth')->get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::middleware('auth')->get('/tours/create', [TourController::class, 'create'])->name('tours.create');
Route::middleware('auth')->post('/tours', [TourController::class, 'store'])->name('tours.store');
Route::middleware('auth')->get('/tours/{tour}', [TourController::class, 'show'])->name('tours.show');
Route::middleware('auth')->get('/tours/{tour}/edit', [TourController::class, 'edit'])->name('tours.edit');
Route::middleware('auth')->put('/tours/{tour}', [TourController::class, 'update'])->name('tours.update');
Route::middleware('auth')->delete('/tours/{tour}', [TourController::class, 'destroy'])->name('tours.destroy');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return Inertia::render('AuthLayout/login', [
            'canResetPassword' => Features::enabled(Features::resetPasswords()),
            'canRegister' => Features::enabled(Features::registration()),
            'status' => session('status'),
        ]);
    })->name('login');

    Route::get('/register', function () {
        return Inertia::render('AuthLayout/register');
    })->name('register');

    Route::get('/forgot-password', function () {
        return Inertia::render('AuthLayout/forgot-password', [
            'status' => session('status'),
        ]);
    })->name('password.request');

    Route::get('/reset-password/{token}', function ($token) {
        return Inertia::render('AuthLayout/reset-password', [
            'token' => $token,
            'email' => request()->query('email'),
        ]);
    })->name('password.reset');
});

Route::middleware('auth')->post('/logout', [LogoutController::class, 'destroy'])
    ->name('logout');
require __DIR__ . '/settings.php';
