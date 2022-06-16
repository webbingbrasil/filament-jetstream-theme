<?php

use Webbingbrasil\FilamentJetstreamTheme\Pages\Profile;
use Webbingbrasil\FilamentJetstreamTheme\Rules\Password;

return [
    'enable_profile_page' => true,
    'profile_page_class' => Profile::class,
    'show_profile_page_in_user_menu' => true,
    'show_profile_page_in_navbar' => false,
    'profile_page_icon' => 'heroicon-o-user',
    'password_rules' => [
        Password::make()
            ->requireNumeric()
            ->requireUppercase()
            ->requireSpecialCharacter()
            ->length(8),
    ],
];
