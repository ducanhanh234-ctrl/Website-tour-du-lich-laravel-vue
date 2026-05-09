<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TourController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::middleware('auth')
    ->prefix('tours')
    ->controller(TourController::class)
    ->group(function () {
        Route::get('/', 'index')->name('tours.index');
        Route::get('/trash', 'trash')->name('tours.trash');
        Route::get('/create', 'create')->name('tours.create');
        Route::post('/', 'store')->name('tours.store');
        Route::get('/{tour}', 'show')->name('tours.show');
        Route::get('/{tour}/edit', 'edit')->name('tours.edit');
        Route::put('/{tour}', 'update')->name('tours.update');
        Route::delete('/{tour}', 'destroy')->name('tours.destroy');
        Route::put('/{tour}/restore', 'restore')->name('tours.restore');
        Route::delete('/{tour}/force-delete-all', 'forceDeleteAll')
            ->name('tours.forceDeleteAll');
        Route::delete('/{tour}/force-delete', 'forceDelete')
            ->name('tours.forceDelete');
    });

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
