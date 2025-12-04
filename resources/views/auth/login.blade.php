<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - GrowCash</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-gray-100 font-sans antialiased selection:bg-luxury-gold selection:text-midnight-950">
    
    <!-- Global Background Effects -->
    <div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-accent-purple/10 rounded-full blur-[100px] animate-float"></div>
        <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-accent-blue/10 rounded-full blur-[100px] animate-float" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-[0.03]"></div>
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 group mb-4">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-luxury-gold to-yellow-600 flex items-center justify-center text-midnight-950 font-bold text-2xl shadow-lg group-hover:scale-110 transition-transform">
                        G
                    </div>
                    <span class="text-3xl font-display font-bold text-white tracking-tight group-hover:text-luxury-gold transition-colors">GrowCash</span>
                </a>
                <p class="text-gray-400 mt-2">Welcome back! Please login to continue</p>
            </div>

            <!-- Login Form -->
            <div class="glass-panel p-8 rounded-3xl border border-white/10">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-200 mb-2">Email Address</label>
                        <input id="email" name="email" type="email" autocomplete="email" required 
                            class="glass-input w-full px-4 py-3 rounded-xl @error('email') ring-2 ring-red-400 @enderror" 
                            placeholder="your@email.com" value="{{ old('email') }}">
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-200 mb-2">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required 
                            class="glass-input w-full px-4 py-3 rounded-xl @error('password') ring-2 ring-red-400 @enderror" 
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember & Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/5 text-luxury-gold focus:ring-luxury-gold focus:ring-offset-0">
                            <span class="ml-2 text-sm text-gray-300">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-luxury-gold hover:text-yellow-400 transition-colors">Forgot password?</a>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="glass-button w-full py-3.5 rounded-xl text-lg font-semibold">
                        Sign In
                    </button>

                    <!-- Register Link -->
                    <div class="text-center pt-4 border-t border-white/10">
                        <p class="text-sm text-gray-400">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-luxury-gold hover:text-yellow-400 font-semibold transition-colors">Sign Up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
