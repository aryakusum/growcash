@extends('layouts.app')

@section('title', 'Welcome to GrowCash')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12">
    <div class="glass-card w-full max-w-3xl p-8 sm:p-12 rounded-3xl relative z-20">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-luxury-gold to-yellow-600 flex items-center justify-center text-midnight-950 font-bold text-4xl shadow-lg mx-auto mb-6 animate-float">
                G
            </div>
            <h1 class="text-4xl font-display font-bold text-white mb-3">
                Welcome to GrowCash
            </h1>
            <p class="text-lg text-gray-400">
                Let's personalize your financial journey based on your unique situation.
            </p>
        </div>

        <form action="{{ route('onboarding.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Step 1: Profile Type -->
            <div class="space-y-4">
                <label class="block text-lg font-semibold text-white">Which describes you best?</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label class="cursor-pointer group">
                        <input type="radio" name="profile_type" value="student" class="peer hidden" required>
                        <div class="p-4 rounded-xl border border-white/10 bg-white/5 peer-checked:border-luxury-gold peer-checked:bg-luxury-gold/10 hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl mb-2">🎓</div>
                            <div class="font-semibold text-white group-hover:text-luxury-gold transition-colors">Student</div>
                            <div class="text-sm text-gray-400">Managing allowance & savings</div>
                        </div>
                    </label>

                    <label class="cursor-pointer group">
                        <input type="radio" name="profile_type" value="freelancer" class="peer hidden">
                        <div class="p-4 rounded-xl border border-white/10 bg-white/5 peer-checked:border-luxury-gold peer-checked:bg-luxury-gold/10 hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl mb-2">💻</div>
                            <div class="font-semibold text-white group-hover:text-luxury-gold transition-colors">Freelancer</div>
                            <div class="text-sm text-gray-400">Variable income & projects</div>
                        </div>
                    </label>

                    <label class="cursor-pointer group">
                        <input type="radio" name="profile_type" value="employee" class="peer hidden">
                        <div class="p-4 rounded-xl border border-white/10 bg-white/5 peer-checked:border-luxury-gold peer-checked:bg-luxury-gold/10 hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl mb-2">💼</div>
                            <div class="font-semibold text-white group-hover:text-luxury-gold transition-colors">Employee</div>
                            <div class="text-sm text-gray-400">Monthly salary & career</div>
                        </div>
                    </label>

                    <label class="cursor-pointer group">
                        <input type="radio" name="profile_type" value="business" class="peer hidden">
                        <div class="p-4 rounded-xl border border-white/10 bg-white/5 peer-checked:border-luxury-gold peer-checked:bg-luxury-gold/10 hover:bg-white/10 transition-all duration-300">
                            <div class="text-2xl mb-2">🚀</div>
                            <div class="font-semibold text-white group-hover:text-luxury-gold transition-colors">Business Owner</div>
                            <div class="text-sm text-gray-400">Cash flow & investments</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Step 2: Income & Expense -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <label for="monthly_income" class="block text-lg font-semibold text-white">Monthly Income</label>
                    <input type="number" id="monthly_income" name="monthly_income" required
                        class="glass-input w-full px-6 py-4 rounded-xl text-lg"
                        placeholder="e.g., 5000000">
                    <p class="text-sm text-gray-400">Your average monthly income</p>
                </div>

                <div class="space-y-4">
                    <label for="monthly_expense" class="block text-lg font-semibold text-white">Monthly Expenses</label>
                    <input type="number" id="monthly_expense" name="monthly_expense" required
                        class="glass-input w-full px-6 py-4 rounded-xl text-lg"
                        placeholder="e.g., 3000000">
                    <p class="text-sm text-gray-400">Your average monthly spending</p>
                </div>
            </div>

            <!-- Step 3: Financial Goals -->
            <div class="space-y-4">
                <label class="block text-lg font-semibold text-white">What are your financial goals?</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label class="flex items-center space-x-3 p-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 cursor-pointer transition-all">
                        <input type="checkbox" name="goals[]" value="emergency_fund" class="w-5 h-5 rounded border-white/20 text-luxury-gold focus:ring-luxury-gold">
                        <span class="text-white">Build Emergency Fund</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 cursor-pointer transition-all">
                        <input type="checkbox" name="goals[]" value="save_house" class="w-5 h-5 rounded border-white/20 text-luxury-gold focus:ring-luxury-gold">
                        <span class="text-white">Save for House/Property</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 cursor-pointer transition-all">
                        <input type="checkbox" name="goals[]" value="retirement" class="w-5 h-5 rounded border-white/20 text-luxury-gold focus:ring-luxury-gold">
                        <span class="text-white">Plan for Retirement</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 cursor-pointer transition-all">
                        <input type="checkbox" name="goals[]" value="investment" class="w-5 h-5 rounded border-white/20 text-luxury-gold focus:ring-luxury-gold">
                        <span class="text-white">Start Investing</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 cursor-pointer transition-all">
                        <input type="checkbox" name="goals[]" value="debt_free" class="w-5 h-5 rounded border-white/20 text-luxury-gold focus:ring-luxury-gold">
                        <span class="text-white">Become Debt-Free</span>
                    </label>
                    <label class="flex items-center space-x-3 p-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 cursor-pointer transition-all">
                        <input type="checkbox" name="goals[]" value="travel" class="w-5 h-5 rounded border-white/20 text-luxury-gold focus:ring-luxury-gold">
                        <span class="text-white">Travel & Experiences</span>
                    </label>
                </div>
            </div>

            <!-- Step 4: Main Reason -->
            <div class="space-y-4">
                <label for="main_reason" class="block text-lg font-semibold text-white">Why are you using GrowCash?</label>
                <select id="main_reason" name="main_reason" required
                    class="glass-input w-full px-6 py-4 rounded-xl text-lg">
                    <option value="" disabled selected>Select your main reason</option>
                    <option value="track_spending">Track my spending habits</option>
                    <option value="save_money">Save more money</option>
                    <option value="reduce_debt">Reduce my debt</option>
                    <option value="plan_future">Plan for the future</option>
                    <option value="financial_freedom">Achieve financial freedom</option>
                    <option value="learn_finance">Learn about personal finance</option>
                </select>
            </div>

            <div class="pt-6">
                <button type="submit" 
                    class="glass-button w-full py-4 rounded-xl text-xl shadow-[0_0_20px_rgba(212,175,55,0.4)]">
                    🚀 Start My Financial Journey
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
