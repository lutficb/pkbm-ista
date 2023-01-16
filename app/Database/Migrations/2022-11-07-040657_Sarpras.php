<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sarpras extends Migration
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
            'judul_gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'info_gambar' => [
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
        $this->forge->addForeignKey('kode_kategori', 'kategori_sarpras', 'slug', 'SET NULL', 'SET NULL');
        $this->forge->createTable('sarpras');
    }

    public function down()
    {
        $this->forge->dropForeignKey('sarpras', 'sarpras_kode_kategori_foreign');
        $this->forge->dropTable('sarpras');
    }
}
