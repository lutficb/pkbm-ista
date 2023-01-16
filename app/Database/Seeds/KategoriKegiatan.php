<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriKegiatan extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kategori = ['Kunjungan', 'Kegiatan Warga Belajar', 'Esktrakulikuler', 'Kegiatan Sosial', 'Pembelajaran'];

        for ($i = 0; $i <= 4; $i++) {
            $data = [
                'slug' => url_title($kategori[$i], '-', true),
                'nama_kategori' => $kategori[$i],
                'info_kategori' => $faker->paragraph(),
                'thumbnail' => 'img-default.jpg',
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];

            $this->db->table('kategori_kegiatan')->insert($data);
        }
    }
}
