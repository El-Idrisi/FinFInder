<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FishType extends Model
{
    use HasFactory;

    protected $table = 'fish_type';

    protected $fillable = ['nama'];

    public function hitungSpotIkan() {
        $jumlahTitik = SpotIkan::whereJsonContains('tipe_ikan', $this->id)
        ->orWhereRaw('JSON_CONTAINS(tipe_ikan, ?)', '"' . $this->id . '"')
        ->count();

        return $jumlahTitik;
    }
    public function hitungSpotIkanTerverifikasi() {
        $jumlahTitik = SpotIkan::where('status', 'disetujui')
        ->whereJsonContains('tipe_ikan', $this->id)
        ->orWhereRaw('JSON_CONTAINS(tipe_ikan, ?)', '"' . $this->id . '"')
        ->count();

        return $jumlahTitik;
    }
}
