<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\KategoriBlogModel;

class KategoriBlog extends ResourceController
{
    protected $helpers = ['pkbm_helper', 'form'];

    function __construct()
    {
        $this->kategoriBlog = new KategoriBlogModel();
        $this->image = \Config\Services::image();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $query = $this->kategoriBlog->paginate(5);
        $pager = $this->kategoriBlog->pager;

        $data = [
            'title' => 'Kategori Blog',
            'subtitle' => 'Kategori Blog',
            'deskripsi' => 'Halaman manajemen kategori blog post.',
            'kategori' => $query,
            'pager' => $pager,
        ];

        return view('admin/kategoriBlog/index', $data);
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
            'title' => 'Kategori Blog',
            'subtitle' => 'Kategori Blog',
            'deskripsi' => 'Halaman tambah atau input kategori blog baru',
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kategoriBlog/new', $data);
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
            return redirect()->to('kategori-blog/new')->withInput();
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
                ->resize(1024, 768, true, 'width')
                ->save('assets/img/blog-kategori/' . $thumbnail);
        }

        $data = [
            'slug' => url_title($post['nama_kategori'], '-', true),
            'nama_kategori' => $post['nama_kategori'],
            'info_kategori' => $post['info_kategori'],
            'thumbnail' => $thumbnail,
        ];

        $query = $this->kategoriBlog->insert($data, false);

        // Cek apakah data berhasil diupdate?
        if ($query) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori Blog baru berhasil ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kategori-blog');
        } else {
            // Hapus file yang telah diupload
            unlink('assets/img/blog-kategori/' . $thumbnail);

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori Blog gagal ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('kategori-blog');
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
            $query = $this->kategoriBlog->find($id);
            $data = [
                'title' => 'Edit Kategori Blog',
                'subtitle' => 'Edit Kategori Blog',
                'deskripsi' => 'Halaman ubah kategori blog yang sudah ada',
                'validation' => \Config\Services::validation(),
            ];

            if (count((array)$query) > 0) {
                $data['kategori'] = $query;

                return view('admin/kategoriBlog/edit', $data);
            } else {
                $data['pesan'] = 'Data kategori dengan ID yang anda cari tidak ada';

                return view('admin/kategoriBlog/edit-blank', $data);
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
            return redirect()->to('kategori-blog/' . $id . '/edit')->withInput();
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
                    ->resize(1024, 768, true, 'width')
                    ->save('assets/img/blog-kategori/' . $namaThumbnail);

                // Hapus file lama
                unlink('assets/img/blog-kategori/' . $fileLama);
            } else {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru dan resize
                $this->image->withFile($file)
                    ->resize(1024, 768, true, 'width')
                    ->save('assets/img/blog-kategori/' . $namaThumbnail);
            }
        }

        $data = [
            'slug' => url_title($post['nama_kategori'], '-', true),
            'nama_kategori' => $post['nama_kategori'],
            'info_kategori' => $post['info_kategori'],
            'thumbnail' => $namaThumbnail,
        ];

        $this->kategoriBlog->update($id, $data);

        $db = db_connect();

        // Cek apakah data berhasil diupdate?
        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori Blog baru berhasil diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kategori-blog');
        } else {
            if ($namaThumbnail != $fileLama) {
                // Hapus file yang telah diupload
                unlink('assets/img/blog-kategori/' . $namaThumbnail);
            }

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori Blog gagal diupdate');

            // Kembali ke halaman pages
            return redirect()->to('kategori-blog');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $query = $this->kategoriBlog->find($id);
        $thumbnail = $query->thumbnail;

        if ($thumbnail != 'img-default.jpg') {
            // Jika nama file buka default maka hapus
            unlink('assets/img/blog-kategori/' . $thumbnail);
        }

        $this->kategoriBlog->delete($id);

        $db = db_connect();

        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Kategori Blog berhasil dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kategori-blog');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Kategori Blog gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('kategori-blog');
        }
    }
}
