<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotIkan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_ikan',
        'longtitude',
        'latitude',
        'deskripsi',
        'status',
        'dibuat_oleh',
        'diverikasi_oleh',
        'tanggal_verifikasi',
    ];
}
