<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KategoriSarprasModel;

class KategoriSarpras extends ResourceController
{
    protected $helpers = ['pkbm_helper', 'form'];

    function __construct()
    {
        $this->kategoriSarpras = new KategoriSarprasModel();
        $this->image = \Config\Services::image();
    }

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $query = $this->kategoriSarpras->paginate(5);
        $pager = $this->kategoriSarpras->pager;

        $data = [
            'title' => 'Kategori Sarpras',
            'subtitle' => 'Kategori Sarpras',
            'deskripsi' => 'Halaman manajemen kategori sarana dan prasarana.',
            'kategori' => $query,
            'pager' => $pager,
        ];

        return view('admin/kategoriSarpras/index', $data);
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
            'title' => 'Kategori Sarpras',
            'subtitle' => 'Kategori Sarpras',
            'deskripsi' => 'Halaman tambah atau input kategori sarpras baru',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kategoriSarpras/new', $data);
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
            return redirect()->to('kategori-sarpras/new')->withInput();
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
                ->save('assets/img/img-sarpras/' . $thumbnail);
        }

        $data = [
            'slug' => url_title($post['nama_kategori'], '-', true),
            'nama_kategori' => $post['nama_kategori'],
            'info_kategori' => $post['info_kategori'],
            'thumbnail' => $thumbnail,
        ];

        $query = $this->kategoriSarpras->insert($data, false);

        // Cek apakah data berhasil diupdate?
        if ($query) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori Sarpras baru berhasil ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kategori-sarpras');
        } else {
            // Hapus file yang telah diupload
            unlink('assets/img/img-sarpras/' . $thumbnail);

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori Blog gagal ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kategori-sarpras');
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
            $query = $this->kategoriSarpras->find($id);
            $data = [
                'title' => 'Edit Kategori Sarpras',
                'subtitle' => 'Edit Kategori Sarpras',
                'deskripsi' => 'Halaman ubah kategori sarpras yang sudah ada',
                'validation' => \Config\Services::validation(),
            ];

            if (count((array)$query) > 0) {
                $data['kategori'] = $query;

                return view('admin/kategoriSarpras/edit', $data);
            } else {
                $data['pesan'] = 'Data kategori dengan ID yang anda cari tidak ada';

                return view('admin/kategoriSarpras/edit-blank', $data);
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
            return redirect()->to('kategori-sarpras/' . $id . '/edit')->withInput();
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
                    ->resize(800, 533, true, 'width')
                    ->save('assets/img/img-sarpras/' . $namaThumbnail);

                // Hapus file lama
                unlink('assets/img/img-sarpras/' . $fileLama);
            } else {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru dan resize
                $this->image->withFile($file)
                    ->resize(800, 533, true, 'width')
                    ->save('assets/img/img-sarpras/' . $namaThumbnail);
            }
        }

        $data = [
            'slug' => url_title($post['nama_kategori'], '-', true),
            'nama_kategori' => $post['nama_kategori'],
            'info_kategori' => $post['info_kategori'],
            'thumbnail' => $namaThumbnail,
        ];

        $this->kategoriSarpras->update($id, $data);

        $db = db_connect();

        // Cek apakah data berhasil diupdate?
        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori Sarpras berhasil diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kategori-sarpras');
        } else {
            if ($namaThumbnail != $fileLama) {
                // Hapus file yang telah diupload
                unlink('assets/img/img-sarpras/' . $namaThumbnail);
            }

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori Sarpras gagal diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kategori-sarpras');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $query = $this->kategoriSarpras->find($id);
        $thumbnail = $query->thumbnail;

        if ($thumbnail != 'img-default.jpg') {
            // Jika nama file buka default maka hapus
            unlink('assets/img/img-sarpras/' . $thumbnail);
        }

        $this->kategoriSarpras->delete($id);

        $db = db_connect();

        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori Sarpras berhasil dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kategori-sarpras');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori Sarpras gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kategori-sarpras');
        }
    }
}
