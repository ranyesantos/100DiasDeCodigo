@props([
    'name' => '',
    'username' => '',
    'avatar' => '',
    'rank' => '',
    'progress' => '',
    'stats' => '',
    'tags' => [],
])

<x-he4rt::card
    class="bg-primary/6 relative cursor-pointer rounded-2xl p-5 backdrop-blur-sm transition-all duration-300"
>
    <x-slot:header class="p-1">
        <x-he4rt::partials.author
            size="lg"
            src="https://avatars.githubusercontent.com/u/103362"
            x-bind:name="participant.name"
            title=""
        />
    </x-slot>

    <x-slot:title class="text-muted-foreground flex items-center justify-center pt-1 text-xs">
        <!-- profile progress-bar -->
        <x-portal::profile.progress />
    </x-slot>

    <x-slot:description>
        <div class="flex flex-row items-center justify-center gap-3">
            <!-- current streak -->
            <x-portal::participants.wrappers.user-stats-card>
                <x-slot:icon>
                    <x-filament::icon icon="heroicon-s-fire" class="h-4 w-4 text-orange-500" />
                </x-slot>

                <x-slot:title>
                    <span x-text="participant.current_streak"></span>
                </x-slot>

                <x-slot:description>Streak</x-slot>
            </x-portal::participants.wrappers.user-stats-card>

            <!-- likes -->
            <x-portal::participants.wrappers.user-stats-card>
                <x-slot:icon>
                    <x-filament::icon icon="heroicon-o-heart" class="h-4 w-4 text-pink-500" />
                </x-slot>

                <x-slot:title>
                    <span x-text="participant.twitter_metrics.likes"></span>
                </x-slot>

                <x-slot:description>Likes</x-slot>
            </x-portal::participants.wrappers.user-stats-card>

            <!-- views -->
            <x-portal::participants.wrappers.user-stats-card>
                <x-slot:icon>
                    <x-filament::icon icon="heroicon-o-eye" class="h-4 w-4 text-blue-500" />
                </x-slot>

                <x-slot:title>
                    <span x-text="participant.twitter_metrics.views"></span>
                </x-slot>

                <x-slot:description>Views</x-slot>
            </x-portal::participants.wrappers.user-stats-card>
        </div>
    </x-slot>

    <x-slot:tags>
        <template x-for="tag in participant.tags">
            <x-he4rt::tag></x-he4rt::tag>
        </template>
    </x-slot>
</x-he4rt::card>
