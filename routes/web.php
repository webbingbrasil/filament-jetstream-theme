<?php

use Illuminate\Support\Facades\Route;
use Webbingbrasil\FilamentJetstreamTheme\Http\Controllers\AssetController;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->name('filament.jetstream.asset')
    ->prefix(config('filament.path'))
    ->get('/core/jetstream-theme/assets/{file}', AssetController::class)->where('file', '.*');
