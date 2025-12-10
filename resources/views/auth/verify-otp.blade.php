@extends('layouts.app')

@section('title', 'Verify OTP - GrowCash')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="glass-card w-full max-w-md p-8 sm:p-10 rounded-3xl relative z-20">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo-custom.png') }}" alt="Logo" class="w-20 h-20 rounded-full shadow-lg mx-auto mb-4">
            <h2 class="text-3xl font-display font-bold text-white mb-2">
                Verify Email
            </h2>
            <p class="text-sm text-gray-400">
                We have sent an OTP code to your email. Please enter the code below.
            </p>
        </div>

        <form class="space-y-6" action="{{ route('verify-otp') }}" method="POST">
            @csrf
            <div>
                <label for="otp_code" class="block text-sm font-medium text-gray-300 mb-2">OTP Code</label>
                <input id="otp_code" name="otp_code" type="text" maxlength="6" required autofocus
                    class="glass-input w-full px-4 py-4 rounded-xl text-center text-3xl tracking-[0.5em] font-display font-bold text-luxury-gold placeholder-white/10"
                    placeholder="000000">
                @error('otp_code')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="glass-button w-full py-4 rounded-xl text-lg">
                    Verify
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <form action="{{ route('resend-otp') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-sm text-gray-400 hover:text-luxury-gold transition-colors">
                    Resend OTP Code
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('otp_code').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });
</script>
@endsection