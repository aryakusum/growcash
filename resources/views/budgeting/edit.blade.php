@extends('layouts.app')

@section('title', 'Edit Budget - GrowCash')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Budget</h1>

        <div class="bg-white shadow rounded-2xl p-6">
            <form action="{{ route('budgeting.update', $budget->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label for="nama_budget" class="block text-sm font-medium text-gray-700">Nama Budget</label>
                        <input type="text" id="nama_budget" name="nama_budget" required
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ old('nama_budget', $budget->nama_budget) }}">
                    </div>

                    <div>
                        <label for="nominal_budget" class="block text-sm font-medium text-gray-700">Nominal Budget</label>
                        <input type="number" id="nominal_budget" name="nominal_budget" required min="1"
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ old('nominal_budget', $budget->nominal_budget) }}">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('budgeting.index') }}" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
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

