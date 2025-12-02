<x-modal-overlay id="modal-edit-goal" title="Edit Financial Goal" subtitle="Ubah informasi financial goal Anda">
    <form id="form-edit-goal" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label for="edit_nama_goals" class="block text-sm font-semibold text-gray-800 mb-2.5">Nama Goal</label>
            <input type="text" id="edit_nama_goals" name="nama_goals" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Contoh: Tabungan Rumah">
            @error('nama_goals')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_tujuan_goals" class="block text-sm font-semibold text-gray-800 mb-2.5">Tujuan Goal</label>
            <textarea id="edit_tujuan_goals" name="tujuan_goals" rows="3" required
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm resize-none"
                placeholder="Deskripsi tujuan dari goal ini"></textarea>
            @error('tujuan_goals')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_target" class="block text-sm font-semibold text-gray-800 mb-2.5">Target (Rp)</label>
            <input type="number" id="edit_target" name="target" required min="1"
                class="w-full px-4 py-2.5 border-2 border-gray-200 rounded-xl bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 hover:border-gray-300 transition-all duration-200 text-sm shadow-sm"
                placeholder="Rp 0">
            @error('target')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-gray-200 mt-5">
            <button type="button" onclick="closeModal('modal-edit-goal')" 
                class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm">
                Batal
            </button>
            <button type="submit" 
                class="w-full sm:w-auto px-6 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200 font-medium text-sm shadow-md">
                Update Goal
            </button>
        </div>
    </form>
</x-modal-overlay>

<script>
function openEditGoalModal(goalId, namaGoals, tujuanGoals, target) {
    // Set form action
    document.getElementById('form-edit-goal').action = `/finance-goals/${goalId}`;
    
    // Fill form fields
    document.getElementById('edit_nama_goals').value = namaGoals || '';
    document.getElementById('edit_tujuan_goals').value = tujuanGoals || '';
    document.getElementById('edit_target').value = target || 0;
    
    // Open modal
    openModal('modal-edit-goal');
}
</script>

