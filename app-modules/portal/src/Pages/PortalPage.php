<?php

declare(strict_types=1);

namespace He4rt\Portal\Pages;

use App\Models\User;
use Filament\Pages\Dashboard;
use Filament\Support\Enums\Width;

class PortalPage extends Dashboard
{
    protected string $view = 'portal::homepage';

    protected static bool $shouldRegisterNavigation = false;

    protected static ?string $title = 'Desafio';

    protected static ?string $navigationLabel = 'Portal';

    protected Width|string|null $maxContentWidth = Width::Full;

    public function getHeading(): string
    {
        return '';
    }

    public function getSubheading(): ?string
    {
        return null;
    }

    protected function getViewData(): array
    {
        return [
            'users' => User::query()
                ->latest()
                ->limit(5)
                ->get(),
            'usersCount' => User::query()->count(),
        ];
    }
}
