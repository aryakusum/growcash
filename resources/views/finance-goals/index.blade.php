@extends('layouts.app')

@section('title', 'Financial Goals - GrowCash')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-white mb-2">Financial Goals</h1>
            <p class="text-gray-400">Plan and achieve your financial dreams</p>
        </div>
        <button onclick="openModal('modal-goal')" class="glass-button px-6 py-3 rounded-xl font-semibold inline-flex items-center gap-2 group">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Goal
        </button>
    </div>

    <!-- Summary Stats -->
    @php
        $totalGoals = $goals->count();
        $totalTarget = $goals->sum('target');
        $totalProgress = $goals->sum('kalkulasi');
        $averageProgress = $totalGoals > 0 && $totalTarget > 0 ? ($totalProgress / $totalTarget) * 100 : 0;
    @endphp

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-blue-500">
            <div class="w-12 h-12 rounded-xl bg-blue-500/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">{{ $totalGoals }}</div>
            <div class="text-sm text-gray-400">Active Goals</div>
        </div>

        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-green-500">
            <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="text-2xl font-display font-bold text-white mb-1">Rp {{ number_format($totalTarget, 0, ',', '.') }}</div>
            <div class="text-sm text-gray-400">Total Target</div>
        </div>

        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-purple-500">
            <div class="w-12 h-12 rounded-xl bg-purple-500/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">{{ number_format($averageProgress, 0) }}%</div>
            <div class="text-sm text-gray-400">Overall Progress</div>
        </div>

        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-luxury-gold">
            <div class="w-12 h-12 rounded-xl bg-luxury-gold/20 flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-luxury-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">{{ $goals->where('kalkulasi', '<', 'target')->count() }}</div>
            <div class="text-sm text-gray-400">In Progress</div>
        </div>
    </div>

    <!-- Goals Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($goals as $goal)
        @php
            $progress = $goal->target > 0 ? min(100, ($goal->kalkulasi / $goal->target) * 100) : 0;
            $isOnTrack = $progress >= 50;
        @endphp
        <div class="glass-card p-6 rounded-2xl hover:scale-105 transition-all duration-300 flex flex-col h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1 min-w-0 pr-4">
                    <h3 class="text-xl font-display font-bold text-white truncate mb-2">{{ $goal->nama_goals }}</h3>
                    <p class="text-sm text-gray-400 line-clamp-2">{{ $goal->tujuan_goals ?: 'No description' }}</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button onclick="openEditGoalModal({{ $goal->id }}, '{{ addslashes($goal->nama_goals) }}', '{{ addslashes($goal->tujuan_goals) }}', {{ $goal->target }})" 
                            class="p-2 rounded-xl bg-white/5 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <form action="{{ route('finance-goals.destroy', $goal->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this goal?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 rounded-xl bg-white/5 text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-auto space-y-4">
                <div>
                    <div class="flex justify-between items-end mb-3">
                        <span class="text-sm font-medium text-gray-400">Achieved</span>
                        <span class="text-xl font-bold text-gradient-gold">Rp {{ number_format($goal->kalkulasi, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-white/5 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500 bg-gradient-to-r from-luxury-gold to-yellow-600 shadow-[0_0_15px_rgba(212,175,55,0.5)]"
                             style="width: {{ $progress }}%">
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-3 text-sm">
                        <span class="font-medium {{ $isOnTrack ? 'text-green-400' : 'text-gray-400' }}">
                            {{ number_format($progress, 1) }}%
                        </span>
                        <span class="text-gray-400">
                            Target: <span class="font-semibold text-white">Rp {{ number_format($goal->target, 0, ',', '.') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-1 md:col-span-2 lg:col-span-3">
            <div class="glass-card p-16 rounded-3xl text-center">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">No financial goals yet</h3>
                <p class="text-gray-400 mb-6">Start planning your financial dreams now</p>
                <button onclick="openModal('modal-goal')" class="glass-button px-6 py-3 rounded-xl inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create First Goal
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

@include('finance-goals.modal-create')
@include('finance-goals.modal-edit')
@endsection
