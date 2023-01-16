<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BlogPost extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $kategori = ['Pendidikan', 'Kegiatan Warga Belajar', 'Esktrakulikuler', 'Kurikulum', 'Pembelajaran'];

        for ($i = 0; $i <= 25; $i++) {
            $judul_post = $faker->words(3, true);

            $data = [
                'judul_post' => $judul_post,
                'slug' => url_title($judul_post, '-', true),
                'konten_post' => $faker->paragraphs(3, true),
                'thumbnail' => 'img-default.jpg',
                'kode_kategori' => url_title($kategori[$faker->numberBetween(0, 4)], '-', true),
                'created_at' => \CodeIgniter\I18n\Time::now()
            ];

            $this->db->table('blog_post')->insert($data);
        }
    }
}
