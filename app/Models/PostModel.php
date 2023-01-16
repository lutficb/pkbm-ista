<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'blog_post';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['judul_post', 'slug', 'konten_post', 'thumbnail', 'status', 'kode_kategori'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function getAll($num, $keyword = null)
    {
        $builder = $this->builder();
        $builder->select('blog_post.id AS id, blog_post.judul_post AS judul, kategori_blog.nama_kategori AS kategori, blog_post.thumbnail AS thumbnail, blog_post.konten_post AS isi, blog_post.created_at AS created_at, blog_post.status AS status');
        $builder->join('kategori_blog', 'kategori_blog.slug = blog_post.kode_kategori');

        if ($keyword != '') {
            $builder->like('judul_post', $keyword)->orLike('nama_kategori', $keyword);
        }

        $builder->orderBy('blog_post.created_at', 'DESC');

        return [
            'post' => $this->paginate($num),
            'pager' => $this->pager,
        ];
    }
}
