@extends('layouts.app')

@section('title', 'Login - GrowCash')

@section('content')
<div class="min-h-screen flex items-center justify-center auth-background py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="w-full max-w-md relative z-20">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo login.png') }}" alt="GrowCash Logo" class="mx-auto h-24 mb-3 drop-shadow-lg transition-transform hover:scale-105 duration-300">
        </div>

        <!-- Login Form - Blue Background -->
        <div class="bg-blue-600 rounded-3xl shadow-2xl p-8 sm:p-10 transition-all hover:shadow-blue-500/20">
            <div class="mb-8 text-center">
                <h2 class="text-3xl font-bold text-white">Welcome Back</h2>
                <p class="text-blue-100 mt-2">Please sign in to your account</p>
            </div>

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Email Field -->
                <div class="space-y-3">
                    <label for="email" class="block text-sm font-medium text-white ml-1">Email Address</label>
                    <div class="relative">
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 relative z-10 @error('email') ring-2 ring-red-400 @enderror" 
                            placeholder="Enter your email" value="{{ old('email') }}">
                        @error('email')
                            <div class="absolute right-0 top-0 h-full flex items-center pr-4 pointer-events-none z-20">
                                <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        @enderror
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-200 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="space-y-3">
                    <label for="password" class="block text-sm font-medium text-white ml-1">Password</label>
                    <div class="relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="w-full px-5 py-3.5 border-0 rounded-2xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-all duration-200 relative z-10 @error('password') ring-2 ring-red-400 @enderror" 
                            placeholder="Enter your password">
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-200 ml-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Forgot Password Link -->
                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-100 hover:text-white transition-colors duration-200">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                    class="w-full py-4 px-6 bg-white text-blue-600 font-bold rounded-2xl shadow-lg hover:shadow-xl hover:bg-gray-50 transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 relative z-10">
                    Sign In
                </button>

                <!-- Register Link -->
                <div class="text-center mt-6">
                    <p class="text-sm text-blue-100">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-bold text-white hover:text-blue-50 ml-1 transition-colors duration-200">
                            Sign Up Now
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

