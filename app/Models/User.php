<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'nama',
        'no_telp',
        'alamat',
        'tanggal_lahir',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    // Di dalam model User
    public function findForPassport($username)
    {
        return $this->where('email', $username)->orWhere('username', $username)->first();
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function owner()
    {
        return $this->hasMany(SpotIkan::class, 'dibuat_oleh');
    }
    public function verificator()
    {
        return $this->hasMany(SpotIkan::class, 'diverifikasi_oleh');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function countVerif()
    {
        return $this->owner()->where('status', 'disetujui')->count();
    }
}
