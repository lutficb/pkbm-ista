<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PsbModel;

class PSB extends BaseController
{
    protected $psb;

    function __construct()
    {
        $this->psb = new PsbModel();
    }

    public function index()
    {
        $query = $this->psb->findAll();

        $data = [
            'title' => 'Data Historis PSB',
            'subtitle' => 'Data Historis PSB',
            'deskripsi' => 'Halaman manajemen Data Historis PSB.',
            'peserta' => $query

        ];

        return view('admin/pesertaPsb/index', $data);
    }

    public function detailPeserta($slug)
    {
        if ($slug != null) {
            $query = $this->psb->where('slug', $slug)->first();

            $data = [
                'title' => 'Data Historis PSB',
                'subtitle' => 'Data Historis PSB',
                'deskripsi' => 'Halaman manajemen Data Historis PSB.',
                'peserta' => $query,
            ];

            return view('admin/pesertaPsb/detail-peserta', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function downloadFoto($slug)
    {
        // Ambl data peserta sesuai dngan slug yang dikirim
        $peserta = $this->psb->where('slug', $slug)->first();

        // Donwload file yang dimaksud
        return $this->response->download('assets/berkas/foto/' . $peserta->foto_peserta, null);
    }

    public function downloadAkta($slug)
    {
        // Ambl data peserta sesuai dngan slug yang dikirim
        $peserta = $this->psb->where('slug', $slug)->first();

        // Donwload file yang dimaksud
        return $this->response->download('assets/berkas/akta/' . $peserta->akta_kelahiran, null);
    }

    public function downloadKk($slug)
    {
        // Ambl data peserta sesuai dngan slug yang dikirim
        $peserta = $this->psb->where('slug', $slug)->first();

        // Donwload file yang dimaksud
        return $this->response->download('assets/berkas/kk/' . $peserta->kartu_keluarga, null);
    }

    public function downloadKip($slug)
    {
        // Ambl data peserta sesuai dngan slug yang dikirim
        $peserta = $this->psb->where('slug', $slug)->first();

        // Donwload file yang dimaksud
        return $this->response->download('assets/berkas/kip/' . $peserta->kartu_kip, null);
    }

    public function downloadPkh($slug)
    {
        // Ambl data peserta sesuai dngan slug yang dikirim
        $peserta = $this->psb->where('slug', $slug)->first();

        // Donwload file yang dimaksud
        return $this->response->download('assets/berkas/pkh/' . $peserta->kartu_pkh, null);
    }

    public function downloadNisn($slug)
    {
        // Ambl data peserta sesuai dngan slug yang dikirim
        $peserta = $this->psb->where('slug', $slug)->first();

        // Donwload file yang dimaksud
        return $this->response->download('assets/berkas/nisn/' . $peserta->kartu_nisn, null);
    }
}
