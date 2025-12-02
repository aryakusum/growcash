@extends('layouts.dashboard')

@section('title', 'Budgeting - GrowCash')

@section('content')
<div class="space-y-6 pb-20">
    <!-- Header & Filter -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Budgeting</h2>
                    <p class="text-gray-500 mt-1">Kelola anggaran keuangan Anda dengan lebih baik</p>
                </div>
                <button onclick="openModal('modal-budget')" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Budget
                </button>
            </div>

            <!-- Period Tabs -->
            <div class="flex flex-wrap gap-2 bg-gray-100 p-1.5 rounded-xl w-full sm:w-auto inline-flex">
                @php
                    $currentPeriode = request('periode', 'semua');
                @endphp
                <a href="{{ route('budgeting.index', ['periode' => 'semua']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex-1 sm:flex-none text-center {{ $currentPeriode == 'semua' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-200' }}">
                    Semua
                </a>
                <a href="{{ route('budgeting.index', ['periode' => 'mingguan']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex-1 sm:flex-none text-center {{ $currentPeriode == 'mingguan' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-200' }}">
                    Mingguan
                </a>
                <a href="{{ route('budgeting.index', ['periode' => 'bulanan']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex-1 sm:flex-none text-center {{ $currentPeriode == 'bulanan' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-200' }}">
                    Bulanan
                </a>
                <a href="{{ route('budgeting.index', ['periode' => 'tahunan']) }}" 
                   class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex-1 sm:flex-none text-center {{ $currentPeriode == 'tahunan' ? 'bg-white text-blue-600 shadow-sm' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-200' }}">
                    Tahunan
                </a>
            </div>
        </div>
    </div>

    <!-- Budget Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($budgets as $budget)
        @php
            $spent = $budget->transaksis->sum('nominal');
            $progress = $budget->nominal_budget > 0 ? min(100, ($spent / $budget->nominal_budget) * 100) : 0;
            $remaining = max(0, $budget->nominal_budget - $spent);
            $isOverBudget = $spent > $budget->nominal_budget;
        @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200 group">
            <div class="flex justify-between items-start mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-sm" style="background-color: {{ $budget->warna ?? '#FF6B6B' }}">
                        {{ substr($budget->nama_budget, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $budget->nama_budget }}</h3>
                        <span class="text-xs font-medium px-2 py-0.5 rounded-full bg-gray-100 text-gray-600 capitalize">
                            {{ $budget->periode }}
                        </span>
                    </div>
                </div>
                <div class="flex gap-2">
                    <button onclick="openEditModal({{ $budget->id }}, '{{ addslashes($budget->nama_budget) }}', {{ $budget->nominal_budget }}, '{{ $budget->periode ?? 'bulanan' }}', '{{ $budget->warna ?? '#FF6B6B' }}')" 
                            class="p-2 bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-all duration-200" title="Edit Budget">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <form action="{{ route('budgeting.destroy', $budget->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus budget ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-all duration-200" title="Hapus Budget">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Terpakai</p>
                        <p class="text-lg font-bold {{ $isOverBudget ? 'text-red-600' : 'text-gray-900' }}">
                            Rp {{ number_format($spent, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500 mb-1">Total Budget</p>
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($budget->nominal_budget, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="relative w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                    <div class="absolute top-0 left-0 h-full rounded-full transition-all duration-500 {{ $isOverBudget ? 'bg-red-500' : '' }}" 
                         style="width: {{ $progress }}%; background-color: {{ $isOverBudget ? '' : ($budget->warna ?? '#FF6B6B') }}">
                    </div>
                </div>

                <div class="flex justify-between items-center text-sm">
                    <span class="font-medium {{ $isOverBudget ? 'text-red-600' : 'text-gray-600' }}">
                        {{ number_format($progress, 1) }}%
                    </span>
                    <span class="text-gray-500">
                        Sisa: <span class="font-bold text-gray-900">Rp {{ number_format($remaining, 0, ',', '.') }}</span>
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-1 md:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-16 h-16 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada budget</h3>
                <p class="text-gray-500 mb-6">Buat budget baru untuk mulai mengelola keuangan Anda dengan lebih baik.</p>
                <button onclick="openModal('modal-budget')" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium">
                    Buat Budget Pertama
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

@include('budgeting.modal-create')
@include('budgeting.modal-edit')
@endsection
