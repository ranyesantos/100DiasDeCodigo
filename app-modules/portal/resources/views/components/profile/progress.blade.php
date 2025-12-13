@props([
    'stats' => ['total_days' => 0],
])

<div class="w-full dark:border-gray-800">
    <div class="mb-1 flex items-end justify-between">
        <h3 class="font-semibold text-gray-900 dark:text-white">Progress</h3>
        <span
            class="text-sm font-medium text-gray-500 dark:text-gray-400"
            x-bind::aria-label="participant.total_days"
            aria-label="{{ $stats['total_days'] }} out of 100 days completed"
            x-text="participant.total_days + '/100'"
        >
            {{ $stats['total_days'] }}/100 days
        </span>
    </div>
    <div
        class="h-3 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800"
        role="progressbar"
        aria-valuenow="{{ $stats['total_days'] }}"
        x-bind::aria-valuenow="participants.total_days"
        aria-valuemin="0"
        aria-valuemax="100"
    >
        <div
            class="from-primary-500 mb-2 h-full rounded-full bg-linear-to-r to-indigo-500 shadow-[0_0_10px_rgba(99,102,241,0.5)] transition-all duration-1000 ease-out"
            x-bind:style="`width: ${Math.min((participant.total_days / 100) * 100, 100)}%`"
            style="width: {{ min(($stats['total_days'] / 100) * 100, 100) }}%"
        ></div>
    </div>
</div>
