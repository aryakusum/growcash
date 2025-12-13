@extends('layouts.app')

@section('title', 'Budgeting - GrowCash')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-white mb-2">Budget Management</h1>
            <p class="text-gray-400">Control your spending with smart budgets</p>
        </div>
        <button onclick="openModal('modal-budget')" class="glass-button px-6 py-3 rounded-xl font-semibold inline-flex items-center gap-2 group">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Budget
        </button>
    </div>

    <!-- Period Filter -->
    <div class="glass-card p-6 rounded-2xl">
        @php
        $currentPeriode = request('periode', 'semua');
        @endphp
        <div class="flex flex-wrap gap-2">
            @foreach([
            ['semua', 'All'],
            ['mingguan', 'Weekly'],
            ['bulanan', 'Monthly'],
            ['tahunan', 'Yearly']
            ] as [$value, $label])
            <a href="{{ route('budgeting.index', ['periode' => $value]) }}"
                class="px-4 py-2 rounded-lg text-sm font-medium transition-all {{ $currentPeriode == $value ? 'bg-luxury-gold text-midnight-950' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Budget Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($budgets as $budget)
        @php
        // Gunakan metode baru yang menghitung spending dalam periode aktif saja
        $spent = $budget->getSpendingDalamPeriode();
        $progress = $budget->nominal_budget > 0 ? min(100, ($spent / $budget->nominal_budget) * 100) : 0;
        $remaining = max(0, $budget->nominal_budget - $spent);
        $isOverBudget = $spent > $budget->nominal_budget;
        @endphp
        <div class="glass-card p-6 rounded-2xl hover:scale-105 transition-all duration-300 {{ $isOverBudget ? 'border-2 border-red-500/50' : '' }}">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg" style="background-color: {{ $budget->warna ?? '#FF6B6B' }}">
                        {{ substr($budget->nama_budget, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-display font-bold text-white text-xl">{{ $budget->nama_budget }}</h3>
                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-white/10 text-gray-300 capitalize">
                            {{ $budget->periode }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button onclick="openEditModal({{ $budget->id }}, '{{ addslashes($budget->nama_budget) }}', {{ $budget->nominal_budget }}, '{{ $budget->periode ?? 'bulanan' }}', '{{ $budget->warna ?? '#FF6B6B' }}')"
                        class="p-2 rounded-xl bg-white/5 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 transition-all">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <form action="{{ route('budgeting.destroy', $budget->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this budget?')">
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

            <div class="space-y-4">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-sm text-gray-400 mb-1">Spent</p>
                        <p class="text-2xl font-bold {{ $isOverBudget ? 'text-red-400' : 'text-white' }}">
                            Rp {{ number_format($spent, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-400 mb-1">Budget</p>
                        <p class="text-xl font-bold text-white">Rp {{ number_format($budget->nominal_budget, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="relative w-full bg-white/5 rounded-full h-3 overflow-hidden">
                    <div class="absolute top-0 left-0 h-full rounded-full transition-all duration-500"
                        style="width: {{ $progress }}%; background-color: {{ $isOverBudget ? '#ef4444' : ($budget->warna ?? '#FF6B6B') }}; box-shadow: 0 0 15px {{ $isOverBudget ? 'rgba(239, 68, 68, 0.5)' : 'rgba(255, 107, 107, 0.5)' }}">
                    </div>
                </div>

                <div class="flex justify-between items-center text-sm">
                    <span class="font-medium {{ $isOverBudget ? 'text-red-400' : 'text-gray-300' }}">
                        {{ number_format($progress, 1) }}%
                    </span>
                    <span class="text-gray-400">
                        Remaining: <span class="font-bold text-white">Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                    </span>
                </div>

                @if($isOverBudget)
                <div class="mt-3 p-3 rounded-xl bg-red-500/10 border border-red-500/20">
                    <div class="flex items-center gap-2 text-red-400 text-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <span class="font-medium">Over budget!</span>
                    </div>
                </div>
                @endif

                {{-- Indikator kapan periode akan reset --}}
                <div class="mt-3 p-3 rounded-xl bg-white/5 border border-white/10">
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-2 text-gray-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Resets in</span>
                        </div>
                        <span class="font-medium text-luxury-gold">
                            {{ $budget->sisa_hari }} {{ $budget->sisa_hari == 1 ? 'day' : 'days' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-1 md:col-span-2">
            <div class="glass-card p-16 rounded-3xl text-center">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">No budgets yet</h3>
                <p class="text-gray-400 mb-6">Create your first budget to start managing your finances better</p>
                <button onclick="openModal('modal-budget')" class="glass-button px-6 py-3 rounded-xl inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create First Budget
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

@include('budgeting.modal-create')
@include('budgeting.modal-edit')
@endsection