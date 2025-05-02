<nav x-data="{ open: false }" class="relative z-50 bg-transparent">
    <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo (Left) --}}
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center" wire:navigate>
                    <div class="flex items-center text-4xl">
                        <span class="font-bold text-blue-400">C</span>
                        <span class="font-bold text-red-400">R</span>
                    </div>
                </a>
            </div>

            <div class="hidden items-center space-x-6 md:flex">
                <div class="flex items-center space-x-6 text-2xl">
                    <a href="{{ route('home') }}" class="nav-link {{ Route::is('home') ? 'active' : '' }}"
                        wire:navigate>{{ __('navbar.links.home') }}</a>
                    <a href="{{ route('projects.index') }}"
                        class="nav-link {{ Route::is('projects.*') ? 'active' : '' }}"
                        wire:navigate>{{ __('navbar.links.projects') }}</a>
                </div>
                <div class="ml-6">
                    <x-frontend.language-switcher />
                </div>
            </div>

            <div class="flex items-center md:hidden">
                <div class="mr-4">
                    <x-frontend.language-switcher />
                </div>

                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                    aria-controls="mobile-menu" :aria-expanded="open.toString()" aria-label="Toggle main menu">
                    <span class="sr-only">Open main menu</span>
                    <i :class="{ 'fa-bars': !open, 'fa-xmark': open }" class="fa-solid text-2xl"></i>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" @click.outside="open = false"
        class="absolute left-0 right-0 top-16 z-40 border-t border-gray-200 bg-white shadow-lg md:hidden dark:border-gray-700/50 dark:bg-gray-900"
        id="mobile-menu" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-2" style="display: none;" <div
        class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        {{-- Mobile Nav Links - Style these as needed --}}
        <a href="{{ route('home') }}" wire:navigate @click="open = false"
            class="{{ Route::is('home') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">
            {{ __('navbar.links.home') }}
        </a>
        <a href="{{ route('projects.index') }}" wire:navigate @click="open = false"
            class="{{ Route::is('projects.*') ? 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-300' : 'text-gray-700 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium">
            {{ __('navbar.links.projects') }}
        </a>
    </div>
    </div>
</nav>
