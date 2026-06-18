<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Simpanan extends Model
{
    protected $casts = [
        'tanggal' => 'date',
    ];
    protected $table = 'simpanan';
    protected $guarded = [];
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
