<x-modal-overlay id="modal-budget" title="Tambah Budget" subtitle="Buat budget baru untuk mengelola keuangan Anda">
    <form action="{{ route('budgeting.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="jumlah_nominal" class="block text-sm font-semibold text-gray-800 mb-2.5">Nama Budget</label>
            <input type="text" id="jumlah_nominal" name="nama_budget" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Contoh: Food & Dining, Transportation, dll" value="{{ old('nama_budget') }}">
            @error('nama_budget')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="jumlah_budget" class="block text-sm font-semibold text-gray-800 mb-2.5">Jumlah Budget</label>
            <input type="number" id="jumlah_budget" name="nominal_budget" required min="1"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Rp 0" value="{{ old('nominal_budget') }}">
            @error('nominal_budget')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="periode" class="block text-sm font-semibold text-gray-800 mb-2.5">Periode</label>
            <select id="periode" name="periode" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm cursor-pointer shadow-sm">
                <option value="">Pilih Periode</option>
                <option value="mingguan" {{ old('periode') === 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                <option value="bulanan" {{ old('periode') === 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                <option value="tahunan" {{ old('periode') === 'tahunan' ? 'selected' : '' }}>Tahunan</option>
            </select>
            @error('periode')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-800 mb-3">Pilih Warna</label>
            <div class="flex gap-3 flex-wrap justify-center sm:justify-start">
                @php
                    $colors = [
                        '#FF6B6B' => 'Reddish-orange',
                        '#4ECDC4' => 'Teal',
                        '#45B7D1' => 'Light blue',
                        '#FFA07A' => 'Orange',
                        '#9B59B6' => 'Purple',
                        '#2ECC71' => 'Green',
                        '#FF69B4' => 'Pink',
                        '#FFD93D' => 'Yellowish-orange',
                    ];
                @endphp
                @foreach($colors as $hex => $name)
                <label class="cursor-pointer">
                    <input type="radio" name="warna" value="{{ $hex }}" 
                        {{ old('warna', '#FF6B6B') === $hex ? 'checked' : '' }}
                        class="hidden color-radio" onchange="document.getElementById('selected_color').value = '{{ $hex }}'">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full border-4 transition-all duration-200 hover:scale-110 cursor-pointer shadow-sm"
                         style="background-color: {{ $hex }}; border-color: {{ old('warna', '#FF6B6B') === $hex ? '#6366f1' : 'transparent' }}"
                         onclick="selectColor(this, '{{ $hex }}')">
                    </div>
                </label>
                @endforeach
            </div>
            <input type="hidden" id="selected_color" name="warna" value="{{ old('warna', '#FF6B6B') }}">
            @error('warna')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-gray-200 mt-5">
            <button type="button" onclick="closeModal('modal-budget')" 
                class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm">
                Batal
            </button>
            <button type="submit" 
                class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm shadow-md">
                Tambah Budget
            </button>
        </div>
    </form>
</x-modal-overlay>

<script>
function selectColor(element, color) {
    // Remove border from all colors
    document.querySelectorAll('.color-radio').forEach(radio => {
        radio.closest('label').querySelector('div').style.borderColor = 'transparent';
    });
    
    // Add border to selected color
    element.style.borderColor = '#6366f1';
    document.getElementById('selected_color').value = color;
    element.closest('label').querySelector('.color-radio').checked = true;
}
</script>
