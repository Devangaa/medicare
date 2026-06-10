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
        Schema::create('pembuangan_obat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_detail_obat');
            $table->unsignedInteger('jumlah');
            $table->string('status')->default('pending');
            $table->date('tanggal_pembuangan');
            $table->unsignedBigInteger('id_akun');
            $table->timestamps();

            $table->foreign('id_detail_obat')->references('id')->on('detail_obat')->onDelete('cascade');
            $table->foreign('id_akun')->references('id')->on('akun')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembuangan_obat');
    }
};
