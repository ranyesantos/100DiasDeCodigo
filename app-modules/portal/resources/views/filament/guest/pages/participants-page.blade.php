<x-filament::page class="">
    <div class="bg-background min-h-screen">
        <x-portal::participants.hero-participants :counters="$counters" :title="$title" :subtitle="$subtitle" />

        <x-portal::participants.list-participants :participants="$users" />
    </div>
</x-filament::page>
