<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $guarded = [];
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
    public function getTanggalDaftarFormatAttribute()
    {
        return Carbon::parse($this->tanggal_daftar)
            ->format('d M Y');
    }
    public function getTanggalDaftarHumanAttribute()
    {
        return Carbon::parse($this->tanggal_daftar)
            ->diffForHumans();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jadwal()
    {
        return $this->belongsTo(JadwalWawancara::class, 'jadwal_id');
    }
    public function simpanan()
    {
        return $this->hasMany(Simpanan::class);
    }
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
    public function cicilan()
    {
        return $this->hasManyThrough(
            \App\Models\Cicilan::class,
            \App\Models\Pinjaman::class
        );
    }
}
