<?php

namespace App\Models;

use CodeIgniter\Model;

class SarprasModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'sarpras';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['judul_gambar', 'info_gambar', 'gambar', 'kode_kategori'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
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
        $builder->select('sarpras.id AS id, sarpras.judul_gambar AS judul, kategori_sarpras.nama_kategori AS kategori, sarpras.info_gambar AS info, sarpras.gambar AS gambar, sarpras.created_at AS created_at');
        $builder->join('kategori_sarpras', 'kategori_sarpras.slug = sarpras.kode_kategori');

        if ($keyword != '') {
            $builder->like('judul_gambar', $keyword)->orLike('nama_kategori', $keyword);
        }

        $builder->orderBy('sarpras.created_at', 'DESC');

        return [
            'sarpras' => $this->paginate($num),
            'pager' => $this->pager,
        ];
    }
}
