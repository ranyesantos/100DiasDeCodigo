<?php

declare(strict_types=1);

namespace App\Filament\Shared\Pages;

use Filament\Auth\Pages\Login as FilamentLoginPage;

final class LoginPage extends FilamentLoginPage
{
    protected string $view = 'filament.shared.pages.login';

    protected ?string $heading = null;
}
