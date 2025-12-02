<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    
    protected $fillable = [
        'user_id',
        'jenis_pengeluaran_pemasukkan',
        'nominal',
        'kategori',
        'deskripsi',
        'tanggal',
        'budget_id',
        'finance_goal_id',
    ];

    protected $casts = [
        'nominal' => 'integer',
        'tanggal' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function budget(): BelongsTo
    {
        return $this->belongsTo(Budgeting::class, 'budget_id');
    }

    public function financeGoal(): BelongsTo
    {
        return $this->belongsTo(FinanceGoal::class, 'finance_goal_id');
    }
}
