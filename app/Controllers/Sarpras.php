<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KategoriSarprasModel;
use App\Models\SarprasModel;

class Sarpras extends ResourceController
{
    protected $helpers = ['pkbm_helper', 'form'];

    function __construct()
    {
        $this->sarpras = new SarprasModel();
        $this->kategori = new KategoriSarprasModel();
        $this->image = \Config\Services::image();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        $query = $this->sarpras->getAll(5, $keyword);

        $countAll = $this->sarpras->withDeleted()->findAll();
        $trash = $this->sarpras->onlyDeleted()->findAll();

        $data = [
            'title' => 'Sarana dan Prasarana',
            'subtitle' => 'Sarana dan Prasarana',
            'deskripsi' => 'Halaman manajemen Sarana dan Prasarana.',
            'sarpras' => $query['sarpras'],
            'pager' => $query['pager'],
            'countAll' => count((array)$countAll),
            'trash' => count((array)$trash),

        ];

        return view('admin/sarpras/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $kategori = $this->kategori->findAll();

        $data = [
            'title' => 'Tambah Sarpras Baru',
            'subtitle' => 'Tambah Sarpras Baru',
            'deskripsi' => 'Halaman tambah sarpras baru.',
            'kategori' => $kategori,
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/sarpras/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // Validasi input dari user
        if (!$this->validate('sarpras')) { //Validation di simpan pada Config\Validation.php

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('sarpras/new')->withInput();
        }

        $post = $this->request->getPost();
        $file = $this->request->getFile('gambar');
        $thumbnail = '';

        if (!$file->isValid()) {
            // jika tidak ada file diupload, maka nama file adalah default
            $thumbnail = 'img-default.jpg';
        } else {
            // Generate nama file random
            $thumbnail = $file->getRandomName();

            // Resize dan pindah file ke folder yang ditentukan
            $this->image->withFile($file)
                ->resize(1280, 720, true, 'width')
                ->save('assets/img/img-sarpras/' . $thumbnail);
        }

        $data = [
            'slug' => url_title($post['judul_gambar'], '-', true),
            'judul_gambar' => $post['judul_gambar'],
            'info_gambar' => $post['info_gambar'],
            'gambar' => $thumbnail,
            'kode_kategori' => $post['kode_kategori'],
        ];

        $query = $this->sarpras->insert($data, false);

        // Cek apakah data berhasil diupdate?
        if ($query) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Sarpras baru berhasil ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('sarpras');
        } else {
            // Hapus file yang telah diupload
            unlink('assets/img/img-sarpras/' . $thumbnail);

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Sarpras gagal ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('sarpras');
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->sarpras->find($id);
            $kategori = $this->kategori->findAll();

            $data = [
                'title' => 'Edit Sarana dan Prasarana',
                'subtitle' => 'Edit Sarana dan Prasarana',
                'deskripsi' => 'Halaman medit sarana dan prasarana',
                'validation' => \Config\Services::validation(),
            ];

            if (count((array)$query) > 0) {
                $data['sarpras'] = $query;
                $data['kategori'] = $kategori;

                return view('admin/sarpras/edit', $data);
            } else {
                $data['pesan'] = 'Data kategori dengan ID yang anda cari tidak ada';

                return view('admin/sarpras/edit-blank', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        // Validasi update sarpras
        $sarpras = [
            'judul_gambar' => [
                'label' => 'Judul Gambar',
                'rules' => 'required|trim|min_length[3]|is_unique[sarpras.judul_gambar, id,' . $id . ']',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'is_unique' => '{field} tidak boleh sama dengan post yang sudah ada',
                ]
            ],
            'info_gambar' => [
                'label' => 'Isi Konten',
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 5 karakter',
                ]
            ],
            'gambar' => [
                'rules' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
                'label' => 'Gambar',
                'errors' => [
                    'is_image' => 'Yang anda pilih bukan gambar jpg/jpeg/png',
                    'mime_in' => 'Yang anda pilih bukan gambar jpg/jpeg/png'
                ]
            ],
            'kode_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diplih salah satu',
                ]
            ],
        ];

        // Validasi input user       
        if (!$this->validate($sarpras)) {

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('sarpras/' . $id . '/edit')->withInput();
        }

        $post = $this->request->getPost();
        $file = $this->request->getFile('gambar');
        $fileLama = $post['file_lama'];
        $namaThumbnail = '';

        if (!$file->isValid()) {
            $namaThumbnail = $fileLama;
        } else {
            if ($fileLama != 'img-default.jpg') {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru dan resize
                $this->image->withFile($file)
                    ->resize(1280, 720, true, 'width')
                    ->save('assets/img/img-sarpras/' . $namaThumbnail);

                // Hapus file lama
                unlink('assets/img/img-sarpras/' . $fileLama);
            } else {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru dan resize
                $this->image->withFile($file)
                    ->resize(1280, 720, true, 'width')
                    ->save('assets/img/img-sarpras/' . $namaThumbnail);
            }
        }

        $data = [
            'slug' => url_title($post['judul_gambar'], '-', true),
            'judul_gambar' => $post['judul_gambar'],
            'kode_kategori' => $post['kode_kategori'],
            'info_gambar' => $post['info_gambar'],
            'gambar' => $namaThumbnail,
        ];

        $this->sarpras->update($id, $data);

        $db = db_connect();

        // Cek apakah data berhasil diupdate?
        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Sarpras berhasil diupdate');

            // Kembali ke halaman pages
            return redirect()->to('sarpras');
        } else {
            if ($namaThumbnail != $fileLama) {
                // Hapus file yang telah diupload
                unlink('assets/img/img-sarpras/' . $namaThumbnail);
            }

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Sarpras gagal diupdate');

            // Kembali ke halaman pages
            return redirect()->to('sarpras');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        // Menggunakn softdelete, jadi untuk gambar bisa atau thumbnail tidek perlu dihapus dulu
        $this->sarpras->delete($id);

        $db = db_connect();

        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Sarpras berhasil dihapus');

            // Kembali ke halaman pages
            return redirect()->to('sarpras');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Sarpras gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('sarpras');
        }
    }

    public function trash()
    {
        // Ambil data post yang telah dihapus
        $query = $this->sarpras
            ->select('sarpras.id AS id, sarpras.judul_gambar AS judul, kategori_sarpras.nama_kategori AS kategori, sarpras.info_gambar AS info, sarpras.gambar AS gambar, sarpras.deleted_at AS delete')
            ->join('kategori_sarpras', 'kategori_sarpras.slug = sarpras.kode_kategori')
            ->onlyDeleted()
            ->findAll();

        $data = [
            'title' => 'Sarpras Dihapus',
            'subtitle' => 'Sarana dan Prasarana',
            'deskripsi' => 'Halaman manajemen sarpras terhapus.',
            'sarpras' => $query,
        ];

        return view('admin/sarpras/trash', $data);
    }

    public function restore($id = null)
    {
        $db = db_connect();
        $builder = $db->table('sarpras');

        if ($id != null) {

            $query = $this->sarpras->onlyDeleted()->find($id);

            if (count((array)$query) > 0) {

                $builder->set('deleted_at', null)->where('id', $id)->update();

                if ($db->affectedRows() > 0) {
                    // Set flash data untuk ditampilkan ke halaman pages
                    session()->setFlashdata('success', 'Sarpras berhasil direstore');

                    // Kembali ke halaman pages
                    return redirect()->to('sarpras');
                } else {
                    // Set flash data untuk ditampilkan ke halaman pages
                    session()->setFlashdata('error', 'Sarpras gagal direstore');

                    // Kembali ke halaman pages
                    return redirect()->to('sarpras');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            $builder->set('deleted_at', null)->where('deleted_at is NOT NULL', NULL, FALSE)->update();

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Sarpras berhasil direstore');

                // Kembali ke halaman pages
                return redirect()->to('sarpras');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Sarpras gagal direstore');

                // Kembali ke halaman pages
                return redirect()->to('sarpras');
            }
        }
    }

    public function delpermanent($id = null)
    {
        $db = db_connect();

        if ($id != null) {
            // cari data yang akan dihapus
            $query = $this->sarpras->onlyDeleted()->find($id);
            // ambil nama thumbnailnya
            $thumbnail = $query->gambar;

            // jika nama file bukan imgpdefault.jpg maka hapus
            if ($thumbnail != 'img-default.jpg') {
                // Hpaus thumbnailnya
                unlink('assets/img/img-sarpras/' . $thumbnail);
            }

            // Delete permanent dengan cara memberikan parameter kedua = true
            $this->sarpras->delete($id, true);

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Sarpras berhasil dihapus');

                // Kembali ke halaman pages
                return redirect()->to('sarpras/trash');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Sarpras gagal dihapus');

                // Kembali ke halaman pages
                return redirect()->to('sarpras/trash');
            }
        } else {
            // Cari semua data yang ada deleted_at
            $query = $this->sarpras->onlyDeleted()->findAll();

            // looping untuk menghapus data thumbnail
            foreach ($query as $key => $value) {
                // Ambil nama thumbnail
                $thumbnail = $value->gambar;

                // Cek apakah nama thumbnail img-default.jpg
                if ($thumbnail != 'img-default.jpg') {
                    // Jika tidka sama dengan img-default.jpg maka harus dihapus
                    unlink('assets/img/img-sarpras/' . $thumbnail);
                }
            }

            // Fungsi purgeDeleted dignakan untuk menghapus semua data yang cretaed_at nya tidak null
            $this->sarpras->purgeDeleted();

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Sarpras berhasil dihapus seluruhnya');

                // Kembali ke halaman sarpras trash
                return redirect()->to('sarpras/trash');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Sarpras gagal dihapus');

                // Kembali ke halaman pages
                return redirect()->to('sarpras/trash');
            }
        }
    }
}
