<x-modal-overlay id="modal-edit-goal" title="Edit Financial Goal" subtitle="Update your financial goal information">
    <form id="form-edit-goal" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label for="edit_nama_goals" class="block text-sm font-semibold text-gray-200 mb-2">Goal Name</label>
            <input type="text" id="edit_nama_goals" name="nama_goals" required
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="e.g., House Savings">
            @error('nama_goals')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_tujuan_goals" class="block text-sm font-semibold text-gray-200 mb-2">Goal Purpose</label>
            <textarea id="edit_tujuan_goals" name="tujuan_goals" rows="3" required
                class="glass-input w-full px-4 py-3 rounded-xl resize-none"
                placeholder="Describe the purpose of this goal"></textarea>
            @error('tujuan_goals')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_target" class="block text-sm font-semibold text-gray-200 mb-2">Target Amount (Rp)</label>
            <input type="number" id="edit_target" name="target" required min="1"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="Rp 0">
            @error('target')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-white/10 mt-5">
            <button type="button" onclick="closeModal('modal-edit-goal')" 
                class="w-full sm:w-auto px-6 py-3 bg-white/5 text-gray-300 rounded-xl hover:bg-white/10 hover:text-white transition-all duration-200 font-medium">
                Cancel
            </button>
            <button type="submit" 
                class="glass-button w-full sm:w-auto px-6 py-3 rounded-xl font-semibold">
                Update Goal
            </button>
        </div>
    </form>
</x-modal-overlay>

<script>
function openEditGoalModal(goalId, namaGoals, tujuanGoals, target) {
    document.getElementById('form-edit-goal').action = `/finance-goals/${goalId}`;
    document.getElementById('edit_nama_goals').value = namaGoals || '';
    document.getElementById('edit_tujuan_goals').value = tujuanGoals || '';
    document.getElementById('edit_target').value = target || 0;
    openModal('modal-edit-goal');
}
</script>
