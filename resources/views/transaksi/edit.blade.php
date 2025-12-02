@extends('layouts.app')

@section('title', 'Edit Transaksi - GrowCash')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Transaksi</h1>

        <div class="bg-white shadow rounded-2xl p-6">
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label for="jenis_pengeluaran_pemasukkan" class="block text-sm font-medium text-gray-700">Jenis</label>
                        <select id="jenis_pengeluaran_pemasukkan" name="jenis_pengeluaran_pemasukkan" required
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="pemasukkan" {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? 'selected' : '' }}>Pemasukkan</option>
                            <option value="pengeluaran" {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                        </select>
                    </div>

                    <div>
                        <label for="nominal" class="block text-sm font-medium text-gray-700">Nominal</label>
                        <input type="number" id="nominal" name="nominal" required min="1"
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ old('nominal', $transaksi->nominal) }}">
                    </div>

                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <input type="text" id="deskripsi" name="deskripsi"
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ old('deskripsi', $transaksi->deskripsi) }}">
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="kategori" name="kategori"
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Biarkan AI mengkategorikan</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ old('kategori', $transaksi->kategori) === $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" id="tanggal" name="tanggal" required
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d')) }}">
                    </div>

                    <div>
                        <label for="budget_id" class="block text-sm font-medium text-gray-700">Budget (Opsional)</label>
                        <select id="budget_id" name="budget_id"
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Tidak ada</option>
                            @foreach($budgets as $budget)
                                <option value="{{ $budget->id }}" {{ old('budget_id', $transaksi->budget_id) == $budget->id ? 'selected' : '' }}>
                                    {{ $budget->nama_budget }} - Rp {{ number_format($budget->nominal_budget, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="finance_goal_id" class="block text-sm font-medium text-gray-700">Financial Goal (Opsional)</label>
                        <select id="finance_goal_id" name="finance_goal_id"
                            class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Tidak ada</option>
                            @foreach($goals as $goal)
                                <option value="{{ $goal->id }}" {{ old('finance_goal_id', $transaksi->finance_goal_id) == $goal->id ? 'selected' : '' }}>
                                    {{ $goal->nama_goals }} - Target: Rp {{ number_format($goal->target, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('transaksi.index') }}" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
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

