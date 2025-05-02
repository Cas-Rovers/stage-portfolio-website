{{-- resources/views/components/language-switcher.blade.php --}}

@if (!empty($availableLocales) && count($availableLocales) > 1)
    @if ($type === 'dropdown')
        <div x-data="{ open: false }" class="relative inline-block text-left">
            <div>
                <button @click="open = !open" type="button"
                    class="flex w-full items-center justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-600 dark:hover:bg-gray-700"
                    id="language-menu-button" aria-expanded="true" aria-haspopup="true">
                    @if (!empty($currentLanguage['flag_url']))
                        <img src="{{ $currentLanguage['flag_url'] }}" alt="{{ $currentLanguage['name'] }} flag"
                            class="mr-2 inline-block h-4 w-auto">
                    @endif

                    <span>{{ $currentLanguage['native'] }}</span>
                    <i class="fa-solid fa-chevron-down transition-transform duration-200"
                        :class="{ 'rotate-180': open }"></i>
                </button>
            </div>

            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-800 dark:ring-1 dark:ring-gray-700"
                role="menu" aria-orientation="vertical" aria-labelledby="language-menu-button" tabindex="-1"
                style="display: none;">
                <div class="py-1" role="none">
                    @foreach ($availableLocales as $localeCode => $properties)
                        @if ($localeCode !== $currentLocale)
                            <a href="{{ route('language.switch', $localeCode) }}"
                                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white"
                                role="menuitem" tabindex="-1" id="menu-item-{{ $localeCode }}">
                                @if (!empty($properties['flag_url']))
                                    <img src="{{ $properties['flag_url'] }}" alt="{{ $properties['name'] }} flag"
                                        class="mr-3 inline-block h-4 w-auto">
                                @endif

                                <span>{{ $properties['native'] }}</span>
                            </a>
                        @else
                            <span
                                class="flex items-center px-4 py-2 text-sm font-semibold text-gray-500 dark:text-gray-400"
                                role="menuitem" tabindex="-1">

                                @if (!empty($properties['flag_url']))
                                    <img src="{{ $properties['flag_url'] }}" alt="{{ $properties['name'] }} flag"
                                        class="mr-3 inline-block h-4 w-auto">
                                @endif

                                <span>{{ $properties['native'] }}</span>
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif
