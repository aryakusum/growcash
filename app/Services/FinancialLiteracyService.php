<?php

namespace App\Services;

use App\Models\User;
use App\Models\Budgeting;
use App\Models\Transaksi;
use Carbon\Carbon;

class FinancialLiteracyService
{
    /**
     * Get financial recommendations based on user's budget usage
     */
    public static function getBudgetRecommendations(User $user)
    {
        $recommendations = [];
        $budgets = $user->budgets()->where('periode', 'bulanan')->get();
        
        foreach ($budgets as $budget) {
            $usage = self::calculateBudgetUsage($user, $budget);
            $percentage = ($budget->nominal_budget > 0) ? ($usage / $budget->nominal_budget) * 100 : 0;
            
            if ($percentage >= 90) {
                $recommendations[] = [
                    'type' => 'critical',
                    'budget' => $budget->nama_budget,
                    'usage' => $usage,
                    'limit' => $budget->nominal_budget,
                    'percentage' => round($percentage, 1),
                    'tips' => self::getCriticalTips($budget->nama_budget),
                ];
            } elseif ($percentage >= 75) {
                $recommendations[] = [
                    'type' => 'warning',
                    'budget' => $budget->nama_budget,
                    'usage' => $usage,
                    'limit' => $budget->nominal_budget,
                    'percentage' => round($percentage, 1),
                    'tips' => self::getWarningTips($budget->nama_budget),
                ];
            }
        }
        
        return $recommendations;
    }

    /**
     * Calculate current month budget usage
     */
    private static function calculateBudgetUsage(User $user, Budgeting $budget)
    {
        // Get spending from transactions linked to this budget
        $linkedSpending = $budget->transaksis()
            ->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal');
        
        // Also check transactions with matching category name
        $categorySpending = $user->transaksis()
            ->where('kategori', $budget->nama_budget)
            ->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->whereNull('budget_id') // Only count unlinked transactions
            ->sum('nominal');
            
        return $linkedSpending + $categorySpending;
    }

    /**
     * Get critical budget tips (90%+ usage)
     */
    private static function getCriticalTips($budgetName)
    {
        $tips = [
            'Food & Groceries' => [
                '🛒 Plan your meals for the week to avoid impulse buying',
                '🏪 Shop at local markets instead of supermarkets for better prices',
                '🍳 Cook at home more often - eating out is 3x more expensive',
                '📝 Make a shopping list and stick to it',
                '💡 Buy in bulk for non-perishable items to save money',
            ],
            'Transportation' => [
                '🚌 Consider using public transportation or carpooling',
                '🚴 Walk or bike for short distances to save fuel',
                '⛽ Use fuel-efficient driving techniques',
                '🚗 Combine multiple errands into one trip',
                '📱 Use ride-sharing apps for better rates',
            ],
            'Entertainment' => [
                '🎬 Look for free or low-cost entertainment options',
                '📚 Use library services instead of buying books',
                '🏞️ Explore free outdoor activities',
                '🎮 Share subscriptions with family or friends',
                '💰 Set a strict entertainment budget and track it weekly',
            ],
            'Utilities & Bills' => [
                '💡 Turn off lights and electronics when not in use',
                '❄️ Adjust AC/heating to moderate temperatures',
                '🚿 Take shorter showers to reduce water bills',
                '🔌 Unplug devices to avoid phantom power usage',
                '📊 Review your bills for any unnecessary charges',
            ],
            'default' => [
                '📊 Review your spending patterns this month',
                '✂️ Cut non-essential expenses immediately',
                '💰 Consider finding additional income sources',
                '📝 Create a detailed spending plan for next month',
                '🎯 Focus on your financial goals and priorities',
            ],
        ];

        return $tips[$budgetName] ?? $tips['default'];
    }

    /**
     * Get warning budget tips (75-89% usage)
     */
    private static function getWarningTips($budgetName)
    {
        $tips = [
            'Food & Groceries' => [
                '📋 Review your grocery receipts to identify expensive items',
                '🥗 Reduce eating out and prepare more meals at home',
                '🛍️ Use coupons and look for sales',
                '🍽️ Avoid food waste by proper meal planning',
            ],
            'Transportation' => [
                '🚗 Maintain your vehicle regularly to improve fuel efficiency',
                '🗺️ Plan routes to minimize distance and fuel consumption',
                '🚌 Consider monthly passes if using public transport frequently',
            ],
            'Entertainment' => [
                '🎯 Prioritize free or low-cost activities',
                '📺 Review and cancel unused subscriptions',
                '🎪 Look for community events and free entertainment',
            ],
            'default' => [
                '⚠️ You\'re approaching your budget limit - be mindful of spending',
                '📊 Track every expense for the rest of the month',
                '🎯 Postpone non-urgent purchases until next month',
                '💡 Look for ways to reduce costs in this category',
            ],
        ];

        return $tips[$budgetName] ?? $tips['default'];
    }

    /**
     * Get overall financial health score
     */
    public static function getFinancialHealthScore(User $user)
    {
        $score = 100;
        $factors = [];

        // Factor 1: Budget adherence (40 points)
        $budgets = $user->budgets()->where('periode', 'bulanan')->get();
        $overBudgetCount = 0;
        $totalBudgets = $budgets->count();

        foreach ($budgets as $budget) {
            $usage = self::calculateBudgetUsage($user, $budget);
            if ($usage > $budget->nominal_budget) {
                $overBudgetCount++;
            }
        }

        if ($totalBudgets > 0) {
            $budgetScore = 40 - (($overBudgetCount / $totalBudgets) * 40);
            $score = $budgetScore;
            $factors[] = [
                'name' => 'Budget Adherence',
                'score' => round($budgetScore),
                'max' => 40,
            ];
        }

        // Factor 2: Savings rate (30 points)
        $income = $user->transaksis()
            ->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal');

        $expenses = $user->transaksis()
            ->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal');

        if ($income > 0) {
            $savingsRate = (($income - $expenses) / $income) * 100;
            $savingsScore = min(30, ($savingsRate / 20) * 30); // 20% savings = full score
            $score += $savingsScore;
            $factors[] = [
                'name' => 'Savings Rate',
                'score' => round($savingsScore),
                'max' => 30,
                'rate' => round($savingsRate, 1),
            ];
        }

        // Factor 3: Goal progress (30 points)
        $goals = $user->financeGoals()->where('status', 'belum_tercapai')->get();
        $goalProgress = 0;

        foreach ($goals as $goal) {
            if ($goal->target > 0) {
                $goalProgress += ($goal->kalkulasi / $goal->target) * 100;
            }
        }

        if ($goals->count() > 0) {
            $avgGoalProgress = $goalProgress / $goals->count();
            $goalScore = min(30, ($avgGoalProgress / 100) * 30);
            $score += $goalScore;
            $factors[] = [
                'name' => 'Goal Progress',
                'score' => round($goalScore),
                'max' => 30,
                'progress' => round($avgGoalProgress, 1),
            ];
        }

        return [
            'total_score' => round($score),
            'grade' => self::getGrade($score),
            'factors' => $factors,
        ];
    }

    private static function getGrade($score)
    {
        if ($score >= 90) return 'A';
        if ($score >= 80) return 'B';
        if ($score >= 70) return 'C';
        if ($score >= 60) return 'D';
        return 'F';
    }
}
