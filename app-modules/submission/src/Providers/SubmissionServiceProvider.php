<?php

declare(strict_types=1);

namespace He4rt\Submission\Providers;

use Filament\Panel;
use He4rt\Submission\AppSubmissionPanelPlugin;
use Illuminate\Support\ServiceProvider;

class SubmissionServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Panel::configureUsing(fn (Panel $panel) => match ($panel->getId()) {
            'app' => $panel->plugin(new AppSubmissionPanelPlugin),
            default => null,
        });
    }

    public function boot(): void {}
}
