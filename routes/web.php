<?php

use App\Http\Controllers\Admin\PetitionExportController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Petitions\Index;
use App\Livewire\Petitions\Show;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('admin/petitions/{petition}/export', PetitionExportController::class)
    ->name('petitions.export')
    ->middleware('auth');

Route::name('resident.')->group(function () {
    Route::get('/', Login::class)->name('login')->middleware('guest');

    Route::get('condominio/{condominium:slug}/cadastro', Register::class)
        ->name('register')
        ->middleware('guest');

    Route::post('app/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('resident.login');
    })->name('logout')->middleware('auth');

    Route::middleware(['auth', 'resident'])
        ->prefix('app/{condominium:slug}')
        ->group(function () {
            Route::get('/', Index::class)->name('dashboard');
            Route::get('/abaixo-assinados/{petition}', Show::class)->name('petitions.show');
        });
});
