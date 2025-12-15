<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use He4rt\Submission\Models\Submission;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;

class ParticipantsPage extends Page
{
    protected string $view = 'portal::filament.guest.pages.participants-page';

    protected array $counters = [
        ['icon' => 'heroicon-o-users', 'color' => 'text-primary', 'value' => 222, 'label' => 'Participants'],
        ['icon' => 'heroicon-o-trophy', 'color' => 'text-green-500', 'value' => '3k', 'label' => 'Completed'],
        ['icon' => 'heroicon-o-calendar', 'color' => 'text-warning-500', 'value' => 132, 'label' => 'Total Days'],
        ['icon' => 'heroicon-s-fire', 'color' => 'text-orange-500', 'value' => 132, 'label' => 'Avg Streak'],
    ];

    protected string $heroTitle = 'Meet the Challengers';

    protected string $subtitle = 'Descubra desenvolvedores que estão superando seus próprios limites com o #100DiasDeCodigo e encontre pessoas para evoluir e programar junto com você';

    protected array $users;

    protected Collection $technologies;

    protected Width|string|null $maxContentWidth = Width::Full;

    public static function abbreviate(int|float $value, int $precision = 1): string
    {
        return $value >= 1000
            ? Number::abbreviate($value, $precision)
            : (string) $value;
    }

    public function mount(): void
    {
        $this->users = User::query()
            ->whereHas('submissions')
            ->get()
            ->map(function ($user): array {
                $metrics = self::calculateTwitterMetrics($user->submissions);

                return [
                    'name' => $user->name,
                    'username' => $user->username,
                    'avatar' => $user->getFilamentAvatarUrl(),
                    'total_days' => static::abbreviate($user->total_days),
                    'current_streak' => static::abbreviate($user->current_streak),
                    'tags' => ['#php', '#vibecoding', '#laravel', 'alpine.js', '#fullstack'],
                    'twitter_metrics' => [
                        'likes' => static::abbreviate($metrics['likes']),
                        'likes_raw' => $metrics['likes'],
                        'views' => static::abbreviate($metrics['views']),
                        'views_raw' => $metrics['views'],
                    ],
                ];
            })
            ->all();
    }

    public function getHeading(): string
    {
        return '';
    }

    public function getSubheading(): ?string
    {
        return null;
    }

    protected function calculateTwitterMetrics($submissions): array
    {
        $metrics = [
            'likes' => 0,
            'views' => 0,
        ];

        /** @var Submission $submission */
        foreach ($submissions as $submission) {
            $tweet = $submission->getTweet();
            $metrics['likes'] += $tweet->likeCount;
            $metrics['views'] += $tweet->viewCount;
        }

        return $metrics;
    }

    protected function getViewData(): array
    {
        return [
            'title' => $this->heroTitle,
            'counters' => $this->counters,
            'subtitle' => $this->subtitle,
            'users' => $this->users,
        ];
    }
}
