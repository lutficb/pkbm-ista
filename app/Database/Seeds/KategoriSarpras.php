<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriSarpras extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kategori = ['Ruang Kelas', 'Asrama', 'Olahraga', 'Ekstrakulikuler', 'Masjid'];

        for ($i = 0; $i <= 4; $i++) {
            $data = [
                'slug' => url_title($kategori[$i], '-', true),
                'nama_kategori' => $kategori[$i],
                'info_kategori' => $faker->paragraphs(3, true),
                'thumbnail' => 'img-default.jpg',
                'created_at' => \CodeIgniter\I18n\Time::now()
            ];

            $this->db->table('kategori_sarpras')->insert($data);
        }
    }
}
