<?php

namespace Webbingbrasil\FilamentJetstreamTheme;

use Filament\Facades\Filament;
use Filament\PluginServiceProvider;
use Spatie\LaravelPackageTools\Package;
use function Filament\get_asset_id;

class FilamentJetstreamThemeProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('filament-jetstream')
            ->hasViews()
            ->hasRoute('web');

        // add theme path hint to filament namespace
        $this->callAfterResolving('view', function ($view) {
            $namespace = 'filament';
            if (isset($this->app->config['view']['paths']) &&
                is_array($this->app->config['view']['paths'])) {
                foreach ($this->app->config['view']['paths'] as $viewPath) {
                    if (is_dir($appPath = $viewPath.'/vendor/filament-jetstream-theme')) {
                        // add a custom vendor path in project resource
                        // folder to allow override theme views
                        $view->addNamespace($namespace, $appPath);
                    }
                }
            }

            $view->addNamespace($namespace, $this->package->basePath('/../resources/vendor/filament'));
        });

        Filament::serving(function (): void {
            Filament::registerTheme(route('filament.jetstream.asset', [
                'id' => get_asset_id('app.css'),
                'file' => 'app.css',
            ]));
        });
    }
}
