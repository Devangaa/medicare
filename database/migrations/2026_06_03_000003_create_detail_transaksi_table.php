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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('jumlah_obat');
            $table->decimal('total_harga', 12, 2);
            $table->unsignedBigInteger('id_detail_obat');
            $table->foreignId('id_transaksi')->constrained('transaksi')->cascadeOnDelete();
            $table->timestamps();

            $table->foreign('id_detail_obat')->references('id')->on('detail_obat')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};
