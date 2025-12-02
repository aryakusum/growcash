@extends('layouts.dashboard')

@section('title', 'Transaksi - GrowCash')

@section('content')
<div class="space-y-4 sm:space-y-5 pb-16 sm:pb-20">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
        <div class="bg-blue-600 text-white px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-base sm:text-lg font-bold tracking-wide">CASH FLOW</h2>
                <button onclick="openModal('modal-transaksi')" class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-white text-blue-600 rounded-xl hover:bg-blue-50 hover:shadow-md hover:scale-105 transition-all duration-200 text-xs sm:text-sm font-medium shadow-sm">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="hidden sm:inline">+ Add</span>
                    <span class="sm:hidden">+</span>
                </button>
            </div>
        </div>
        
        <!-- Cash Flow Summary -->
        <div class="bg-white px-4 sm:px-6 py-4 sm:py-5">
            <div class="flex items-start justify-between mb-5">
                <div class="flex items-center space-x-3">
                    <div class="w-1.5 h-14 sm:h-16 bg-blue-600 rounded-full"></div>
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                            @if(($period ?? '1M') === '7D')
                                7 Days
                            @elseif(($period ?? '1M') === '1M')
                                Last Month
                            @elseif(($period ?? '1M') === '3M')
                                3 Months
                            @elseif(($period ?? '1M') === '6M')
                                6 Months
                            @elseif(($period ?? '1M') === '1Y')
                                Last Year
                            @else
                                Last Month
                            @endif
                        </h3>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <button onclick="openModal('modal-transaksi')" class="px-3 py-1.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-md hover:scale-105 transition-all duration-200 text-xs sm:text-sm font-medium flex items-center shadow-sm">
                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="hidden sm:inline">Add</span>
                    </button>
                    <button class="p-1.5 sm:p-2 text-orange-500 hover:bg-orange-50 rounded-lg transition-all duration-200" title="Edit">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <button class="p-1.5 sm:p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200" title="Delete">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
            
            @php
                $totalSavings = $totalSavings ?? 0;
                $totalExpenses = $totalExpenses ?? 0;
                $totalIncome = $totalIncome ?? 0;
                $maxValue = max($totalSavings, $totalExpenses) ?: 1;
                $savingsPercent = $maxValue > 0 ? ($totalSavings / $maxValue) * 100 : 0;
                $expensesPercent = $maxValue > 0 ? ($totalExpenses / $maxValue) * 100 : 0;
            @endphp
            
            <!-- Total Savings -->
            <div class="mb-5">
                <div class="flex justify-between items-center mb-2.5">
                    <span class="text-sm sm:text-base font-medium text-gray-700">Total Savings</span>
                    <span class="text-base sm:text-lg font-bold text-gray-900">Rp {{ number_format($totalSavings, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-gradient-to-r from-green-50 to-emerald-50 rounded-full h-5 sm:h-6 shadow-inner overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-300"
                         style="width: {{ min($savingsPercent, 100) }}%; background: linear-gradient(90deg,#34d399,#059669);">
                    </div>
                </div>
            </div>
            
            <!-- Expenses -->
            <div class="mb-5">
                <div class="flex justify-between items-center mb-2.5">
                    <span class="text-sm sm:text-base font-medium text-gray-700">Expenses</span>
                    <span class="text-base sm:text-lg font-bold text-gray-900">Rp {{ number_format($totalExpenses, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-gradient-to-r from-red-50 via-rose-50 to-orange-50 rounded-full h-5 sm:h-6 shadow-inner overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-300"
                         style="width: {{ min($expensesPercent, 100) }}%; background: linear-gradient(90deg,#fb7185,#dc2626);">
                    </div>
                </div>
            </div>
            
            <!-- Period Selection -->
            <div class="flex flex-wrap gap-2 mt-6">
                <a href="{{ route('transaksi.index', ['period' => '7D']) }}" class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium rounded-xl transition-all duration-200 {{ ($period ?? '1M') === '7D' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    7D
                </a>
                <a href="{{ route('transaksi.index', ['period' => '1M']) }}" class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium rounded-xl transition-all duration-200 {{ ($period ?? '1M') === '1M' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    1M
                </a>
                <a href="{{ route('transaksi.index', ['period' => '3M']) }}" class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium rounded-xl transition-all duration-200 {{ ($period ?? '1M') === '3M' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    3M
                </a>
                <a href="{{ route('transaksi.index', ['period' => '6M']) }}" class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium rounded-xl transition-all duration-200 {{ ($period ?? '1M') === '6M' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    6M
                </a>
                <a href="{{ route('transaksi.index', ['period' => '1Y']) }}" class="px-3 sm:px-4 py-1.5 sm:py-2 text-xs sm:text-sm font-medium rounded-xl transition-all duration-200 {{ ($period ?? '1M') === '1Y' ? 'bg-blue-600 text-white shadow-sm' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    1Y
                </a>
            </div>
        </div>
    </div>

    <!-- Transaction List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
        <div class="p-4 sm:p-6">
            @forelse($transaksis as $transaksi)
            <div class="border-b border-gray-200 last:border-b-0 pb-3 sm:pb-4 mb-3 sm:mb-4 last:mb-0 hover:bg-gray-50 rounded-xl p-2 -mx-2 transition-all duration-200">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <div class="flex-shrink-0">
                                @if($transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan')
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm sm:text-base font-medium text-gray-900 truncate">
                                    {{ $transaksi->deskripsi ?: 'Tanpa deskripsi' }}
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">
                                    {{ $transaksi->kategori }} • {{ $transaksi->tanggal->format('d M Y') }}
                                </p>
                                @if($transaksi->budget || $transaksi->financeGoal)
                                <p class="text-xs text-gray-400 mt-1">
                                    @if($transaksi->budget) Budget: {{ $transaksi->budget->nama_budget }} @endif
                                    @if($transaksi->budget && $transaksi->financeGoal) • @endif
                                    @if($transaksi->financeGoal) Goal: {{ $transaksi->financeGoal->nama_goals }} @endif
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="ml-4 flex items-center space-x-2">
                        <div class="text-right">
                            <div class="text-sm sm:text-base font-semibold {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? '+' : '-' }}Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="flex items-center space-x-1">
                            <button onclick="openEditTransaksiModal({{ $transaksi->id }}, '{{ $transaksi->jenis_pengeluaran_pemasukkan }}', {{ $transaksi->nominal }}, '{{ addslashes($transaksi->deskripsi ?? '') }}', '{{ addslashes($transaksi->kategori ?? '') }}', '{{ $transaksi->tanggal->format('Y-m-d') }}', '{{ $transaksi->budget_id }}', '{{ $transaksi->finance_goal_id }}')" class="p-1.5 hover:bg-gray-100 rounded transition-all duration-200" title="Edit">
                                <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 hover:bg-gray-100 rounded transition-all duration-200" title="Delete">
                                    <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada transaksi</h3>
                <p class="mt-2 text-sm text-gray-500">Mulai dengan menambahkan transaksi pertama Anda.</p>
                <div class="mt-6">
                    <button onclick="openModal('modal-transaksi')" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 text-sm font-medium shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Transaksi
                    </button>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if($transaksis->hasPages())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4">
        {{ $transaksis->links() }}
    </div>
    @endif
</div>

@include('transaksi.modal-create')
@include('transaksi.modal-edit')
@endsection
