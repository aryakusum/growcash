<x-modal-overlay id="modal-goal" title="Tambah Financial Goal" subtitle="Buat financial goal baru untuk mencapai target keuangan Anda">
    <form action="{{ route('finance-goals.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="nama_goals" class="block text-sm font-semibold text-gray-800 mb-2.5">Nama Goal</label>
            <input type="text" id="nama_goals" name="nama_goals" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Contoh: Tabungan Rumah" value="{{ old('nama_goals') }}">
            @error('nama_goals')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tujuan_goals" class="block text-sm font-semibold text-gray-800 mb-2.5">Tujuan Goal</label>
            <textarea id="tujuan_goals" name="tujuan_goals" rows="3" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm resize-none shadow-sm"
                placeholder="Deskripsi tujuan dari goal ini">{{ old('tujuan_goals') }}</textarea>
            @error('tujuan_goals')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="target" class="block text-sm font-semibold text-gray-800 mb-2.5">Target (Rp)</label>
            <input type="number" id="target" name="target" required min="1"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Rp 0" value="{{ old('target') }}">
            @error('target')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-gray-200 mt-5">
            <button type="button" onclick="closeModal('modal-goal')" 
                class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm">
                Batal
            </button>
            <button type="submit" 
                class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm shadow-md">
                Tambah Goal
            </button>
        </div>
    </form>
</x-modal-overlay>

