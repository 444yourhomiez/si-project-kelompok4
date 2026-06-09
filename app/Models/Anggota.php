<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $guarded = [];
    protected $casts = [

        'tanggal_lahir' => 'date',

    ];

    public function getTanggalDaftarFormatAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_daftar)
            ->format('d M Y');
    }

    public function getTanggalDaftarHumanAttribute()
    {
        return \Carbon\Carbon::parse($this->tanggal_daftar)
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
}
