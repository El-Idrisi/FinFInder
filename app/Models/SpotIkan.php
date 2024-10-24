<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotIkan extends Model
{
    use HasFactory;

    protected $table = 'spot_ikan';

    protected $fillable = [
        'tipe_ikan',
        'longitude',
        'latitude',
        'deskripsi',
        'status',
        'dibuat_oleh',
        'diverikasi_oleh',
        'tanggal_verifikasi',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }

    public function getFishTypes()
    {
        $fishTypeIds = json_decode($this->tipe_ikan, true);
        return FishType::whereIn('id', $fishTypeIds)->get();
    }
}
