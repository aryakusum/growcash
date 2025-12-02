<?php

use Illuminate\Contracts\Console\Kernel;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

$goals = \App\Models\FinanceGoal::all();
foreach ($goals as $goal) {
    $income = \App\Models\Transaksi::where('finance_goal_id', $goal->id)
        ->where('jenis_pengeluaran_pemasukkan', 'pemasukkan')
        ->sum('nominal');
    
    $expense = \App\Models\Transaksi::where('finance_goal_id', $goal->id)
        ->where('jenis_pengeluaran_pemasukkan', 'pengeluaran')
        ->sum('nominal');
    
    $goal->kalkulasi = $income - $expense;
    $goal->save();
    echo "Updated Goal {$goal->id}: {$goal->nama_goals} -> {$goal->kalkulasi}\n";
}
echo "Done.\n";
