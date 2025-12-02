<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Budgeting;
use App\Models\FinanceGoal;
use App\Services\AICategorizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    protected AICategorizationService $aiService;

    public function __construct(AICategorizationService $aiService)
    {
        $this->aiService = $aiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get period from request (default: 1M - last month)
        $period = $request->get('period', '1M');
        
        // Calculate date range based on period
        $endDate = now();
        switch ($period) {
            case '7D':
                $startDate = now()->subDays(7);
                break;
            case '1M':
                $startDate = now()->subMonth();
                break;
            case '3M':
                $startDate = now()->subMonths(3);
                break;
            case '6M':
                $startDate = now()->subMonths(6);
                break;
            case '1Y':
                $startDate = now()->subYear();
                break;
            default:
                $startDate = now()->subMonth();
        }
        
        // Get transactions for the period
        $periodTransaksis = Transaksi::where('user_id', $user->id)
            ->whereBetween('tanggal', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get();
        
        // Calculate totals for the period
        $totalIncome = $periodTransaksis->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')->sum('nominal');
        $totalExpenses = $periodTransaksis->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')->sum('nominal');
        $totalSavings = $totalIncome - $totalExpenses;
        
        // Get all transactions for pagination
        $transaksis = Transaksi::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('transaksi.index', compact('transaksis', 'totalIncome', 'totalExpenses', 'totalSavings', 'period'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->aiService->getAvailableCategories();
        $budgets = Budgeting::where('user_id', Auth::id())->get();
        $goals = FinanceGoal::where('user_id', Auth::id())->get();
        return view('transaksi.create', compact('categories', 'budgets', 'goals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_pengeluaran_pemasukkan' => 'required|in:pengeluaran,pemasukkan',
            'nominal' => 'required|integer|min:1',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'tanggal' => 'required|date',
            'budget_id' => 'nullable|exists:budgets,id',
            'finance_goal_id' => 'nullable|exists:finance_goals,id',
        ]);

        // Validasi budget dan goal milik user
        if ($validated['budget_id']) {
            $budget = Budgeting::where('id', $validated['budget_id'])
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        if ($validated['finance_goal_id']) {
            $goal = FinanceGoal::where('id', $validated['finance_goal_id'])
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        // AI Kategorisasi jika kategori tidak diisi
        if (empty($validated['kategori']) && !empty($validated['deskripsi'])) {
            $validated['kategori'] = $this->aiService->categorize(
                $validated['deskripsi'],
                $validated['jenis_pengeluaran_pemasukkan']
            );
        }

        Transaksi::create([
            'user_id' => Auth::id(),
            ...$validated,
        ]);

        // Update Finance Goal Progress
        if (!empty($validated['finance_goal_id'])) {
            $goal = FinanceGoal::find($validated['finance_goal_id']);
            if ($goal) {
                if ($validated['jenis_pengeluaran_pemasukkan'] === 'pemasukkan') {
                    $goal->increment('kalkulasi', $validated['nominal']);
                } else {
                    $goal->decrement('kalkulasi', $validated['nominal']);
                }
            }
        }

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->findOrFail($id);
        $categories = $this->aiService->getAvailableCategories();
        $budgets = Budgeting::where('user_id', Auth::id())->get();
        $goals = FinanceGoal::where('user_id', Auth::id())->get();
        return view('transaksi.edit', compact('transaksi', 'categories', 'budgets', 'goals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'jenis_pengeluaran_pemasukkan' => 'required|in:pengeluaran,pemasukkan',
            'nominal' => 'required|integer|min:1',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
            'tanggal' => 'required|date',
            'budget_id' => 'nullable|exists:budgets,id',
            'finance_goal_id' => 'nullable|exists:finance_goals,id',
        ]);

        // Validasi budget dan goal milik user
        if ($validated['budget_id']) {
            $budget = Budgeting::where('id', $validated['budget_id'])
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        if ($validated['finance_goal_id']) {
            $goal = FinanceGoal::where('id', $validated['finance_goal_id'])
                ->where('user_id', Auth::id())
                ->firstOrFail();
        }

        // AI Kategorisasi jika kategori tidak diisi
        if (empty($validated['kategori']) && !empty($validated['deskripsi'])) {
            $validated['kategori'] = $this->aiService->categorize(
                $validated['deskripsi'],
                $validated['jenis_pengeluaran_pemasukkan']
            );
        }

        // Revert old goal effect
        if ($transaksi->finance_goal_id) {
            $oldGoal = FinanceGoal::find($transaksi->finance_goal_id);
            if ($oldGoal) {
                if ($transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan') {
                    $oldGoal->decrement('kalkulasi', $transaksi->nominal);
                } else {
                    $oldGoal->increment('kalkulasi', $transaksi->nominal);
                }
            }
        }

        $transaksi->update($validated);

        // Apply new goal effect
        if (!empty($validated['finance_goal_id'])) {
            $newGoal = FinanceGoal::find($validated['finance_goal_id']);
            if ($newGoal) {
                if ($validated['jenis_pengeluaran_pemasukkan'] === 'pemasukkan') {
                    $newGoal->increment('kalkulasi', $validated['nominal']);
                } else {
                    $newGoal->decrement('kalkulasi', $validated['nominal']);
                }
            }
        }

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::where('user_id', Auth::id())->findOrFail($id);
        
        // Revert Finance Goal Progress
        if ($transaksi->finance_goal_id) {
            $goal = FinanceGoal::find($transaksi->finance_goal_id);
            if ($goal) {
                if ($transaksi->jenis_pengeluaran_pemasukkan === 'pemasukkan') {
                    $goal->decrement('kalkulasi', $transaksi->nominal);
                } else {
                    $goal->increment('kalkulasi', $transaksi->nominal);
                }
            }
        }

        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }

    /**
     * View laporan transaksi
     */
    public function laporan()
    {
        $user = Auth::user();
        
        $transaksis = Transaksi::where('user_id', $user->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Group by kategori
        $byKategori = $transaksis->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')
            ->groupBy('kategori')
            ->map(function ($items) {
                return $items->sum('nominal');
            });

        // Group by bulan
        $byBulan = $transaksis->groupBy(function ($item) {
            return $item->tanggal->format('Y-m');
        })->map(function ($items) {
            return [
                'pemasukkan' => $items->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')->sum('nominal'),
                'pengeluaran' => $items->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')->sum('nominal'),
            ];
        })->sortKeys(); // Sort by month key (ascending - oldest to newest)

        return view('transaksi.laporan', compact('transaksis', 'byKategori', 'byBulan'));
    }
}
