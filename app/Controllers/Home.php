<?php

namespace App\Controllers;

class Home extends BaseController
{
    function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {
        $query = $this->db->table('home')->get()->getRow();

        if (count((array)$query) > 0) {
            $data = [
                'title' => 'Halaman Utama',
                'home' => $query,
            ];

            return view('home/home', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function about()
    {
        $data = [
            'title' => 'Tentang Lembaga'
        ];

        return view('home/about', $data);
    }

    public function visiMisi()
    {
        $data = [
            'title' => 'Visi dan Misi Lembaga'
        ];

        return view('home/visimisi', $data);
    }

    public function legalitas()
    {
        $data = [
            'title' => 'Legalitas Lembaga'
        ];

        return view('home/legalitas', $data);
    }

    public function sarpras()
    {
        $data = [
            'title' => 'Sarana dan Prasarana'
        ];

        return view('home/sarpras', $data);
    }

    public function paketc()
    {
        $data = [
            'title' => 'Kesetaraan Paket C'
        ];

        return view('home/paketc', $data);
    }

    public function paketb()
    {
        $data = [
            'title' => 'Kesetaraan Paket B'
        ];

        return view('home/paketb', $data);
    }

    public function tutor()
    {
        $data = [
            'title' => 'Tutor dan Staff'
        ];

        return view('home/tutor', $data);
    }

    public function berita()
    {
        $data = [
            'title' => 'Berita Terbaru'
        ];

        return view('home/berita', $data);
    }

    public function ppdb()
    {
        $data = [
            'title' => 'Penerimaan Peserta Didik Baru'
        ];

        return view('home/ppdb', $data);
    }

    public function kontak()
    {
        $data = [
            'title' => 'Kontak Kami'
        ];

        return view('home/kontak', $data);
    }

    public function dashboard()
    {
        $builder = $this->db->table('home');
        $query = $builder->get()->getRowArray();

        $nama_konten = ['Headline 1', 'Headline 2', 'Headline 3', 'Sambutan Kepala PKBM', 'Jumlah Warga Belajar Paket B', 'Jumlah Warga Belajar Paket C', 'Jumlah Tutor', 'Why Us?', 'Judul Keunggulan 1', 'Keunggulan 1', 'Judul Keunggulan 2', 'Keunggulan 2', 'Judul Keunggulan 3', 'Keunggulan 3', 'Alamat PKB', 'Nomor Telp. PKBM', 'Email PKBM'];

        $isi_konten = ['headline1', 'headline2', 'headline3', 'sambutan', 'jml_paket_b', 'jml_paket_c', 'tutor', 'why_us', 'judul_keunggulan1', 'keunggulan1', 'judul_keunggulan2', 'keunggulan2', 'judul_keunggulan3', 'keunggulan3', 'alamat', 'phone', 'email'];

        $num_array = count($nama_konten);

        if (count($query) > 0) {
            $data = [
                'title' => 'Dashboard',
                'home' => $query,
                'nama_konten' => $nama_konten,
                'isi_konten' => $isi_konten,
                'num' => $num_array,
            ];

            return view('admin/dashboard', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function edit($id = null)
    {
        $builder = $this->db->table('home');
        $query = $builder->where('id', $id)->get()->getRow();

        if (count((array)$query) > 0) {

            $data = [
                'title' => 'Edit Dashboard',
                'home' => $query,
            ];

            return view('admin/edit-dashboard', $data);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id = null)
    {
        $dataForm = $this->request->getPost();

        $data = [
            'headline1' => $dataForm['headline1'],
            'headline2' => $dataForm['headline2'],
            'headline3' => $dataForm['headline3'],
            'sambutan' => $dataForm['sambutan'],
            'jml_paket_b' => $dataForm['jml_paket_b'],
            'jml_paket_c' => $dataForm['jml_paket_c'],
            'why_us' => $dataForm['why_us'],
            'alamat' => $dataForm['alamat'],
            'phone' => $dataForm['phone'],
            'email' => $dataForm['email'],
        ];

        $this->db->table('home')->where('id', $id)->update($data);

        return redirect()->to('dashboard');
    }

    public function pageNotFound()
    {
        $data = [
            'title' => 'Halaman tidak ditemukan'
        ];

        return view('home/404.php');
    }
}
