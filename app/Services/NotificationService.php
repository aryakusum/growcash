<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public static function create($userId, $type, $title, $message)
    {
        return Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
        ]);
    }

    public static function checkBudgetOverrun($user, $transaksi)
    {
        // Cek semua budget yang mungkin terkait dengan transaksi ini
        // Bisa berdasarkan budget_id langsung atau berdasarkan nama kategori
        $budgets = collect();

        // Jika transaksi punya budget_id langsung
        if ($transaksi->budget_id) {
            $budget = $user->budgets()->find($transaksi->budget_id);
            if ($budget) {
                $budgets->push($budget);
            }
        }

        // Juga cek budget berdasarkan nama kategori
        $categoryBudget = $user->budgets()
            ->where('nama_budget', $transaksi->kategori)
            ->first();

        if ($categoryBudget && !$budgets->contains('id', $categoryBudget->id)) {
            $budgets->push($categoryBudget);
        }

        foreach ($budgets as $budget) {
            // Gunakan method periode-aware untuk menghitung spending
            $totalSpent = $budget->getSpendingDalamPeriode();

            // Check if over budget
            if ($totalSpent > $budget->nominal_budget) {
                $overAmount = $totalSpent - $budget->nominal_budget;
                $periodeLabel = $budget->periode_label ?? $budget->periode;

                self::create(
                    $user->id,
                    'budget_alert',
                    '⚠️ Budget Limit Exceeded!',
                    "Your '{$budget->nama_budget}' budget ({$periodeLabel}) has exceeded by Rp " . number_format($overAmount, 0, ',', '.')
                );
            }
        }
    }

    public static function checkGoalAchieved($user, $transaksi)
    {
        // Only check for income transactions
        if ($transaksi->jenis_pengeluaran_pemasukkan !== 'pemasukkan') {
            return;
        }

        // Check all active goals
        $goals = $user->financeGoals()->where('status', 'belum_tercapai')->get();

        foreach ($goals as $goal) {
            if ($goal->kalkulasi >= $goal->target) {
                self::create(
                    $user->id,
                    'goal_achieved',
                    '🎉 Goal Achieved!',
                    "Congratulations! You've reached your goal: {$goal->nama_goals}"
                );

                // Update goal status
                $goal->update(['status' => 'tercapai']);
            }
        }
    }

    public static function notifyTransaction($user, $transaksi)
    {
        $type = $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? 'Income' : 'Expense';
        $icon = $transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan' ? '💰' : '💸';

        self::create(
            $user->id,
            'transaction',
            "{$icon} New {$type} Added",
            "Rp " . number_format($transaksi->nominal, 0, ',', '.') . " - {$transaksi->deskripsi}"
        );
    }
}
