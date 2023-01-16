<?php

namespace App\Controllers;

use App\Models\PostModel;
use App\Models\KategoriSarprasModel;
use App\Models\SarprasModel;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;

class Home extends BaseController
{
    function __construct()
    {
        $this->db = db_connect();
        $this->posts = new PostModel();
        $this->kategoriSarpras = new KategoriSarprasModel();
        $this->sarpras = new SarprasModel();
        $this->kategoriKegiatan = new KategoriKegiatanModel();
        $this->kegiatan = new KegiatanModel();
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
        $query = $this->db->table('pages')->get()->getResult();
        $dataAbout = $query[0];

        $data = [
            'title' => 'Tentang Lembaga',
            'about' => $dataAbout,
        ];

        return view('home/about', $data);
    }

    public function visiMisi()
    {
        $query = $this->db->table('pages')->get()->getResult();
        $dataVisi = $query[1];

        $data = [
            'title' => 'Visi dan Misi Lembaga',
            'visi' => $dataVisi,
        ];

        return view('home/visimisi', $data);
    }

    public function legalitas()
    {
        $query = $this->db->table('pages')->get()->getResult();
        $dataLegalitas = $query[2];

        $data = [
            'title' => 'Legalitas Lembaga',
            'legalitas' => $dataLegalitas,
        ];

        return view('home/legalitas', $data);
    }

    public function sarpras()
    {
        $query = $this->kategoriSarpras->findAll();

        $data = [
            'title' => 'Sarana dan Prasarana',
            'sarpras' => $query,
        ];

        return view('home/sarpras', $data);
    }

    public function detailSarpras($kategori)
    {
        $query = $this->sarpras
            ->select('sarpras.gambar AS gambar, kategori_sarpras.nama_kategori AS kategori, sarpras.info_gambar AS info')
            ->join('kategori_sarpras', 'kategori_sarpras.slug = sarpras.kode_kategori')
            ->where('sarpras.kode_kategori', $kategori)
            ->findAll();

        $kategori = $this->kategoriSarpras->where('slug', $kategori)->first();

        $data = [
            'title' => 'Sarana dan Prasarana',
            'sarpras' => $query,
            'kategori' => $kategori->nama_kategori,
        ];

        return view('home/galeri-sarpras', $data);
    }

    public function kegiatan()
    {
        $query = $this->kategoriKegiatan->findAll();

        $data = [
            'title' => 'Kegiatan Siswa',
            'kegiatan' => $query,
        ];

        return view('home/kegiatan', $data);
    }

    public function galeriKegiatan($kategori)
    {
        $query = $this->kegiatan
            ->select('kegiatan_siswa.gambar AS gambar, kategori_kegiatan.nama_kategori AS kategori, kegiatan_siswa.info_kegiatan AS info')
            ->join('kategori_kegiatan', 'kategori_kegiatan.slug = kegiatan_siswa.kode_kategori')
            ->where('kegiatan_siswa.kode_kategori', $kategori)
            ->findAll();

        $kategori = $this->kategoriKegiatan->where('slug', $kategori)->first();

        $data = [
            'title' => 'Galeri Kegiatan Siswa',
            'kegiatan' => $query,
            'kategori' => $kategori->nama_kategori,
        ];

        return view('home/galeri-kegiatan', $data);
    }

    public function paketc()
    {
        $query = $this->db->table('pages')->get()->getResult();
        $paketc = $query[4];

        $data = [
            'title' => 'Kesetaraan Paket C',
            'paketc' => $paketc
        ];

        return view('home/paketc', $data);
    }

    public function paketb()
    {
        $query = $this->db->table('pages')->get()->getResult();
        $paketb = $query[3];

        $data = [
            'title' => 'Kesetaraan Paket B',
            'paketb' => $paketb
        ];

        return view('home/paketb', $data);
    }

    public function tutor()
    {
        $query = $this->db->table('pages')->get()->getResult();
        $tutor = $query[5];

        $data = [
            'title' => 'Tutor dan Staff',
            'tutor' => $tutor
        ];

        return view('home/tutor', $data);
    }

    public function berita($slug = null)
    {
        if ($slug != null) {
            // Ambil semua post
            $allPost = $this->allPost();
            $query = $this->postWithSlug($slug);

            $data = [
                'title' => 'Berita Terbaru',
                'post' => $query,
            ];

            // membuat array khusus slug untuk dapat indexnya
            $arraySlug = array();
            foreach ($allPost as $k => $v) {
                $arraySlug[] = $v->slug;
            }

            $index_post = array_search($slug, $arraySlug);
            // Find index after and before
            $prev = $index_post - 1;
            $next = $index_post + 1;

            ($prev < 0) ? $data['postPrev'] = null : $data['postPrev'] = $this->postWithSlug($arraySlug[$prev]);

            ($next >= count($arraySlug)) ? $data['postNext'] = null : $data['postNext'] = $this->postWithSlug($arraySlug[$next]);

            return view('home/detail-berita', $data);
        } else {
            $query = $this->allPost();

            $data = [
                'title' => 'Berita Terbaru',
                'post' => $query,
            ];

            return view('home/berita', $data);
        }
    }

    public function ppdb()
    {
        $query = $this->db->table('pages')->get()->getResult();
        $ppdb = $query[6];

        $data = [
            'title' => 'Penerimaan Peserta Didik Baru',
            'ppdb' => $ppdb,
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

        if (count((array)$query) > 0) {
            $data = [
                'title' => 'Dashboard',
                'subtitle' => 'Dashboard',
                'deskripsi' => 'Pengaturan konten-konten yang muncul di halaman utama website.',
                'home' => $query,
                'nama_konten' => $nama_konten,
                'isi_konten' => $isi_konten,
                'num' => $num_array,
            ];

            return view('admin/dashboard', $data);
        } else {
            $data = [
                'title' => 'Dashboard',
                'subtitle' => 'Dashboard',
                'deskripsi' => 'Pengaturan konten-konten yang muncul di halaman utama website.',
                'pesan' => 'Belum ada data ditemukan'
            ];

            return view('admin/dashboard-blank', $data);
        }
    }

    public function edit($id = null)
    {
        $builder = $this->db->table('home');
        $query = $builder->where('id', $id)->get()->getRow();

        if (count((array)$query) > 0) {

            $data = [
                'title' => 'Edit Dashboard',
                'subtitle' => 'Edit Dashboard',
                'deskripsi' => 'Pengaturan konten-konten yang muncul di halaman utama website.',
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

        if ($this->db->affectedRows() > 0) {
            session()->setFlashdata('success', 'Data berhasil diperbaharui');

            return redirect()->to('dashboard');
        } else {
            session()->setFlashdata('error', 'Data gagal diperbaharui');

            return redirect()->to('dashboard');
        }
    }

    public function pageNotFound()
    {
        $data = [
            'title' => 'Halaman tidak ditemukan'
        ];

        return view('home/404.php');
    }

    public function pages()
    {
        $builder = $this->db->table('pages');
        $query = $builder->get()->getResult();

        if (count((array)$query) > 0) {
            $data = [
                'title' => 'Pages',
                'subtitle' => 'Pages',
                'deskripsi' => 'Daftar halaman - halaman utama seperti : tentang lembaga, Visi dan Misi serta lainnya.',
                'pages' => $query
            ];

            return view('admin/pages', $data);
        } else {
            $data = [
                'title' => 'Pages',
                'subtitle' => 'Pages',
                'deskripsi' => 'Daftar halaman - halaman utama seperti : tentang lembaga, Visi dan Misi serta lainnya.',
                'pesan' => 'Belum ada data ditemukan'
            ];

            return view('admin/pages-blank', $data);
        }
    }

    public function editPages($id = null)
    {
        if ($id != null) {
            $builder = $this->db->table('pages');
            $query = $builder->where('id', $id)->get()->getRow();

            if (count((array)$query) > 0) {
                $data = [
                    'title' => 'Edit Pages',
                    'subtitle' => 'Edit Pages',
                    'deskripsi' => 'Perbaharui detail dari halaman (Judul, Thumbnail dan Isi halaman).',
                    'page' => $query,
                ];

                return view('admin/edit-pages', $data);
            } else {
                $data = [
                    'title' => 'Edit Pages',
                    'subtitle' => 'Edit Pages',
                    'deskripsi' => 'Perbaharui detail dari halaman (Judul, Thumbnail dan Isi halaman).',
                    'pesan' => 'Data yang ada cari tidak ditemukan',
                ];

                return view('admin/edit-pages-blank', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function updatePages($id = null)
    {
        $dataForm = $this->request->getPost();
        $file = $this->request->getFile('thumbnail');
        $fileLama = $dataForm['file-lama'];
        $namaThumbnail = '';

        if (!$file->isValid()) {
            $namaThumbnail = $fileLama;
        } else {
            if ($fileLama != 'img-default.jpg') {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru
                $file->move('assets/img/img-pages/', $namaThumbnail);

                // Hapus file lama
                unlink('assets/img/img-pages/' . $fileLama);
            } else {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru
                $file->move('assets/img/img-pages/', $namaThumbnail);
            }
        }

        $data = [
            'thumbnail' => $namaThumbnail,
            'isi_halaman' => $dataForm['isi_halaman'],
        ];

        $this->db->table('pages')->where('id', $id)->update($data);

        // Cek apakah data berhasil diupdate?
        if ($this->db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Data berhasil diperbaharui');

            // Kembali ke halaman pages
            return redirect()->to('pages');
        } else {
            if ($namaThumbnail != $fileLama) {
                // Hapus file yang telah diupload
                unlink('assets/img/img-pages/' . $namaThumbnail);
            }

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Data gagal diperbaharui');

            // Kembali ke halaman pages
            return redirect()->to('pages');
        }
    }

    public function uploadImgArticle()
    {
        $img = $this->request->getFile('img');
        $namaFile = $img->getRandomName();

        $image = \Config\Services::image();
        $image->withFile($img)
            ->resize(400, 266, true, 'width')
            ->save('assets/img/img-article/' . $namaFile);

        echo base_url('assets/img/img-article/' . $namaFile);
    }

    public function deleteImgArticle()
    {
        $image = $this->request->getPost('image');
        $namaFile = str_replace(base_url() . '/', '', $image);
        if (unlink($namaFile)) {
            echo 'File berhasil dihapus';
        }
    }

    public function allPost()
    {
        $query = $this->posts
            ->select('blog_post.id AS id, blog_post.judul_post AS judul, kategori_blog.nama_kategori AS kategori, blog_post.thumbnail AS thumbnail, blog_post.konten_post AS isi, blog_post.created_at AS created_at, blog_post.status AS status, blog_post.slug AS slug')
            ->join('kategori_blog', 'kategori_blog.slug = blog_post.kode_kategori')
            ->where('blog_post.status', 'publish')
            ->orderBy('blog_post.created_at', 'DESC')
            ->findAll();

        return $query;
    }

    public function postWithSlug($slug)
    {
        $query = $this->posts
            ->select('blog_post.id AS id, blog_post.judul_post AS judul, kategori_blog.nama_kategori AS kategori, blog_post.thumbnail AS thumbnail, blog_post.konten_post AS isi, blog_post.created_at AS created_at, blog_post.status AS status, blog_post.slug AS slug')
            ->join('kategori_blog', 'kategori_blog.slug = blog_post.kode_kategori')
            ->where('blog_post.slug', $slug)
            ->first();

        return $query;
    }
}
