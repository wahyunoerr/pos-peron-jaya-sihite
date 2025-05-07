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
        Schema::create('sortirs', function (Blueprint $table) {
            $table->id();
            $table->string('timbang_masuk', 100);
            $table->string('timbang_keluar', 100);
            $table->string('berat_kotor', 100);
            $table->enum('status', ['bagus', 'jelek']);
            $table->string('jangkos', 255)->nullable();
            $table->decimal('harga', 10, 2);
            $table->string('timbangan_bersih', 255);

            $table->foreignId('presentase_id')->constrained('presentases')->onDelete('cascade');
            $table->foreignId('penjual_id')->constrained('penjuals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sortirs');
    }
};
