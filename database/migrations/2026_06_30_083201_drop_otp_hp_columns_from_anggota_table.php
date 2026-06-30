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
        Schema::table('anggota', function (Blueprint $table) {
            $table->dropColumn(['otp_hp', 'otp_hp_expires_at', 'no_hp_verified_at']);
        });
    }

    public function down(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $table->string('otp_hp')->nullable()->after('no_hp');
            $table->timestamp('otp_hp_expires_at')->nullable()->after('otp_hp');
            $table->timestamp('no_hp_verified_at')->nullable()->after('otp_hp_expires_at');
        });
    }
};
