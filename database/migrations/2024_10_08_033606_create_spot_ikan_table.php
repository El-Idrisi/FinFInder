<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('spot_ikan', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_ikan');
            $table->decimal('longitude', 10, 8);
            $table->decimal('latitude', 10, 8);
            $table->text('deskripsi');
            $table->enum('status', ['ditunda', 'disetujui', 'ditolak']);
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->foreignId('diverifikasi_oleh')->constrained('users')->onDelete('cascade');
            $table->date("tanggal_verifikasi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spot_ikan');
    }
};
