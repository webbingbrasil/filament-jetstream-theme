# Filament Jetstream Theme

A Jetstream theme for filament admin

## Installation

```bash
composer require webbingbrasil/filament-jetstream-theme
```

Optionally, you can publish the config file using:

```bash
php artisan vendor:publish --tag="filament-jetstream-config"
```

Optionally, you can publish the views using:

```bash
php artisan vendor:publish --tag="filament-jetstream-views"
```

## Password rule

This theme provides a password rule class, you can use it in any form validation:

```php

use Webbingbrasil\FilamentJetstreamTheme\Rules\Password;

Forms\Components\TextInput::make('new_password')
    ->label(__('filament-jetstream::default.fields.new_password'))
    ->password()
    ->rules(Password::make()
            ->requireNumeric()
            ->requireUppercase()
            ->requireSpecialCharacter()
            ->length(8))
```

By default, we provide a configuration property with a predefined password rule: ``config('filament-jetstream.password_rules')``,
This rule is used on the profile page, to customize publish and update the config file.

## Profile page

This theme provides a basic profile page with user information and password update forms, it is registered by default 
but you can extend and customize the page using two methods.

### Using render hooks

Make use of Filament's render hook to register additional content to profile page.

```php
## in Service Provider file
public function boot()
{
    Filament::registerRenderHook(
        'filament-jetstream.profile-page.start',
        fn (): string => Blade::render('@livewire(\'profile-instructions\')'),
    );
    Filament::registerRenderHook(
        'filament-jetstream.profile-page.after-profile-form',
        fn (): string => Blade::render('@livewire(\'extra-forms\')'),
    );
    Filament::registerRenderHook(
        'filament-jetstream.profile-page.end',
        fn (): string => Blade::render('@livewire(\'filament-two-factor-form\')'),
    );
}
```

### Exten profile page class

Another way to customize profile page is extending page class.

```php
namespace App\Filament\Pages;

use Webbingbrasil\FilamentJetstreamTheme\Pages\Profile as BaseProfile;
use Filament\Forms;

class Profile extends BaseProfile
{

  protected function getProfileFormSchema(): array
    {
        return array_merge(parent::getProfileFormSchema(), [
            Forms\Components\TextInput::make("job_title"),
            Forms\Components\Checkbox::make("marketing_consent")->label(
                "I consent to receive email notifications....."
            ),
        ]);
    }
```

After create you custom page, publish theme config and update ``profile_page_class`` property

## User manage account menu

To register new items to the user menu, you should use a service provider:

```php
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
 
Filament::serving(function () {
    Filament::registerUserMenuItems([
        UserMenuItem::make()
            ->label('Settings')
            ->url(route('filament.pages.settings'))
            ->icon('heroicon-s-cog'),
        // ...
    ]);
});
```

## Add resource title and description

You can add title and description to resources pages using `$pageSectionTitle` and `$pageSectionDescription` properties in resource page class

```php
    <?php
    
    namespace App\Filament\Resources\UserResource\Pages;
    
    use App\Filament\Resources\UserResource;
    use Filament\Resources\Pages\CreateRecord;

    class CreateUserContent extends CreateRecord
    {
        protected static string $resource = UserResource::class;
    
        public string $pageSectionTitle = 'Resource Details';
        public string $pageSectionDescription = 'Resource details description';
    }
```

## Components

You can use a extra component to design you custom pages: `<x-filament-jetstream::grid-section>` 

Usage example
```
<x-filament-jetstream::grid-section>
        <x-slot name="title">
            title
        </x-slot>

        <x-slot name="description">
            description
        </x-slot>

        <x-filament::form wire:submit.prevent="create">
            <x-filament::card>
                {{ $this->form }}

                <x-slot name="footer">
                    <x-filament::form.actions :actions="$this->getFormActions()" />
                </x-slot>
            </x-filament::card>
        </x-filament::form>
    </x-filament-jetstream::grid-section>
```

## Screenshots

![Screenshot of Login](./images/login.png)
![Screenshot of Dashboard](./images/dashboard.png)
![Screenshot of User Manage Account Menu](./images/user-manage-account-menu.png)
![Screenshot of List Page](./images/list-page.png)
![Screenshot of Form Page](./images/resource-create-page.png)
![Screenshot of Form Page With Title and Description](./images/resource-create-page-with-title.png)

## Credits

-   [Danilo Andrade](https://github.com/dmandrade)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
