<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShuTahunan extends Model
{
    protected $table = 'shu_tahunan';

    protected $fillable = ['tahun', 'nilai_shu', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
