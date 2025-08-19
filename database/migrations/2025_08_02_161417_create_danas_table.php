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
    Schema::create('danas', function (Blueprint $table) {
        $table->id();

        // VA number, bisa pakai unique jika 1 VA hanya boleh sekali
        $table->string('no_va')->index(); 

        // Tipe transaksi: 'C' (credit) atau 'D' (debit)
        $table->enum('tipe', ['C', 'D'])->comment('C = Credit, D = Debit');

        // Nominal transaksi (15 digit total, 2 digit desimal)
        $table->decimal('nominal', 15, 2);

        // Status pengembalian, null saat insert lalu diisi otomatis via trigger
        $table->enum('status', [
            'Belum Dikembalikan',
            'Sudah Dikembalikan',
            'Sebagian Dikembalikan',
            'Lebih Bayar'
        ])->nullable()->default(null);

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danas');
    }
};
