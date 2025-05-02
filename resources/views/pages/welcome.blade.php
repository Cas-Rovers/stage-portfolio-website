@extends('layouts.guest')

@section('content')
    {{-- Greetings --}}
    <section class="dark:bg-transparent">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 md:grid-cols-5">
                <div class="relative col-span-5 md:col-span-3 lg:h-[50vh]">
                    <div class="relative z-10 flex flex-col py-10 pr-6">
                        <div class="name">
                            <h1 class="text-6xl font-extrabold leading-none drop-shadow-lg md:text-8xl">Cas</h1>
                            <h1 class="-mt-2 text-6xl font-extrabold leading-none drop-shadow-lg md:text-8xl">
                                Rovers
                            </h1>
                        </div>
                        <div class="devider h-[10px] w-[10%] bg-indigo-500"></div>
                        <div class="socials mt-4 flex gap-3">
                            <a href="https://github.com/Cas-Rovers/" target="_blank"
                                class="text-3xl transition-colors duration-300 hover:text-indigo-400"
                                aria-label="{{ __('homepage.introduction.buttons.github.aria-label') }}">
                                <i class="fa-brands fa-github"></i>
                            </a>
                            <a href="https://linkedin.com/in/casrovers/" target="_blank"
                                class="text-3xl transition-colors duration-300 hover:text-indigo-400"
                                aria-label="{{ __('homepage.introduction.buttons.linkedin.aria-label') }}">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                    <img src="{{ $personImage }}"
                        alt="{{ __('homepage.introduction.images.person.alt', ['name' => 'Cas Rovers']) }}"
                        class="absolute inset-0 z-0 ml-auto h-full rounded-md"
                        aria-label="{{ __('homepage.introduction.images.person.alt', ['name' => 'Cas Rovers']) }}">
                </div>
                <div class="col-span-5 flex items-center justify-center md:col-span-2 lg:h-[50vh]">
                    <div class="flex h-full w-[70%] flex-col justify-center py-8 md:py-0 md:pb-4">
                        <h2 class="pb-3 text-3xl font-bold text-indigo-400">
                            {{ __('homepage.introduction.greeting') }}
                        </h2>
                        <p class="text-sm">
                            {{ __('homepage.introduction.about') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- About me --}}
    <section class="bg-slate-100 py-16 dark:bg-slate-800">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2">
                <div>
                    <div class="mb-6 flex flex-col">
                        <h2 class="mb-1 text-4xl font-bold text-gray-900 dark:text-white">
                            {{ __('homepage.about-me.title') }}
                        </h2>
                        <span class="devider h-[10px] w-[10%] bg-indigo-500"></span>
                    </div>
                    <p class="mb-4 text-lg text-gray-700 dark:text-gray-300">
                        {{ __('homepage.about-me.content') }}
                    </p>
                    <a href="{{ route('projects.index') }}"
                        class="mt-6 inline-block rounded bg-indigo-600 px-6 py-3 font-semibold text-white transition hover:bg-indigo-500"
                        aria-label="{{ __('homepage.about-me.buttons.projects.aria-label') }}">
                        {{ __('homepage.about-me.buttons.projects.label') }}
                    </a>
                </div>
                <div>
                    <img src="https://placehold.co/600x400" alt="{{ __('homepage.about-me.images.pets.alt') }}"
                        class="h-auto w-full rounded-lg shadow-lg"
                        aria-label="{{ __('homepage.about-me.images.pets.alt') }}">
                </div>
            </div>
        </div>
    </section>

    {{-- Skills --}}
    <section class="py-16 dark:bg-transparent">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            <div class="mb-12 text-center">
                <h2 class="text-4xl font-bold text-indigo-400">{{ __('homepage.skills.title') }}</h2>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">{{ __('homepage.skills.subtitle') }}</p>
            </div>

            <div class="flex flex-wrap justify-center gap-6">
                @foreach ($skills as $skill)
                    <div
                        class="dark:bg-midnight-900 cursor-default rounded-2xl border border-indigo-200 bg-white p-6 shadow-md transition-all duration-200 hover:scale-105 hover:shadow-xl dark:border-indigo-600">
                        <div class="flex items-center justify-between">
                            <div class="flex gap-4">
                                <i
                                    class="{{ $skill['icon_data']['type'] }} {{ $skill['icon_data']['value'] }} text-3xl text-indigo-500"></i>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $skill->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section class="bg-slate-100 py-16 dark:bg-slate-800">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            <div class="grid grid-cols-1 items-center gap-12 md:grid-cols-2">
                <div>
                    <img src="https://placehold.co/600x400"
                        alt="{{ __('homepage.contact.images.person.alt', ['name' => 'Cas Rovers']) }}"
                        class="h-auto w-full rounded-lg shadow-lg dark:shadow-gray-700/50"
                        aria-label="{{ __('homepage.contact.images.person.alt', ['name' => 'Cas Rovers']) }}">
                </div>
                <div>
                    <div class="mb-6 flex flex-col">
                        <h2 class="mb-1 text-4xl font-bold text-gray-900 dark:text-white">
                            {{ __('homepage.contact.title') }}
                        </h2>
                        <span class="devider h-[10px] w-[10%] bg-indigo-500"></span>
                    </div>
                    <p class="mb-6 text-lg text-gray-700 dark:text-gray-300">
                        {{ __('homepage.contact.subtitle') }}
                    </p>
                    <div class="flex flex-col gap-4 text-lg text-gray-700 dark:text-gray-300">
                        <a href="mailto:contact@example.com"
                            class="flex w-fit items-center gap-3 transition-colors hover:text-indigo-600">
                            <i class="fas fa-envelope text-xl"></i>
                            contact@example.nl
                        </a>
                        <a href="tel:+1234567890"
                            class="flex w-fit items-center gap-3 transition-colors hover:text-indigo-600">
                            <i class="fas fa-phone text-xl"></i>
                            +31 6 12345678
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
