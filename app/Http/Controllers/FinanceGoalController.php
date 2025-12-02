<?php

namespace App\Http\Controllers;

use App\Models\FinanceGoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goals = FinanceGoal::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('finance-goals.index', compact('goals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('finance-goals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_goals' => 'required|string|max:255',
            'tujuan_goals' => 'required|string|max:500',
            'target' => 'required|integer|min:1',
        ]);

        FinanceGoal::create([
            'user_id' => Auth::id(),
            'nama_goals' => $validated['nama_goals'],
            'tujuan_goals' => $validated['tujuan_goals'],
            'target' => $validated['target'],
            'kalkulasi' => 0,
        ]);

        return redirect()->route('finance-goals.index')
            ->with('success', 'Financial goal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $goal = FinanceGoal::where('user_id', Auth::id())->findOrFail($id);
        
        // Hitung progress dari transaksi pemasukkan
        $totalPemasukkan = \App\Models\Transaksi::where('user_id', Auth::id())
            ->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')
            ->sum('nominal');
        
        $progress = min(100, ($totalPemasukkan / $goal->target) * 100);
        
        return view('finance-goals.show', compact('goal', 'progress', 'totalPemasukkan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $goal = FinanceGoal::where('user_id', Auth::id())->findOrFail($id);
        return view('finance-goals.edit', compact('goal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $goal = FinanceGoal::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'nama_goals' => 'required|string|max:255',
            'tujuan_goals' => 'required|string|max:500',
            'target' => 'required|integer|min:1',
        ]);

        $goal->update($validated);

        return redirect()->route('finance-goals.index')
            ->with('success', 'Financial goal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $goal = FinanceGoal::where('user_id', Auth::id())->findOrFail($id);
        $goal->delete();

        return redirect()->route('finance-goals.index')
            ->with('success', 'Financial goal berhasil dihapus');
    }
}
