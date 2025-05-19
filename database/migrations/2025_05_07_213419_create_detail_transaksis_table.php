<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onDelete('cascade');
            $table->string('nama_pabrik');
            $table->unsignedBigInteger('sortir_id');
            $table->decimal('harga_jual_per_kg', 15, 2);
            $table->decimal('total_harga_jual', 15, 2);
            $table->foreignId('supir_id')->constrained('supirs')->onDelete('cascade');
            $table->decimal('upah_supir', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksis');
    }
};
