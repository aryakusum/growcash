<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - GrowCash')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 min-h-screen">
    <!-- Mobile Overlay -->
    <div id="mobile-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
    
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="mobile-sidebar w-20 sm:w-24 lg:w-32 bg-blue-600 flex flex-col items-center py-6 sm:py-8 space-y-4 sm:space-y-6 flex-shrink-0 h-screen fixed lg:sticky top-0 left-0 z-50 transform lg:transform-none -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out shadow-xl">
            <!-- Logo -->
            <div class="flex items-center justify-center px-1 mb-2">
                <img src="{{ asset('images/logo navbar.png') }}" alt="GROWCASH" class="w-full max-w-[80px] sm:max-w-[90px] lg:max-w-[110px] h-auto object-contain">
            </div>

            <!-- Navigation Icons - Only for navigation, not buttons -->
            <nav class="flex flex-col justify-between flex-1 w-full items-center py-4">
                @php
                    $currentRoute = Route::currentRouteName();
                @endphp
                <!-- Home -->
                <a href="{{ route('dashboard') }}" class="sidebar-icon flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-2xl p-1 transition-[transform,background-color,box-shadow] duration-300 {{ $currentRoute === 'dashboard' ? 'bg-blue-500 shadow-inner' : 'hover:bg-blue-500 hover:shadow-lg hover:-translate-y-1' }}" title="Home">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 text-orange-500 icon-svg transition-transform duration-200 {{ $currentRoute === 'dashboard' ? 'scale-110' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                </a>

                <!-- Transactions -->
                <a href="{{ route('transaksi.index') }}" class="sidebar-icon flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-2xl p-1 transition-[transform,background-color,box-shadow] duration-300 {{ $currentRoute === 'transaksi.index' ? 'bg-blue-500 shadow-inner' : 'hover:bg-blue-500 hover:shadow-lg hover:-translate-y-1' }}" title="Transactions">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 text-green-500 icon-svg transition-transform duration-200 {{ $currentRoute === 'transaksi.index' ? 'scale-110' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </a>

                <!-- Budgeting -->
                <a href="{{ route('budgeting.index') }}" class="sidebar-icon flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-2xl p-1 transition-[transform,background-color,box-shadow] duration-300 {{ $currentRoute === 'budgeting.index' ? 'bg-blue-500 shadow-inner' : 'hover:bg-blue-500 hover:shadow-lg hover:-translate-y-1' }}" title="Budgeting">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 text-orange-500 icon-svg transition-transform duration-200 {{ $currentRoute === 'budgeting.index' ? 'scale-110' : '' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                </a>

                <!-- Goals -->
                <a href="{{ route('finance-goals.index') }}" class="sidebar-icon flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-2xl p-1 transition-[transform,background-color,box-shadow] duration-300 {{ $currentRoute === 'finance-goals.index' ? 'bg-blue-500 shadow-inner' : 'hover:bg-blue-500 hover:shadow-lg hover:-translate-y-1' }}" title="Goals">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 text-red-500 icon-svg transition-transform duration-200 {{ $currentRoute === 'finance-goals.index' ? 'scale-110' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </a>

                <!-- Reports -->
                <a href="{{ route('transaksi.laporan') }}" class="sidebar-icon flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 rounded-2xl p-1 transition-[transform,background-color,box-shadow] duration-300 {{ $currentRoute === 'transaksi.laporan' ? 'bg-blue-500 shadow-inner' : 'hover:bg-blue-500 hover:shadow-lg hover:-translate-y-1' }}" title="Reports">
                    <svg class="w-10 h-10 sm:w-12 sm:h-12 lg:w-14 lg:h-14 text-blue-300 icon-svg transition-transform duration-200 {{ $currentRoute === 'transaksi.laporan' ? 'scale-110' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col w-full lg:w-auto">
            <!-- Top Bar -->
            <header class="bg-blue-600 text-white px-6 sm:px-8 py-4 sm:py-5 flex items-center gap-4 sm:gap-6 sticky top-0 z-30 shadow-md">
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-blue-500 hover:scale-110 transition-transform duration-200" aria-label="Toggle menu">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Search Bar -->
                <div class="flex-1 sm:flex-1 sm:max-w-md">
                    <input type="text" placeholder="Search" class="block w-full px-4 sm:px-5 py-2.5 sm:py-3 border border-blue-400 rounded-xl bg-blue-500/50 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent focus:bg-blue-500 text-center text-sm sm:text-base transition-colors duration-200 shadow-inner">
                </div>

                <!-- Profile Section -->
                <div class="flex items-center space-x-1.5 sm:space-x-4">
                    <!-- Mobile Settings Toggle -->
                    <div class="relative lg:hidden">
                        <button id="mobile-settings-btn" class="topbar-icon p-1.5 rounded-lg hover:bg-blue-500 hover:scale-110 transition-transform duration-200" title="Settings">
                            <svg class="w-6 h-6 text-yellow-400 topbar-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                        <!-- Mobile Settings Dropdown -->
                        <div id="mobile-settings-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50">
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Settings</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Notifications</a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 text-sm">Profile</a>
                        </div>
                    </div>
                    <!-- Settings Icon (Yellow) - Desktop -->
                    <button type="button" class="hidden lg:block topbar-icon p-1.5 sm:p-2 lg:p-2.5 rounded-lg hover:bg-blue-500 hover:scale-110 transition-transform duration-200" title="Settings">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-yellow-400 topbar-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </button>

                    <!-- Notifications Icon - Desktop -->
                    <button type="button" class="hidden lg:block topbar-icon p-1.5 sm:p-2 lg:p-2.5 rounded-lg hover:bg-blue-500 hover:scale-110 transition-transform duration-200" title="Notifications">
                        <svg class="w-7 h-7 sm:w-8 sm:h-8 lg:w-10 lg:h-10 text-orange-500 topbar-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>

                    <!-- Profile Dropdown - Desktop -->
                    <div class="hidden lg:flex profile-dropdown items-center space-x-1.5 sm:space-x-2 cursor-pointer hover:bg-blue-500 hover:scale-105 rounded-lg px-2 sm:px-3 py-1.5 sm:py-2 transition-transform duration-200">
                        <div class="w-7 h-7 sm:w-8 sm:h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 profile-avatar">
                            <span class="text-xs sm:text-sm font-semibold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-xs sm:text-sm font-medium hidden sm:inline">Profile</span>
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 hidden sm:block profile-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>

                    <!-- Profile Avatar - Mobile -->
                    <div class="lg:hidden profile-dropdown cursor-pointer hover:bg-blue-500 hover:scale-110 rounded-lg p-1.5 transition-transform duration-200">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0 profile-avatar">
                            <span class="text-sm font-semibold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 dashboard-background p-6 sm:p-8 min-h-screen pb-20 sm:pb-24">
                @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="relative z-10 pb-8 sm:pb-12">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile Sidebar Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobile-overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            mobileOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', toggleSidebar);
        }

        if (mobileOverlay) {
            mobileOverlay.addEventListener('click', toggleSidebar);
        }

        // Mobile Settings Toggle
        const mobileSettingsBtn = document.getElementById('mobile-settings-btn');
        const mobileSettingsMenu = document.getElementById('mobile-settings-menu');

        if (mobileSettingsBtn && mobileSettingsMenu) {
            mobileSettingsBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                mobileSettingsMenu.classList.toggle('hidden');
            });

            // Close menu when clicking outside
            document.addEventListener('click', (e) => {
                if (!mobileSettingsBtn.contains(e.target) && !mobileSettingsMenu.contains(e.target)) {
                    mobileSettingsMenu.classList.add('hidden');
                }
            });
        }

        // Close sidebar when clicking on a link (mobile)
        const sidebarLinks = document.querySelectorAll('.mobile-sidebar a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 1024) {
                    toggleSidebar();
                }
            });
        });

        // Modal Functions - Ensure modals are hidden on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Hide all modals on page load
            const allModals = document.querySelectorAll('[id^="modal-"]');
            allModals.forEach(modal => {
                modal.classList.add('hidden');
                modal.style.display = 'none';
            });
        });

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('modal-overlay') || event.target.classList.contains('bg-opacity-50') || event.target.classList.contains('bg-black') || event.target.classList.contains('bg-gray-500')) {
                const modal = event.target.closest('.fixed');
                if (modal && modal.id) {
                    closeModal(modal.id);
                }
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('.modal-overlay, .fixed.bg-opacity-50, .fixed.bg-black, .fixed.bg-gray-500');
                modals.forEach(modal => {
                    if (modal.style.display !== 'none' && modal.id) {
                        closeModal(modal.id);
                    }
                });
            }
        });
    </script>
</body>
</html>

