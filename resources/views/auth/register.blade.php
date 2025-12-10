<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - GrowCash</title>
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
        <div class="w-full max-w-lg">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-flex items-center gap-2 group mb-4">
                    <img src="{{ asset('images/logo-custom.png') }}" alt="Logo" class="w-16 h-16 rounded-full shadow-lg group-hover:scale-110 transition-transform">
                    <span class="text-3xl font-display font-bold text-white tracking-tight group-hover:text-luxury-gold transition-colors">GrowCash</span>
                </a>
                <p class="text-gray-400 mt-2">Create your account and start growing your wealth</p>
            </div>

            <!-- Register Form -->
            <div class="glass-panel p-8 rounded-3xl border border-white/10">
                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-200 mb-2">Full Name</label>
                        <input id="name" name="name" type="text" required
                            class="glass-input w-full px-4 py-3 rounded-xl @error('name') ring-2 ring-red-400 @enderror"
                            placeholder="John Doe" value="{{ old('name') }}">
                        @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-gray-200 mb-2">Date of Birth</label>
                        <input id="tanggal_lahir" name="tanggal_lahir" type="date" required
                            class="glass-input w-full px-4 py-3 rounded-xl @error('tanggal_lahir') ring-2 ring-red-400 @enderror"
                            value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-200 mb-2">Email Address</label>
                        <input id="email" name="email" type="email" required
                            class="glass-input w-full px-4 py-3 rounded-xl @error('email') ring-2 ring-red-400 @enderror"
                            placeholder="your@email.com" value="{{ old('email') }}">
                        @error('email')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-200 mb-2">Phone Number</label>
                        <input id="nomor_telepon" name="nomor_telepon" type="tel" required
                            class="glass-input w-full px-4 py-3 rounded-xl @error('nomor_telepon') ring-2 ring-red-400 @enderror"
                            placeholder="+62 812 3456 7890" value="{{ old('nomor_telepon') }}">
                        @error('nomor_telepon')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-200 mb-2">Password</label>
                        <input id="password" name="password" type="password" required
                            class="glass-input w-full px-4 py-3 rounded-xl @error('password') ring-2 ring-red-400 @enderror"
                            placeholder="••••••••">

                        <!-- Password Strength -->
                        <div class="grid grid-cols-3 gap-2 mt-2">
                            <div id="strength-bar-1" class="h-1 rounded-full bg-white/10 transition-colors duration-300"></div>
                            <div id="strength-bar-2" class="h-1 rounded-full bg-white/10 transition-colors duration-300"></div>
                            <div id="strength-bar-3" class="h-1 rounded-full bg-white/10 transition-colors duration-300"></div>
                        </div>

                        <div class="mt-2 text-xs text-gray-400 space-y-1">
                            <p id="hint-length" class="flex items-center">
                                <svg class="w-3 h-3 mr-1.5 opacity-0 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Min. 8 characters
                            </p>
                            <p id="hint-letter" class="flex items-center">
                                <svg class="w-3 h-3 mr-1.5 opacity-0 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Contains a letter
                            </p>
                            <p id="hint-number" class="flex items-center">
                                <svg class="w-3 h-3 mr-1.5 opacity-0 transition-opacity" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Contains a number
                            </p>
                        </div>
                        @error('password')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-200 mb-2">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                            class="glass-input w-full px-4 py-3 rounded-xl"
                            placeholder="••••••••">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="glass-button w-full py-3.5 rounded-xl text-lg font-semibold mt-6">
                        Create Account
                    </button>

                    <!-- Login Link -->
                    <div class="text-center pt-4 border-t border-white/10">
                        <p class="text-sm text-gray-400">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-luxury-gold hover:text-yellow-400 font-semibold transition-colors">Sign In</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const hintLength = document.getElementById('hint-length');
        const hintLetter = document.getElementById('hint-letter');
        const hintNumber = document.getElementById('hint-number');
        const bar1 = document.getElementById('strength-bar-1');
        const bar2 = document.getElementById('strength-bar-2');
        const bar3 = document.getElementById('strength-bar-3');

        function updateRequirement(element, isValid) {
            const icon = element.querySelector('svg');
            if (isValid) {
                element.classList.add('text-green-400');
                icon.classList.remove('opacity-0');
            } else {
                element.classList.remove('text-green-400');
                icon.classList.add('opacity-0');
            }
        }

        function updateStrength(score) {
            [bar1, bar2, bar3].forEach(bar => bar.className = 'h-1 rounded-full bg-white/10 transition-colors duration-300');

            if (score >= 1) bar1.classList.replace('bg-white/10', 'bg-red-400');
            if (score >= 2) {
                bar1.classList.replace('bg-red-400', 'bg-yellow-400');
                bar2.classList.replace('bg-white/10', 'bg-yellow-400');
            }
            if (score >= 3) {
                bar1.classList.replace('bg-yellow-400', 'bg-green-400');
                bar2.classList.replace('bg-yellow-400', 'bg-green-400');
                bar3.classList.replace('bg-white/10', 'bg-green-400');
            }
        }

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let score = 0;

            const isLengthValid = password.length >= 8;
            updateRequirement(hintLength, isLengthValid);
            if (isLengthValid) score++;

            const isLetterValid = /[a-zA-Z]/.test(password);
            updateRequirement(hintLetter, isLetterValid);
            if (isLetterValid) score++;

            const isNumberValid = /[0-9]/.test(password);
            updateRequirement(hintNumber, isNumberValid);
            if (isNumberValid) score++;

            updateStrength(score);
        });
    </script>
</body>

</html>