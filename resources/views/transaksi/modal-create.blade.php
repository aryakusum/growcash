@php
    $categories = app(\App\Services\AICategorizationService::class)->getAvailableCategories();
    $budgets = \App\Models\Budgeting::where('user_id', auth()->id())->get();
    $goals = \App\Models\FinanceGoal::where('user_id', auth()->id())->get();
@endphp

<x-modal-overlay id="modal-transaksi" title="Tambah Transaksi" subtitle="Buat transaksi baru untuk mengelola arus kas Anda">
    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="kategori_transaksi" class="block text-sm font-semibold text-gray-800 mb-2.5">Kategori Transaksi</label>
            <select id="kategori_transaksi" name="jenis_pengeluaran_pemasukkan" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm cursor-pointer shadow-sm">
                <option value="pemasukkan">Arus Masuk</option>
                <option value="pengeluaran">Arus Keluar</option>
            </select>
            @error('jenis_pengeluaran_pemasukkan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nominal_transaksi" class="block text-sm font-semibold text-gray-800 mb-2.5">Nominal Transaksi</label>
            <input type="number" id="nominal_transaksi" name="nominal" required min="1"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Rp 0" value="{{ old('nominal') }}">
            @error('nominal')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-gray-800 mb-2.5">Deskripsi</label>
            <input type="text" id="deskripsi" name="deskripsi"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Contoh: Belanja, Kesehatan, dll" value="{{ old('deskripsi') }}">
            <p class="mt-1 text-xs text-gray-500">AI akan mengkategorikan secara otomatis</p>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tanggal" class="block text-sm font-semibold text-gray-800 mb-2.5">Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm cursor-pointer shadow-sm">
            @error('tanggal')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="budget_id" class="block text-sm font-semibold text-gray-800 mb-2.5">Budget (Opsional)</label>
            <select id="budget_id" name="budget_id"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm cursor-pointer shadow-sm">
                <option value="">Tidak ada</option>
                @foreach($budgets as $budget)
                    <option value="{{ $budget->id }}">{{ $budget->nama_budget }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="finance_goal_id" class="block text-sm font-semibold text-gray-800 mb-2.5">Financial Goal (Opsional)</label>
            <select id="finance_goal_id" name="finance_goal_id"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm cursor-pointer shadow-sm">
                <option value="">Tidak ada</option>
                @foreach($goals as $goal)
                    <option value="{{ $goal->id }}">{{ $goal->nama_goals }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-gray-200 mt-5">
            <button type="button" onclick="closeModal('modal-transaksi')" 
                class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm">
                Batal
            </button>
            <button type="submit" 
                class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm shadow-md">
                Tambah Transaksi
            </button>
        </div>
    </form>
</x-modal-overlay>

