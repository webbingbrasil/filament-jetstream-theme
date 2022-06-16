<?php

namespace Webbingbrasil\FilamentJetstreamTheme\Pages;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class Profile extends Page
{
    protected static string $view = 'filament-jetstream::pages.profile';

    public $user;
    public $userData;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $this->user = Filament::auth()->user();
        $this->profileForm->fill($this->user->toArray());
    }

    protected function getForms(): array
    {
        return array_merge(parent::getForms(), [
            'profileForm' => $this->makeForm()
                ->schema($this->getProfileFormSchema())
                ->statePath('userData'),
            'newPasswordForm' => $this->makeForm()->schema(
                $this->getNewPasswordFormSchema()
            ),
        ]);
    }

    protected function getProfileFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->label(__('filament-jetstream::default.fields.name'))
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label(__('filament-jetstream::default.fields.email'))
                ->unique(ignorable: $this->user)
                ->required(),
        ];
    }

    public function updateProfile()
    {
        $this->user->update($this->profileForm->getState());
        $this->notify('success', __('filament-jetstream::default.profile-page.profile-form.notify'));
    }

    protected function getNewPasswordFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('new_password')
                ->label(__('filament-jetstream::default.fields.new_password'))
                ->password()
                ->rules(config('filament-jetstream.password_rules'))
                ->required(),
            Forms\Components\TextInput::make('new_password_confirmation')
                ->label(__('filament-jetstream::default.fields.new_password_confirmation'))
                ->password()
                ->same('new_password')
                ->required(),
        ];
    }

    public function updatePassword()
    {
        $state = $this->newPasswordForm->getState();
        if (empty($state['new_password'])) {
            return;
        }
        $this->user->update([
            'password' => Hash::make($state['new_password']),
        ]);
        session()->forget('password_hash_web');
        Filament::auth()->login($this->user);
        $this->notify('success', __('filament-jetstream::default.profile-page.new-password-form.notify'));
        $this->reset(['new_password', 'new_password_confirmation']);
    }

    protected static function getNavigationIcon(): string
    {
        return config('filament-jetstream.profile_page_icon', 'heroicon-o-user');
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('filament-jetstream::default.profile-page.group');
    }

    public static function getNavigationLabel(): string
    {
        return __('filament-jetstream::default.profile-page.label');
    }

    protected function getTitle(): string
    {
        return __('filament-jetstream::default.profile-page.title');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return config('filament-jetstream.show_profile_page_in_navbar');
    }
}
