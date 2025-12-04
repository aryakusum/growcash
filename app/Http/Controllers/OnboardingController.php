<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Budgeting;
use App\Models\FinanceGoal;

class OnboardingController extends Controller
{
    public function index()
    {
        return view('onboarding.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'profile_type' => 'required|in:student,freelancer,employee,business',
            'monthly_income' => 'required|numeric|min:0',
            'monthly_expense' => 'required|numeric|min:0',
            'goals' => 'nullable|array',
            'main_reason' => 'required|string',
        ]);

        $user = Auth::user();
        $income = $validated['monthly_income'];
        $expense = $validated['monthly_expense'];
        $savingCapacity = $income - $expense;

        // Generate Smart Budget Templates based on income and profile
        $this->generateSmartBudgets($user, $income, $expense, $validated['profile_type']);

        // Generate Goals based on selected goals and saving capacity
        if (!empty($validated['goals'])) {
            $this->generateSmartGoals($user, $validated['goals'], $savingCapacity);
        }

        // Mark user as onboarded
        $user->update(['is_onboarded' => true]);

        return redirect()->route('dashboard')
            ->with('success', 'Welcome to GrowCash! Your personalized financial plan is ready.');
    }

    private function generateSmartBudgets($user, $income, $expense, $profileType)
    {
        // Calculate recommended budget allocation (50/30/20 rule adjusted)
        $needs = $income * 0.50;      // 50% for needs
        $wants = $income * 0.30;      // 30% for wants
        $savings = $income * 0.20;    // 20% for savings

        $budgets = [];

        // Essential budgets for all profiles
        $budgets[] = [
            'nama_budget' => 'Food & Groceries',
            'nominal_budget' => round($needs * 0.40), // 40% of needs
            'periode' => 'bulanan',
        ];

        $budgets[] = [
            'nama_budget' => 'Transportation',
            'nominal_budget' => round($needs * 0.20), // 20% of needs
            'periode' => 'bulanan',
        ];

        $budgets[] = [
            'nama_budget' => 'Utilities & Bills',
            'nominal_budget' => round($needs * 0.25), // 25% of needs
            'periode' => 'bulanan',
        ];

        // Profile-specific budgets
        switch ($profileType) {
            case 'student':
                $budgets[] = [
                    'nama_budget' => 'Education & Books',
                    'nominal_budget' => round($wants * 0.40),
                    'periode' => 'bulanan',
                ];
                $budgets[] = [
                    'nama_budget' => 'Entertainment',
                    'nominal_budget' => round($wants * 0.30),
                    'periode' => 'bulanan',
                ];
                break;

            case 'freelancer':
                $budgets[] = [
                    'nama_budget' => 'Business Expenses',
                    'nominal_budget' => round($wants * 0.35),
                    'periode' => 'bulanan',
                ];
                $budgets[] = [
                    'nama_budget' => 'Professional Development',
                    'nominal_budget' => round($wants * 0.25),
                    'periode' => 'bulanan',
                ];
                break;

            case 'employee':
                $budgets[] = [
                    'nama_budget' => 'Career Development',
                    'nominal_budget' => round($wants * 0.20),
                    'periode' => 'bulanan',
                ];
                $budgets[] = [
                    'nama_budget' => 'Health & Wellness',
                    'nominal_budget' => round($wants * 0.30),
                    'periode' => 'bulanan',
                ];
                break;

            case 'business':
                $budgets[] = [
                    'nama_budget' => 'Business Investment',
                    'nominal_budget' => round($wants * 0.40),
                    'periode' => 'bulanan',
                ];
                $budgets[] = [
                    'nama_budget' => 'Networking & Marketing',
                    'nominal_budget' => round($wants * 0.25),
                    'periode' => 'bulanan',
                ];
                break;
        }

        // Savings budget
        $budgets[] = [
            'nama_budget' => 'Savings & Investment',
            'nominal_budget' => round($savings),
            'periode' => 'bulanan',
        ];

        // Create budgets
        foreach ($budgets as $budget) {
            Budgeting::create([
                'user_id' => $user->id,
                ...$budget,
            ]);
        }
    }

    private function generateSmartGoals($user, $selectedGoals, $savingCapacity)
    {
        $goalTemplates = [
            'emergency_fund' => [
                'nama_goals' => 'Emergency Fund (6 Months)',
                'target' => $savingCapacity * 6,
                'deadline' => now()->addMonths(12),
                'deskripsi' => 'Build a safety net for unexpected expenses',
            ],
            'save_house' => [
                'nama_goals' => 'House Down Payment',
                'target' => 100000000, // 100 juta
                'deadline' => now()->addYears(3),
                'deskripsi' => 'Save for your dream home',
            ],
            'retirement' => [
                'nama_goals' => 'Retirement Fund',
                'target' => 500000000, // 500 juta
                'deadline' => now()->addYears(10),
                'deskripsi' => 'Secure your future retirement',
            ],
            'investment' => [
                'nama_goals' => 'Investment Portfolio',
                'target' => 50000000, // 50 juta
                'deadline' => now()->addYears(2),
                'deskripsi' => 'Start building your investment portfolio',
            ],
            'debt_free' => [
                'nama_goals' => 'Debt-Free Journey',
                'target' => 20000000, // 20 juta
                'deadline' => now()->addYears(1),
                'deskripsi' => 'Pay off all outstanding debts',
            ],
            'travel' => [
                'nama_goals' => 'Dream Vacation',
                'target' => 30000000, // 30 juta
                'deadline' => now()->addMonths(18),
                'deskripsi' => 'Travel to your dream destination',
            ],
        ];

        foreach ($selectedGoals as $goalKey) {
            if (isset($goalTemplates[$goalKey])) {
                $template = $goalTemplates[$goalKey];
                FinanceGoal::create([
                    'user_id' => $user->id,
                    'nama_goals' => $template['nama_goals'],
                    'tujuan_goals' => $template['nama_goals'], // Use same name as goal name
                    'target' => $template['target'],
                    'kalkulasi' => 0,
                    'deadline' => $template['deadline'],
                    'deskripsi' => $template['deskripsi'],
                    'status' => 'belum_tercapai',
                ]);
            }
        }
    }
}
