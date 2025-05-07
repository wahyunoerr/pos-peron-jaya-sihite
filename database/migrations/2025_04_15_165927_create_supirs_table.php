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
        Schema::create('supirs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('fotoSupir', 100);
            $table->string('noTelp', 13);
            $table->string('alamat', 100);
            $table->enum('status', ['aktif', 'tidak aktif']);

            $table->foreignId('truk_id')->nullable()->constrained('truks')->onDelete('set null')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supirs');
    }
};
