<?php

use App\Http\Middleware\LanguageMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\GuildController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\Metin2AuthController;
use Livewire\Livewire;
use App\Http\Livewire\Auth\Metin2Login;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ItemShopController;
use App\Http\Controllers\CategoryController;

// Aplica middleware-ul global pentru toate rutele
Route::middleware([LanguageMiddleware::class])->group(function () {
    Route::get('/switch-lang/{lang}', [LanguageController::class, 'switchLang'])->name('switch.lang');
    Route::get('/', [WelcomeController::class, 'index'])->name('index');
    Route::get('/top-players', [PlayerController::class, 'topPlayers'])->name('top.players');
    Route::get('/top-guilds', [GuildController::class, 'topGuilds'])->name('top.guilds');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

    // 🔹 Ruta pentru activarea contului prin email
    Route::get('/activate/{token}', [RegisterController::class, 'activateAccount'])->name('account.activate');
	
	Route::get('/download', [DownloadController::class, 'index'])->name('download');
	
	Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
	
	Route::post('/metin2/login', [Metin2AuthController::class, 'login'])->name('metin2.login');
	Route::post('/metin2/logout', [Metin2AuthController::class, 'logout'])->name('metin2.logout');
	Route::middleware(['metin2.auth'])->group(function () {
		// Change Password
        Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.update');
		
		//Item Shop
		Route::get('/itemshop', [ItemShopController::class, 'index'])->name('itemshop');
		Route::get('/itemshop/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');
    });
	
	Route::get('/check-auth', function () {
    return response()->json(['authenticated' => session()->has('metin2_user')]);
});

});
 