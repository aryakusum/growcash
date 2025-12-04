@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-display font-bold text-white mb-2">Profile Settings</h1>
            <p class="text-gray-400">Manage your account information and preferences</p>
        </div>
    </div>

    <!-- Profile Information -->
    <div class="glass-card p-8 rounded-2xl">
        <h2 class="text-2xl font-display font-bold text-white mb-6">Personal Information</h2>
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-200 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required
                        class="glass-input w-full px-4 py-3 rounded-xl">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-200 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                        class="glass-input w-full px-4 py-3 rounded-xl">
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-200 mb-2">Date of Birth</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', Auth::user()->tanggal_lahir?->format('Y-m-d')) }}"
                        class="glass-input w-full px-4 py-3 rounded-xl">
                    @error('tanggal_lahir')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-200 mb-2">Phone Number</label>
                    <input type="text" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', Auth::user()->nomor_telepon) }}"
                        class="glass-input w-full px-4 py-3 rounded-xl">
                    @error('nomor_telepon')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="glass-button px-8 py-3 rounded-xl">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    <!-- Change Password -->
    <div class="glass-card p-8 rounded-2xl">
        <h2 class="text-2xl font-display font-bold text-white mb-6">Change Password</h2>
        <form action="{{ route('profile.password') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-gray-200 mb-2">Current Password</label>
                <input type="password" id="current_password" name="current_password" required
                    class="glass-input w-full px-4 py-3 rounded-xl">
                @error('current_password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-200 mb-2">New Password</label>
                    <input type="password" id="password" name="password" required
                        class="glass-input w-full px-4 py-3 rounded-xl">
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-200 mb-2">Confirm New Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="glass-input w-full px-4 py-3 rounded-xl">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="glass-button px-8 py-3 rounded-xl">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
