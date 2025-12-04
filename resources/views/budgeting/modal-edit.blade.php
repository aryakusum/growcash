<x-modal-overlay id="modal-edit-budget" title="Edit Budget" subtitle="Update your budget information">
    <form id="form-edit-budget" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label for="edit_nama_budget" class="block text-sm font-semibold text-gray-200 mb-2">Budget Name</label>
            <input type="text" id="edit_nama_budget" name="nama_budget" required
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="e.g., Food & Dining, Transportation, etc.">
            @error('nama_budget')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_nominal_budget" class="block text-sm font-semibold text-gray-200 mb-2">Budget Amount</label>
            <input type="number" id="edit_nominal_budget" name="nominal_budget" required min="1"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="Rp 0">
            @error('nominal_budget')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_periode" class="block text-sm font-semibold text-gray-200 mb-2">Period</label>
            <select id="edit_periode" name="periode" required
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="">Select Period</option>
                <option value="mingguan">Weekly</option>
                <option value="bulanan">Monthly</option>
                <option value="tahunan">Yearly</option>
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
                        class="hidden color-radio-edit" onchange="document.getElementById('selected_color_edit').value = '{{ $hex }}'">
                    <div class="w-12 h-12 rounded-full border-4 transition-all duration-200 hover:scale-110 cursor-pointer edit-color-circle shadow-lg"
                         style="background-color: {{ $hex }}; border-color: transparent"
                         onclick="selectColorEdit(this, '{{ $hex }}')">
                    </div>
                </label>
                @endforeach
            </div>
            <input type="hidden" id="selected_color_edit" name="warna" value="">
            @error('warna')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-white/10 mt-5">
            <button type="button" onclick="closeModal('modal-edit-budget')" 
                class="w-full sm:w-auto px-6 py-3 bg-white/5 text-gray-300 rounded-xl hover:bg-white/10 hover:text-white transition-all duration-200 font-medium">
                Cancel
            </button>
            <button type="submit" 
                class="glass-button w-full sm:w-auto px-6 py-3 rounded-xl font-semibold">
                Update Budget
            </button>
        </div>
    </form>
</x-modal-overlay>

<script>
function selectColorEdit(element, color) {
    document.querySelectorAll('.edit-color-circle').forEach(circle => {
        circle.style.borderColor = 'transparent';
    });
    element.style.borderColor = '#d4af37';
    document.getElementById('selected_color_edit').value = color;
    element.closest('label').querySelector('.color-radio-edit').checked = true;
}

function openEditModal(budgetId, namaBudget, nominalBudget, periode, warna) {
    document.getElementById('form-edit-budget').action = `/budgeting/${budgetId}`;
    document.getElementById('edit_nama_budget').value = namaBudget || '';
    document.getElementById('edit_nominal_budget').value = nominalBudget || 0;
    document.getElementById('edit_periode').value = periode || 'bulanan';
    const selectedColor = warna || '#FF6B6B';
    document.getElementById('selected_color_edit').value = selectedColor;
    
    document.querySelectorAll('.edit-color-circle').forEach(circle => {
        circle.style.borderColor = 'transparent';
    });
    document.querySelectorAll('.color-radio-edit').forEach(radio => {
        radio.checked = false;
    });
    
    document.querySelectorAll('.color-radio-edit').forEach(radio => {
        if (radio.value === selectedColor) {
            radio.checked = true;
            const circle = radio.closest('label').querySelector('.edit-color-circle');
            if (circle) {
                circle.style.borderColor = '#d4af37';
            }
        }
    });
    
    openModal('modal-edit-budget');
}
</script>
