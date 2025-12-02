@extends('layouts.app')

@section('title', 'Detail Financial Goal - GrowCash')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Financial Goal</h1>
            <div class="flex space-x-3">
                <a href="{{ route('finance-goals.edit', $goal->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                    Edit
                </a>
                <form action="{{ route('finance-goals.destroy', $goal->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus goal ini?')" 
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-red-600 hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow rounded-2xl p-6 mb-6">
            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama Goal</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $goal->nama_goals }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Target</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900">Rp {{ number_format($goal->target, 0, ',', '.') }}</dd>
                </div>
                <div class="col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Tujuan Goal</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $goal->tujuan_goals }}</dd>
                </div>
            </dl>
        </div>

        <div class="bg-white shadow rounded-2xl p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Progress</h3>
            <div class="mb-4">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-600">Terkumpul</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($totalPemasukkan, 0, ',', '.') }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-4">
                    <div class="bg-indigo-600 h-4 rounded-full flex items-center justify-end pr-2" style="width: {{ min(100, $progress) }}%">
                        @if($progress > 10)
                        <span class="text-xs text-white font-medium">{{ number_format($progress, 1) }}%</span>
                        @endif
                    </div>
                </div>
                @if($progress < 10)
                <p class="text-xs text-gray-500 mt-1 text-right">Progress: {{ number_format($progress, 1) }}%</p>
                @endif
            </div>
            <div class="text-sm text-gray-600">
                <p>Sisa yang dibutuhkan: <span class="font-medium text-gray-900">Rp {{ number_format(max(0, $goal->target - $totalPemasukkan), 0, ',', '.') }}</span></p>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('finance-goals.index') }}" class="text-indigo-600 hover:text-indigo-500">
                ← Kembali ke daftar goals
            </a>
        </div>
    </div>
</div>
@endsection

