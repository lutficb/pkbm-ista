<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KegiatanSiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kegiatan' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'info_kegiatan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'gambar' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'kode_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kode_kategori', 'kategori_kegiatan', 'slug', 'SET NULL', 'SET NULL');
        $this->forge->createTable('kegiatan_siswa');
    }

    public function down()
    {
        $this->forge->dropForeignKey('kegiatan_siswa', 'kegiatan_siswa_kode_kategori_foreign');
        $this->forge->dropTable('kegiatan_siswa');
    }
}
