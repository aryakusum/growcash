@extends('layouts.dashboard')

@section('title', 'Transaksi - GrowCash')

@section('content')
<div class="space-y-6 pb-20">
    <!-- Header & Summary -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Summary Card -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Cash Flow</h2>
                    <p class="text-gray-500 mt-1">
                        @if(($period ?? '1M') === '7D')
                            Ringkasan 7 Hari Terakhir
                        @elseif(($period ?? '1M') === '1M')
                            Ringkasan Bulan Ini
                        @elseif(($period ?? '1M') === '3M')
                            Ringkasan 3 Bulan Terakhir
                        @elseif(($period ?? '1M') === '6M')
                            Ringkasan 6 Bulan Terakhir
                        @elseif(($period ?? '1M') === '1Y')
                            Ringkasan Tahun Ini
                        @else
                            Ringkasan Bulan Ini
                        @endif
                    </p>
                </div>
                <button onclick="openModal('modal-transaksi')" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium group">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Transaksi
                </button>
            </div>

            @php
                $totalSavings = $totalSavings ?? 0;
                $totalExpenses = $totalExpenses ?? 0;
                $totalIncome = $totalIncome ?? 0;
                $maxValue = max($totalSavings, $totalExpenses) ?: 1;
                $savingsPercent = $maxValue > 0 ? ($totalSavings / $maxValue) * 100 : 0;
                $expensesPercent = $maxValue > 0 ? ($totalExpenses / $maxValue) * 100 : 0;
            @endphp

            <div class="space-y-6">
                <!-- Savings Bar -->
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <span class="text-sm font-medium text-gray-500 block mb-1">Pemasukan</span>
                            <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalSavings, 0, ',', '.') }}</span>
                        </div>
                        <span class="text-sm font-medium text-green-600 bg-green-50 px-2.5 py-1 rounded-lg">
                            +{{ number_format($savingsPercent, 0) }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500"
                             style="width: {{ min($savingsPercent, 100) }}%; background-color: #10B981;">
                        </div>
                    </div>
                </div>

                <!-- Expenses Bar -->
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <div>
                            <span class="text-sm font-medium text-gray-500 block mb-1">Pengeluaran</span>
                            <span class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</span>
                        </div>
                        <span class="text-sm font-medium text-red-600 bg-red-50 px-2.5 py-1 rounded-lg">
                            -{{ number_format($expensesPercent, 0) }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500"
                             style="width: {{ min($expensesPercent, 100) }}%; background-color: #EF4444;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Period Selector Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8 flex flex-col justify-center">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Periode Laporan</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('transaksi.index', ['period' => '7D']) }}" 
                   class="px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 text-center border {{ ($period ?? '1M') === '7D' ? 'bg-blue-50 border-blue-200 text-blue-700 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                    7 Hari
                </a>
                <a href="{{ route('transaksi.index', ['period' => '1M']) }}" 
                   class="px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 text-center border {{ ($period ?? '1M') === '1M' ? 'bg-blue-50 border-blue-200 text-blue-700 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                    1 Bulan
                </a>
                <a href="{{ route('transaksi.index', ['period' => '3M']) }}" 
                   class="px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 text-center border {{ ($period ?? '1M') === '3M' ? 'bg-blue-50 border-blue-200 text-blue-700 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                    3 Bulan
                </a>
                <a href="{{ route('transaksi.index', ['period' => '6M']) }}" 
                   class="px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 text-center border {{ ($period ?? '1M') === '6M' ? 'bg-blue-50 border-blue-200 text-blue-700 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                    6 Bulan
                </a>
                <a href="{{ route('transaksi.index', ['period' => '1Y']) }}" 
                   class="col-span-2 px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 text-center border {{ ($period ?? '1M') === '1Y' ? 'bg-blue-50 border-blue-200 text-blue-700 shadow-sm' : 'bg-white border-gray-200 text-gray-600 hover:border-blue-300 hover:text-blue-600' }}">
                    Tahun Ini
                </a>
            </div>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-900">Riwayat Transaksi</h3>
            <span class="text-sm text-gray-500">{{ $transaksis->total() }} Transaksi</span>
        </div>
        
        <div class="divide-y divide-gray-100">
            @forelse($transaksis as $transaksi)
            <div class="p-4 sm:p-5 hover:bg-gray-50 transition-colors duration-200 group">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            @if($transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan')
                                <div class="w-12 h-12 rounded-2xl bg-green-50 flex items-center justify-center text-green-600 group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            @else
                                <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600 group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Details -->
                        <div class="min-w-0">
                            <h4 class="text-base font-semibold text-gray-900 truncate mb-0.5">
                                {{ $transaksi->deskripsi ?: 'Tanpa deskripsi' }}
                            </h4>
                            <div class="flex flex-wrap items-center gap-2 text-sm text-gray-500">
                                <span class="bg-gray-100 px-2 py-0.5 rounded text-xs font-medium text-gray-600">
                                    {{ $transaksi->kategori }}
                                </span>
                                <span>•</span>
                                <span>{{ $transaksi->tanggal->format('d M Y') }}</span>
                            </div>
                            @if($transaksi->budget || $transaksi->financeGoal)
                            <div class="mt-1.5 flex flex-wrap gap-2">
                                @if($transaksi->budget)
                                    <span class="inline-flex items-center text-xs text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">
                                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                        {{ $transaksi->budget->nama_budget }}
                                    </span>
                                @endif
                                @if($transaksi->financeGoal)
                                    <span class="inline-flex items-center text-xs text-purple-600 bg-purple-50 px-2 py-0.5 rounded-full">
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
                    <div class="flex items-center gap-4 sm:gap-6">
                        <div class="text-right">
                            <span class="block text-base sm:text-lg font-bold {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? '+' : '-' }}Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <button onclick="openEditTransaksiModal({{ $transaksi->id }}, '{{ $transaksi->jenis_pengeluaran_pemasukkan }}', {{ $transaksi->nominal }}, '{{ addslashes($transaksi->deskripsi ?? '') }}', '{{ addslashes($transaksi->kategori ?? '') }}', '{{ $transaksi->tanggal->format('Y-m-d') }}', '{{ $transaksi->budget_id }}', '{{ $transaksi->finance_goal_id }}')" 
                                    class="p-2 bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-all duration-200" title="Edit">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-all duration-200" title="Delete">
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
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Belum ada transaksi</h3>
                <p class="text-gray-500 mt-1 mb-6">Mulai catat pemasukan dan pengeluaran Anda sekarang.</p>
                <button onclick="openModal('modal-transaksi')" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Transaksi Pertama
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
