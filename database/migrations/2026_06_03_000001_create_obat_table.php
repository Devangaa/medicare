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
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->string('kode_obat')->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 12, 2);
            $table->text('foto_obat')->nullable();
            $table->decimal('berat', 10, 2);
            $table->string('kategori');
            $table->unsignedInteger('total_terjual')->default(0);
            $table->string('unit_satuan');
            $table->string('status');
            $table->boolean('is_delete')->default(false);
            $table->unsignedBigInteger('id_akun')->nullable();
            $table->timestamps();

            $table->foreign('id_akun')->references('id')->on('akun')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
