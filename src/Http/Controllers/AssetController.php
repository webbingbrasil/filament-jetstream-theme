<?php

namespace Webbingbrasil\FilamentJetstreamTheme\Http\Controllers;

use Filament\Http\Controllers\AssetController as BaseAssetController;

class AssetController extends BaseAssetController
{
    public function __invoke(string $file)
    {
        return $this->pretendResponseIsFile(__DIR__ . '/../../../dist/app.css', 'text/css; charset=utf-8');
    }
}
