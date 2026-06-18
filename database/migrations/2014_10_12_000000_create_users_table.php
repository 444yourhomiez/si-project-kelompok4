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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_user');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->enum('role', [
                'anggota',
                'manajemen',
                'pengawas',
            ])->default('anggota');
            $table->enum('status', [
                'disetujui',
                'ditolak',
                'menunggu',
            ])->default('menunggu');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
