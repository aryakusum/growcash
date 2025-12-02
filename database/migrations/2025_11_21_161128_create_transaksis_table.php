<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('jenis_pengeluaran_pemasukkan'); // pengeluaran, pemasukkan
            $table->bigInteger('nominal');
            $table->string('kategori')->nullable(); // AI categorized
            $table->text('deskripsi')->nullable();
            $table->date('tanggal');
            $table->foreignId('budget_id')->nullable()->constrained('budgets')->onDelete('set null');
            $table->foreignId('finance_goal_id')->nullable()->constrained('finance_goals')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
