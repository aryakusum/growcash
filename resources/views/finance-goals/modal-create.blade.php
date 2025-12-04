<x-modal-overlay id="modal-goal" title="Add Financial Goal" subtitle="Create a new financial goal to achieve your targets">
    <form action="{{ route('finance-goals.store') }}" method="POST" class="space-y-5">
        @csrf
        
        <div>
            <label for="nama_goals" class="block text-sm font-semibold text-gray-200 mb-2">Goal Name</label>
            <input type="text" id="nama_goals" name="nama_goals" required
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="e.g., House Savings" value="{{ old('nama_goals') }}">
            @error('nama_goals')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="tujuan_goals" class="block text-sm font-semibold text-gray-200 mb-2">Goal Purpose</label>
            <textarea id="tujuan_goals" name="tujuan_goals" rows="3" required
                class="glass-input w-full px-4 py-3 rounded-xl resize-none"
                placeholder="Describe the purpose of this goal">{{ old('tujuan_goals') }}</textarea>
            @error('tujuan_goals')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="target" class="block text-sm font-semibold text-gray-200 mb-2">Target Amount (Rp)</label>
            <input type="number" id="target" name="target" required min="1"
                class="glass-input w-full px-4 py-3 rounded-xl"
                placeholder="Rp 0" value="{{ old('target') }}">
            @error('target')
                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-5 border-t border-white/10 mt-5">
            <button type="button" onclick="closeModal('modal-goal')" 
                class="w-full sm:w-auto px-6 py-3 bg-white/5 text-gray-300 rounded-xl hover:bg-white/10 hover:text-white transition-all duration-200 font-medium">
                Cancel
            </button>
            <button type="submit" 
                class="glass-button w-full sm:w-auto px-6 py-3 rounded-xl font-semibold">
                Add Goal
            </button>
        </div>
    </form>
</x-modal-overlay>
