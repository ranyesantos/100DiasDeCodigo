@props([
    'interactive' => false,
    'fields' => [],
    'technologies' => [],
    'participants' => [],
    'defaultSort' => 'Progress',
    'defaultViewMode' => 'grid',
])

<section
    x-ref="section"
    class="container mx-auto max-w-7xl px-4 py-8"
    x-init="
        $watch('selectedSort', (value) => console.log('sorting:', value))

        //reseta a pagina em searching
        $watch('search', (newValue, oldValue) => {
            if (newValue !== oldValue) {
                currentPage = 1
            }
        })
        //reseta a página quando altera o sorting
        $watch('[selectedSort]', () => {
            currentPage = 1
        })
    "
    x-data="{
        search: $queryString('').usePush().as('search'),
        selectedSort: $queryString('Progress').usePush().as('sort'),
        participants: @js($participants),

        _currentPage: $queryString(1).usePush().as('page'),
        get currentPage() {
            return +this._currentPage
        },
        set currentPage(value) {
            this._currentPage = value
            this.$nextTick(() => {
                this.$refs.section.scrollIntoView({ behavior: 'smooth' })
            })
        },

        //todo: alterar o perpage
        perPage: 3,
        totalItems: 0,
        get totalPages() {
            return Math.ceil(this.totalItems / this.perPage)
        },

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

            this.totalItems = filteredParticipants.length
            filteredParticipants = filteredParticipants.slice(
                (this.currentPage - 1) * this.perPage,
                this.currentPage * this.perPage,
            )

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
                                <x-filament::icon icon="heroicon-o-star" class="text-primary h-4 w-4" x-on::click="" />
                                Campo
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
                    <x-filament::icon
                        icon="heroicon-o-magnifying-glass"
                        class="lucide lucide-search text-muted-foreground text-primary absolute top-1/2 left-3 me-2 h-4 w-4 -translate-y-1/2"
                        x-on::click=""
                    />
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
                        class="flex flex-row items-center justify-center gap-1 rounded-md border border-gray-200 bg-white p-2 px-3 py-2 text-sm dark:border-gray-700 dark:bg-gray-800"
                    >
                        <x-filament::icon icon="heroicon-o-arrows-up-down" class="me-2 h-4 w-4" x-on::click="" />
                        <select class="border-0 bg-white text-sm outline-0 dark:bg-gray-800" x-model="selectedSort">
                            <option>Progress</option>
                            <option>Streak</option>
                            <option>Likes</option>
                            <option>Views</option>
                        </select>
                    </div>

                    <div
                        class="hidden items-center rounded-lg border border-gray-200 bg-white p-1 sm:flex dark:border-gray-700 dark:bg-gray-800"
                    >
                        <button id="gridView" class="bg-primary rounded px-2 py-1 text-white">
                            <x-filament::icon icon="heroicon-s-table-cells" class="h-4 w-4 text-white" x-on::click="" />
                        </button>
                        <button id="listView" class="rounded px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <x-filament::icon icon="heroicon-o-list-bullet" class="h-4 w-4 text-white" x-on::click="" />
                        </button>
                    </div>
                </div>
            </div>

            <div class="mb-4 flex items-center justify-between">
                <div x-show="filteredParticipants.length" class="text- mr-auto text-sm">
                    Mostrando
                    <span class="font-extrabold" x-text="(currentPage - 1) * perPage + 1"></span>
                    até
                    <span class="font-extrabold" x-text="Math.min(currentPage * perPage, totalItems)"></span>
                    de
                    <span class="font-extrabold" x-text="totalItems"></span>
                    resultados
                </div>
            </div>

            <div x-ref="participantCardsWrapper" class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <template x-for="participant in filteredParticipants" :key="participant.username">
                    <x-portal::participants.participant-card />
                </template>
            </div>
            <div class="flex items-center justify-end px-1 pt-7">
                <x-he4rt::pagination />
            </div>
        </main>
    </div>
</section>
