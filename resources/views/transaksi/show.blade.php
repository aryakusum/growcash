@extends('layouts.app')

@section('title', 'Detail Transaksi - GrowCash')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Detail Transaksi</h1>
            <div class="flex space-x-3">
                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Edit
                </a>
                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')" 
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-6">
            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Jenis</dt>
                    <dd class="mt-1 text-sm text-gray-900">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($transaksi->jenis_pengeluaran_pemasukkan) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Nominal</dt>
                    <dd class="mt-1 text-lg font-semibold {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? '+' : '-' }}Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->kategori ?: 'Tidak ada kategori' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Deskripsi</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->deskripsi ?: 'Tidak ada deskripsi' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->tanggal->format('d M Y') }}</dd>
                </div>
                @if($transaksi->budget)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Budget</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->budget->nama_budget }}</dd>
                </div>
                @endif
                @if($transaksi->financeGoal)
                <div>
                    <dt class="text-sm font-medium text-gray-500">Financial Goal</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $transaksi->financeGoal->nama_goals }}</dd>
                </div>
                @endif
            </dl>
        </div>

        <div class="mt-6">
            <a href="{{ route('transaksi.index') }}" class="text-indigo-600 hover:text-indigo-500">
                ← Kembali ke daftar transaksi
            </a>
        </div>
    </div>
</div>
@endsection

