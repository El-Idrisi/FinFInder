<?php

namespace Database\Factories;

use App\Models\FishType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpotIkan>
 */
class SpotIkanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pastikan ada user role 'user'
        $user = User::where('role', 'nelayan')->first();
        // if (!$user) {
        //     $user = User::factory()->create(['role' => 'user']);
        // }

        // Pastikan ada admin
        $admin = User::where('role', 'admin')->first();
        // if (!$admin) {
        //     $admin = User::factory()->create(['role' => 'admin']);
        // }

        // Ambil random 1-3 jenis ikan
        $fishTypeIds = FishType::pluck('id')->toArray();
        $selectedFishTypes = json_encode($this->faker->randomElements(
            $fishTypeIds,
            $this->faker->numberBetween(1, 5)
        ));

        // Status random
        $status = $this->faker->randomElement(['ditunda', 'disetujui', 'ditolak']);

        // Verifikator dan tanggal verifikasi berdasarkan status
        $verifikator = null;
        $tanggalVerifikasi = null;
        if ($status !== 'ditunda') {
            $verifikator = $admin->id;
            $tanggalVerifikasi = $this->faker->dateTimeBetween('-1 week', 'now');
        }

        return [
            'tipe_ikan' => $selectedFishTypes,
            'longitude' => $this->faker->longitude(102.0, 102.5),
            'latitude' => $this->faker->latitude(1.3, 1.5),
            'deskripsi' => $this->faker->paragraph(),
            'status' => $status,
            'created_at' => $this->faker->dateTimeBetween('-5 months', 'now'),
            'dibuat_oleh' => $user->id,
            'diverifikasi_oleh' => $verifikator,
            'tanggal_verifikasi' => $tanggalVerifikasi
        ];
    }

    public function ditunda()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'ditunda',
                'diverifikasi_oleh' => null,
                'tanggal_verifikasi' => null
            ];
        });
    }

    public function disetujui()
    {
        $admin = User::where('role', 'admin')->first();

        return $this->state(function (array $attributes) use ($admin) {
            return [
                'status' => 'disetujui',
                'diverifikasi_oleh' => $admin->id,
                'tanggal_verifikasi' => $this->faker->dateTimeBetween('-1 week', 'now')
            ];
        });
    }

    public function ditolak()
    {
        $admin = User::where('role', 'admin')->first();

        return $this->state(function (array $attributes) use ($admin) {
            return [
                'status' => 'ditolak',
                'diverifikasi_oleh' => $admin->id,
                'tanggal_verifikasi' => $this->faker->dateTimeBetween('-1 week', 'now')
            ];
        });
    }
}
