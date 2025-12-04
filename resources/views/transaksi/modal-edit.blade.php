@php
    $categories = app(\App\Services\AICategorizationService::class)->getAvailableCategories();
    $budgets = \App\Models\Budgeting::where('user_id', auth()->id())->get();
    $goals = \App\Models\FinanceGoal::where('user_id', auth()->id())->get();
@endphp

<x-modal-overlay id="modal-edit-transaksi" title="Edit Transaction" subtitle="Update your transaction information">
    <form id="form-edit-transaksi" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        
        <div>
            <label for="edit_kategori_transaksi" class="block text-sm font-semibold text-gray-200 mb-2">Transaction Type</label>
            <select id="edit_kategori_transaksi" name="jenis_pengeluaran_pemasukkan" required
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="pemasukkan">Income</option>
                <option value="pengeluaran">Expense</option>
            </select>
            @error('jenis_pengeluaran_pemasukkan')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_nominal_transaksi" class="block text-sm font-semibold text-gray-200 mb-2">Amount</label>
            <input type="number" id="edit_nominal_transaksi" name="nominal" required min="1"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="Rp 0">
            @error('nominal')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_deskripsi" class="block text-sm font-semibold text-gray-200 mb-2">Description</label>
            <input type="text" id="edit_deskripsi" name="deskripsi"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="e.g., Shopping, Health, etc.">
            <p class="mt-2 text-xs text-gray-400">AI will categorize automatically</p>
            @error('deskripsi')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_kategori" class="block text-sm font-semibold text-gray-200 mb-2">Category</label>
            <select id="edit_kategori" name="kategori"
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="">Let AI categorize</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
            @error('kategori')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_tanggal" class="block text-sm font-semibold text-gray-200 mb-2">Date</label>
            <input type="date" id="edit_tanggal" name="tanggal" required
                class="glass-input w-full px-4 py-3 rounded-xl">
            @error('tanggal')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="edit_budget_id" class="block text-sm font-semibold text-gray-200 mb-2">Budget (Optional)</label>
            <select id="edit_budget_id" name="budget_id"
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="">None</option>
                @foreach($budgets as $budget)
                    <option value="{{ $budget->id }}">{{ $budget->nama_budget }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="edit_finance_goal_id" class="block text-sm font-semibold text-gray-200 mb-2">Financial Goal (Optional)</label>
            <select id="edit_finance_goal_id" name="finance_goal_id"
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="">None</option>
                @foreach($goals as $goal)
                    <option value="{{ $goal->id }}">{{ $goal->nama_goals }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-white/10 mt-5">
            <button type="button" onclick="closeModal('modal-edit-transaksi')" 
                class="w-full sm:w-auto px-6 py-3 bg-white/5 text-gray-300 rounded-xl hover:bg-white/10 hover:text-white transition-all duration-200 font-medium">
                Cancel
            </button>
            <button type="submit" 
                class="glass-button w-full sm:w-auto px-6 py-3 rounded-xl font-semibold">
                Update Transaction
            </button>
        </div>
    </form>
</x-modal-overlay>

<script>
function openEditTransaksiModal(transaksiId, jenis, nominal, deskripsi, kategori, tanggal, budgetId, financeGoalId) {
    document.getElementById('form-edit-transaksi').action = `/transaksi/${transaksiId}`;
    document.getElementById('edit_kategori_transaksi').value = jenis || 'pengeluaran';
    document.getElementById('edit_nominal_transaksi').value = nominal || 0;
    document.getElementById('edit_deskripsi').value = deskripsi || '';
    document.getElementById('edit_kategori').value = kategori || '';
    document.getElementById('edit_tanggal').value = tanggal || '';
    document.getElementById('edit_budget_id').value = (budgetId && budgetId !== '') ? budgetId : '';
    document.getElementById('edit_finance_goal_id').value = (financeGoalId && financeGoalId !== '') ? financeGoalId : '';
    openModal('modal-edit-transaksi');
}
</script>
