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
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 transition-colors p-2 bg-white/80 backdrop-blur-sm rounded-full shadow-sm hover:shadow-md">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </a>
                </div>
                
                <!-- Logo and Tagline -->
                <div class="text-center">
                    <img src="{{ asset('images/logo login.png') }}" alt="GrowCash Logo" class="mx-auto h-32 mb-6 drop-shadow-xl transition-transform hover:scale-105 duration-300">
                </div>
            </div>

            <!-- Right Section - Registration Form (Blue) -->
            <div class="w-full lg:max-w-md mx-auto relative z-20">
                <div class="bg-blue-600 rounded-3xl shadow-2xl p-8 sm:p-10 transition-all hover:shadow-blue-500/20">
                    <!-- Mobile Back Arrow -->
                    <div class="lg:hidden mb-6">
                        <a href="{{ route('login') }}" class="text-white hover:text-blue-100 transition-colors inline-flex items-center group">
                            <div class="bg-white/20 p-1.5 rounded-full mr-2 group-hover:bg-white/30 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </div>
                            <span class="font-medium">Back to Login</span>
                        </a>
                    </div>

                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-white">Create Account</h2>
                        <p class="text-blue-100 mt-2">Start your financial journey today</p>
                    </div>

                    <form class="space-y-5" action="{{ route('register') }}" method="POST">
                        @csrf
                        
                        <!-- Nama Lengkap Field -->
                        <div class="space-y-3">
                            <label for="name" class="block text-sm font-medium text-white ml-1">Full Name</label>
                            <input id="name" name="name" type="text" required 
                                class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 relative z-10 @error('name') ring-2 ring-red-400 @enderror" 
                                placeholder="Enter your full name" value="{{ old('name') }}">
                            @error('name')
                                <p class="mt-1 text-sm text-red-200 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir Field -->
                        <div class="space-y-3">
                            <label for="tanggal_lahir" class="block text-sm font-medium text-white ml-1">Date of Birth</label>
                            <input id="tanggal_lahir" name="tanggal_lahir" type="date" required 
                                class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 cursor-pointer relative z-10 @error('tanggal_lahir') ring-2 ring-red-400 @enderror" 
                                value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
                                <p class="mt-1 text-sm text-red-200 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="space-y-3">
                            <label for="email" class="block text-sm font-medium text-white ml-1">Email Address</label>
                            <input id="email" name="email" type="email" required 
                                class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 relative z-10 @error('email') ring-2 ring-red-400 @enderror" 
                                placeholder="Enter your email" value="{{ old('email') }}">
                            @error('email')
                                <p class="mt-1 text-sm text-red-200 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor Telepon Field -->
                        <div class="space-y-3">
                            <label for="nomor_telepon" class="block text-sm font-medium text-white ml-1">Phone Number</label>
                            <input id="nomor_telepon" name="nomor_telepon" type="tel" required 
                                class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 relative z-10 @error('nomor_telepon') ring-2 ring-red-400 @enderror" 
                                placeholder="Enter your phone number" value="{{ old('nomor_telepon') }}">
                            @error('nomor_telepon')
                                <p class="mt-1 text-sm text-red-200 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-3">
                            <label for="password" class="block text-sm font-medium text-white ml-1">Password</label>
                            <input id="password" name="password" type="password" required 
                                class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 relative z-10 @error('password') ring-2 ring-red-400 @enderror" 
                                placeholder="Create a password">
                            
                            <!-- Password Strength Indicator -->
                            <div class="grid grid-cols-3 gap-2 mt-2">
                                <div id="strength-bar-1" class="h-1 rounded-full bg-white/20 transition-colors duration-300"></div>
                                <div id="strength-bar-2" class="h-1 rounded-full bg-white/20 transition-colors duration-300"></div>
                                <div id="strength-bar-3" class="h-1 rounded-full bg-white/20 transition-colors duration-300"></div>
                            </div>

                            <div id="password-hint" class="mt-2 text-xs text-blue-100 bg-white/10 p-3 rounded-xl backdrop-blur-sm">
                                <p class="mb-1.5 font-semibold text-white">Password requirements:</p>
                                <ul class="space-y-1">
                                    <li id="hint-length" class="flex items-center text-blue-200 transition-colors duration-200">
                                        <svg class="w-3 h-3 mr-1.5 opacity-0 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Min. 8 characters
                                    </li>
                                    <li id="hint-letter" class="flex items-center text-blue-200 transition-colors duration-200">
                                        <svg class="w-3 h-3 mr-1.5 opacity-0 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Contains a letter
                                    </li>
                                    <li id="hint-number" class="flex items-center text-blue-200 transition-colors duration-200">
                                        <svg class="w-3 h-3 mr-1.5 opacity-0 transition-opacity duration-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        Contains a number
                                    </li>
                                </ul>
                            </div>
                            @error('password')
                                <p class="mt-1 text-sm text-red-200 ml-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="space-y-3">
                            <label for="password_confirmation" class="block text-sm font-medium text-white ml-1">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required 
                                class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 relative z-10" 
                                placeholder="Confirm your password">
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button type="submit" 
                                class="w-full py-4 px-6 bg-white text-blue-600 font-bold rounded-2xl shadow-lg hover:shadow-xl hover:bg-gray-50 transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 relative z-10">
                                Create Account
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
    
    // Strength bars
    const bar1 = document.getElementById('strength-bar-1');
    const bar2 = document.getElementById('strength-bar-2');
    const bar3 = document.getElementById('strength-bar-3');

    function updateRequirement(element, isValid) {
        const icon = element.querySelector('svg');
        if (isValid) {
            element.classList.remove('text-blue-200');
            element.classList.add('text-green-300', 'font-medium');
            icon.classList.remove('opacity-0');
        } else {
            element.classList.remove('text-green-300', 'font-medium');
            element.classList.add('text-blue-200');
            icon.classList.add('opacity-0');
        }
    }

    function updateStrength(score) {
        // Reset bars
        [bar1, bar2, bar3].forEach(bar => {
            bar.className = 'h-1 rounded-full bg-white/20 transition-colors duration-300';
        });

        if (score >= 1) bar1.classList.replace('bg-white/20', 'bg-red-400');
        if (score >= 2) {
            bar1.classList.replace('bg-red-400', 'bg-yellow-400');
            bar2.classList.replace('bg-white/20', 'bg-yellow-400');
        }
        if (score >= 3) {
            bar1.classList.replace('bg-yellow-400', 'bg-green-400');
            bar2.classList.replace('bg-yellow-400', 'bg-green-400');
            bar3.classList.replace('bg-white/20', 'bg-green-400');
        }
    }

    passwordInput.addEventListener('input', function() {
        const password = this.value;
        let score = 0;
        
        // Check length
        const isLengthValid = password.length >= 8;
        updateRequirement(hintLength, isLengthValid);
        if (isLengthValid) score++;
        
        // Check letter
        const isLetterValid = /[a-zA-Z]/.test(password);
        updateRequirement(hintLetter, isLetterValid);
        if (isLetterValid) score++;
        
        // Check number
        const isNumberValid = /[0-9]/.test(password);
        updateRequirement(hintNumber, isNumberValid);
        if (isNumberValid) score++;

        updateStrength(score);
    });
</script>
@endsection

