@extends('layouts.app')

@section('title', 'Verifikasi OTP - GrowCash')

@section('content')
<div class="min-h-screen flex items-center justify-center auth-background py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <div class="w-full max-w-md bg-white/95 backdrop-blur-md rounded-2xl shadow-2xl relative z-20 border border-white/30 p-8 sm:p-10">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo login.png') }}" alt="GrowCash Logo" class="mx-auto h-20 mb-3">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                Verifikasi Email
            </h2>
            <p class="text-sm text-gray-600">
                Kami telah mengirimkan kode OTP ke email Anda. Silakan masukkan kode tersebut di bawah ini.
            </p>
        </div>
        <form class="space-y-5" action="{{ route('verify-otp') }}" method="POST">
            @csrf
            <div>
                <label for="otp_code" class="block text-sm font-medium text-gray-700 mb-1.5">Kode OTP</label>
                <input id="otp_code" name="otp_code" type="text" maxlength="6" required autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-center text-2xl tracking-widest font-mono @error('otp_code') border-red-500 @enderror"
                    placeholder="000000">
                @error('otp_code')
                    <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full py-3.5 px-6 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2">
                    Verifikasi
                </button>
            </div>

            <div class="text-center">
                <form action="{{ route('resend-otp') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-500">
                        Kirim ulang kode OTP
                    </button>
                </form>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto focus and move to next input (if you want to add 6 separate inputs)
    document.getElementById('otp_code').addEventListener('input', function(e) {
        // Remove non-numeric characters
        e.target.value = e.target.value.replace(/\D/g, '');
    });
</script>
@endsection

