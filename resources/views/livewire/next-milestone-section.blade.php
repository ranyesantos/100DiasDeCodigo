<div
    class="rounded-2xl border border-gray-200 bg-white/50 p-6 backdrop-blur-sm dark:border-gray-800 dark:bg-gray-900/50"
>
    <h3 class="mb-3 font-semibold text-gray-900 dark:text-white">Próximo Marco</h3>
    <div class="flex items-center gap-4">
        <div
            class="bg-primary-500/10 text-primary-500 flex h-14 w-14 items-center justify-center rounded-full text-xl font-bold"
        >
            {{ $nextMilestone }}
        </div>
        <div>
            <p class="font-medium text-gray-900 dark:text-white">
                @if ($nextMilestone === 50)
                    Metade do caminho!
                @elseif ($nextMilestone === 100)
                    Reta final!
                @else
                    Continue assim!
                @endif
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">Faltam apenas {{ $daysRemaining }} dias</p>
        </div>
    </div>
</div>
