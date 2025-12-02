$goals = App\Models\FinanceGoal::all();
foreach ($goals as $goal) {
    $income = App\Models\Transaksi::where('finance_goal_id', $goal->id)->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')->sum('nominal');
    $expense = App\Models\Transaksi::where('finance_goal_id', $goal->id)->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')->sum('nominal');
    $goal->kalkulasi = $income - $expense;
    $goal->save();
    echo "Updated " . $goal->nama_goals . " to " . $goal->kalkulasi . "\n";
}
