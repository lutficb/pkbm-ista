<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Run extends Seeder
{
    public function run()
    {
        $this->call('Home');
        $this->call('KategoriBlog');
        $this->call('BlogPost');
        $this->call('KategoriSarpras');
        $this->call('Sarpras');
        $this->call('Pages');
        $this->call('KategoriKegiatan');
        $this->call('KegiatanSiswa');
    }
}
