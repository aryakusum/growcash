@extends('layouts.app')

@section('title', 'Register - GrowCash')

@section('content')
<div class="min-h-screen auth-background relative overflow-hidden">
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center min-h-[90vh]">
            <!-- Left Section - Branding -->
            <div class="hidden lg:flex flex-col justify-center items-center relative z-20">
                <!-- Back Arrow -->
                <div class="absolute top-0 left-0">
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-600 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Logo and Tagline -->
                <div class="text-center">
                    <img src="{{ asset('images/logo login.png') }}" alt="GrowCash Logo" class="mx-auto h-32 mb-4">
                    <p class="text-sm text-gray-700 font-medium uppercase tracking-wide">MONEY CAN BUY THE FUTURE</p>
                </div>
            </div>

            <!-- Right Section - Registration Form (Blue) -->
            <div class="w-full lg:max-w-md mx-auto relative z-20">
                <div class="bg-blue-600 rounded-2xl shadow-2xl p-8 sm:p-10">
                    <!-- Mobile Back Arrow -->
                    <div class="lg:hidden mb-6">
                        <a href="{{ route('login') }}" class="text-white hover:text-gray-200 transition-colors inline-flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span>Kembali</span>
                        </a>
                    </div>

                    <form class="space-y-5" action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <!-- Nama Lengkap Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-white mb-2">Nama Lengkap</label>
                            <input id="name" name="name" type="text" required 
                                class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all @error('name') ring-2 ring-red-500 @enderror" 
                                placeholder="Nama lengkap" value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir Field -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-white mb-2">Tanggal Lahir</label>
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date" required 
                                class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all @error('tanggal_lahir') ring-2 ring-red-500 @enderror" 
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
                            <input id="email" name="email" type="email" required 
                                class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all @error('email') ring-2 ring-red-500 @enderror" 
                                placeholder="Email address" value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor Telepon Field -->
                        <div>
                            <label for="nomor_telepon" class="block text-sm font-medium text-white mb-2">Nomor Telepon</label>
                            <input id="nomor_telepon" name="nomor_telepon" type="tel" required 
                                class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all @error('nomor_telepon') ring-2 ring-red-500 @enderror" 
                                placeholder="Nomor telepon" value="{{ old('nomor_telepon') }}">
                            @error('nomor_telepon')
                                <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                            <input id="password" name="password" type="password" required 
                                class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all @error('password') ring-2 ring-red-500 @enderror" 
                                placeholder="Password">
                            <div id="password-hint" class="mt-1.5 text-xs text-blue-100">
                                <p class="mb-1 font-medium">Password harus:</p>
                                <ul class="list-disc list-inside space-y-0.5">
                                    <li id="hint-length" class="text-blue-200">Minimal 8 karakter</li>
                                    <li id="hint-letter" class="text-blue-200">Mengandung huruf</li>
                                    <li id="hint-number" class="text-blue-200">Mengandung angka</li>
                                </ul>
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-white mb-2">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all" 
                                placeholder="Confirm password">
                        </div>

                        <!-- Submit Button - White with Blue Text -->
                        <div class="pt-2">
                            <button type="submit" 
                                class="w-full py-3.5 px-6 bg-white hover:bg-gray-100 text-blue-600 font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600">
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Real-time password validation
    const passwordInput = document.getElementById('password');
    const hintLength = document.getElementById('hint-length');
    const hintLetter = document.getElementById('hint-letter');
    const hintNumber = document.getElementById('hint-number');

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        
        // Check length (min 8 characters)
        if (password.length >= 8) {
            hintLength.classList.remove('text-blue-200');
            hintLength.classList.add('text-green-300');
            hintLength.innerHTML = '✓ Minimal 8 karakter';
        } else {
            hintLength.classList.remove('text-green-300');
            hintLength.classList.add('text-blue-200');
            hintLength.innerHTML = 'Minimal 8 karakter';
        }
        
        // Check for letter
        if (/[a-zA-Z]/.test(password)) {
            hintLetter.classList.remove('text-blue-200');
            hintLetter.classList.add('text-green-300');
            hintLetter.innerHTML = '✓ Mengandung huruf';
        } else {
            hintLetter.classList.remove('text-green-300');
            hintLetter.classList.add('text-blue-200');
            hintLetter.innerHTML = 'Mengandung huruf';
        }
        
        // Check for number
        if (/[0-9]/.test(password)) {
            hintNumber.classList.remove('text-blue-200');
            hintNumber.classList.add('text-green-300');
            hintNumber.innerHTML = '✓ Mengandung angka';
        } else {
            hintNumber.classList.remove('text-green-300');
            hintNumber.classList.add('text-blue-200');
            hintNumber.innerHTML = 'Mengandung angka';
        }
    });
</script>
@endsection

