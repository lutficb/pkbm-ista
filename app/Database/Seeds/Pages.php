<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Pages extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        $pages = ['Tentang Lembaga', 'Visi & Misi', 'Legalitas Lembaga', 'Program Paket B', 'Program Paket C', 'Tutor & Staff', 'PPDB'];

        for ($i = 1; $i <= 7; $i++) {
            $data = [
                'judul_halaman' => $pages[$i - 1],
                'isi_halaman' => $faker->paragraphs(3, true),
                'thumbnail' => 'img-default.jpg',
                'created_at' => \CodeIgniter\I18n\Time::now()
            ];

            $this->db->table('pages')->insert($data);
        }
    }
}
