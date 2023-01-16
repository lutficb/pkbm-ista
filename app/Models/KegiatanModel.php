<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    // protected $DBGroup          = 'default';
    protected $table            = 'kegiatan_siswa';
    protected $primaryKey       = 'id';
    // protected $useAutoIncrement = true;
    // protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    // protected $protectFields    = true;
    protected $allowedFields    = ['nama_kegiatan', 'slug', 'info_kegiatan', 'gambar', 'kode_kategori'];

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
        $builder->select('kegiatan_siswa.id AS id, kegiatan_siswa.nama_kegiatan AS nama, kategori_kegiatan.nama_kategori AS kategori, kegiatan_siswa.info_kegiatan AS info, kegiatan_siswa.gambar AS gambar, kegiatan_siswa.created_at AS created_at');
        $builder->join('kategori_kegiatan', 'kategori_kegiatan.slug = kegiatan_siswa.kode_kategori');

        if ($keyword != '') {
            $builder->like('nama_kegiatan', $keyword)->orLike('nama_kategori', $keyword);
        }

        $builder->orderBy('kegiatan_siswa.created_at', 'DESC');

        return [
            'kegiatan' => $this->paginate($num),
            'pager' => $this->pager,
        ];
    }
}
