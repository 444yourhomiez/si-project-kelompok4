<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shu_tahunan', function (Blueprint $table) {
            $table->id();
            $table->year('tahun')->unique();
            $table->decimal('nilai_shu', 30, 0);
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shu_tahunan');
    }
};
