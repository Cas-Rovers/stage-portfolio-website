<nav class="relative z-50 bg-white dark:bg-transparent">
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
            <div class="md:hidden">
                <button type="button" id="mobile-nav-btn"
                    class="text-gray-700 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500 dark:text-gray-300 dark:hover:text-white"
                    aria-label="Open mobile menu">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
