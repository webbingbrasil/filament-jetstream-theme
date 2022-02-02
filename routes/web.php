<?php

use Webbingbrasil\FilamentJetstreamTheme\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->name('filament.jetstream.asset')
    ->prefix(config('filament.path'))
    ->get('/core/jetstream-theme/assets/{file}', AssetController::class)->where('file', '.*');
