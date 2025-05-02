@extends('layouts.app')

@section('content')
    <div class="mx-auto mt-10 max-w-2xl rounded-xl bg-white p-6 shadow">

        <h2 class="mb-6 text-2xl font-bold text-gray-800">Edit Profile</h2>

        @if (session('success'))
            <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- First Name -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name"
                    class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{ old('first_name', $user->first_name) }}" required>
            </div>

            <!-- Last Name -->
            <div>
                <label for="last_name" class="block p-2 text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name"
                    class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{ old('last_name', $user->last_name) }}">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Avatar -->
            <div>
                <label for="avatar" class="block text-sm font-medium text-gray-700">Avatar</label>
                <input type="file" name="avatar" id="avatar"
                    class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100">

                @if ($user->getFirstMediaUrl('avatar'))
                    <div class="mt-4">
                        <img src="{{ $user->getFirstMediaUrl('avatar', 'thumb') }}" alt="Current Avatar"
                            class="h-[96px] w-[96px] rounded-full border object-cover shadow">
                    </div>
                @endif
            </div>

            <!-- Submit -->
            <div class="pt-4">
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Update Profile
                </button>
            </div>
        </form>

        <hr class="my-10">

        <h2 class="mb-4 text-xl font-bold text-gray-800">Change Password</h2>

        @if (session('password_status'))
            <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
                {{ session('password_status') }}
            </div>
        @endif

        <form action="{{ route('admin.profile.updatePassword') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Current Password -->
            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                <input type="password" name="current_password" id="current_password"
                    class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <!-- New Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <!-- Confirm New Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                    Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full rounded-md border-gray-300 p-2 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="inline-flex w-full justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Update Password
                </button>
            </div>
        </form>
    </div>
@endsection
