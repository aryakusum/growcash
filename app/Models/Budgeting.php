<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budgeting extends Model
{
    protected $table = 'budgets';
    
    protected $fillable = [
        'user_id',
        'nama_budget',
        'nominal_budget',
        'kalkulasi',
        'warna',
        'periode',
    ];

    protected $casts = [
        'nominal_budget' => 'integer',
        'kalkulasi' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'budget_id');
    }
}
