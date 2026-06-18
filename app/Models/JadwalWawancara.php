<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class JadwalWawancara extends Model
{
    protected $table = 'jadwal_wawancara';
    protected $guarded = [];
    protected $fillable = ['tanggal', 'waktu', 'kuota', 'terisi'];
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'jadwal_id');
    }
}
