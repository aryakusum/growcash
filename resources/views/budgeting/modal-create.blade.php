<x-modal-overlay id="modal-budget" title="Add Budget" subtitle="Create a new budget to manage your finances">
    <form action="{{ route('budgeting.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="jumlah_nominal" class="block text-sm font-semibold text-gray-200 mb-2">Budget Name</label>
            <input type="text" id="jumlah_nominal" name="nama_budget" required
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="e.g., Food & Dining, Transportation, etc." value="{{ old('nama_budget') }}">
            @error('nama_budget')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="jumlah_budget" class="block text-sm font-semibold text-gray-200 mb-2">Budget Amount</label>
            <input type="number" id="jumlah_budget" name="nominal_budget" required min="1"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="Rp 0" value="{{ old('nominal_budget') }}">
            @error('nominal_budget')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="periode" class="block text-sm font-semibold text-gray-200 mb-2">Period</label>
            <select id="periode" name="periode" required
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="">Select Period</option>
                <option value="mingguan" {{ old('periode') === 'mingguan' ? 'selected' : '' }}>Weekly</option>
                <option value="bulanan" {{ old('periode') === 'bulanan' ? 'selected' : '' }}>Monthly</option>
                <option value="tahunan" {{ old('periode') === 'tahunan' ? 'selected' : '' }}>Yearly</option>
            </select>
            @error('periode')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-200 mb-3">Choose Color</label>
            <div class="flex gap-3 flex-wrap">
                @php
                    $colors = [
                        '#FF6B6B' => 'Red',
                        '#4ECDC4' => 'Teal',
                        '#45B7D1' => 'Blue',
                        '#FFA07A' => 'Orange',
                        '#9B59B6' => 'Purple',
                        '#2ECC71' => 'Green',
                        '#FF69B4' => 'Pink',
                        '#FFD93D' => 'Yellow',
                    ];
                @endphp
                @foreach($colors as $hex => $name)
                <label class="cursor-pointer">
                    <input type="radio" name="warna" value="{{ $hex }}" 
                        {{ old('warna', '#FF6B6B') === $hex ? 'checked' : '' }}
                        class="hidden color-radio" onchange="document.getElementById('selected_color').value = '{{ $hex }}'">
                    <div class="w-12 h-12 rounded-full border-4 transition-all duration-200 hover:scale-110 cursor-pointer shadow-lg"
                         style="background-color: {{ $hex }}; border-color: {{ old('warna', '#FF6B6B') === $hex ? '#d4af37' : 'transparent' }}"
                         onclick="selectColor(this, '{{ $hex }}')">
                    </div>
                </label>
                @endforeach
            </div>
            <input type="hidden" id="selected_color" name="warna" value="{{ old('warna', '#FF6B6B') }}">
            @error('warna')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-white/10 mt-5">
            <button type="button" onclick="closeModal('modal-budget')" 
                class="w-full sm:w-auto px-6 py-3 bg-white/5 text-gray-300 rounded-xl hover:bg-white/10 hover:text-white transition-all duration-200 font-medium">
                Cancel
            </button>
            <button type="submit" 
                class="glass-button w-full sm:w-auto px-6 py-3 rounded-xl font-semibold">
                Add Budget
            </button>
        </div>
    </form>
</x-modal-overlay>

<script>
function selectColor(element, color) {
    document.querySelectorAll('.color-radio').forEach(radio => {
        radio.closest('label').querySelector('div').style.borderColor = 'transparent';
    });
    element.style.borderColor = '#d4af37';
    document.getElementById('selected_color').value = color;
    element.closest('label').querySelector('.color-radio').checked = true;
}
</script>
