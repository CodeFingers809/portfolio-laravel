<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Portfolio Homepage
Route::get('/', [PortfolioController::class, 'index'])->name('home');

// Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/{slug}/asset/{type}/{filename}', [BlogController::class, 'asset'])->name('asset');
});

// SEO Routes
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
