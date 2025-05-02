<div class="relative z-10 space-y-6">
    <div
        class="mx-auto flex w-full max-w-3xl flex-col gap-2 rounded-lg border border-slate-100 p-3 shadow-md sm:flex-row sm:justify-between dark:border-0 dark:bg-gray-800">
        <div class="flex w-full flex-col gap-2 sm:flex-row sm:justify-start sm:gap-3">
            <div x-data="{ open: false }" class="group relative w-full sm:w-auto">
                <button @click="open = !open"
                    class="flex w-full items-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-indigo-400 dark:focus:ring-offset-gray-800">
                    <i class="fa-solid fa-layer-group"></i>
                    {{ __('projects.categories.title') }}
                    <i class="fa-solid fa-chevron-down transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute right-0 top-12 z-50 w-48 rounded-md border border-gray-100 bg-white py-2 shadow-lg ring-1 ring-black/5 dark:border-gray-700 dark:bg-gray-800 dark:ring-white/10">
                    <div class="py-1">
                        <button type="button" wire:click="setCategory('')"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-white">{{ __('projects.categories.options.all') }}</button>
                        @foreach ($categories as $category)
                            <button type="button" wire:click="setCategory('{{ $category }}')"
                                class="flex gap-1 px-4 py-2 text-sm text-gray-700 dark:text-white">
                                @if ($category === $this->category)
                                    <i class="fa-solid fa-check"></i>
                                @endif
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
            <div x-data="{ open: false }" class="group relative w-full sm:w-auto">
                <button @click="open = !open"
                    class="flex w-full items-center gap-2 rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700 dark:focus:ring-indigo-400 dark:focus:ring-offset-gray-800">
                    <i class="fa-solid fa-tags"></i>
                    {{ __('projects.tags.title') }}
                    <i class="fa-solid fa-chevron-down transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute right-0 top-12 z-50 w-48 rounded-md border border-gray-100 bg-white py-2 shadow-lg ring-1 ring-black/5 dark:border-gray-700 dark:bg-gray-800 dark:ring-white/10">
                    <div class="py-1">
                        @foreach ($tags as $tag)
                            <label class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 dark:text-white">
                                <input type="checkbox" wire:model.live="selectedTags" value="{{ $tag }}"
                                    class="h-4 w-4 rounded-sm border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:focus:ring-blue-600">
                                <span class="text-sm text-gray-700 dark:text-white">{{ $tag }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="flex w-full items-end justify-end gap-2 sm:mt-0 sm:flex-row">
            <form wire:submit="search" class="flex w-full justify-end gap-2 sm:w-auto">
                <input type="text"
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:focus:ring-indigo-400 dark:focus:ring-offset-gray-800"
                    wire:model.live.debounce.300ms="search" placeholder="{{ __('projects.search.placeholder') }}"
                    aria-label="The projects search bar">
            </form>
        </div>
    </div>



    <div class="mx-auto grid max-w-3xl grid-cols-1 gap-6 px-4">
        @forelse ($this->projects as $project)
            <a href="{{ route('projects.show', $project->slug) }}" wire:navigate>
                <div
                    class="group transform rounded-lg border border-slate-100 bg-white p-6 shadow-md transition-transform hover:scale-105 dark:border-0 dark:bg-gray-800 dark:hover:scale-105">
                    @if ($project->getFirstMediaUrl('main_image', 'preview'))
                        <div class="mb-4 h-48 w-full overflow-hidden rounded-md">
                            <img src="{{ $project->getFirstMediaUrl('main_image', 'preview') }}"
                                alt="{{ $project->title }}" class="h-full w-full object-cover">
                        </div>
                    @else
                        <div class="mb-4 h-48 w-full overflow-hidden rounded-md">
                            <img src="https://placehold.co/600x400" alt="A placeholder text"
                                class="h-full w-full object-cover">
                        </div>
                    @endif

                    <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $project->title }}</h3>
                    <p
                        class="w-fit rounded-full bg-indigo-100 p-0 px-3 py-1 text-xs font-medium text-indigo-800 dark:bg-indigo-600 dark:text-indigo-200">
                        {{ $project->category }}
                    </p>
                    <div class="tinymce-content">
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                            {!! $project->truncatedDescription !!}
                        </p>
                    </div>

                    <ul class="mt-3 flex flex-wrap gap-2">
                        <span>{{ __('projects.tags.title') }}:</span>
                        @foreach ($project->tags as $tag)
                            <li
                                class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-800 dark:bg-indigo-600 dark:text-indigo-200">
                                {{ $tag->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </a>
        @empty
            <p class="text-center text-gray-500 dark:text-gray-400">{{ __('projects.no-records') }}</p>
        @endforelse

    </div>

    @if ($this->projects->hasPages())
        <div class="mt-6">
            {{ $this->projects->links() }}
        </div>
    @endif
</div>
