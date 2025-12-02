@extends('layouts.dashboard')

@section('title', 'Financial Goals - GrowCash')

@section('content')
<div class="space-y-4 sm:space-y-5 pb-16 sm:pb-20">
    <!-- Header -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
        <div class="bg-blue-600 text-white px-4 sm:px-6 py-3 sm:py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-base sm:text-lg font-bold tracking-wide">Financial Goals</h2>
                <button onclick="openModal('modal-goal')" class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-white text-blue-600 rounded-xl hover:bg-blue-50 hover:shadow-md hover:scale-105 transition-all duration-200 text-xs sm:text-sm font-medium shadow-sm">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="hidden sm:inline">+ Add Goals</span>
                    <span class="sm:hidden">+</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Summary Cards -->
    @php
        $totalGoals = $goals->count();
        $totalTarget = $goals->sum('target');
        $totalProgress = $goals->sum('kalkulasi');
        $averageProgress = $totalGoals > 0 && $totalTarget > 0 ? ($totalProgress / $totalTarget) * 100 : 0;
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3 lg:gap-4">
        <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-4 text-center hover:shadow-md hover:border-blue-300 transition-all duration-200 cursor-pointer">
            <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-1 sm:mb-2">{{ $totalGoals }}</div>
            <div class="text-xs sm:text-sm text-gray-600">Active financial targets</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-4 text-center hover:shadow-md hover:border-blue-300 transition-all duration-200 cursor-pointer">
            <div class="text-base sm:text-lg lg:text-2xl font-bold text-gray-900 mb-1 sm:mb-2 truncate">Rp {{ number_format($totalTarget, 0, ',', '.') }}</div>
            <div class="text-xs sm:text-sm text-gray-600">Combined goal amount</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-4 text-center hover:shadow-md hover:border-blue-300 transition-all duration-200 cursor-pointer">
            <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-1 sm:mb-2">{{ number_format($averageProgress, 0) }}%</div>
            <div class="text-xs sm:text-sm text-gray-600">Overall completion</div>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-3 sm:p-4 text-center hover:shadow-md hover:border-blue-300 transition-all duration-200 cursor-pointer">
            <div class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-1 sm:mb-2">{{ $goals->where('kalkulasi', '<', 'target')->count() }}</div>
            <div class="text-xs sm:text-sm text-gray-600">Goals to complete</div>
        </div>
    </div>

    <!-- Goals List -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200">
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-sm sm:text-base font-semibold text-gray-900">Your Financial Goals</h3>
                <button onclick="openModal('modal-goal')" class="inline-flex items-center px-3 sm:px-4 py-1.5 sm:py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-md hover:scale-105 transition-all duration-200 text-xs sm:text-sm font-medium shadow-sm">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    + Add Goals
                </button>
            </div>
        </div>
        <div class="p-4 sm:p-6">
            @forelse($goals as $goal)
            @php
                $progress = $goal->target > 0 ? min(100, ($goal->kalkulasi / $goal->target) * 100) : 0;
                $isOnTrack = $progress >= 50;
            @endphp
            <div class="border border-gray-200 rounded-xl p-3 sm:p-4 mb-3 sm:mb-4 last:mb-0 hover:shadow-md hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 cursor-pointer">
                <div class="flex items-start justify-between mb-2 sm:mb-3 flex-wrap gap-2">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-xs sm:text-sm lg:text-base font-semibold text-gray-900 mb-1 truncate">{{ $goal->nama_goals }}</h3>
                        <p class="text-xs sm:text-sm text-gray-600 mb-2 break-words">Target: Rp {{ number_format($goal->target, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center space-x-2 ml-2 sm:ml-4 flex-shrink-0">
                        <button onclick="openEditGoalModal({{ $goal->id }}, '{{ addslashes($goal->nama_goals) }}', '{{ addslashes($goal->tujuan_goals) }}', {{ $goal->target }})" class="p-1.5 hover:bg-gray-100 rounded transition-all duration-200" title="Edit">
                            <svg class="w-4 h-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <form action="{{ route('finance-goals.destroy', $goal->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus goal ini?')">
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
                <div class="mb-3">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-blue-600 h-full rounded-full transition-all duration-300" style="width: {{ $progress }}%"></div>
                    </div>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-xs text-gray-600">Progress: {{ number_format($progress, 1) }}%</span>
                        <span class="text-xs font-medium {{ $isOnTrack ? 'text-orange-600' : 'text-gray-600' }}">{{ $isOnTrack ? 'On Track' : 'In Progress' }}</span>
                    </div>
                </div>
                <p class="text-xs text-gray-500">Current: Rp {{ number_format($goal->kalkulasi, 0, ',', '.') }} / Rp {{ number_format($goal->target, 0, ',', '.') }}</p>
            </div>
            @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-4 text-sm font-medium text-gray-900">Belum ada financial goal</h3>
                <p class="mt-2 text-sm text-gray-500">Mulai dengan membuat financial goal pertama Anda.</p>
                <div class="mt-6">
                    <button onclick="openModal('modal-goal')" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all duration-200 text-sm font-medium shadow-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Goal
                    </button>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

@include('finance-goals.modal-create')
@include('finance-goals.modal-edit')
@endsection
