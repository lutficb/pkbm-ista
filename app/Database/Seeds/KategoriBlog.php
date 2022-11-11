<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriBlog extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 5; $i++) {
            $data = [
                'nama_kategori' => $faker->words(2, true),
                'info_kategori' => $faker->paragraph(),
                'thumbnail' => $faker->imageUrl(640, 480, null, true),
                'created_at' => \CodeIgniter\I18n\Time::now(),
            ];

            $this->db->table('kategori_blog')->insert($data);
        }
    }
}
