<div
    class="flex items-center justify-between border-b border-gray-200 bg-white px-4 py-3 dark:border-gray-700 dark:bg-gray-800">
    <div class="flex items-center space-x-3">
        <i class="fas fa-rocket text-xl text-indigo-600 dark:text-indigo-400"></i>
        <span class="text-lg font-semibold text-gray-800 dark:text-white">Admin Dashboard</span>
    </div>

    <div class="flex items-center space-x-4">
        <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"
            class="group relative flex cursor-pointer items-center space-x-3">

            <div class="h-9 w-9 overflow-hidden rounded-full border-2 border-gray-300 dark:border-gray-600">
                <img src="{{ auth()->user()->getFirstMediaUrl('avatar', 'thumb') }}" alt="User Avatar"
                    class="h-full w-full object-cover" />
            </div>

            <div class="flex flex-col">
                <span class="hidden text-sm font-medium text-gray-800 sm:inline-block dark:text-white">
                    {{ auth()->user()->full_name }}
                </span>
                <span class="hidden text-xs font-medium text-gray-800 sm:inline-block dark:text-white">
                    {{ auth()->user()->email }}
                </span>
            </div>

            <i
                class="fas fa-chevron-down text-xs text-gray-500 transition-transform duration-200 group-hover:rotate-180 dark:text-gray-300">
            </i>

            <div x-show="open" x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1"
                class="absolute right-0 top-12 z-50 w-48 rounded-md border border-gray-100 bg-white py-2 shadow-lg ring-1 ring-black/5 dark:border-gray-700 dark:bg-gray-800 dark:ring-white/10">

                <a href="{{ route('admin.profile.index') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                    <i class="fas fa-user mr-2 w-4"></i>
                    {{ __('top-nav.links.profile') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full cursor-pointer px-4 py-2 text-left text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">
                        <i class="fas fa-sign-out-alt mr-2 w-4"></i>
                        {{ __('top-nav.links.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
