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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')
                ->constrained('anggota')
                ->cascadeOnDelete();
            $table->string('kode_pinjaman')->unique();
            $table->decimal('total_simpanan', 30, 0)->default(0);
            $table->enum('jenis_pinjaman', [
                'biasa',
                'khusus',
            ])->nullable();
            $table->decimal('jumlah_pengajuan', 30, 0);
            $table->decimal('jumlah_disetujui', 30, 0)
                ->nullable();
            $table->integer('tenor')->default(6);
            $table->decimal('bunga', 5, 2)
                ->default(1);
            $table->decimal('provisi', 30, 0)
                ->default(0);
            $table->decimal('kapitalisasi', 30, 0)
                ->default(0);
            $table->decimal('dana_perlindungan', 30, 0)
                ->default(0);
            $table->decimal('dana_diterima', 30, 0)
                ->default(0);
            $table->decimal('cicilan_per_bulan', 30, 0);
            $table->decimal(
                'total_pembayaran',
                30,
                0
            )->default(0);
            $table->enum('jenis_bunga', [
                'flat',
                'menurun',
            ])->default('flat');
            $table->decimal('biaya_admin', 30, 0)
                ->default(0);
            $table->decimal('jumlah_cair', 30, 0)
                ->nullable();
            $table->text('tujuan_pinjaman');
            $table->string('jaminan')
                ->nullable();
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_persetujuan')
                ->nullable();
            $table->enum('status', [
                'pending',
                'ditunda',
                'ditolak',
                'disetujui',
                'aktif',
                'lunas',
            ])->default('pending');
            $table->text('catatan')
                ->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamans');
    }
};
