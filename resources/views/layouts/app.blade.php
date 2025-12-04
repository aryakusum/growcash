<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GrowCash - Premium Finance')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-gray-100 font-sans antialiased selection:bg-luxury-gold selection:text-midnight-950 overflow-x-hidden">
    
    <!-- Global Background Effects -->
    <div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-accent-purple/10 rounded-full blur-[100px] animate-float"></div>
        <div class="absolute bottom-0 right-1/4 w-[500px] h-[500px] bg-accent-blue/10 rounded-full blur-[100px] animate-float" style="animation-delay: -3s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full h-full bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-[0.03]"></div>
    </div>

    @auth
    <!-- Floating Glass Navigation -->
    <nav class="fixed top-4 left-4 right-4 z-50 glass-panel rounded-2xl transition-all duration-300 border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center relative">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-luxury-gold to-yellow-600 flex items-center justify-center text-midnight-950 font-bold text-xl shadow-lg group-hover:scale-110 transition-transform">
                            G
                        </div>
                        <span class="text-2xl font-display font-bold text-white tracking-tight group-hover:text-luxury-gold transition-colors">GrowCash</span>
                    </a>
                </div>

                <!-- Desktop Menu (Centered) -->
                <div class="hidden md:flex flex-1 justify-center space-x-1">
                    @foreach([
                        ['route' => 'dashboard', 'label' => 'Dashboard'],
                        ['route' => 'transaksi.index', 'label' => 'Transaction'],
                        ['route' => 'budgeting.index', 'label' => 'Budgeting'],
                        ['route' => 'finance-goals.index', 'label' => 'Goals'],
                        ['route' => 'transaksi.laporan', 'label' => 'Laporan'],
                    ] as $item)
                        <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}" 
                           class="{{ request()->routeIs($item['route'].'*') ? 'bg-white/10 text-luxury-gold shadow-[0_0_15px_rgba(212,175,55,0.2)]' : 'text-gray-400 hover:text-white hover:bg-white/5' }} 
                                  px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 relative overflow-hidden group">
                            {{ $item['label'] }}
                            @if(request()->routeIs($item['route'].'*'))
                                <div class="absolute bottom-0 left-0 w-full h-0.5 bg-luxury-gold shadow-[0_0_10px_#d4af37]"></div>
                            @endif
                        </a>
                    @endforeach
                </div>

                <!-- User Profile & Actions (Right Aligned) -->
                <div class="hidden md:flex items-center gap-4 ml-auto">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-xl text-gray-400 hover:text-luxury-gold hover:bg-white/5 transition-all duration-300" title="Toggle Theme">
                        <svg id="theme-icon-dark" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg id="theme-icon-light" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </button>
                    
                    <!-- Notifications Bell -->
                    @php
                        $unreadCount = Auth::user()->notifications()->where('is_read', false)->count();
                        $notifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->take(5)->get();
                    @endphp
                    <button id="notifications-toggle" class="p-2 rounded-xl text-gray-400 hover:text-luxury-gold hover:bg-white/5 transition-all duration-300 relative" title="Notifications">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        @if($unreadCount > 0)
                        <span class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                        @endif
                    </button>
                    
                    <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3 py-1.5 rounded-xl bg-white/5 border border-white/5 hover:border-luxury-gold/30 hover:bg-white/10 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-accent-purple to-accent-blue flex items-center justify-center text-xs font-bold shadow-inner">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium text-gray-200">{{ Auth::user()->name }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 rounded-xl text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-all duration-300" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>
                </div>

                <!-- Mobile Menu Button (Right Aligned on Mobile) -->
                <div class="md:hidden flex items-center ml-auto">
                    <button type="button" class="mobile-menu-button p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/10 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Shared Notifications Dropdown (Outside hidden container) -->
            <div id="notifications-dropdown" class="hidden absolute right-4 top-20 w-80 glass-panel rounded-2xl shadow-2xl z-50 max-h-96 overflow-y-auto transform transition-all duration-200 origin-top-right">
                <div class="p-4 border-b border-white/10 flex items-center justify-between">
                    <h3 class="font-semibold text-white">Notifications</h3>
                    @if($unreadCount > 0)
                    <form action="{{ route('notifications.readAll') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-xs text-luxury-gold hover:text-yellow-400 transition-colors">
                            Mark all as read
                        </button>
                    </form>
                    @endif
                </div>
                @forelse($notifications as $notif)
                <form action="{{ route('notifications.read', $notif->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left p-4 border-b border-white/5 hover:bg-white/5 transition-colors {{ $notif->is_read ? 'opacity-60' : '' }}">
                        <div class="flex items-start gap-3">
                            <div class="flex-1">
                                <div class="font-medium text-white text-sm">{{ $notif->title }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $notif->message }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $notif->created_at->diffForHumans() }}</div>
                            </div>
                            @if(!$notif->is_read)
                            <div class="w-2 h-2 bg-luxury-gold rounded-full flex-shrink-0 mt-1"></div>
                            @endif
                        </div>
                    </button>
                </form>
                @empty
                <div class="p-8 text-center text-gray-400">
                    No notifications yet
                </div>
                @endforelse
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden mobile-menu hidden border-t border-white/5 bg-midnight-900/95 backdrop-blur-xl rounded-b-2xl">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @foreach([
                    ['route' => 'dashboard', 'label' => 'Dashboard'],
                    ['route' => 'transaksi.index', 'label' => 'Transaksi'],
                    ['route' => 'budgeting.index', 'label' => 'Budgeting'],
                    ['route' => 'finance-goals.index', 'label' => 'Goals'],
                    ['route' => 'transaksi.laporan', 'label' => 'Laporan'],
                ] as $item)
                    <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}" 
                       class="{{ request()->routeIs($item['route'].'*') ? 'bg-luxury-gold/10 text-luxury-gold border-l-2 border-luxury-gold' : 'text-gray-400 hover:bg-white/5 hover:text-white' }} 
                              block px-3 py-2 rounded-r-lg text-base font-medium transition-colors">
                        {{ $item['label'] }}
                    </a>
                @endforeach
                
                <div class="border-t border-white/5 my-2"></div>
                
                <!-- Mobile Profile Link -->
                <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-accent-purple to-accent-blue flex items-center justify-center text-xs font-bold shadow-inner text-white">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <span>My Profile</span>
                </a>

                <!-- Mobile Notifications Link -->
                <button id="mobile-notifications-toggle" class="w-full flex items-center gap-3 px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <span>Notifications</span>
                    @if($unreadCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $unreadCount }}
                    </span>
                    @endif
                </button>

                <!-- Mobile Theme Toggle -->
                <button id="mobile-theme-toggle" class="w-full flex items-center gap-3 px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white rounded-lg transition-colors">
                    <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center">
                        <svg id="mobile-theme-icon-dark" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                        <svg id="mobile-theme-icon-light" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <span id="mobile-theme-text">Switch Theme</span>
                </button>

                <div class="border-t border-white/5 my-2"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-base font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-lg transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
    @endauth

    <!-- Main Content -->
    <main class="pt-28 pb-12 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-[calc(100vh-4rem)]">
        <!-- Toast Notifications -->
        @if(session('success'))
        <div class="mb-6 animate-float" style="animation-duration: 3s;">
            <div class="glass-panel border-l-4 border-l-green-500 text-green-400 px-6 py-4 rounded-xl flex items-center shadow-lg shadow-green-900/20">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 animate-float" style="animation-duration: 3s;">
            <div class="glass-panel border-l-4 border-l-red-500 text-red-400 px-6 py-4 rounded-xl flex items-center shadow-lg shadow-red-900/20">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.querySelector('.mobile-menu');
            menu.classList.toggle('hidden');
            // Add slide animation logic here if needed
        });

        // Add scroll effect to nav
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 20) {
                nav?.classList.add('shadow-2xl', 'bg-midnight-900/80');
            } else {
                nav?.classList.remove('shadow-2xl', 'bg-midnight-900/80');
            }
        });

        // Modal functions
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'flex';
                setTimeout(() => {
                    modal.classList.remove('hidden');
                    const content = modal.querySelector('.modal-content');
                    if (content) {
                        content.style.opacity = '1';
                        content.style.transform = 'translateY(0) scale(1)';
                    }
                }, 10);
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                const content = modal.querySelector('.modal-content');
                if (content) {
                    content.style.opacity = '0';
                    content.style.transform = 'translateY(30px) scale(0.9)';
                }
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }, 300);
            }
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="modal-"]').forEach(modal => {
                    if (!modal.classList.contains('hidden')) {
                        closeModal(modal.id);
                    }
                });
            }
        });

        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const iconDark = document.getElementById('theme-icon-dark');
        const iconLight = document.getElementById('theme-icon-light');
        
        // Load saved theme or default to dark
        const currentTheme = localStorage.getItem('theme') || 'dark';
        if (currentTheme === 'light') {
            document.documentElement.classList.add('light');
            iconDark.classList.remove('hidden');
            iconLight.classList.add('hidden');
        }

        // Toggle theme on button click
        themeToggle?.addEventListener('click', function() {
            const isLight = document.documentElement.classList.toggle('light');
            
            if (isLight) {
                localStorage.setItem('theme', 'light');
                iconDark.classList.remove('hidden');
                iconLight.classList.add('hidden');
            } else {
                localStorage.setItem('theme', 'dark');
                iconDark.classList.add('hidden');
                iconLight.classList.remove('hidden');
            }
        });

        // Notifications Toggle
        const notificationsToggle = document.getElementById('notifications-toggle');
        const notificationsDropdown = document.getElementById('notifications-dropdown');
        
        notificationsToggle?.addEventListener('click', function(e) {
            e.stopPropagation();
            notificationsDropdown.classList.toggle('hidden');
        });

        // Mobile Theme Toggle
        const mobileThemeToggle = document.getElementById('mobile-theme-toggle');
        const mobileIconDark = document.getElementById('mobile-theme-icon-dark');
        const mobileIconLight = document.getElementById('mobile-theme-icon-light');
        const mobileThemeText = document.getElementById('mobile-theme-text');

        function updateMobileThemeIcons(isLight) {
            if (isLight) {
                mobileIconDark?.classList.remove('hidden');
                mobileIconLight?.classList.add('hidden');
                if(mobileThemeText) mobileThemeText.textContent = 'Switch to Dark Mode';
            } else {
                mobileIconDark?.classList.add('hidden');
                mobileIconLight?.classList.remove('hidden');
                if(mobileThemeText) mobileThemeText.textContent = 'Switch to Light Mode';
            }
        }

        // Initialize mobile icons
        updateMobileThemeIcons(currentTheme === 'light');

        mobileThemeToggle?.addEventListener('click', function() {
            const isLight = document.documentElement.classList.toggle('light');
            
            if (isLight) {
                localStorage.setItem('theme', 'light');
                iconDark.classList.remove('hidden');
                iconLight.classList.add('hidden');
            } else {
                localStorage.setItem('theme', 'dark');
                iconDark.classList.add('hidden');
                iconLight.classList.remove('hidden');
            }
            updateMobileThemeIcons(isLight);
        });

        // Mobile Notifications Toggle
        const mobileNotificationsToggle = document.getElementById('mobile-notifications-toggle');
        
        mobileNotificationsToggle?.addEventListener('click', function(e) {
            e.stopPropagation();
            // Toggle the desktop dropdown but position it for mobile
            notificationsDropdown.classList.toggle('hidden');
            
            // Adjust positioning for mobile
            if (window.innerWidth < 768) {
                notificationsDropdown.style.position = 'fixed';
                notificationsDropdown.style.top = '80px';
                notificationsDropdown.style.left = '50%';
                notificationsDropdown.style.transform = 'translateX(-50%)';
                notificationsDropdown.style.width = '90%';
                notificationsDropdown.style.maxWidth = '350px';
            } else {
                notificationsDropdown.style.position = '';
                notificationsDropdown.style.top = '';
                notificationsDropdown.style.left = '';
                notificationsDropdown.style.transform = '';
                notificationsDropdown.style.width = '';
            }
        });
    </script>
</body>
</html>
