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
        Schema::create('cicilan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')
                ->constrained('pinjaman')
                ->cascadeOnDelete();
            $table->integer('cicilan_ke');
            $table->decimal('jumlah_tagihan', 30, 0);
            $table->date('jatuh_tempo');
            $table->date('tanggal_bayar')
                ->nullable();
            $table->enum('status', [
                'belum',
                'lunas',
            ])->default('belum');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cicilan');
    }
};
