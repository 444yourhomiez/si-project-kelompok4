<?php
namespace Database\Seeders;
use App\Models\JadwalWawancara;
use Illuminate\Database\Seeder;
class JadwalWawancaraSeeder extends Seeder
{
    public function run()
    {
        $jam = [
            '09:00 - 10:00',
            '10:00 - 11:00',
            '11:00 - 12:00',
            '13:00 - 14:00',
        ];
        for ($i = 1; $i <= 7; $i++) {
            $tanggal = now()->addDays($i)->format('Y-m-d');
            // skip hari minggu 🔥
            if (date('w', strtotime($tanggal)) == 0) {
                continue;
            }
            foreach ($jam as $j) {
                JadwalWawancara::create([
                    'tanggal' => $tanggal,
                    'waktu' => $j,
                    'kuota' => 5,
                ]);
            }
        }
    }
}
