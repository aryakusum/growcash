@extends('layouts.app')

@section('title', 'Dashboard - GrowCash')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="glass-card p-8 rounded-3xl border-l-4 border-l-luxury-gold">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-display font-bold text-white mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-gray-400">Here's your financial overview for today</p>
            </div>
            <div class="hidden md:block">
                <div class="text-right">
                    <div class="text-sm text-gray-400">Current Balance</div>
                    <div class="text-3xl font-display font-bold text-gradient-gold">
                        Rp {{ number_format($saving, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Income -->
        <div class="glass-card p-6 rounded-2xl group hover:scale-105 transition-all duration-300 border border-green-500/20">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-400 px-2 py-1 rounded-full bg-green-500/10">+Income</span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</div>
            <div class="text-sm text-gray-400">Total Income</div>
        </div>

        <!-- Total Expenses -->
        <div class="glass-card p-6 rounded-2xl group hover:scale-105 transition-all duration-300 border border-red-500/20">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-red-400 px-2 py-1 rounded-full bg-red-500/10">-Expense</span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            <div class="text-sm text-gray-400">Total Expenses</div>
        </div>

        <!-- Saving Rate -->
        <div class="glass-card p-6 rounded-2xl group hover:scale-105 transition-all duration-300 border border-luxury-gold/20">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-luxury-gold/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-luxury-gold px-2 py-1 rounded-full bg-luxury-gold/10">Rate</span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">{{ number_format($savingRate, 1) }}%</div>
            <div class="text-sm text-gray-400">Saving Rate</div>
        </div>

        <!-- Active Goals -->
        <div class="glass-card p-6 rounded-2xl group hover:scale-105 transition-all duration-300 border border-blue-500/20">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-blue-400 px-2 py-1 rounded-full bg-blue-500/10">Goals</span>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">{{ $totalGoals }}</div>
            <div class="text-sm text-gray-400">Active Goals</div>
        </div>
    </div>

    <!-- Financial Literacy Recommendations -->
    @if(!empty($recommendations))
    <div class="glass-card p-6 rounded-2xl">
        <div class="flex items-center gap-2 mb-4">
            <div class="w-10 h-10 rounded-xl bg-luxury-gold/20 flex items-center justify-center">
                <svg class="w-5 h-5 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                </svg>
            </div>
            <h3 class="text-xl font-display font-bold text-white">💡 Financial Literacy Tips</h3>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @foreach($recommendations as $rec)
            <div class="p-4 rounded-xl border {{ $rec['type'] === 'critical' ? 'border-red-500/30 bg-red-500/10' : 'border-yellow-500/30 bg-yellow-500/10' }}">
                <div class="flex items-start gap-3 mb-3">
                    <div class="text-2xl">{{ $rec['type'] === 'critical' ? '🚨' : '⚠️' }}</div>
                    <div class="flex-1">
                        <div class="font-semibold {{ $rec['type'] === 'critical' ? 'text-red-400' : 'text-yellow-400' }} mb-1">
                            {{ $rec['budget'] }} - {{ $rec['percentage'] }}% Used
                        </div>
                        <div class="text-sm text-gray-300 mb-2">
                            Spent: Rp {{ number_format($rec['usage'], 0, ',', '.') }} / Rp {{ number_format($rec['limit'], 0, ',', '.') }}
                        </div>
                    </div>
                </div>
                <div class="pl-11">
                    <div class="text-sm font-medium text-white mb-2">💡 Recommended Actions:</div>
                    <ul class="space-y-1">
                        @foreach(array_slice($rec['tips'], 0, 3) as $tip)
                        <li class="text-sm text-gray-300 flex items-start gap-2">
                            <span class="text-luxury-gold mt-1">•</span>
                            <span>{{ $tip }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Transaction Overview -->
    <div class="glass-card p-8 rounded-3xl">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-display font-bold text-white">Transaction Overview</h2>
            <a href="{{ route('transaksi.index') }}" class="text-luxury-gold hover:text-yellow-400 transition-colors text-sm font-medium">View All →</a>
        </div>
        
        @php
            $incomeWidth = $totalPemasukkan > 0 && ($totalPemasukkan + $totalPengeluaran) > 0
                ? min(100, ($totalPemasukkan / ($totalPemasukkan + $totalPengeluaran)) * 100)
                : 0;
            $expenseWidth = $totalPengeluaran > 0 && ($totalPemasukkan + $totalPengeluaran) > 0
                ? min(100, ($totalPengeluaran / ($totalPemasukkan + $totalPengeluaran)) * 100)
                : 0;
        @endphp

        <div class="space-y-6">
            <!-- Income Bar -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm font-medium text-gray-300">Income</span>
                    <span class="text-sm font-semibold text-green-400">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-white/5 rounded-full h-3 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-green-500 to-emerald-400 rounded-full transition-all duration-500 shadow-[0_0_15px_rgba(34,197,94,0.5)]" 
                         style="width: {{ $incomeWidth }}%"></div>
                </div>
            </div>

            <!-- Expense Bar -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-sm font-medium text-gray-300">Expenses</span>
                    <span class="text-sm font-semibold text-red-400">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-white/5 rounded-full h-3 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-red-500 to-rose-400 rounded-full transition-all duration-500 shadow-[0_0_15px_rgba(239,68,68,0.5)]" 
                         style="width: {{ $expenseWidth }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Budget & Goals Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Budgeting -->
        <div class="glass-card p-8 rounded-3xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-display font-bold text-white">Budget Tracking</h2>
                <a href="{{ route('budgeting.index') }}" class="text-luxury-gold hover:text-yellow-400 transition-colors text-sm font-medium">Manage →</a>
            </div>
            
            <div class="space-y-4">
                @forelse($budgets->take(3) as $budget)
                <div class="bg-white/5 border border-white/10 rounded-2xl p-5 hover:bg-white/10 transition-all duration-300">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full" style="background-color: {{ $budget['warna'] }}"></div>
                            <span class="font-medium text-white">{{ $budget['nama_budget'] }}</span>
                        </div>
                        <span class="text-sm text-gray-400">{{ number_format($budget['progress'], 1) }}%</span>
                    </div>
                    <div class="mb-2">
                        <div class="text-sm text-gray-400">Rp {{ number_format($budget['spent'], 0, ',', '.') }} / Rp {{ number_format($budget['nominal_budget'], 0, ',', '.') }}</div>
                    </div>
                    <div class="w-full bg-white/5 rounded-full h-2 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500" 
                             style="width: {{ min(100, $budget['progress']) }}%; background-color: {{ $budget['warna'] }}"></div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-3">No budgets yet</div>
                    <a href="{{ route('budgeting.index') }}" class="glass-button px-6 py-2 rounded-xl text-sm inline-block">Create Budget</a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Goals -->
        <div class="glass-card p-8 rounded-3xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-display font-bold text-white">Financial Goals</h2>
                <a href="{{ route('finance-goals.index') }}" class="text-luxury-gold hover:text-yellow-400 transition-colors text-sm font-medium">View All →</a>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gradient-to-br from-luxury-gold/20 to-yellow-600/20 border border-luxury-gold/30 rounded-2xl p-6 text-center">
                    <div class="text-4xl font-display font-bold text-gradient-gold mb-2">{{ $totalGoals }}</div>
                    <div class="text-sm text-gray-300">Active Goals</div>
                </div>
                <div class="bg-gradient-to-br from-blue-500/20 to-indigo-600/20 border border-blue-500/30 rounded-2xl p-6 text-center">
                    <div class="text-2xl font-display font-bold text-blue-400 mb-2">Rp {{ number_format($totalTarget, 0, ',', '.') }}</div>
                    <div class="text-sm text-gray-300">Total Target</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
