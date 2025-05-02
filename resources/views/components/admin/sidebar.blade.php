<!-- Sidebar -->
<div class="w-64 flex-shrink-0 space-y-6 border-r border-r-slate-200 bg-white p-5 dark:bg-gray-800">
    <div class="flex items-center justify-center space-x-2">
        <span class="text-xl font-semibold text-gray-800 dark:text-white">{{ config('app.name') }}</span>
    </div>

    <nav class="mt-10">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ Route::is('admin.dashboard') ? 'bg-gray-100' : '' }} flex items-center rounded-md px-4 py-2 text-gray-700 transition hover:bg-gray-200 dark:text-gray-200 dark:hover:bg-gray-700"
                    wire:navigate>
                    <i class="fas fa-tachometer-alt text-gray-500 dark:text-gray-300"></i>
                    <span class="ml-3">{{ __('dashboard.title') }}</span>
                </a>
                <a href="{{ route('admin.projects.index') }}"
                    class="{{ Route::is('admin.projects.index') ? 'bg-gray-100' : '' }} flex items-center rounded-md px-4 py-2 text-gray-700 transition hover:bg-gray-200 dark:text-gray-200 dark:hover:bg-gray-700"
                    wire:navigate>
                    <i class="fa-solid fa-diagram-project text-gray-500 dark:text-gray-300"></i>
                    <span class="ml-3">{{ __('projects.title') }}</span>
                </a>
            </li>
        </ul>
    </nav>
</div>
