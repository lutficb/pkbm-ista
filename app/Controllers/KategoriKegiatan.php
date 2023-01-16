<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KategoriKegiatanModel;

class KategoriKegiatan extends ResourceController
{
    protected $helpers = ['pkbm_helper', 'form'];

    function __construct()
    {
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
        $query = $this->kategori->paginate(5);
        $pager = $this->kategori->pager;

        $data = [
            'title' => 'Kategori Kegiatan',
            'subtitle' => 'Kategori Kegiatan',
            'deskripsi' => 'Halaman manajemen kategori kegiatan.',
            'kategori' => $query,
            'pager' => $pager,
        ];

        return view('admin/kategoriKegiatan/index', $data);
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
        $data = [
            'title' => 'Kategori Kegiatan',
            'subtitle' => 'Kategori Kegiatan',
            'deskripsi' => 'Halaman tambah atau input kategori kegiatan baru',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kategoriKegiatan/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // // Validasi input user       
        if (!$this->validate('kategori_rules')) { //Rules disimpan di Config\Validation

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('kategori-kegiatan/new')->withInput();
        }

        $post = $this->request->getPost();
        $file = $this->request->getFile('thumbnail');
        $thumbnail = '';

        if (!$file->isValid()) {
            // jika tidak ada file diupload, maka nama file adalah default
            $thumbnail = 'img-default.jpg';
        } else {
            // Generate nama file random
            $thumbnail = $file->getRandomName();

            // Resize dan Pindah file ke folder yang ditentukan
            $this->image->withFile($file)
                ->resize(800, 533, true, 'width')
                ->save('assets/img/img-kegiatan/' . $thumbnail);
        }

        $data = [
            'slug' => url_title($post['nama_kategori'], '-', true),
            'nama_kategori' => $post['nama_kategori'],
            'info_kategori' => $post['info_kategori'],
            'thumbnail' => $thumbnail,
        ];

        $query = $this->kategori->insert($data, false);

        // Cek apakah data berhasil diupdate?
        if ($query) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori Kegiatan baru berhasil ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kategori-kegiatan');
        } else {
            // Hapus file yang telah diupload
            unlink('assets/img/img-kegiatan/' . $thumbnail);

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori kegiatan gagal ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kategori-kegiatan');
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
            $query = $this->kategori->find($id);
            $data = [
                'title' => 'Edit Kategori Kegiatan',
                'subtitle' => 'Edit Kategori Kegiatan',
                'deskripsi' => 'Halaman ubah kategori kegiatan yang sudah ada',
                'validation' => \Config\Services::validation(),
            ];

            if (count((array)$query) > 0) {
                $data['kategori'] = $query;

                return view('admin/kategoriKegiatan/edit', $data);
            } else {
                $data['pesan'] = 'Data kategori dengan ID yang anda cari tidak ada';

                return view('admin/kategoriKegiatan/edit-blank', $data);
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
        $update_rule = [
            'nama_kategori' => [
                'label' => 'Nama Kategori',
                'rules' => 'required|trim|min_length[4]|is_unique[kategori_blog.nama_kategori,id,' . $id . ']',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} tidak boleh sama dengan kategori yang sudah ada',
                    'min_length' => '{field} minimal 4 karakter',
                ]
            ],
            'info_kategori' => [
                'label' => 'Info Kategori',
                'rules' => 'required|trim',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'thumbnail' => [
                'rules' => 'is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]',
                'label' => 'Thumbnail',
                'errors' => [
                    'is_image' => 'Yang anda pilih bukan gambar jpg/jpeg/png',
                    'mime_in' => 'Yang anda pilih bukan gambar jpg/jpeg/png'
                ]
            ],
        ];

        // Validasi input user       
        if (!$this->validate($update_rule)) {

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('kategori-kegiatan/' . $id . '/edit')->withInput();
        }

        $post = $this->request->getPost();
        $file = $this->request->getFile('thumbnail');
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
                    ->resize(1024, 720, true, 'width')
                    ->save('assets/img/img-kegiatan/' . $namaThumbnail);

                // Hapus file lama
                unlink('assets/img/img-kegiatan/' . $fileLama);
            } else {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru dan resize
                $this->image->withFile($file)
                    ->resize(1024, 720, true, 'width')
                    ->save('assets/img/img-kegiatan/' . $namaThumbnail);
            }
        }

        $data = [
            'slug' => url_title($post['nama_kategori'], '-', true),
            'nama_kategori' => $post['nama_kategori'],
            'info_kategori' => $post['info_kategori'],
            'thumbnail' => $namaThumbnail,
        ];

        $this->kategori->update($id, $data);

        $db = db_connect();

        // Cek apakah data berhasil diupdate?
        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori kegiatan berhasil diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kategori-kegiatan');
        } else {
            if ($namaThumbnail != $fileLama) {
                // Hapus file yang telah diupload
                unlink('assets/img/img-kegiatan/' . $namaThumbnail);
            }

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori kegiatan gagal diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kategori-kegiatan');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $query = $this->kategori->find($id);
        $thumbnail = $query->thumbnail;

        if ($thumbnail != 'img-default.jpg') {
            // Jika nama file buka default maka hapus
            unlink('assets/img/img-kegiatan/' . $thumbnail);
        }

        $this->kategori->delete($id);

        $db = db_connect();

        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori kegiatan berhasil dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kategori-kegiatan');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori kegiatan gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kategori-kegiatan');
        }
    }
}
