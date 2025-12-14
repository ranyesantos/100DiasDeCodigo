<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use He4rt\Submission\Models\Submission;
use Illuminate\Support\Collection;
use Illuminate\Support\Number;
use Spatie\Tags\Tag;

class ParticipantsPage extends Page
{
    public Collection $submissions;
    protected string $view = 'portal::filament.guest.pages.participants-page';

    protected array $counters = [
        ['icon' => 'heroicon-o-users', 'color' => 'text-primary', 'value' => 512, 'label' => 'Participants'],
        ['icon' => 'heroicon-o-trophy', 'color' => 'text-green-500', 'value' => 132, 'label' => 'Completed'],
        ['icon' => 'heroicon-o-calendar', 'color' => 'text-warning-500', 'value' => 132, 'label' => 'Total Days'],
        ['icon' => 'heroicon-s-fire', 'color' => 'text-orange-500', 'value' => 132, 'label' => 'Avg Streak'],
    ];

    protected string $heroTitle = 'Meet the Challengers';

    protected string $subtitle = 'Discover developers pushing their limits with #100DaysOfCode. Filter by field, technologies, and find your coding companions.';

    protected array $users;

    protected Collection $technologies;

    protected Width|string|null $maxContentWidth = Width::Full;

    public function mount(): void
    {
        $this->technologies = Tag::query()->withType('technologies')->get();

        $users = User::query()->whereHas('submissions')
            ->with('submissions')
            ->get();

        $this->users = $users->map(function ($user): array {
            $metrics = self::calculateTwitterMetrics($user->submissions);

            return [
                'name' => $user->name,
                'username' => $user->username,
                'avatar' => $user->getFilamentAvatarUrl(),
                'total_days' => Number::abbreviate($user->total_days),
                'current_streak' => Number::abbreviate($user->current_streak),
                'tags' => ['#php', '#vibecoding', '#laravel', 'alpine.js', '#fullstack'],
                'twitter_metrics' => [
                    'likes' => Number::abbreviate($metrics['likes']),
                    'views' => Number::abbreviate($metrics['views']),
                ],
            ];
        })->toArray();
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
            'technologies' => $this->technologies,
        ];
    }
}
