<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cicilan extends Model
{
    protected $table = 'cicilan';
    protected $guarded = [];
    protected $casts = [
        'tanggal_bayar' => 'date',
        'jatuh_tempo'   => 'date',
    ];
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
