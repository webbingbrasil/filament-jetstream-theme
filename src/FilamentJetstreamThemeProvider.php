<?php

namespace Webbingbrasil\FilamentJetstreamTheme;

use Filament\Facades\Filament;
use function Filament\get_asset_id;
use Filament\Navigation\UserMenuItem;
use Filament\PluginServiceProvider;
use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;
use Webbingbrasil\FilamentJetstreamTheme\Pages\Profile;

class FilamentJetstreamThemeProvider extends PluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-jetstream')
            ->hasConfigFile()
            ->hasViews()
            ->hasRoute('web')
            ->hasTranslations();

        // set Nunito font
        Config::set('filament.google_fonts', 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');

        // add theme path hint to filament namespace
        $this->callAfterResolving('view', function ($view) use ($package) {
            $namespace = 'filament';
            if (isset($this->app->config['view']['paths']) &&
                is_array($this->app->config['view']['paths'])) {
                foreach ($this->app->config['view']['paths'] as $viewPath) {
                    if (is_dir($appPath = $viewPath . '/vendor/filament-jetstream')) {
                        // add a custom vendor path in project resource
                        // folder to allow override theme views
                        $view->addNamespace($package->shortName(), $appPath);
                        $view->addNamespace($namespace, $viewPath . '/vendor/filament');
                    }
                }
            }

            $view->addNamespace($namespace, $package->basePath('/../resources/vendor/filament'));
        });

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $package->basePath('/../resources/vendor/filament') => base_path('resources/views/vendor/filament'),
            ], "{$package->shortName()}-views");
        }
    }

    public function packageBooted(): void
    {
        parent::packageBooted();

        Filament::serving(function () {
            Filament::registerTheme(route('filament.jetstream.asset', [
                'id' => get_asset_id('app.css'),
                'file' => 'app.css',
            ]));
            if (config('filament-jetstream.enable_profile_page')
                && config('filament-jetstream.show_profile_page_in_user_menu')) {
                Filament::registerUserMenuItems([
                    'account' => UserMenuItem::make()
                        ->url(config('filament-jetstream.profile_page_class', Profile::class)::getUrl()),
                ]);
            }
        });
    }

    protected function getPages(): array
    {
        return config('filament-jetstream.enable_profile_page') ?
            [
                config('filament-jetstream.profile_page_class', Profile::class),
            ] : [];
    }
}
