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
        Schema::create('detail_obat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obat');
            $table->string('batch');
            $table->unsignedInteger('jumlah_stok');
            $table->date('tanggal_kadaluwarsa');
            $table->timestamps();

            $table->foreign('id_obat')->references('id')->on('obat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_obat');
    }
};
