@extends('layouts.dashboard')

@section('title', 'Financial Goals - GrowCash')

@section('content')
<div class="space-y-6 pb-20">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Financial Goals</h2>
                    <p class="text-gray-500 mt-1">Wujudkan impian finansial Anda dengan perencanaan yang tepat</p>
                </div>
                <button onclick="openModal('modal-goal')" class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium group">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Goal
                </button>
            </div>

            <!-- Summary Cards -->
            @php
                $totalGoals = $goals->count();
                $totalTarget = $goals->sum('target');
                $totalProgress = $goals->sum('kalkulasi');
                $averageProgress = $totalGoals > 0 && $totalTarget > 0 ? ($totalProgress / $totalTarget) * 100 : 0;
            @endphp
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-blue-50 rounded-2xl p-5 border border-blue-100">
                    <div class="text-blue-600 mb-2">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ $totalGoals }}</div>
                    <div class="text-sm font-medium text-gray-600">Active Goals</div>
                </div>
                
                <div class="bg-green-50 rounded-2xl p-5 border border-green-100">
                    <div class="text-green-600 mb-2">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1 truncate">Rp {{ number_format($totalTarget, 0, ',', '.') }}</div>
                    <div class="text-sm font-medium text-gray-600">Total Target</div>
                </div>

                <div class="bg-purple-50 rounded-2xl p-5 border border-purple-100">
                    <div class="text-purple-600 mb-2">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($averageProgress, 0) }}%</div>
                    <div class="text-sm font-medium text-gray-600">Overall Progress</div>
                </div>

                <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100">
                    <div class="text-orange-600 mb-2">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ $goals->where('kalkulasi', '<', 'target')->count() }}</div>
                    <div class="text-sm font-medium text-gray-600">In Progress</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Goals Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($goals as $goal)
        @php
            $progress = $goal->target > 0 ? min(100, ($goal->kalkulasi / $goal->target) * 100) : 0;
            $isOnTrack = $progress >= 50;
        @endphp
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-200 group flex flex-col h-full">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1 min-w-0 pr-4">
                    <h3 class="text-lg font-bold text-gray-900 truncate mb-1">{{ $goal->nama_goals }}</h3>
                    <p class="text-sm text-gray-500 line-clamp-2">{{ $goal->tujuan_goals ?: 'Tidak ada deskripsi' }}</p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button onclick="openEditGoalModal({{ $goal->id }}, '{{ addslashes($goal->nama_goals) }}', '{{ addslashes($goal->tujuan_goals) }}', {{ $goal->target }})" 
                            class="p-2 bg-white text-gray-400 hover:text-blue-600 hover:bg-blue-50 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-all duration-200" title="Edit Goal">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </button>
                    <form action="{{ route('finance-goals.destroy', $goal->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus goal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 bg-white text-gray-400 hover:text-red-600 hover:bg-red-50 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-all duration-200" title="Hapus Goal">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-auto space-y-4">
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-sm font-medium text-gray-500">Tercapai</span>
                        <span class="text-lg font-bold text-blue-600">Rp {{ number_format($goal->kalkulasi, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-500"
                             style="width: {{ $progress }}%; background-color: #2563EB;">
                        </div>
                    </div>
                    <div class="flex justify-between items-center mt-2 text-sm">
                        <span class="font-medium {{ $isOnTrack ? 'text-green-600' : 'text-gray-600' }}">
                            {{ number_format($progress, 1) }}%
                        </span>
                        <span class="text-gray-500">
                            Target: <span class="font-semibold text-gray-900">Rp {{ number_format($goal->target, 0, ',', '.') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-1 md:col-span-2 lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
                <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada financial goal</h3>
                <p class="text-gray-500 mb-6">Mulai rencanakan impian finansial Anda sekarang.</p>
                <button onclick="openModal('modal-goal')" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 font-medium shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Buat Goal Pertama
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

@include('finance-goals.modal-create')
@include('finance-goals.modal-edit')
@endsection
