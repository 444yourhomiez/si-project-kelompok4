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
        Schema::create('jadwal_wawancara', function (Blueprint $table) {
            $table->id();

            $table->date('tanggal');
            $table->string('waktu');

            $table->integer('kuota')->default(5);
            $table->integer('terisi')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_wawancara');
    }
};
