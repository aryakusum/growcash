@extends('layouts.app')

@section('title', 'Transaction - GrowCash')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-white mb-2">Transactions</h1>
            <p class="text-gray-400">
                @if(($period ?? '1M') === '7D') Last 7 Days
                @elseif(($period ?? '1M') === '1M') This Month
                @elseif(($period ?? '1M') === '3M') Last 3 Months
                @elseif(($period ?? '1M') === '6M') Last 6 Months
                @elseif(($period ?? '1M') === '1Y') This Year
                @else This Month @endif
            </p>
        </div>
        <button onclick="openModal('modal-transaksi')" class="glass-button px-6 py-3 rounded-xl font-semibold inline-flex items-center gap-2 group">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Add Transaction
        </button>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @php
        $totalSavings = $totalSavings ?? 0;
        $totalExpenses = $totalExpenses ?? 0;
        $totalIncome = $totalIncome ?? 0;
        @endphp

        <!-- Income -->
        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-green-500">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-green-400 px-2 py-1 rounded-full bg-green-500/10">Income</span>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">Rp {{ number_format($totalSavings, 0, ',', '.') }}</div>
            <div class="w-full bg-white/5 rounded-full h-2 mt-3">
                <div class="h-full bg-gradient-to-r from-green-500 to-emerald-400 rounded-full" style="width: 100%"></div>
            </div>
        </div>

        <!-- Expenses -->
        <div class="glass-card p-6 rounded-2xl border-l-4 border-l-red-500">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                    </svg>
                </div>
                <span class="text-xs font-medium text-red-400 px-2 py-1 rounded-full bg-red-500/10">Expense</span>
            </div>
            <div class="text-3xl font-display font-bold text-white mb-1">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</div>
            <div class="w-full bg-white/5 rounded-full h-2 mt-3">
                <div class="h-full bg-gradient-to-r from-red-500 to-rose-400 rounded-full" style="width: 100%"></div>
            </div>
        </div>

        <!-- Period Selector -->
        <div class="glass-card p-6 rounded-2xl">
            <h3 class="text-lg font-display font-bold text-white mb-4">Period</h3>
            <div class="grid grid-cols-2 gap-2">
                @foreach([
                ['7D', '7 Days'],
                ['1M', '1 Month'],
                ['3M', '3 Months'],
                ['6M', '6 Months'],
                ['1Y', '1 Year']
                ] as [$value, $label])
                <a href="{{ route('transaksi.index', ['period' => $value]) }}"
                    class="px-3 py-2 text-sm font-medium rounded-lg transition-all text-center {{ ($period ?? '1M') === $value ? 'bg-luxury-gold text-midnight-950' : 'bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white' }}">
                    {{ $label }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="glass-card rounded-3xl overflow-hidden">
        <div class="p-6 border-b border-white/10 flex justify-between items-center">
            <h3 class="text-xl font-display font-bold text-white">Transaction History</h3>
            <span class="text-sm text-gray-400">{{ $transaksis->total() }} transactions</span>
        </div>

        <div class="divide-y divide-white/5">
            @forelse($transaksis as $transaksi)
            <div class="p-5 hover:bg-white/5 transition-all duration-300 group">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4 flex-1 min-w-0">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            @if($transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan')
                            <div class="w-12 h-12 rounded-xl bg-green-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                </svg>
                            </div>
                            @else
                            <div class="w-12 h-12 rounded-xl bg-red-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                </svg>
                            </div>
                            @endif
                        </div>

                        <!-- Details -->
                        <div class="flex-1 min-w-0">
                            <h4 class="text-base font-semibold text-white truncate mb-1">
                                {{ $transaksi->deskripsi ?: 'No description' }}
                            </h4>
                            <div class="flex flex-wrap items-center gap-2 text-sm">
                                <span class="px-2 py-0.5 rounded-full bg-white/10 text-gray-300 text-xs">
                                    {{ $transaksi->kategori }}
                                </span>
                                <span class="text-gray-400">{{ $transaksi->tanggal->format('d M Y') }}</span>
                            </div>
                            @if($transaksi->budget || $transaksi->financeGoal)
                            <div class="mt-2 flex flex-wrap gap-2">
                                @if($transaksi->budget)
                                <span class="inline-flex items-center text-xs text-blue-400 bg-blue-500/10 px-2 py-1 rounded-full">
                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                    {{ $transaksi->budget->nama_budget }}
                                </span>
                                @endif
                                @if($transaksi->financeGoal)
                                <span class="inline-flex items-center text-xs text-purple-400 bg-purple-500/10 px-2 py-1 rounded-full">
                                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                    {{ $transaksi->financeGoal->nama_goals }}
                                </span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Amount & Actions -->
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <span class="block text-lg font-bold {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? 'text-green-400' : 'text-red-400' }}">
                                {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? '+' : '-' }}Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <button onclick="openEditTransaksiModal({{ $transaksi->id }}, '{{ $transaksi->jenis_pengeluaran_pemasukkan }}', {{ $transaksi->nominal }}, '{{ addslashes($transaksi->deskripsi ?? '') }}', '{{ addslashes($transaksi->kategori ?? '') }}', '{{ $transaksi->tanggal->format('Y-m-d') }}', '{{ $transaksi->budget_id }}', '{{ $transaksi->finance_goal_id }}')"
                                class="p-2 rounded-xl bg-white/5 text-gray-400 hover:text-blue-400 hover:bg-blue-500/10 transition-all">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this transaction?')">
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
                </div>
            </div>
            @empty
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">No transactions yet</h3>
                <p class="text-gray-400 mb-6">Start tracking your income and expenses now</p>
                <button onclick="openModal('modal-transaksi')" class="glass-button px-6 py-3 rounded-xl inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create First Transaction
                </button>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($transaksis->hasPages())
    <div class="mt-6">
        {{ $transaksis->links() }}
    </div>
    @endif
</div>

@include('transaksi.modal-create')
@include('transaksi.modal-edit')
@endsection