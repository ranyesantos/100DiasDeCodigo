@props(['interactive' => false])

<x-he4rt::card
    class="flex items-center justify-center gap-0 rounded-2xl border-0 py-4 pt-3"
    :interactive="$interactive"
>
    <x-slot:icon class="mb-1 flex items-center justify-center">
        {{ $icon ?? '' }}
    </x-slot>

    <x-slot:description class="flex flex-col items-center justify-center text-xs text-white">
        <span class="font-bold">{{ $title ?? '' }}</span>
        <span>{{ $description ?? '' }}</span>
    </x-slot>
</x-he4rt::card>
