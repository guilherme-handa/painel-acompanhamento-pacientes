<?php

use App\Livewire\Cadastro\Cadastro;
use App\Livewire\Painel\Painel;
use App\Livewire\PainelEspelho\PainelEspelho;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Usuarios\Usuarios;
use Illuminate\Support\Facades\Route;

Route::get('/', Cadastro::class)->middleware(['auth', 'verified'])->name('cadastro');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/cadastro', Cadastro::class)->middleware(['auth', 'verified'])->name('cadastro');
Route::get('/painel-espelho',PainelEspelho::class)->middleware(['auth', 'verified'])->name('painel-espelho');
// Route::get('/usuarios',Usuarios::class)->middleware(['auth', 'verified'])->name('usuarios');
Route::get('/painel', Painel::class)->name('painel');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
