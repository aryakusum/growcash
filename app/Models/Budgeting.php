<?php

namespace App\Models;

use Carbon\Carbon;
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
        'periode_mulai',
    ];

    protected $casts = [
        'nominal_budget' => 'integer',
        'kalkulasi' => 'integer',
        'periode_mulai' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'budget_id');
    }

    /**
     * Menghitung tanggal mulai periode saat ini berdasarkan tipe periode.
     * Contoh: jika periode = 'bulanan' dan sekarang 13 Des 2025, 
     * maka periode mulai = 1 Des 2025.
     */
    public static function hitungPeriodeMulai(string $periode): Carbon
    {
        $now = now();

        return match ($periode) {
            'mingguan' => $now->copy()->startOfWeek(),
            'bulanan' => $now->copy()->startOfMonth(),
            'tahunan' => $now->copy()->startOfYear(),
            default => $now->copy()->startOfMonth(),
        };
    }

    /**
     * Menghitung tanggal akhir periode berdasarkan tipe periode.
     */
    public static function hitungPeriodeAkhir(string $periode): Carbon
    {
        $now = now();

        return match ($periode) {
            'mingguan' => $now->copy()->endOfWeek(),
            'bulanan' => $now->copy()->endOfMonth(),
            'tahunan' => $now->copy()->endOfYear(),
            default => $now->copy()->endOfMonth(),
        };
    }

    /**
     * Mengecek apakah periode budget sudah expired dan perlu di-reset.
     * Return true jika periode_mulai sudah tidak dalam periode yang sama dengan sekarang.
     */
    public function periodePerluReset(): bool
    {
        if (!$this->periode_mulai) {
            return true;
        }

        $periodeMulaiBaru = self::hitungPeriodeMulai($this->periode);

        // Jika periode mulai yang tersimpan berbeda dengan periode mulai yang seharusnya,
        // berarti sudah ganti periode dan perlu reset.
        return $this->periode_mulai->format('Y-m-d') !== $periodeMulaiBaru->format('Y-m-d');
    }

    /**
     * Reset periode budget ke periode saat ini.
     * Ini akan mengupdate periode_mulai ke tanggal mulai periode yang baru.
     */
    public function resetPeriode(): void
    {
        $this->periode_mulai = self::hitungPeriodeMulai($this->periode);
        $this->save();
    }

    /**
     * Menghitung total spending dalam periode aktif saja.
     * Transaksi yang terjadi sebelum periode_mulai tidak akan dihitung.
     */
    public function getSpendingDalamPeriode(): int
    {
        // Pastikan periode sudah diupdate jika perlu
        if ($this->periodePerluReset()) {
            $this->resetPeriode();
        }

        $periodeMulai = $this->periode_mulai ?? self::hitungPeriodeMulai($this->periode);
        $periodeAkhir = self::hitungPeriodeAkhir($this->periode);

        return $this->transaksis()
            ->whereBetween('tanggal', [$periodeMulai, $periodeAkhir])
            ->sum('nominal');
    }

    /**
     * Accessor untuk mendapatkan sisa hari dalam periode.
     */
    public function getSisaHariAttribute(): int
    {
        $periodeAkhir = self::hitungPeriodeAkhir($this->periode);
        return max(0, now()->diffInDays($periodeAkhir, false));
    }

    /**
     * Accessor untuk mendapatkan label periode dalam bahasa Indonesia yang lebih friendly.
     */
    public function getPeriodeLabelAttribute(): string
    {
        return match ($this->periode) {
            'mingguan' => 'Minggu Ini',
            'bulanan' => 'Bulan Ini',
            'tahunan' => 'Tahun Ini',
            default => $this->periode,
        };
    }
}
