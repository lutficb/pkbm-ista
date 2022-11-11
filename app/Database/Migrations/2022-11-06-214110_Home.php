<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Home extends Migration
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
            'headline1' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'headline2' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'headline3' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'sambutan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'jml_paket_b' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'jml_paket_c' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'tutor' => [
                'type' => 'INT',
                'constraint' => 4,
            ],
            'why_us' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'judul_keunggulan1' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'keunggulan1' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'judul_keunggulan2' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'keunggulan2' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'judul_keunggulan3' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'keunggulan3' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'alamat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'phone' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('home');
    }

    public function down()
    {
        $this->forge->dropTable('home');
    }
}
