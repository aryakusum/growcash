<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinanceGoal extends Model
{
    protected $table = 'finance_goals';
    
    protected $fillable = [
        'user_id',
        'nama_goals',
        'tujuan_goals',
        'target',
        'kalkulasi',
    ];

    protected $casts = [
        'target' => 'integer',
        'kalkulasi' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'finance_goal_id');
    }
}
