@extends('layouts.app')

@section('title', 'Detail Budget - GrowCash')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Budget</h1>
            <div class="flex space-x-3">
                <a href="{{ route('budgeting.edit', $budget->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                    Edit
                </a>
                <form action="{{ route('budgeting.destroy', $budget->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus budget ini?')" 
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-red-600 hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow rounded-2xl p-6">
            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nama Budget</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $budget->nama_budget }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nominal Budget</dt>
                    <dd class="mt-1 text-lg font-semibold text-gray-900">Rp {{ number_format($budget->nominal_budget, 0, ',', '.') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Kalkulasi</dt>
                    <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($budget->kalkulasi, 0, ',', '.') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Dibuat</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $budget->created_at->format('d M Y H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="mt-6">
            <a href="{{ route('budgeting.index') }}" class="text-indigo-600 hover:text-indigo-500">
                ← Kembali ke daftar budget
            </a>
        </div>
    </div>
</div>
@endsection

