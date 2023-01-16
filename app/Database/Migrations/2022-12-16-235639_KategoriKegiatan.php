<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class KategoriKegiatan extends Migration
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
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'info_kategori' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
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
        $this->forge->createTable('kategori_kegiatan');
    }

    public function down()
    {
        $this->forge->dropTable('kategori_kegiatan');
    }
}
