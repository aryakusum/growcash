@extends('layouts.dashboard')

@section('title', 'Budgeting - GrowCash')

@section('content')
<div class="space-y-4 sm:space-y-5 pb-16 sm:pb-20">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
        <div class="bg-blue-600 text-white px-4 sm:px-6 py-3 sm:py-4">
            <h2 class="text-base sm:text-lg font-bold tracking-wide">BUDGETING</h2>
        </div>
        <div class="p-4 sm:p-6 bg-gray-50">
            <h3 class="text-sm sm:text-base font-semibold text-gray-900 mb-1.5 sm:mb-2">Budget Management</h3>
            <p class="text-xs sm:text-sm text-gray-600 mb-3 sm:mb-4">Kelola anggaran keuangan Anda untuk periode mingguan, bulanan, dan tahunan</p>
            <!-- Period Tabs -->
            <div class="flex flex-wrap gap-2 sm:space-x-2">
                <button id="tab-mingguan" class="px-3 sm:px-4 py-2 bg-blue-600 text-white rounded-xl text-xs sm:text-sm font-medium transition-colors flex-1 sm:flex-none min-w-[80px]">
                    Mingguan
                </button>
                <button id="tab-bulanan" class="px-3 sm:px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 text-xs sm:text-sm font-medium transition-colors flex-1 sm:flex-none min-w-[80px]">
                    Bulanan
                </button>
                <button id="tab-tahunan" class="px-3 sm:px-4 py-2 bg-gray-200 text-gray-700 rounded-xl hover:bg-gray-300 text-xs sm:text-sm font-medium transition-colors flex-1 sm:flex-none min-w-[80px]">
                    Tahunan
                </button>
            </div>
        </div>
    </div>

    <!-- Budget Categories -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Budget Categories</h3>
                <button onclick="openModal('modal-budget')" class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-md hover:scale-105 transition-all duration-200 text-xs sm:text-sm font-medium shadow-sm">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    + Add Budget
                </button>
            </div>
        </div>
        <div class="p-4 sm:p-6">
            @forelse($budgets as $budget)
            @php
                $spent = $budget->transaksis->sum('nominal');
                $progress = $budget->nominal_budget > 0 ? min(100, ($spent / $budget->nominal_budget) * 100) : 0;
                $remaining = max(0, $budget->nominal_budget - $spent);
            @endphp
            <div class="border border-gray-200 rounded-xl p-3 sm:p-4 mb-3 sm:mb-4 last:mb-0 hover:shadow-md hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 cursor-pointer">
                <div class="flex items-center justify-between mb-2 sm:mb-3 flex-wrap gap-2">
                    <div class="flex items-center space-x-2 flex-1 min-w-0">
                        <div class="w-3 h-3 rounded-full flex-shrink-0" style="background-color: {{ $budget->warna ?? '#FF6B6B' }}"></div>
                        <span class="text-xs sm:text-sm font-medium text-gray-900 truncate">{{ $budget->nama_budget }}</span>
                    </div>
                    <div class="flex items-center space-x-1 flex-shrink-0">
                        <button onclick="openEditModal({{ $budget->id }}, '{{ addslashes($budget->nama_budget) }}', {{ $budget->nominal_budget }}, '{{ $budget->periode ?? 'bulanan' }}', '{{ $budget->warna ?? '#FF6B6B' }}')" class="p-1.5 hover:bg-gray-100 rounded transition-all duration-200" title="Edit">
                            <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <form action="{{ route('budgeting.destroy', $budget->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus budget ini?')">
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
                <div class="mb-2">
                    <span class="text-xs sm:text-sm text-gray-600">Spent</span>
                    <span class="text-xs sm:text-sm font-medium text-gray-900 ml-2 break-words">Rp {{ number_format($spent, 0, ',', '.') }} / Rp {{ number_format($budget->nominal_budget, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2 sm:h-2.5 mb-2 overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-300" style="width: {{ $progress }}%; background-color: {{ $budget->warna ?? '#FF6B6B' }}"></div>
                </div>
                <div class="flex flex-wrap justify-between gap-1 sm:gap-0 text-xs text-gray-600">
                    <span>Progress: {{ number_format($progress, 1) }}%</span>
                    <span class="break-words">Remaining: Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada budget</h3>
                <p class="mt-2 text-sm text-gray-500">Mulai dengan membuat budget pertama Anda.</p>
                <div class="mt-6">
                    <button onclick="openModal('modal-budget')" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 text-sm font-medium shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Budget
                    </button>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@include('budgeting.modal-create')
@include('budgeting.modal-edit')

<script>
// Tab switching functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabs = {
        'tab-mingguan': document.getElementById('tab-mingguan'),
        'tab-bulanan': document.getElementById('tab-bulanan'),
        'tab-tahunan': document.getElementById('tab-tahunan')
    };

    Object.keys(tabs).forEach(tabId => {
        if (tabs[tabId]) {
            tabs[tabId].addEventListener('click', function() {
                // Reset all tabs
                Object.values(tabs).forEach(tab => {
                    if (tab) {
                        tab.classList.remove('bg-blue-600', 'text-white');
                        tab.classList.add('bg-gray-200', 'text-gray-700');
                    }
                });
                // Activate clicked tab
                this.classList.remove('bg-gray-200', 'text-gray-700');
                this.classList.add('bg-blue-600', 'text-white');
            });
        }
    });
});
</script>
@endsection
