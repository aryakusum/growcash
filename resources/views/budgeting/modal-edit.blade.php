<x-modal-overlay id="modal-edit-budget" title="Edit Budget" subtitle="Ubah informasi budget Anda">
    <form id="form-edit-budget" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label for="edit_nama_budget" class="block text-sm font-semibold text-gray-800 mb-2.5">Nama Budget</label>
            <input type="text" id="edit_nama_budget" name="nama_budget" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Contoh: Food & Dining, Transportation, dll">
            @error('nama_budget')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_nominal_budget" class="block text-sm font-semibold text-gray-800 mb-2.5">Jumlah Budget</label>
            <input type="number" id="edit_nominal_budget" name="nominal_budget" required min="1"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Rp 0">
            @error('nominal_budget')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_periode" class="block text-sm font-semibold text-gray-800 mb-2.5">Periode</label>
            <select id="edit_periode" name="periode" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm cursor-pointer">
                <option value="">Pilih Periode</option>
                <option value="mingguan">Mingguan</option>
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
            </select>
            @error('periode')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Warna</label>
            <div class="flex gap-3 flex-wrap">
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
                        class="hidden color-radio-edit" onchange="document.getElementById('selected_color_edit').value = '{{ $hex }}'">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full border-4 transition-all duration-200 hover:scale-110 cursor-pointer edit-color-circle"
                         style="background-color: {{ $hex }}; border-color: transparent"
                         onclick="selectColorEdit(this, '{{ $hex }}')">
                    </div>
                </label>
                @endforeach
            </div>
            <input type="hidden" id="selected_color_edit" name="warna" value="">
            @error('warna')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-gray-200 mt-5">
            <button type="button" onclick="closeModal('modal-edit-budget')" 
                class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm">
                Batal
            </button>
            <button type="submit" 
                class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm shadow-md">
                Update Budget
            </button>
        </div>
    </form>
</x-modal-overlay>

<script>
function selectColorEdit(element, color) {
    // Remove border from all colors
    document.querySelectorAll('.edit-color-circle').forEach(circle => {
        circle.style.borderColor = 'transparent';
    });
    
    // Add border to selected color
    element.style.borderColor = '#ef4444';
    document.getElementById('selected_color_edit').value = color;
    element.closest('label').querySelector('.color-radio-edit').checked = true;
}

function openEditModal(budgetId, namaBudget, nominalBudget, periode, warna) {
    // Set form action
    document.getElementById('form-edit-budget').action = `/budgeting/${budgetId}`;
    
    // Fill form fields
    document.getElementById('edit_nama_budget').value = namaBudget || '';
    document.getElementById('edit_nominal_budget').value = nominalBudget || 0;
    document.getElementById('edit_periode').value = periode || 'bulanan';
    const selectedColor = warna || '#FF6B6B';
    document.getElementById('selected_color_edit').value = selectedColor;
    
    // Reset all color selections
    document.querySelectorAll('.edit-color-circle').forEach(circle => {
        circle.style.borderColor = 'transparent';
    });
    document.querySelectorAll('.color-radio-edit').forEach(radio => {
        radio.checked = false;
    });
    
    // Select the correct color
    document.querySelectorAll('.color-radio-edit').forEach(radio => {
        if (radio.value === selectedColor) {
            radio.checked = true;
            const circle = radio.closest('label').querySelector('.edit-color-circle');
            if (circle) {
                circle.style.borderColor = '#ef4444';
            }
        }
    });
    
    // Open modal
    openModal('modal-edit-budget');
}
</script>

