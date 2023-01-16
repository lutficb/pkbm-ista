<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Sarpras extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kategori = ['Ruang Kelas', 'Asrama', 'Olahraga', 'Ekstrakulikuler', 'Masjid'];

        for ($i = 0; $i <= 24; $i++) {
            $judul_sarpras = $faker->words(3, true);

            $data = [
                'judul_gambar' => $judul_sarpras,
                'slug' => url_title($judul_sarpras, '-', true),
                'info_gambar' => $faker->paragraph(),
                'gambar' => 'img-default.jpg',
                'kode_kategori' => url_title($kategori[$faker->numberBetween(0, 4)], '-', true),
                'created_at' => \CodeIgniter\I18n\Time::now()
            ];

            $this->db->table('sarpras')->insert($data);
        }
    }
}
