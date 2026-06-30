<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Cicilan extends Model
{
    protected $table = 'cicilan';
    protected $guarded = [];
    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
