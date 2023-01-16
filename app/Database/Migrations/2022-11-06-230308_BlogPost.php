<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BlogPost extends Migration
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
            'judul_post' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'konten_post' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['publish', 'draft'],
                'default'    => 'draft',
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
        $this->forge->addForeignKey('kode_kategori', 'kategori_blog', 'slug', 'SET NULL', 'SET NULL');
        $this->forge->createTable('blog_post');
    }

    public function down()
    {
        $this->forge->dropForeignKey('blog_post', 'blog_post_kode_kategori_foreign');
        $this->forge->dropTable('blog_post');
    }
}
