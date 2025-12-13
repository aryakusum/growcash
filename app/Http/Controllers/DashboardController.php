<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\Budgeting;
use App\Models\FinanceGoal;

use App\Services\FinancialLiteracyService;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total pemasukkan (semua waktu)
        $totalPemasukkan = Transaksi::where('user_id', $user->id)
            ->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')
            ->sum('nominal');

        // Total pengeluaran (semua waktu)
        $totalPengeluaran = Transaksi::where('user_id', $user->id)
            ->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')
            ->sum('nominal');

        // Saving (Total Income - Total Expenses)
        $saving = $totalPemasukkan - $totalPengeluaran;

        // Saving Rate (percentage)
        $savingRate = $totalPemasukkan > 0
            ? round(($saving / $totalPemasukkan) * 100, 1)
            : 0;

        // Budgets dengan progress - gunakan method periode-aware
        $budgets = Budgeting::where('user_id', $user->id)
            ->get()
            ->map(function ($budget) {
                // Hitung spending dalam periode aktif saja
                $spent = $budget->getSpendingDalamPeriode();

                $progress = $budget->nominal_budget > 0
                    ? round(($spent / $budget->nominal_budget) * 100, 1)
                    : 0;

                $remaining = max(0, $budget->nominal_budget - $spent);

                return [
                    'id' => $budget->id,
                    'nama_budget' => $budget->nama_budget,
                    'nominal_budget' => $budget->nominal_budget,
                    'spent' => $spent,
                    'progress' => $progress,
                    'remaining' => $remaining,
                    'warna' => $budget->warna ?? '#6366f1',
                    'periode' => $budget->periode,
                    'periode_label' => $budget->periode_label,
                    'sisa_hari' => $budget->sisa_hari,
                ];
            });

        // Total Goals
        $totalGoals = FinanceGoal::where('user_id', $user->id)->count();

        // Total Target (sum of all goals)
        $totalTarget = FinanceGoal::where('user_id', $user->id)->sum('target');

        // Financial Literacy - Get recommendations
        $recommendations = FinancialLiteracyService::getBudgetRecommendations($user);

        return view('dashboard', compact(
            'totalPemasukkan',
            'totalPengeluaran',
            'saving',
            'savingRate',
            'budgets',
            'totalGoals',
            'totalTarget',
            'recommendations'
        ));
    }
}
