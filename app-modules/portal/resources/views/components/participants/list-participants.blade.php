@props([
    'interactive' => false,
    'fields' => [],
    'technologies' => [],
    'participants' => [],
    'defaultSort' => 'Progress',
    'defaultViewMode' => 'grid',
])

<section
    class="container mx-auto max-w-7xl px-4 py-8"
    x-init="$watch('selectedSort', (value) => console.log('sorting:', value))"
    x-data="{
        search: $queryString('').usePush().as('search'),
        selectedSort: $queryString('Progress').usePush().as('sort'),
        participants: @js($participants),

        get filteredParticipants() {
            let filteredParticipants = this.participants

            const sortMap = {
                'Progress': (p) => p.total_days,
                'Streak': (p) => p.current_streak,
                'Likes': (p) => p.twitter_metrics.likes,
                'Views': (p) => p.twitter_metrics.views,
            }

            filteredParticipants = filteredParticipants
                .slice()
                .sort(
                    (a, b) =>
                        sortMap[this.selectedSort](b) -
                        sortMap[this.selectedSort](a),
                )

            if (this.search) {
                const term = this.search.toLowerCase()

                filteredParticipants = filteredParticipants.filter(
                    (i) =>
                        i.username?.toLowerCase().includes(term) ||
                        i.name?.toLowerCase().includes(term),
                )
            }

            return filteredParticipants
        },
    }"
>
    <div class="flex flex-col gap-8 lg:flex-row">
        <aside class="hidden w-64 shrink-0 lg:block">
            <div class="sticky top-24 space-y-6">
                <div class="bg-card/50 border-border/50 rounded-2xl border p-5 backdrop-blur-sm">
                    <div class="space-y-6">
                        <div>
                            <h3 class="mb-3 flex items-center gap-2 text-sm font-semibold">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="lucide lucide-sparkles text-primary h-4 w-4"
                                >
                                    <path
                                        d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"
                                    ></path>
                                    <path d="M20 3v4"></path>
                                    <path d="M22 5h-4"></path>
                                    <path d="M4 17v2"></path>
                                    <path d="M5 18H3"></path>
                                </svg>
                                Field
                            </h3>
                        </div>
                        <div>
                            <h3 class="mb-3 text-sm font-semibold">Technologies</h3>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <main class="min-w-0 flex-1">
            <div class="mb-6 flex flex-col gap-4 sm:flex-row">
                <div class="relative flex-1">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="lucide lucide-search text-muted-foreground absolute top-1/2 left-3 h-4 w-4 -translate-y-1/2"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </svg>
                    <input
                        x-model="search"
                        data-slot="input"
                        class="border-border bg-card/50 text-foreground placeholder:text-muted-foreground focus:ring-ring focus:border-ring dark:bg-input/30 h-9 w-full rounded-md border px-3 pl-10 text-sm focus:ring-2 focus:outline-none disabled:cursor-not-allowed disabled:opacity-50"
                        placeholder="Busque por nome ou username..."
                        value=""
                    />
                </div>
                <div class="flex items-center">
                    <div
                        class="gap-1justify-center flex flex-row items-center rounded-md border border-gray-200 bg-white p-2 px-3 py-2 text-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <x-filament::icon icon="heroicon-o-arrows-up-down" class="h-4 w-4" />
                        <select class="border-0 bg-white text-sm dark:bg-gray-800" x-model="selectedSort">
                            <option>Progress</option>
                            <option>Streak</option>
                            <option>Likes</option>
                            <option>Views</option>
                        </select>
                    </div>

                    <div
                        class="hidden items-center rounded-lg border border-gray-200 bg-white p-1 sm:flex dark:border-gray-700 dark:bg-gray-800"
                    >
                        <button id="gridView" class="rounded bg-blue-600 px-2 py-1 text-white">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect width="18" height="18" x="3" y="3" rx="2" />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 9h18M3 15h18M9 3v18M15 3v18"
                                />
                            </svg>
                        </button>
                        <button id="listView" class="rounded px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <line
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    x1="8"
                                    x2="21"
                                    y1="6"
                                    y2="6"
                                />
                                <line
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    x1="8"
                                    x2="21"
                                    y1="12"
                                    y2="12"
                                />
                                <line
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    x1="8"
                                    x2="21"
                                    y1="18"
                                    y2="18"
                                />
                                <line
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    x1="3"
                                    x2="3.01"
                                    y1="6"
                                    y2="6"
                                />
                                <line
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    x1="3"
                                    x2="3.01"
                                    y1="12"
                                    y2="12"
                                />
                                <line
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    x1="3"
                                    x2="3.01"
                                    y1="18"
                                    y2="18"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mb-4 flex items-center justify-between">
                <p class="text-muted-foreground text-sm">
                    Exibindo
                    <span class="text-foreground font-medium" x-text="filteredParticipants.length"></span>
                    participantes
                </p>
            </div>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <template x-for="participant in filteredParticipants" :key="participant.username">
                    <x-portal::participants.participant-card />
                </template>
            </div>
        </main>
    </div>
</section>
