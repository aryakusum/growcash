@extends('layouts.app')

@section('title', 'Financial Reports - GrowCash')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-3xl font-display font-bold text-white mb-2">Financial Reports</h1>
        <p class="text-gray-400">Comprehensive analysis of your financial performance</p>
    </div>

    <!-- Tab Navigation -->
    <div class="glass-card p-2 rounded-2xl flex gap-2">
        <button id="tab-ringkasan" onclick="switchTab('ringkasan')" class="flex-1 px-6 py-3 text-sm font-semibold rounded-xl transition-all bg-luxury-gold text-midnight-950 shadow-[0_0_15px_rgba(212,175,55,0.3)]">
            Summary
        </button>
        <button id="tab-income" onclick="switchTab('income')" class="flex-1 px-6 py-3 text-sm font-semibold rounded-xl transition-all text-gray-400 hover:text-white hover:bg-white/5">
            Income
        </button>
        <button id="tab-expenses" onclick="switchTab('expenses')" class="flex-1 px-6 py-3 text-sm font-semibold rounded-xl transition-all text-gray-400 hover:text-white hover:bg-white/5">
            Expenses
        </button>
    </div>

    @php
        $totalPemasukkan = $transaksis->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')->sum('nominal');
        $totalPengeluaran = $transaksis->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')->sum('nominal');
        $saving = $totalPemasukkan - $totalPengeluaran;
        $savingRate = $totalPemasukkan > 0 ? ($saving / $totalPemasukkan) * 100 : 0;
    @endphp

    <!-- Tab Content: Summary -->
    <div id="content-ringkasan" class="tab-content space-y-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-emerald-500 hover:bg-white/5 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center mb-4 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                    <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-sm text-gray-400 mb-1">Total Income</div>
                <div class="text-2xl font-display font-bold text-white">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</div>
            </div>

            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-rose-500 hover:bg-white/5 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-rose-500/20 flex items-center justify-center mb-4 shadow-[0_0_15px_rgba(244,63,94,0.2)]">
                    <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="text-sm text-gray-400 mb-1">Total Expenses</div>
                <div class="text-2xl font-display font-bold text-white">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>

            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-sky-500 hover:bg-white/5 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-sky-500/20 flex items-center justify-center mb-4 shadow-[0_0_15px_rgba(14,165,233,0.2)]">
                    <svg class="w-6 h-6 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="text-sm text-gray-400 mb-1">Saving</div>
                <div class="text-2xl font-display font-bold {{ $saving >= 0 ? 'text-emerald-400' : 'text-rose-400' }}">Rp {{ number_format($saving, 0, ',', '.') }}</div>
            </div>

            <div class="glass-card p-6 rounded-2xl border-l-4 border-l-luxury-gold hover:bg-white/5 transition-colors">
                <div class="w-12 h-12 rounded-xl bg-luxury-gold/20 flex items-center justify-center mb-4 shadow-[0_0_15px_rgba(212,175,55,0.2)]">
                    <svg class="w-6 h-6 text-luxury-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="text-sm text-gray-400 mb-1">Saving Rate</div>
                <div class="text-2xl font-display font-bold text-white">{{ number_format($savingRate, 1) }}%</div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Expenses by Category -->
            <div class="glass-card p-6 rounded-2xl">
                <h3 class="text-xl font-display font-bold text-white mb-6">Expenses by Category</h3>
                @php
                    $totalKategori = $byKategori->sum();
                    $categoryColors = ['#F43F5E', '#0EA5E9', '#10B981', '#F59E0B', '#8B5CF6']; // Rose, Sky, Emerald, Amber, Violet
                @endphp
                <div class="space-y-4">
                    @forelse($byKategori as $kategori => $total)
                    @php
                        $percentage = $totalKategori > 0 ? ($total / $totalKategori) * 100 : 0;
                        $color = $categoryColors[$loop->index % count($categoryColors)];
                    @endphp
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full shadow-[0_0_10px_currentColor]" style="background-color: {{ $color }}; color: {{ $color }}"></div>
                                <span class="text-sm font-medium text-white">{{ $kategori ?: 'Uncategorized' }}</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-300">{{ number_format($percentage, 1) }}%</span>
                        </div>
                        <div class="w-full bg-white/5 rounded-full h-2 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-500 shadow-[0_0_10px_currentColor]" style="width: {{ $percentage }}%; background-color: {{ $color }}; color: {{ $color }}"></div>
                        </div>
                        <div class="text-xs text-gray-400 mt-1">Rp {{ number_format($total, 0, ',', '.') }}</div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-400">No expense data</div>
                    @endforelse
                </div>
            </div>

            <!-- Monthly Trend -->
            <div class="glass-card p-6 rounded-2xl">
                <h3 class="text-xl font-display font-bold text-white mb-6">Monthly Trend</h3>
                @php
                    $sortedBulan = $byBulan->sortKeys();
                    $last3Months = $sortedBulan->take(-3);
                    $globalMax = $last3Months->reduce(function ($carry, $item) {
                        return max($carry, $item['pemasukkan'], $item['pengeluaran']);
                    }, 0);
                @endphp
                @if($last3Months->count() > 0)
                <div class="flex items-end justify-between h-48 gap-4">
                    @foreach($last3Months as $bulan => $data)
                    <div class="flex-1 flex flex-col items-center h-full">
                        <div class="w-full flex items-end justify-center gap-2 flex-1">
                            <!-- Income Bar Wrapper -->
                            <div class="flex-1 flex flex-col justify-end h-full">
                                <div class="w-full rounded-t bg-gradient-to-t from-emerald-600 to-emerald-400 transition-all hover:opacity-80 shadow-[0_0_15px_rgba(16,185,129,0.3)] relative group" 
                                     style="height: {{ $globalMax > 0 ? ($data['pemasukkan'] / $globalMax) * 100 : 0 }}%">
                                     <!-- Tooltip -->
                                     <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-midnight-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap border border-white/10 z-10">
                                        Rp {{ number_format($data['pemasukkan'], 0, ',', '.') }}
                                     </div>
                                </div>
                            </div>
                            <!-- Expense Bar Wrapper -->
                            <div class="flex-1 flex flex-col justify-end h-full">
                                <div class="w-full rounded-t bg-gradient-to-t from-rose-600 to-rose-400 transition-all hover:opacity-80 shadow-[0_0_15px_rgba(244,63,94,0.3)] relative group" 
                                     style="height: {{ $globalMax > 0 ? ($data['pengeluaran'] / $globalMax) * 100 : 0 }}%">
                                     <!-- Tooltip -->
                                     <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-midnight-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap border border-white/10 z-10">
                                        Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}
                                     </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm font-medium text-gray-300 mt-3">
                            {{ \Carbon\Carbon::parse($bulan)->format('M') }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-center gap-6 mt-6 pt-4 border-t border-white/10">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-emerald-500 rounded shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                        <span class="text-sm text-gray-400">Income</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 bg-rose-500 rounded shadow-[0_0_10px_rgba(244,63,94,0.5)]"></div>
                        <span class="text-sm text-gray-400">Expenses</span>
                    </div>
                </div>
                @else
                <div class="h-48 flex items-center justify-center text-gray-400">No monthly data</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Tab Content: Income (Hidden) -->
    <div id="content-income" class="tab-content hidden space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Income Trend -->
            <div class="glass-card p-6 rounded-2xl">
                <h3 class="text-xl font-display font-bold text-white mb-6">Monthly Income Trend</h3>
                @php
                    $maxIncome = $byBulan->max('pemasukkan') ?: 1;
                @endphp
                @if($byBulan->count() > 0)
                <div class="flex items-end justify-between h-48 gap-2">
                    @foreach($byBulan as $bulan => $data)
                    <div class="flex-1 flex flex-col items-center h-full group">
                        <div class="w-full flex items-end justify-center flex-1">
                            <div class="w-full max-w-[40px] rounded-t bg-gradient-to-t from-emerald-600 to-emerald-400 transition-all hover:opacity-80 shadow-[0_0_15px_rgba(16,185,129,0.3)] relative" 
                                 style="height: {{ ($data['pemasukkan'] / $maxIncome) * 100 }}%">
                                 <!-- Tooltip -->
                                 <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-midnight-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap border border-white/10 z-10">
                                    Rp {{ number_format($data['pemasukkan'], 0, ',', '.') }}
                                 </div>
                            </div>
                        </div>
                        <div class="text-xs font-medium text-gray-400 mt-3 rotate-0 sm:rotate-0">
                            {{ \Carbon\Carbon::parse($bulan)->format('M') }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="h-48 flex items-center justify-center text-gray-400">No income data available</div>
                @endif
            </div>

            <!-- Recent Income -->
            <div class="glass-card p-6 rounded-2xl">
                <h3 class="text-xl font-display font-bold text-white mb-6">Recent Income</h3>
                <div class="space-y-4">
                    @forelse($transaksis->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')->take(5) as $income)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-white">{{ $income->deskripsi }}</div>
                                <div class="text-xs text-gray-400">{{ $income->tanggal->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="font-bold text-emerald-400">
                            + Rp {{ number_format($income->nominal, 0, ',', '.') }}
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-400">No recent income</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content: Expenses (Hidden) -->
    <div id="content-expenses" class="tab-content hidden space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Monthly Expense Trend -->
            <div class="glass-card p-6 rounded-2xl">
                <h3 class="text-xl font-display font-bold text-white mb-6">Monthly Expense Trend</h3>
                @php
                    $maxExpense = $byBulan->max('pengeluaran') ?: 1;
                @endphp
                @if($byBulan->count() > 0)
                <div class="flex items-end justify-between h-48 gap-2">
                    @foreach($byBulan as $bulan => $data)
                    <div class="flex-1 flex flex-col items-center h-full group">
                        <div class="w-full flex items-end justify-center flex-1">
                            <div class="w-full max-w-[40px] rounded-t bg-gradient-to-t from-rose-600 to-rose-400 transition-all hover:opacity-80 shadow-[0_0_15px_rgba(244,63,94,0.3)] relative" 
                                 style="height: {{ ($data['pengeluaran'] / $maxExpense) * 100 }}%">
                                 <!-- Tooltip -->
                                 <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 hidden group-hover:block bg-midnight-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap border border-white/10 z-10">
                                    Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}
                                 </div>
                            </div>
                        </div>
                        <div class="text-xs font-medium text-gray-400 mt-3 rotate-0 sm:rotate-0">
                            {{ \Carbon\Carbon::parse($bulan)->format('M') }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="h-48 flex items-center justify-center text-gray-400">No expense data available</div>
                @endif
            </div>

            <!-- Recent Expenses -->
            <div class="glass-card p-6 rounded-2xl">
                <h3 class="text-xl font-display font-bold text-white mb-6">Recent Expenses</h3>
                <div class="space-y-4">
                    @forelse($transaksis->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')->take(5) as $expense)
                    <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 hover:bg-white/10 transition-colors border border-white/5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-rose-500/20 flex items-center justify-center text-rose-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-medium text-white">{{ $expense->deskripsi }}</div>
                                <div class="text-xs text-gray-400">{{ $expense->tanggal->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="font-bold text-rose-400">
                            - Rp {{ number_format($expense->nominal, 0, ',', '.') }}
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-400">No recent expenses</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all tabs
    document.querySelectorAll('[id^="tab-"]').forEach(tab => {
        tab.classList.remove('bg-luxury-gold', 'text-midnight-950', 'shadow-[0_0_15px_rgba(212,175,55,0.3)]');
        tab.classList.add('text-gray-400', 'hover:text-white', 'hover:bg-white/5');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Add active state to selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    if (activeTab) {
        activeTab.classList.remove('text-gray-400', 'hover:text-white', 'hover:bg-white/5');
        activeTab.classList.add('bg-luxury-gold', 'text-midnight-950', 'shadow-[0_0_15px_rgba(212,175,55,0.3)]');
    }
}
</script>
@endsection
