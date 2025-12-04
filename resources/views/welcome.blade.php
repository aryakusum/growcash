<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrowCash - Money Can Buy The Future</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-midnight-950 text-white font-sans antialiased overflow-x-hidden min-h-screen flex flex-col relative">

    <!-- Background Glow Effects -->
    <div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
        <!-- Large Blue Glow on Left -->
        <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] bg-accent-blue/10 rounded-full blur-[120px] animate-pulse"></div>
        <!-- Subtle Bottom Right Glow -->
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-accent-purple/5 rounded-full blur-[100px]"></div>
    </div>

    <!-- Navbar -->
    <nav class="w-full z-50 px-6 py-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 group">
                <span class="text-2xl font-display font-bold tracking-wider text-white">GROW<span class="text-luxury-gold">CASH</span></span>
            </a>
            
            <!-- Links (Desktop) -->
            <div class="hidden md:flex items-center gap-8 text-xs font-semibold tracking-widest text-gray-300">
                <a href="#" class="hover:text-white hover:text-luxury-gold transition-colors">HOME</a>
                <a href="#about-us" class="hover:text-white hover:text-luxury-gold transition-colors">ABOUT US</a>
            </div>

            <!-- CTA -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="hidden md:block px-6 py-2.5 bg-accent-blue rounded-full text-xs font-bold tracking-wide hover:bg-blue-700 transition-all shadow-[0_0_20px_rgba(3,40,238,0.4)] hover:shadow-[0_0_30px_rgba(3,40,238,0.6)]">
                        DASHBOARD
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold tracking-wide text-gray-300 hover:text-white mr-4 md:hidden">SIGN IN</a>
                    <a href="{{ route('login') }}" class="hidden md:block px-6 py-2.5 bg-accent-blue rounded-full text-xs font-bold tracking-wide hover:bg-blue-700 transition-all shadow-[0_0_20px_rgba(3,40,238,0.4)] hover:shadow-[0_0_30px_rgba(3,40,238,0.6)]">
                        SIGN IN
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Content -->
    <main class="flex-grow flex items-center justify-center relative px-6 py-12">
        <div class="max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left Text -->
            <div class="space-y-8 text-center lg:text-left z-10">
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-display font-bold leading-[1.1]">
                    Money Can Buy <br>
                    The Future
                </h1>
                <p class="text-gray-400 text-lg leading-relaxed max-w-lg mx-auto lg:mx-0">
                    GrowCash is a personal finance application designed to help individuals manage their money more effectively. It is available as a web based platform, giving users the flexibility to access and manage their finances anytime, anywhere.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" class="px-10 py-4 bg-accent-blue rounded-full font-bold text-sm tracking-widest hover:bg-blue-700 transition-all shadow-[0_0_20px_rgba(3,40,238,0.4)] hover:shadow-[0_0_30px_rgba(3,40,238,0.6)] hover:-translate-y-1 border border-white/10">
                        SIGN UP
                    </a>
                </div>
            </div>

            <!-- Right Image (Laptop Mockup) -->
            <div class="relative w-full max-w-[600px] mx-auto lg:mr-0 perspective-1000">
                <!-- Laptop Body -->
                <div class="relative bg-midnight-800 border-[12px] border-midnight-900 rounded-t-2xl shadow-2xl overflow-hidden aspect-[16/10]">
                    <!-- Screen Content -->
                    <div class="absolute inset-0 bg-midnight-900 flex flex-col">
                        <!-- Fake Browser Header -->
                        <div class="h-6 bg-midnight-950 flex items-center px-3 gap-1.5 border-b border-white/5">
                            <div class="w-2 h-2 rounded-full bg-red-500"></div>
                            <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                            <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        </div>
                        <!-- Dashboard Preview (Simplified) -->
                        <div class="flex-1 p-6 relative overflow-hidden">
                            <!-- Sidebar -->
                            <div class="absolute left-0 top-0 bottom-0 w-16 bg-midnight-950 border-r border-white/5 flex flex-col items-center py-4 gap-4">
                                <div class="w-8 h-8 rounded-lg bg-accent-blue/20"></div>
                                <div class="w-8 h-8 rounded-lg bg-white/5"></div>
                                <div class="w-8 h-8 rounded-lg bg-white/5"></div>
                            </div>
                            <!-- Main Content -->
                            <div class="ml-16 h-full flex flex-col gap-4">
                                <!-- Header -->
                                <div class="h-12 w-full flex justify-between items-center">
                                    <div class="w-32 h-6 bg-white/10 rounded"></div>
                                    <div class="w-8 h-8 rounded-full bg-luxury-gold/20"></div>
                                </div>
                                <!-- Cards -->
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="h-24 rounded-xl bg-gradient-to-br from-accent-blue/20 to-transparent border border-white/5 p-3">
                                        <div class="w-8 h-8 rounded bg-accent-blue/30 mb-2"></div>
                                        <div class="w-20 h-4 bg-white/10 rounded"></div>
                                    </div>
                                    <div class="h-24 rounded-xl bg-white/5 border border-white/5 p-3">
                                        <div class="w-8 h-8 rounded bg-luxury-gold/20 mb-2"></div>
                                        <div class="w-20 h-4 bg-white/10 rounded"></div>
                                    </div>
                                </div>
                                <!-- Chart Area -->
                                <div class="flex-1 rounded-xl bg-white/5 border border-white/5 relative overflow-hidden">
                                    <div class="absolute bottom-0 left-0 right-0 h-1/2 bg-gradient-to-t from-accent-blue/10 to-transparent"></div>
                                    <svg class="absolute bottom-0 left-0 right-0 w-full h-2/3 text-accent-blue opacity-50" viewBox="0 0 100 40" preserveAspectRatio="none">
                                        <path d="M0,40 Q20,35 40,10 T100,20 V40 H0 Z" fill="currentColor"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Laptop Base -->
                <div class="relative mx-auto bg-midnight-900 h-4 w-[120%] -ml-[10%] rounded-b-xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex justify-center">
                    <div class="w-1/3 h-2 bg-midnight-800 rounded-b-lg"></div>
                </div>
            </div>
        </div>
    </main>

    <!-- About Us Section -->
    <section id="about-us" class="py-20 px-6 bg-midnight-900/50">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-4xl font-display font-bold mb-8"><span class="text-white">About</span> <span class="text-luxury-gold">Us</span></h2>
            <p class="text-gray-400 text-lg max-w-3xl mx-auto leading-relaxed">
                GrowCash is dedicated to empowering individuals with the tools they need to achieve financial freedom. 
                Our platform combines intuitive design with powerful analytics to help you track spending, set goals, and grow your wealth.
                Whether you're just starting your financial journey or looking to optimize your portfolio, GrowCash is here to support you every step of the way.
            </p>
        </div>
    </section>

    <!-- Supported Companies -->
    <div class="w-full py-12 border-t border-white/5 bg-midnight-950/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-gray-500 text-sm mb-8 font-medium tracking-wide">Growcash has been featured on</p>
            <div class="flex flex-wrap justify-center items-start gap-12 md:gap-20">
                <!-- Finplan -->
                <div class="flex flex-col items-center gap-3 group">
                    <div class="h-16 flex items-center justify-center bg-white/20 rounded-xl px-6 py-3 transition-all hover:scale-105 border border-white/30 hover:border-luxury-gold/50 shadow-lg">
                        <img src="{{ asset('images/logos/finplan_new.png') }}" alt="Finplan" class="h-full object-contain">
                    </div>
                    <span class="text-gray-400 text-xs font-medium tracking-wider">FINPLAN</span>
                </div>
                
                <!-- Telkom University -->
                <div class="flex flex-col items-center gap-3 group">
                    <div class="h-16 flex items-center justify-center bg-white/20 rounded-xl px-6 py-3 transition-all hover:scale-105 border border-white/30 hover:border-luxury-gold/50 shadow-lg">
                        <img src="{{ asset('images/logos/telkom_university.png') }}" alt="Telkom University" class="h-full object-contain">
                    </div>
                    <span class="text-gray-400 text-xs font-medium tracking-wider">TELKOM UNIVERSITY</span>
                </div>

                <!-- Applied Science -->
                <div class="flex flex-col items-center gap-3 group">
                    <div class="h-16 flex items-center justify-center bg-white/20 rounded-xl px-6 py-3 transition-all hover:scale-105 border border-white/30 hover:border-luxury-gold/50 shadow-lg">
                        <img src="{{ asset('images/logos/applied_science_new.png') }}" alt="Applied Science" class="h-full object-contain">
                    </div>
                    <span class="text-gray-400 text-xs font-medium tracking-wider">APPLIED SCIENCE</span>
                </div>

                <!-- Notery -->
                <div class="flex flex-col items-center gap-3 group">
                    <div class="h-16 flex items-center justify-center bg-white/20 rounded-xl px-6 py-3 transition-all hover:scale-105 border border-white/30 hover:border-luxury-gold/50 shadow-lg">
                        <img src="{{ asset('images/logos/notery.png') }}" alt="Notery" class="h-full object-contain">
                    </div>
                    <span class="text-gray-400 text-xs font-medium tracking-wider">NOTERY</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
