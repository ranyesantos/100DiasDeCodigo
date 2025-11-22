<?php

declare(strict_types=1);

namespace He4rt\Portal\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\Width;

class PublicUserProfilePage extends Page
{
    protected static bool $shouldRegisterNavigation = false;

    protected Width|string|null $maxContentWidth = Width::ScreenTwoExtraLarge;

    protected string $view = 'portal::filament.guest.pages.public-user-profile-page';
}
