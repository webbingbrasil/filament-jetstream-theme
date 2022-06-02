<?php

namespace Webbingbrasil\FilamentJetstreamTheme;

use Filament\Facades\Filament;
use function Filament\get_asset_id;
use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;

class FilamentJetstreamThemeProvider extends PluginServiceProvider
{
    public static string $name = 'filament-jetstream';

    public function packageConfigured(Package $package): void
    {
//        return;
        $package->hasRoute('web');

        // set Nunito font
        Config::set('filament.google_fonts', 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');

        // add theme path hint to filament namespace
        $this->callAfterResolving('view', function ($view) use ($package) {
            $namespace = 'filament';
            if (isset($this->app->config['view']['paths']) &&
                is_array($this->app->config['view']['paths'])) {
                foreach ($this->app->config['view']['paths'] as $viewPath) {
                    if (is_dir($appPath = $viewPath.'/vendor/filament-jetstream')) {
                        // add a custom vendor path in project resource
                        // folder to allow override theme views
                        $view->addNamespace($package->shortName(), $appPath);
                        $view->addNamespace($namespace, $viewPath.'/vendor/filament');
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

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $this->package->basePath('/../resources/vendor/filament') => base_path('resources/views/vendor/filament'),
            ], "{$this->package->shortName()}-views");
        }
    }
}
