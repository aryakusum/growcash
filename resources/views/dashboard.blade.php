@extends('layouts.dashboard')

@section('title', 'Dashboard - GrowCash')

@section('content')
<div class="space-y-4 sm:space-y-6 pb-16 sm:pb-20">
    <!-- DATA TRANSAKSI Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-[transform,box-shadow] duration-300">
        <div class="bg-blue-600 text-white px-4 sm:px-6 py-3 sm:py-4">
            <h2 class="text-base sm:text-lg font-bold">DATA TRANSAKSI</h2>
        </div>
        <div class="p-6 sm:p-8 space-y-6">
            <!-- Income -->
            @php
                $incomeWidth = $totalPemasukkan > 0 && ($totalPemasukkan + $totalPengeluaran) > 0
                    ? min(100, ($totalPemasukkan / ($totalPemasukkan + $totalPengeluaran)) * 100)
                    : 0;
            @endphp
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Income</span>
                    <span class="text-sm font-semibold text-green-600">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-gradient-to-r from-green-50 to-emerald-50 rounded-full h-7 shadow-inner overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-300"
                        style="width: {{ $incomeWidth }}%; background: linear-gradient(90deg,#34d399,#059669);">
                    </div>
                </div>
            </div>

            <!-- Expenses -->
            @php
                $expenseWidth = $totalPengeluaran > 0 && ($totalPemasukkan + $totalPengeluaran) > 0
                    ? min(100, ($totalPengeluaran / ($totalPemasukkan + $totalPengeluaran)) * 100)
                    : 0;
            @endphp
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Expenses</span>
                    <span class="text-sm font-semibold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-gradient-to-r from-red-50 via-rose-50 to-orange-50 rounded-full h-7 shadow-inner overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-300"
                        style="width: {{ $expenseWidth }}%; background: linear-gradient(90deg,#fb7185,#dc2626);">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BUDGETING and GOALS Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-5 lg:gap-6">
        <!-- BUDGETING Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-[transform,box-shadow] duration-300">
            <div class="bg-blue-600 text-white px-4 sm:px-6 py-3 sm:py-4">
                <h2 class="text-base sm:text-lg font-bold">BUDGETING</h2>
            </div>
            <div class="p-6 sm:p-8 space-y-6">
                @forelse($budgets->take(3) as $budget)
                <div class="border border-gray-100 rounded-xl p-4 sm:p-5 hover:shadow-md hover:border-blue-200 transition-[transform,box-shadow,border-color] duration-300 bg-gray-50/50">
                    <div class="flex items-center justify-between mb-2 sm:mb-3">
                        <div class="flex items-center space-x-2 flex-1 min-w-0">
                            <div class="w-3 h-3 rounded-full flex-shrink-0" style="background-color: {{ $budget['warna'] }}"></div>
                            <span class="text-xs sm:text-sm font-medium text-gray-700 truncate">{{ $budget['nama_budget'] }}</span>
                        </div>
                        <div class="flex items-center space-x-1 sm:space-x-2 flex-shrink-0">
                            <button class="p-1 hover:bg-gray-100 rounded" title="Edit">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            <button class="p-1 hover:bg-gray-100 rounded" title="Delete">
                                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="mb-2">
                        <span class="text-xs sm:text-sm text-gray-600 break-words">Rp {{ number_format($budget['spent'], 0, ',', '.') }} / Rp {{ number_format($budget['nominal_budget'], 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2 sm:h-3 mb-2">
                        <div class="h-full rounded-full transition-all duration-300" style="width: {{ min(100, $budget['progress']) }}%; background-color: {{ $budget['warna'] }}"></div>
                    </div>
                    <div class="flex flex-wrap justify-between gap-1 sm:gap-0 text-xs text-gray-600">
                        <span>Progress: {{ number_format($budget['progress'], 1) }}%</span>
                        <span class="break-words">Remaining: Rp {{ number_format($budget['remaining'], 0, ',', '.') }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-500 py-8">
                    <p>Belum ada budget</p>
                    <a href="{{ route('budgeting.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Tambah Budget</a>
                </div>
                @endforelse
            </div>
        </div>

        <!-- GOALS Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-[transform,box-shadow] duration-300">
            <div class="bg-blue-600 text-white px-4 sm:px-6 py-3 sm:py-4">
                <h2 class="text-base sm:text-lg font-bold">GOALS</h2>
            </div>
            <div class="p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                    <!-- Total Goals -->
                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 text-center hover:shadow-md hover:border-blue-200 transition-[transform,box-shadow,border-color] duration-300 group">
                        <div class="text-2xl sm:text-3xl font-bold text-gray-900 mb-1 sm:mb-2">{{ $totalGoals }}</div>
                        <div class="text-xs sm:text-sm text-gray-600">Active financial targets</div>
                    </div>

                    <!-- Total Target -->
                    <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-6 text-center hover:shadow-md hover:border-blue-200 transition-[transform,box-shadow,border-color] duration-300 group">
                        <div class="text-xl sm:text-2xl font-bold text-gray-900 mb-1 sm:mb-2 truncate">Rp {{ number_format($totalTarget, 0, ',', '.') }}</div>
                        <div class="text-xs sm:text-sm text-gray-600">Combined goal amount</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LAPORAN KEUANGAN Card -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-[transform,box-shadow] duration-300">
        <div class="bg-blue-600 text-white px-4 sm:px-6 py-3 sm:py-4">
            <h2 class="text-base sm:text-lg font-bold">LAPORAN KEUANGAN</h2>
        </div>
        <div class="p-6 sm:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                <!-- Total Income -->
                <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-5 hover:shadow-lg hover:border-blue-300 hover:-translate-y-1 transition-[transform,box-shadow,border-color] duration-300 cursor-pointer group">
                    <div class="flex items-center space-x-2 sm:space-x-3 mb-2 sm:mb-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs sm:text-sm text-gray-600">Total Income</div>
                            <div class="text-base sm:text-lg font-bold text-gray-900 truncate">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Total Expenses -->
                <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-5 hover:shadow-lg hover:border-blue-300 hover:-translate-y-1 transition-[transform,box-shadow,border-color] duration-300 cursor-pointer group">
                    <div class="flex items-center space-x-2 sm:space-x-3 mb-2 sm:mb-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs sm:text-sm text-gray-600">Total Expenses</div>
                            <div class="text-base sm:text-lg font-bold text-gray-900 truncate">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Saving -->
                <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-5 hover:shadow-lg hover:border-blue-300 hover:-translate-y-1 transition-[transform,box-shadow,border-color] duration-300 cursor-pointer group">
                    <div class="flex items-center space-x-2 sm:space-x-3 mb-2 sm:mb-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs sm:text-sm text-gray-600">Saving</div>
                            <div class="text-base sm:text-lg font-bold {{ $saving >= 0 ? 'text-green-600' : 'text-red-600' }} truncate">Rp {{ number_format($saving, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Saving Rate -->
                <div class="bg-white border border-gray-100 rounded-xl p-4 sm:p-5 hover:shadow-lg hover:border-blue-300 hover:-translate-y-1 transition-[transform,box-shadow,border-color] duration-300 cursor-pointer group">
                    <div class="flex items-center space-x-2 sm:space-x-3 mb-2 sm:mb-3">
                        <div class="w-9 h-9 sm:w-10 sm:h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs sm:text-sm text-gray-600">Saving Rate</div>
                            <div class="text-base sm:text-lg font-bold text-gray-900">{{ number_format($savingRate, 1) }}%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
