<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapHarian extends Model
{
    protected $table = 'rekap_harian';

    protected $fillable = [
        'user_id',
        'jenis',
        'nominal',
        'keterangan',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
