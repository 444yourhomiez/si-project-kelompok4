<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pinjaman extends Model
{
    protected $table = 'pinjaman';
    protected $casts = [
        'tanggal_pengajuan'   => 'date',
        'tanggal_persetujuan' => 'date',
    ];
    protected $fillable = [
        'anggota_id',
        'kode_pinjaman',
        'jenis_pinjaman',
        'jumlah_pengajuan',
        'jumlah_disetujui',
        'total_simpanan',
        'bunga',
        'provisi',
        'kapitalisasi',
        'dana_perlindungan',
        'dana_diterima',
        'tenor',
        'cicilan_per_bulan',
        'total_pembayaran',
        'tujuan_pinjaman',
        'jaminan',
        'status',
        'tanggal_pengajuan',
        'tanggal_persetujuan',
        'catatan',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($pinjaman) {
            $last = self::count() + 1;
            $pinjaman->kode_pinjaman =
                'PJM-'.str_pad($last, 5, '0', STR_PAD_LEFT);
        });
    }
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
    public function cicilan()
    {
        return $this->hasMany(Cicilan::class);
    }
}
