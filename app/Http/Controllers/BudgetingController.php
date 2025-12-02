<?php

namespace App\Http\Controllers;

use App\Models\Budgeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgets = Budgeting::where('user_id', Auth::id())
            ->with('transaksis')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('budgeting.index', compact('budgets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('budgeting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_budget' => 'required|string|max:255',
            'nominal_budget' => 'required|integer|min:1',
            'warna' => 'nullable|string|max:7',
            'periode' => 'required|in:mingguan,bulanan,tahunan',
        ]);

        Budgeting::create([
            'user_id' => Auth::id(),
            'nama_budget' => $validated['nama_budget'],
            'nominal_budget' => $validated['nominal_budget'],
            'kalkulasi' => 0,
            'warna' => $validated['warna'] ?? '#FF6B6B',
            'periode' => $validated['periode'],
        ]);

        return redirect()->route('budgeting.index')
            ->with('success', 'Budget berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $budget = Budgeting::where('user_id', Auth::id())->findOrFail($id);
        return view('budgeting.show', compact('budget'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $budget = Budgeting::where('user_id', Auth::id())->findOrFail($id);
        return view('budgeting.edit', compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $budget = Budgeting::where('user_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'nama_budget' => 'required|string|max:255',
            'nominal_budget' => 'required|integer|min:1',
            'warna' => 'nullable|string|max:7',
            'periode' => 'required|in:mingguan,bulanan,tahunan',
        ]);

        $budget->update($validated);

        return redirect()->route('budgeting.index')
            ->with('success', 'Budget berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $budget = Budgeting::where('user_id', Auth::id())->findOrFail($id);
        $budget->delete();

        return redirect()->route('budgeting.index')
            ->with('success', 'Budget berhasil dihapus');
    }
}
