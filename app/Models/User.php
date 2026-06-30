<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama_user',
        'email',
        'email_verified_at',
        'password',
        'role',
        'status',
        'foto_profile',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFotoUrlAttribute(): string
    {
        if (! $this->foto_profile) {
            return asset('adminlte3/dist/img/user2-160x160.jpg');
        }
        if (str_starts_with($this->foto_profile, 'data:')) {
            return $this->foto_profile;
        }
        $disk = config('filesystems.default') === 's3' ? 's3' : 'public';
        return Storage::disk($disk)->url($this->foto_profile);
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'user_id');
    }
}
