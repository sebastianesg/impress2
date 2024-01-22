<?php

use App\Http\Controllers\front\StaticController;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

// locale Route
//Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/', [StaticController::class, 'index'])->name('front.pages.index');
Route::get('/contacto', [StaticController::class, 'contact'])->name('front.pages.contacto');
