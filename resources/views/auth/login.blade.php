@extends('layouts.auth')

@section('title', __('login.title'))

@section('content')
    <div class="flex min-h-screen items-center justify-center">
        <div class="w-full max-w-md rounded-lg border border-slate-100 bg-white p-6 shadow-lg">
            <h2 class="mb-6 text-center text-2xl font-semibold">{{ __('login.title') }}</h2>
            <form action="{{ route('login') }}" method="POST" name="login-form" class="space-y-5">
                @csrf
                <div>
                    <label for="email-input" class="mb-1 block text-sm font-medium text-gray-700">
                        {{ __('login.inputs.email.label') }}
                    </label>
                    <input type="email" id="email-input" name="email" value="{{ old('email') }}"
                        placeholder="{{ __('login.inputs.email.placeholder') }}" required autocomplete="email"
                        aria-label="{{ __('login.inputs.email.aria_label') }}" autofocus
                        class="w-full rounded-md border border-gray-300 px-4 py-2 transition-all focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password-input" class="mb-1 block text-sm font-medium text-gray-700">
                        {{ __('login.inputs.password.label') }}
                    </label>
                    <input type="password" id="password-input" name="password"
                        placeholder="{{ __('login.inputs.password.placeholder') }}" required autocomplete="current-password"
                        aria-label="{{ __('login.inputs.password.aria_label') }}"
                        class="w-full rounded-md border border-gray-300 px-4 py-2 transition-all focus:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" aria-label="{{ __('login.actions.submit.aria_label') }}"
                    class="w-full cursor-pointer rounded-md bg-blue-600 py-2 font-medium text-white transition-colors hover:bg-blue-700">
                    {{ __('login.actions.submit.content') }}
                </button>
            </form>
        </div>
    </div>
@endsection
