@extends('layouts.app')

@section('title', 'Edit Financial Goal - GrowCash')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Financial Goal</h1>

        <div class="bg-white shadow rounded-2xl p-6">
            <form action="{{ route('finance-goals.update', $goal->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label for="nama_goals" class="block text-sm font-medium text-gray-700">Nama Goal</label>
                        <input type="text" id="nama_goals" name="nama_goals" required
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ old('nama_goals', $goal->nama_goals) }}">
                    </div>

                    <div>
                        <label for="tujuan_goals" class="block text-sm font-medium text-gray-700">Tujuan Goal</label>
                        <textarea id="tujuan_goals" name="tujuan_goals" rows="3" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('tujuan_goals', $goal->tujuan_goals) }}</textarea>
                    </div>

                    <div>
                        <label for="target" class="block text-sm font-medium text-gray-700">Target (Rp)</label>
                        <input type="number" id="target" name="target" required min="1"
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ old('target', $goal->target) }}">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('finance-goals.index') }}" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

