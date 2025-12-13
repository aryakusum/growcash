<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Menambahkan kolom periode_mulai untuk tracking kapan periode budget dimulai.
     * Kolom ini digunakan untuk menghitung spending yang hanya dalam periode aktif saja.
     */
    public function up(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->date('periode_mulai')->nullable()->after('periode');
        });

        // Set default periode_mulai berdasarkan tipe periode masing-masing budget
        $budgets = DB::table('budgets')->get();
        foreach ($budgets as $budget) {
            $periodeMulai = $this->hitungPeriodeMulai($budget->periode);
            DB::table('budgets')
                ->where('id', $budget->id)
                ->update(['periode_mulai' => $periodeMulai]);
        }
    }

    /**
     * Menghitung tanggal mulai periode berdasarkan tipe periode.
     */
    private function hitungPeriodeMulai(string $periode): string
    {
        $now = now();

        return match ($periode) {
            'mingguan' => $now->startOfWeek()->format('Y-m-d'),
            'bulanan' => $now->startOfMonth()->format('Y-m-d'),
            'tahunan' => $now->startOfYear()->format('Y-m-d'),
            default => $now->startOfMonth()->format('Y-m-d'),
        };
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropColumn('periode_mulai');
        });
    }
};
