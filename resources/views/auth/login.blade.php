@extends('layouts.app')

@section('title', 'Login - GrowCash')

@section('content')
<div class="min-h-screen flex items-center justify-center auth-background py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="w-full max-w-md relative z-20">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo login.png') }}" alt="GrowCash Logo" class="mx-auto h-24 mb-2">
            <p class="text-sm text-gray-700 font-medium">MONEY CAN BUY THE FUTURE</p>
        </div>

        <!-- Login Form - Blue Background -->
        <div class="bg-blue-600 rounded-2xl shadow-2xl p-8 sm:p-10">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-white mb-2">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required 
                        class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all @error('email') ring-2 ring-red-500 @enderror" 
                        placeholder="Email address" value="{{ old('email') }}">
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required 
                        class="w-full px-4 py-3 border-0 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all @error('password') ring-2 ring-red-500 @enderror" 
                        placeholder="Password">
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-200">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Forgot Password Link -->
                <div class="text-left">
                    <a href="#" class="text-sm text-white hover:text-gray-200 underline">
                        Forgot Password?
                    </a>
                </div>

                <!-- Submit Button - White with Blue Text -->
                <div class="pt-2">
                    <button type="submit" 
                        class="w-full py-3.5 px-6 bg-white hover:bg-gray-100 text-blue-600 font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600">
                        Login
                    </button>
                </div>

                <!-- Register Link -->
                <div class="text-center pt-2">
                    <p class="text-sm text-white">
                        Not a member? 
                        <a href="{{ route('register') }}" class="underline hover:text-gray-200 font-medium">
                            Sign In Now
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

