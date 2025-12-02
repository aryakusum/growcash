@extends('layouts.dashboard')

@section('title', 'Laporan Keuangan - GrowCash')

@section('content')
<style>
    /* Smooth scrolling for mobile */
    .overflow-x-auto {
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
    }
    .overflow-x-auto::-webkit-scrollbar {
        height: 6px;
    }
    .overflow-x-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }
    .overflow-x-auto::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>
<div class="space-y-4 sm:space-y-6 pb-16 sm:pb-20">
    <!-- Header -->
    <div class="mb-4 sm:mb-6">
        <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 mb-3 sm:mb-4">Laporan Keuangan</h2>
        
        <!-- Tab Navigation -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-1 sm:p-1.5 flex gap-1 sm:gap-1.5 w-full justify-center sm:justify-center hover:shadow-md transition-all duration-200">
            <button id="tab-ringkasan" onclick="switchTab('ringkasan')" class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-white bg-blue-600 rounded-xl transition-all duration-200 hover:bg-blue-700 shadow-sm whitespace-nowrap flex-1 sm:flex-none">
                Ringkasan
            </button>
            <button id="tab-income" onclick="switchTab('income')" class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-gray-700 hover:text-gray-900 rounded-xl transition-all duration-200 hover:bg-gray-50 whitespace-nowrap flex-1 sm:flex-none">
                Income
            </button>
            <button id="tab-expenses" onclick="switchTab('expenses')" class="px-3 sm:px-5 py-2 sm:py-2.5 text-xs sm:text-sm font-semibold text-gray-700 hover:text-gray-900 rounded-xl transition-all duration-200 hover:bg-gray-50 whitespace-nowrap flex-1 sm:flex-none">
                Expenses
            </button>
        </div>
    </div>

    @php
        $totalPemasukkan = $transaksis->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')->sum('nominal');
        $totalPengeluaran = $transaksis->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')->sum('nominal');
        $saving = $totalPemasukkan - $totalPengeluaran;
        $savingRate = $totalPemasukkan > 0 ? ($saving / $totalPemasukkan) * 100 : 0;
    @endphp

    <!-- Tab Content: Ringkasan -->
    <div id="content-ringkasan" class="tab-content pb-12 sm:pb-16">
        <!-- Summary Cards -->
        <div class="flex gap-3 sm:gap-4 mb-4 sm:mb-6 overflow-x-auto pb-2 justify-center items-center">
            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; max-width: 250px; flex: 1 1 0;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Total Income</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 truncate">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; flex: 1 1 auto;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Total Expenses</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 truncate">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; flex: 1 1 auto;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Saving</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold {{ $saving >= 0 ? 'text-green-600' : 'text-red-600' }} truncate">Rp {{ number_format($saving, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; flex: 1 1 auto;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Saving Rate</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold text-gray-900">{{ number_format($savingRate, 1) }}%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5 mb-6 sm:mb-8">
            <!-- Pengeluaran per Kategori -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm sm:text-base font-semibold text-gray-900">Pengeluaran per Kategori</h3>
                </div>
                <div class="p-4 sm:p-5">
                    @php
                        $totalKategori = $byKategori->sum();
                        $categoryColors = [
                            'Makanan & Minuman' => '#FF6B6B',
                            'Transportasi' => '#45B7D1',
                            'Hiburan' => '#2ECC71',
                            'Belanja' => '#FF6B6B',
                            'Lainnya' => '#9B59B6',
                        ];
                        $defaultColors = ['#FF6B6B', '#45B7D1', '#2ECC71', '#FF6B6B', '#9B59B6'];
                    @endphp
                    <div class="space-y-2.5 sm:space-y-3">
                        @forelse($byKategori as $kategori => $total)
                        @php
                            $percentage = $totalKategori > 0 ? ($total / $totalKategori) * 100 : 0;
                            $color = $categoryColors[$kategori] ?? $defaultColors[$loop->index % count($defaultColors)];
                        @endphp
                        <div class="flex items-center justify-between py-2 sm:py-2.5">
                            <div class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
                                <div class="w-3 h-3 sm:w-4 sm:h-4 rounded-full flex-shrink-0" style="background-color: {{ $color }}"></div>
                                <span class="text-xs sm:text-sm font-medium text-gray-900 truncate">{{ $kategori ?: 'Tidak ada kategori' }}</span>
                            </div>
                            <div class="flex items-center space-x-2 sm:space-x-3 ml-2 sm:ml-4">
                                <span class="text-xs sm:text-sm font-semibold text-gray-900 whitespace-nowrap">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                <span class="text-xs sm:text-sm text-gray-500 w-12 sm:w-16 text-right whitespace-nowrap">{{ number_format($percentage, 1) }}%</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-6 sm:py-8">
                            <p class="text-xs sm:text-sm text-gray-500">Belum ada data pengeluaran</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Tren Bulanan -->
            <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                    <h3 class="text-sm sm:text-base font-semibold text-gray-900">Tren Bulanan</h3>
                </div>
                <div class="p-4 sm:p-5">
                    @php
                        $sortedBulan = $byBulan->sortKeys();
                        $last3Months = $sortedBulan->take(-3);
                        $maxValue = $last3Months->count() > 0 ? $last3Months->max(function($data) {
                            return max($data['pemasukkan'], $data['pengeluaran']);
                        }) : 1;
                        $chartHeight = 180;
                    @endphp
                    @if($last3Months->count() > 0)
                    <div class="mb-4 sm:mb-5 overflow-x-auto -mx-4 sm:-mx-5 px-4 sm:px-5" style="height: {{ $chartHeight }}px; position: relative;">
                        <div class="flex items-end justify-between h-full space-x-2 sm:space-x-4" style="height: 100%; align-items: flex-end; min-width: 300px;">
                            @foreach($last3Months as $bulan => $data)
                            @php
                                $pemasukkanPercent = $maxValue > 0 ? (($data['pemasukkan'] / $maxValue) * 100) : 0;
                                $pengeluaranPercent = $maxValue > 0 ? (($data['pengeluaran'] / $maxValue) * 100) : 0;
                                $availableHeight = $chartHeight - 40;
                                $pemasukkanPx = $data['pemasukkan'] > 0 ? max(($pemasukkanPercent / 100) * $availableHeight, 30) : 0;
                                $pengeluaranPx = $data['pengeluaran'] > 0 ? max(($pengeluaranPercent / 100) * $availableHeight, 30) : 0;
                            @endphp
                            <div class="flex-1 flex flex-col items-center min-w-0" style="height: 100%;">
                                <div class="w-full flex items-end justify-center space-x-1 sm:space-x-2" style="height: {{ $availableHeight }}px; padding-bottom: 0;">
                                    <!-- Bar Pemasukkan (Hijau) -->
                                    <div class="flex-1 flex flex-col justify-end items-center" style="max-width: 48%;">
                                        <div class="w-full rounded-t transition-all duration-300 hover:opacity-80 cursor-pointer relative group" 
                                             style="background-color: #10b981; height: {{ $pemasukkanPx }}px; min-height: {{ $data['pemasukkan'] > 0 ? '30px' : '0px' }}; display: block; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-10">
                                                Pemasukkan: Rp {{ number_format($data['pemasukkan'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Bar Pengeluaran (Merah) -->
                                    <div class="flex-1 flex flex-col justify-end items-center" style="max-width: 48%;">
                                        <div class="w-full rounded-t transition-all duration-300 hover:opacity-80 cursor-pointer relative group" 
                                             style="background-color: #ef4444; height: {{ $pengeluaranPx }}px; min-height: {{ $data['pengeluaran'] > 0 ? '30px' : '0px' }}; display: block; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-10">
                                                Pengeluaran: Rp {{ number_format($data['pengeluaran'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs sm:text-sm font-medium text-gray-700 mt-2 sm:mt-3">
                                    {{ \Carbon\Carbon::parse($bulan)->format('M') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <div class="mb-4 sm:mb-5" style="height: {{ $chartHeight }}px; display: flex; align-items: center; justify-content: center;">
                        <p class="text-xs sm:text-sm text-gray-500">Belum ada data bulanan</p>
                    </div>
                    @endif
                    <div class="flex items-center justify-center space-x-4 sm:space-x-6 pt-3 sm:pt-4 border-t border-gray-200">
                        <div class="flex items-center space-x-1.5 sm:space-x-2">
                            <div class="w-3 h-3 sm:w-4 sm:h-4 bg-green-500 rounded"></div>
                            <span class="text-xs sm:text-sm text-gray-600">Pemasukkan</span>
                        </div>
                        <div class="flex items-center space-x-1.5 sm:space-x-2">
                            <div class="w-3 h-3 sm:w-4 sm:h-4 bg-red-500 rounded"></div>
                            <span class="text-xs sm:text-sm text-gray-600">Pengeluaran</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content: Income (Hidden by default) -->
    <div id="content-income" class="tab-content hidden pb-12 sm:pb-16">
        @php
            $currentYear = date('Y');
            $allMonthsIncome = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthKey = sprintf('%04d-%02d', $currentYear, $i);
                $allMonthsIncome[$monthKey] = $byBulan->get($monthKey, ['pemasukkan' => 0, 'pengeluaran' => 0])['pemasukkan'];
            }
            $maxIncomeValue = max($allMonthsIncome) ?: 1;
        @endphp
        
        <!-- Summary Cards -->
        <div class="flex gap-3 sm:gap-4 mb-4 sm:mb-6 overflow-x-auto pb-2 justify-center items-center">
            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; max-width: 250px; flex: 1 1 0;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-green-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Total Income</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 truncate">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; flex: 1 1 auto;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Saving</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold {{ $saving >= 0 ? 'text-green-600' : 'text-red-600' }} truncate">Rp {{ number_format($saving, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; flex: 1 1 auto;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Saving Rate</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold text-gray-900">{{ number_format($savingRate, 1) }}%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Income Chart -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden mb-6 sm:mb-8">
            <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Tren Pemasukkan Bulanan</h3>
            </div>
            <div class="p-4 sm:p-5">
                @php
                    $chartHeight = 180;
                    $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                @endphp
                <div class="mb-4 sm:mb-5 overflow-x-auto -mx-4 sm:-mx-5 px-4 sm:px-5">
                    <div style="min-width: 500px; height: {{ $chartHeight }}px;">
                        <div class="flex items-end justify-between h-full space-x-0.5 sm:space-x-1">
                            @foreach($allMonthsIncome as $monthKey => $income)
                            @php
                                $monthIndex = (int)substr($monthKey, 5, 2) - 1;
                                $monthName = $monthNames[$monthIndex];
                                $barHeight = $maxIncomeValue > 0 ? (($income / $maxIncomeValue) * 100) : 0;
                                $barHeightPx = max(($barHeight / 100) * ($chartHeight - 40), $income > 0 ? 20 : 0);
                            @endphp
                            <div class="flex-1 flex flex-col items-center min-w-0" style="height: 100%;">
                                <div class="w-full flex flex-col justify-end items-center" style="height: calc(100% - 25px);">
                                    <div class="w-full rounded-t transition-all duration-300 hover:opacity-80 cursor-pointer relative group" 
                                         style="background-color: #10b981; height: {{ $barHeightPx }}px; min-height: {{ $income > 0 ? '20px' : '0px' }}; display: block; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-10">
                                            {{ $monthName }}: Rp {{ number_format($income, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs font-medium text-gray-700 mt-2">
                                    {{ $monthName }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Content: Expenses (Hidden by default) -->
    <div id="content-expenses" class="tab-content hidden pb-12 sm:pb-16">
        @php
            $currentYear = date('Y');
            $allMonthsExpenses = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthKey = sprintf('%04d-%02d', $currentYear, $i);
                $allMonthsExpenses[$monthKey] = $byBulan->get($monthKey, ['pemasukkan' => 0, 'pengeluaran' => 0])['pengeluaran'];
            }
            $maxExpenseValue = max($allMonthsExpenses) ?: 1;
        @endphp
        
        <!-- Summary Cards -->
        <div class="flex gap-3 sm:gap-4 mb-4 sm:mb-6 overflow-x-auto pb-2 justify-center items-center">
            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; max-width: 250px; flex: 1 1 0;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-red-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Total Expenses</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold text-gray-900 truncate">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; flex: 1 1 auto;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Saving</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold {{ $saving >= 0 ? 'text-green-600' : 'text-red-600' }} truncate">Rp {{ number_format($saving, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm flex-shrink-0" style="min-width: 180px; flex: 1 1 auto;">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-orange-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 sm:w-8 sm:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-xs text-gray-600 mb-0.5 sm:mb-1">Saving Rate</div>
                        <div class="text-sm sm:text-base lg:text-lg font-bold text-gray-900">{{ number_format($savingRate, 1) }}%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Expenses Chart -->
        <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden mb-6 sm:mb-8">
            <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Tren Pengeluaran Bulanan</h3>
            </div>
            <div class="p-4 sm:p-5">
                @php
                    $chartHeight = 180;
                    $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Juni', 'Juli', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
                @endphp
                <div class="mb-4 sm:mb-5 overflow-x-auto -mx-4 sm:-mx-5 px-4 sm:px-5">
                    <div style="min-width: 500px; height: {{ $chartHeight }}px;">
                        <div class="flex items-end justify-between h-full space-x-0.5 sm:space-x-1">
                            @foreach($allMonthsExpenses as $monthKey => $expense)
                            @php
                                $monthIndex = (int)substr($monthKey, 5, 2) - 1;
                                $monthName = $monthNames[$monthIndex];
                                $barHeight = $maxExpenseValue > 0 ? (($expense / $maxExpenseValue) * 100) : 0;
                                $barHeightPx = max(($barHeight / 100) * ($chartHeight - 40), $expense > 0 ? 20 : 0);
                            @endphp
                            <div class="flex-1 flex flex-col items-center min-w-0" style="height: 100%;">
                                <div class="w-full flex flex-col justify-end items-center" style="height: calc(100% - 25px);">
                                    <div class="w-full rounded-t transition-all duration-300 hover:opacity-80 cursor-pointer relative group" 
                                         style="background-color: #ef4444; height: {{ $barHeightPx }}px; min-height: {{ $expense > 0 ? '20px' : '0px' }}; display: block; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block bg-gray-900 text-white text-xs rounded px-2 py-1 whitespace-nowrap z-10">
                                            {{ $monthName }}: Rp {{ number_format($expense, 0, ',', '.') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-xs font-medium text-gray-700 mt-2">
                                    {{ $monthName }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
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
        tab.classList.remove('bg-blue-600', 'text-white', 'shadow-sm');
        tab.classList.add('text-gray-700', 'hover:text-gray-900');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Add active state to selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    if (activeTab) {
        activeTab.classList.remove('text-gray-700', 'hover:text-gray-900');
        activeTab.classList.add('bg-blue-600', 'text-white', 'shadow-sm');
    }
}
</script>
@endsection
