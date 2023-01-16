<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KategoriKegiatanModel;
use App\Models\KegiatanModel;

class Kegiatan extends ResourceController
{
    protected $helpers = ['pkbm_helper', 'form'];

    function __construct()
    {
        $this->kegiatan = new KegiatanModel();
        $this->kategori = new KategoriKegiatanModel();
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
        $query = $this->kegiatan->getAll(5, $keyword);

        $countAll = $this->kegiatan->withDeleted()->findAll();
        $trash = $this->kegiatan->onlyDeleted()->findAll();

        $data = [
            'title' => 'Kegiatan siswa',
            'subtitle' => 'Kegiatan siswa',
            'deskripsi' => 'Halaman manajemen Kegiatan siswa.',
            'kegiatan' => $query['kegiatan'],
            'pager' => $query['pager'],
            'countAll' => count((array)$countAll),
            'trash' => count((array)$trash),

        ];

        return view('admin/kegiatan/index', $data);
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
            'title' => 'Tambah Kegiatan Baru',
            'subtitle' => 'Tambah Kegiatan Baru',
            'deskripsi' => 'Halaman tambah kegiatan baru.',
            'kategori' => $kategori,
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kegiatan/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // Validasi input dari user
        if (!$this->validate('kegiatan')) { //Validation di simpan pada Config\Validation.php

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('kegiatan/new')->withInput();
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
                ->save('assets/img/img-kegiatan/' . $thumbnail);
        }

        $data = [
            'slug' => url_title($post['nama_kegiatan'], '-', true),
            'nama_kegiatan' => $post['nama_kegiatan'],
            'info_kegiatan' => $post['info_kegiatan'],
            'gambar' => $thumbnail,
            'kode_kategori' => $post['kode_kategori'],
        ];

        $query = $this->kegiatan->insert($data, false);

        // Cek apakah data berhasil diupdate?
        if ($query) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kegiatan baru berhasil ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kegiatan');
        } else {
            // Hapus file yang telah diupload
            unlink('assets/img/img-kegiatan/' . $thumbnail);

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kegiatan gagal ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kegiatan');
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
            $query = $this->kegiatan->find($id);
            $kategori = $this->kategori->findAll();

            $data = [
                'title' => 'Edit kegiatan siswa',
                'subtitle' => 'Edit kegiatan siswa',
                'deskripsi' => 'Halaman medit kegiatan siswa',
                'validation' => \Config\Services::validation(),
            ];

            if (count((array)$query) > 0) {
                $data['kegiatan'] = $query;
                $data['kategori'] = $kategori;

                return view('admin/kegiatan/edit', $data);
            } else {
                $data['pesan'] = 'Data kategori dengan ID yang anda cari tidak ada';

                return view('admin/kegiatan/edit-blank', $data);
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
        $kegiatan = [
            'nama_kegiatan' => [
                'label' => 'Nama Kegiatan',
                'rules' => 'required|trim|min_length[3]|is_unique[kegiatan_siswa.nama_kegiatan, id,' . $id . ']',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'is_unique' => '{field} tidak boleh sama dengan post yang sudah ada',
                ]
            ],
            'info_kegiatan' => [
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
        if (!$this->validate($kegiatan)) {

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('kegiatan/' . $id . '/edit')->withInput();
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
                    ->save('assets/img/img-kegiatan/' . $namaThumbnail);

                // Hapus file lama
                unlink('assets/img/img-kegiatan/' . $fileLama);
            } else {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru dan resize
                $this->image->withFile($file)
                    ->resize(1280, 720, true, 'width')
                    ->save('assets/img/img-kegiatan/' . $namaThumbnail);
            }
        }

        $data = [
            'slug' => url_title($post['nama_kegiatan'], '-', true),
            'nama_kegiatan' => $post['nama_kegiatan'],
            'kode_kategori' => $post['kode_kategori'],
            'info_kegiatan' => $post['info_kegiatan'],
            'gambar' => $namaThumbnail,
        ];

        $this->kegiatan->update($id, $data);

        $db = db_connect();

        // Cek apakah data berhasil diupdate?
        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kegiatan berhasil diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kegiatan');
        } else {
            if ($namaThumbnail != $fileLama) {
                // Hapus file yang telah diupload
                unlink('assets/img/img-kegiatan/' . $namaThumbnail);
            }

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kegiatan gagal diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kegiatan');
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
        $this->kegiatan->delete($id);

        $db = db_connect();

        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kegiatan siswa berhasil dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kegiatan');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kegiatan siswa gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kegiatan');
        }
    }

    public function trash()
    {
        // Ambil data post yang telah dihapus
        $query = $this->kegiatan
            ->select('kegiatan_siswa.id AS id, kegiatan_siswa.nama_kegiatan AS judul, kategori_kegiatan.nama_kategori AS kategori, kegiatan_siswa.info_kegiatan AS info, kegiatan_siswa.gambar AS gambar, kegiatan_siswa.deleted_at AS delete')
            ->join('kategori_kegiatan', 'kategori_kegiatan.slug = kegiatan_siswa.kode_kategori')
            ->onlyDeleted()
            ->findAll();

        $data = [
            'title' => 'Kegiatan siswa Dihapus',
            'subtitle' => 'Kegiatan Siswa',
            'deskripsi' => 'Halaman manajemen kegiatan siswa terhapus.',
            'kegiatan' => $query,
        ];

        return view('admin/kegiatan/trash', $data);
    }

    public function restore($id = null)
    {
        $db = db_connect();
        $builder = $db->table('kegiatan_siswa');

        if ($id != null) {

            $query = $this->kegiatan->onlyDeleted()->find($id);

            if (count((array)$query) > 0) {

                $builder->set('deleted_at', null)->where('id', $id)->update();

                if ($db->affectedRows() > 0) {
                    // Set flash data untuk ditampilkan ke halaman pages
                    session()->setFlashdata('success', 'Kegiatan siswa berhasil direstore');

                    // Kembali ke halaman pages
                    return redirect()->to('kegiatan');
                } else {
                    // Set flash data untuk ditampilkan ke halaman pages
                    session()->setFlashdata('error', 'Kegiatan siswa gagal direstore');

                    // Kembali ke halaman pages
                    return redirect()->to('kegiatan');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            $builder->set('deleted_at', null)->where('deleted_at is NOT NULL', NULL, FALSE)->update();

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Kegiatan siswa berhasil direstore');

                // Kembali ke halaman pages
                return redirect()->to('kegiatan');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Kegiatan siswa gagal direstore');

                // Kembali ke halaman pages
                return redirect()->to('kegiatan');
            }
        }
    }

    public function delpermanent($id = null)
    {
        $db = db_connect();

        if ($id != null) {
            // cari data yang akan dihapus
            $query = $this->kegiatan->onlyDeleted()->find($id);
            // ambil nama thumbnailnya
            $thumbnail = $query->gambar;

            // jika nama file bukan imgpdefault.jpg maka hapus
            if ($thumbnail != 'img-default.jpg') {
                // Hpaus thumbnailnya
                unlink('assets/img/img-kegiatan/' . $thumbnail);
            }

            // Delete permanent dengan cara memberikan parameter kedua = true
            $this->kegiatan->delete($id, true);

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Kegiatan siswa berhasil dihapus permanen');

                // Kembali ke halaman pages
                return redirect()->to('kegiatan/trash');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Kegiatan siswa gagal dihapus permanen');

                // Kembali ke halaman pages
                return redirect()->to('kegiatan/trash');
            }
        } else {
            // Cari semua data yang ada deleted_at
            $query = $this->kegiatan->onlyDeleted()->findAll();

            // looping untuk menghapus data thumbnail
            foreach ($query as $key => $value) {
                // Ambil nama thumbnail
                $thumbnail = $value->gambar;

                // Cek apakah nama thumbnail img-default.jpg
                if ($thumbnail != 'img-default.jpg') {
                    // Jika tidka sama dengan img-default.jpg maka harus dihapus
                    unlink('assets/img/img-kegiatan/' . $thumbnail);
                }
            }

            // Fungsi purgeDeleted dignakan untuk menghapus semua data yang cretaed_at nya tidak null
            $this->kegiatan->purgeDeleted();

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Kegiatan siswa berhasil dihapus permanen seluruhnya');

                // Kembali ke halaman kegiatan trash
                return redirect()->to('kegiatan/trash');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Kegiatan siswa gagal dihapus permanen selurhnya');

                // Kembali ke halaman pages
                return redirect()->to('kegiatan/trash');
            }
        }
    }
}
