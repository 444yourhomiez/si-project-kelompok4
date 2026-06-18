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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwal_wawancara')->nullOnDelete();
            // DATA UTAMA
            $table->string('kode_anggota')->nullable();
            $table->string('nama_anggota');
            $table->string('no_ktp')->unique();
            $table->string('no_hp')->unique();
            $table->text('alamat');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', [
                'Islam',
                'Kristen',
                'Katolik',
                'Hindu',
                'Buddha',
                'Konghucu',
                'Lainnya',
            ]);
            $table->string('nama_ibu_kandung');
            $table->string('nama_ahli_waris');
            $table->enum('hubungan_ahli_waris', [
                'Ayah',
                'Ibu',
                'Suami',
                'Istri',
                'Anak',
                'Saudara Kandung',
                'Kakek',
                'Nenek',
                'Paman',
                'Bibi',
                'Lainnya',
            ]);
            $table->enum('status_rumah', [
                'Milik Sendiri',
                'Milik Keluarga',
                'Milik Perusahaan',
                'Sewa',
            ]);
            $table->enum('penghasilan', [
                'Dibawah Rp 500.000',
                'Rp 500.000 - Rp. 1.000.000',
                'Rp 1.000.000 - Rp. 2.000.000',
                'Rp 2.000.000 - Rp. 3.000.000',
                'Rp 3.000.000 - Rp. 4.000.000',
                'Rp 4.000.000 - Rp. 5.000.000',
                'Diatas Rp 5.000.000',
            ]);
            // 🔥 TAMBAHAN (yang tadi belum kepakai)
            $table->date('tanggal_kawin')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->date('tanggal_daftar')->default(now());
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
