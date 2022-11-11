<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlogPost extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 15; $i++) {
            $data = [
                'judul_post' => $faker->words(3, true),
                'konten_post' => $faker->paragraphs(3, true),
                'excerpt' => $faker->paragraph(),
                'thumbnail' => $faker->imageUrl(640, 480, null, true),
                'id_kategori' => $faker->numberBetween(1, 5),
                'created_at' => \CodeIgniter\I18n\Time::now()
            ];

            $this->db->table('blog_post')->insert($data);
        }
    }
}
