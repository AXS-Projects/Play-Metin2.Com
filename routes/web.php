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
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ForgotPasswordController;

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
        Route::get('/events', [EventController::class, 'index'])->name('events.index');

        // Contact
        Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
        Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

        // News routes
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/category/{slug}', [NewsController::class, 'category'])->name('news.category');
        Route::get('/news/author/{author}', [NewsController::class, 'author'])->name('news.author');
        Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
        Route::post('/news/{slug}/comment', [NewsController::class, 'comment'])->name('news.comment');
        Route::post('/comments/{comment}/like', [NewsController::class, 'like'])->name('comments.like');
        Route::post('/comments/{comment}/dislike', [NewsController::class, 'dislike'])->name('comments.dislike');

        // Gallery routes
        Route::get('/screenshots', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/{item}', [GalleryController::class, 'show'])->name('gallery.show');
        Route::post('/gallery/{item}/comment', [GalleryController::class, 'comment'])->name('gallery.comment');
        Route::post('/gallery/comments/{comment}/like', [GalleryController::class, 'like'])->name('gallery.comments.like');
        Route::post('/gallery/comments/{comment}/dislike', [GalleryController::class, 'dislike'])->name('gallery.comments.dislike');

        // Password reset routes
        Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
        Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update.reset');
        Route::get('/cancel-reset/{token}', [ForgotPasswordController::class, 'cancel'])->name('password.reset.cancel');
	
	Route::post('/metin2/login', [Metin2AuthController::class, 'login'])->name('metin2.login');
	Route::post('/metin2/logout', [Metin2AuthController::class, 'logout'])->name('metin2.logout');
	Route::middleware(['metin2.auth'])->group(function () {
		// Change Password
        Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
        Route::post('/change-password', [PasswordController::class, 'updatePassword'])->name('password.update');
		
                //Item Shop
                Route::get('/itemshop', [ItemShopController::class, 'index'])->name('itemshop');
                Route::get('/itemshop/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

                // Tickets
                Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
                Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
                Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
                Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    });
	
	Route::get('/check-auth', function () {
    return response()->json(['authenticated' => session()->has('metin2_user')]);
});

});
 