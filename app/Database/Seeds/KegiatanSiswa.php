<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KegiatanSiswa extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kategori = ['Kunjungan', 'Kegiatan Warga Belajar', 'Esktrakulikuler', 'Kegiatan Sosial', 'Pembelajaran'];

        for ($i = 0; $i <= 24; $i++) {
            $judul_sarpras = $faker->words(3, true);

            $data = [
                'nama_kegiatan' => $judul_sarpras,
                'slug' => url_title($judul_sarpras, '-', true),
                'info_kegiatan' => $faker->paragraph(),
                'gambar' => 'img-default.jpg',
                'kode_kategori' => url_title($kategori[$faker->numberBetween(0, 4)], '-', true),
                'created_at' => \CodeIgniter\I18n\Time::now()
            ];

            $this->db->table('kegiatan_siswa')->insert($data);
        }
    }
}
