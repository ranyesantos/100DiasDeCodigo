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
    class="group bg-card/50 hover:border-primary/50 hover:bg-card/80 flex w-full cursor-pointer justify-start gap-0 rounded-2xl border border-white/50 p-5 backdrop-blur-sm transition-all duration-300"
>
    <!-- TODO: a barra de progresso dentro de titulo?? status do usuario dentro de description?? ta certo isso ai?-->
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
        <div class="flex flex-row justify-around">
            <!-- current streak -->
            <x-portal::participants.wrappers.user-stats-card>
                <x-slot:icon>
                    <x-filament::icon icon="heroicon-s-fire" class="h-3 w-3 text-orange-500" />
                </x-slot>

                <x-slot:title>
                    <span x-text="participant.twitterMetrics.current_streak"></span>
                </x-slot>

                <x-slot:description>Streak</x-slot>
            </x-portal::participants.wrappers.user-stats-card>

            <!-- likes -->
            <x-portal::participants.wrappers.user-stats-card>
                <x-slot:icon>
                    <x-filament::icon icon="heroicon-o-heart" class="h-3 w-3 text-pink-500" />
                </x-slot>

                <x-slot:title>
                    <span x-text="participant.twitterMetrics.likes"></span>
                </x-slot>

                <x-slot:description>Likes</x-slot>
            </x-portal::participants.wrappers.user-stats-card>

            <!-- views -->
            <x-portal::participants.wrappers.user-stats-card>
                <x-slot:icon>
                    <x-filament::icon icon="heroicon-o-eye" class="h-3 w-3 text-blue-500" />
                </x-slot>

                <x-slot:title>
                    <span x-text="participant.twitterMetrics.views"></span>
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
