<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_kerusakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('detail_transaksi_id')->constrained('detail_transaksis')->onDelete('cascade');
            $table->string('nama_kerusakan')->nullable();
            $table->decimal('biaya_kerusakan', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_kerusakans');
    }
};
