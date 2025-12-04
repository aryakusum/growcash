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
        Schema::table('finance_goals', function (Blueprint $table) {
            if (!Schema::hasColumn('finance_goals', 'deadline')) {
                $table->date('deadline')->nullable()->after('kalkulasi');
            }
            if (!Schema::hasColumn('finance_goals', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('deadline');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finance_goals', function (Blueprint $table) {
            if (Schema::hasColumn('finance_goals', 'deadline')) {
                $table->dropColumn('deadline');
            }
            if (Schema::hasColumn('finance_goals', 'deskripsi')) {
                $table->dropColumn('deskripsi');
            }
        });
    }
};
