@php
    $categories = app(\App\Services\AICategorizationService::class)->getAvailableCategories();
    $budgets = \App\Models\Budgeting::where('user_id', auth()->id())->get();
    $goals = \App\Models\FinanceGoal::where('user_id', auth()->id())->get();
@endphp

<x-modal-overlay id="modal-transaksi" title="Add Transaction" subtitle="Create a new transaction to manage your cash flow">
    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="kategori_transaksi" class="block text-sm font-semibold text-gray-200 mb-2">Transaction Type</label>
            <select id="kategori_transaksi" name="jenis_pengeluaran_pemasukkan" required
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="pemasukkan">Income</option>
                <option value="pengeluaran">Expense</option>
            </select>
            @error('jenis_pengeluaran_pemasukkan')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="nominal_transaksi" class="block text-sm font-semibold text-gray-200 mb-2">Amount</label>
            <input type="number" id="nominal_transaksi" name="nominal" required min="1"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="Rp 0" value="{{ old('nominal') }}">
            @error('nominal')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-semibold text-gray-200 mb-2">Description</label>
            <input type="text" id="deskripsi" name="deskripsi"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="e.g., Shopping, Health, etc." value="{{ old('deskripsi') }}">
            <p class="mt-2 text-xs text-gray-400">AI will categorize automatically</p>
            @error('deskripsi')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tanggal" class="block text-sm font-semibold text-gray-200 mb-2">Date</label>
            <input type="date" id="tanggal" name="tanggal" required
                class="glass-input w-full px-4 py-3 rounded-xl">
            @error('tanggal')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div id="budget-container">
            <label for="budget_id" class="block text-sm font-semibold text-gray-200 mb-2">Budget (Optional)</label>
            <select id="budget_id" name="budget_id"
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="">Select Budget</option>
                @foreach($budgets as $budget)
                    <option value="{{ $budget->id }}">{{ $budget->nama_budget }}</option>
                @endforeach
            </select>
        </div>

        <div id="goal-container" class="hidden">
            <label for="finance_goal_id" class="block text-sm font-semibold text-gray-200 mb-2">Financial Goal (Optional)</label>
            <select id="finance_goal_id" name="finance_goal_id"
                class="glass-input w-full px-4 py-3 rounded-xl">
                <option value="">Select Goal</option>
                @foreach($goals as $goal)
                    <option value="{{ $goal->id }}">{{ $goal->nama_goals }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-white/10 mt-5">
            <button type="button" onclick="closeModal('modal-transaksi')" 
                class="w-full sm:w-auto px-6 py-3 bg-white/5 text-gray-300 rounded-xl hover:bg-white/10 hover:text-white transition-all duration-200 font-medium">
                Cancel
            </button>
            <button type="submit" 
                class="glass-button w-full sm:w-auto px-6 py-3 rounded-xl font-semibold">
                Add Transaction
            </button>
        </div>
    </form>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSelect = document.getElementById('kategori_transaksi');
            const budgetContainer = document.getElementById('budget-container');
            const goalContainer = document.getElementById('goal-container');
            const budgetSelect = document.getElementById('budget_id');
            const goalSelect = document.getElementById('finance_goal_id');

            function toggleFields() {
                if (typeSelect.value === 'pemasukkan') {
                    budgetContainer.classList.add('hidden');
                    goalContainer.classList.remove('hidden');
                    budgetSelect.value = ''; // Reset budget selection
                } else {
                    budgetContainer.classList.remove('hidden');
                    goalContainer.classList.add('hidden');
                    goalSelect.value = ''; // Reset goal selection
                }
            }

            // Initial check
            toggleFields();

            // Listen for changes
            typeSelect.addEventListener('change', toggleFields);
        });
    </script>
</x-modal-overlay>
