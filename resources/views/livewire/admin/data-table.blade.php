{{-- Hoofdcontainer met wat verticale padding --}}
<div class="space-y-4 p-4 md:p-6">

    {{-- Controlebalk: Per Pagina, Zoeken, Nieuw Maken --}}
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        {{-- Links: Per Pagina & Zoeken --}}
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:gap-6">
            {{-- Per Pagina Selector --}}
            <div class="flex items-center gap-2">
                <label for="perPage"
                    class="whitespace-nowrap text-sm font-medium text-gray-700">{{ __('data-table.per-page') }}</label>
                <select wire:model.live="perPage" id="perPage"
                    class="rounded-md border border-gray-300 p-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>

            {{-- Zoekveld --}}
            <div class="relative">
                {{-- Optioneel: Zoekicoon --}}
                {{-- <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                     <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                     </svg>
                 </div> --}}
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="{{ __('data-table.search') }}"
                    class="{{-- pl-10 als je icoon gebruikt --}} block w-full rounded-md border border-gray-300 p-2 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500 md:w-64"
                    aria-label="{{ __('data-table.search') }}">
            </div>
        </div>

        {{-- Rechts: Nieuw Maken Knop --}}
        <div>
            <a href="{{ route($createLink) }}"
                class="inline-flex items-center justify-center gap-2 rounded-md border border-transparent bg-green-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                aria-label="{{ __('data-table.create') }}">
                <i class="fa-solid fa-plus"></i>
                {{ __('data-table.create') }}
            </a>
        </div>
    </div>

    {{-- Tabel Container met Schaduw en Horizontaal Scrollen --}}
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-50">
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                {{ __("data-table.columns.$column") !== "data-table.columns.$column" ? __("data-table.columns.$column") : ucfirst(str_replace('_', ' ', $column)) }}
                            </th>
                        @endforeach
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                            {{ __('data-table.actions') }}
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">{{ __('data-table.actions') }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($query as $item)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-100">
                            @foreach ($columns as $column)
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800">
                                    @if ($column === 'is_published')
                                        {{-- Controleer de waarde van is_published.
                                             PHP behandelt 1 als 'true' en 0, null, of leeg als 'false' in deze context.
                                             Gebruik __() voor vertaalbaarheid. --}}
                                        @if ($item->$column)
                                            <span
                                                class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                                {{ __('data-table.yes') }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                                {{ __('data-table.no') }}
                                            </span>
                                        @endif
                                    @else
                                        {{-- Voor alle andere kolommen, toon gewoon de waarde --}}
                                        {{ $item->$column }}
                                        {{-- Hier kun je eventueel specifieke formatting per andere kolom toevoegen --}}
                                        {{-- @if ($column === 'status') ... @endif --}}
                                    @endif
                                </td>
                            @endforeach
                            <td class="flex items-center gap-2 px-6 py-4 text-sm font-medium">
                                <a href="{{ route($editLink, $item->id) }}"
                                    class="inline-flex items-center rounded border border-transparent bg-blue-100 px-2.5 py-1.5 text-xs font-medium text-blue-700 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                                    title="{{ __('data-table.edit') }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route($deleteLink, $item->id) }}" method="POST"
                                    onsubmit="return confirm('{{ __('data-table.delete-confirm') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center rounded border border-transparent bg-red-100 px-2.5 py-1.5 text-xs font-medium text-red-700 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                        title="{{ __('data-table.delete') }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-800"></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($columns) + 2 }}"
                                class="px-6 py-12 text-center text-sm text-gray-500">
                                {{ __('data-table.no-records') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Paginering: Zorg dat Tailwind views gepubliceerd zijn --}}
    @if ($query->hasPages())
        <div class="mt-4 px-2 py-2">
            {{ $query->links() }}
        </div>
    @endif
</div>
