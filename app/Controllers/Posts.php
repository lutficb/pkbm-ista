<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PostModel;
use App\Models\KategoriBlogModel;
use phpDocumentor\Reflection\Types\Null_;

class Posts extends ResourceController
{
    protected $helpers = ['pkbm_helper', 'form'];

    function __construct()
    {
        $this->post = new PostModel();
        $this->kategori = new KategoriBlogModel();
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
        $query = $this->post->getAll(5, $keyword);

        $countAll = $this->post->withDeleted()->findAll();
        $publish = $this->post->where('status', 'publish')->findAll();
        $draft = $this->post->where('status', 'draft')->findAll();
        $trash = $this->post->onlyDeleted()->findAll();

        $data = [
            'title' => 'Blog Post',
            'subtitle' => 'Blog Post',
            'deskripsi' => 'Halaman manajemen blog post.',
            'posts' => $query['post'],
            'pager' => $query['pager'],
            'countAll' => count((array)$countAll),
            'publish' => count((array)$publish),
            'draft' => count((array)$draft),
            'trash' => count((array)$trash),

        ];

        return view('admin/posts/index', $data);
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
            'title' => 'Tambah Post Baru',
            'subtitle' => 'Tambah Post Baru',
            'deskripsi' => 'Halaman tambah post baru.',
            'kategori' => $kategori,
        ];

        return view('admin/posts/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        // Validasi input dari user
        if (!$this->validate('post')) { //Validation di simpan pada Config\Validation.php

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('posts/new')->withInput();
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

            // Resize dan pindah file ke folder yang ditentukan
            $this->image->withFile($file)
                ->resize(1100, 523, true, 'width')
                ->save('assets/img/img-post/' . $thumbnail);
        }

        $data = [
            'slug' => url_title($post['judul_post'], '-', true),
            'judul_post' => $post['judul_post'],
            'konten_post' => $post['konten_post'],
            'thumbnail' => $thumbnail,
            'status' => $post['status'],
            'kode_kategori' => $post['kode_kategori'],
        ];

        $query = $this->post->insert($data, false);

        // Cek apakah data berhasil diupdate?
        if ($query) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Post baru berhasil ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('posts');
        } else {
            // Hapus file yang telah diupload
            unlink('assets/img/img-post/' . $thumbnail);

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Post gagal ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('posts');
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
            $query = $this->post->find($id);
            $kategori = $this->kategori->findAll();

            $data = [
                'title' => 'Edit Blog Post',
                'subtitle' => 'Edit Blog Post',
                'deskripsi' => 'Halaman medit blog post',
                'validation' => \Config\Services::validation(),
            ];

            if (count((array)$query) > 0) {
                $data['post'] = $query;
                $data['kategori'] = $kategori;

                return view('admin/posts/edit', $data);
            } else {
                $data['pesan'] = 'Data kategori dengan ID yang anda cari tidak ada';

                return view('admin/posts/edit-blank', $data);
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
        $post = [
            'judul_post' => [
                'label' => 'Judul Post',
                'rules' => 'required|trim|min_length[3]|is_unique[blog_post.judul_post, id,' . $id . ']',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 3 karakter',
                    'is_unique' => '{field} tidak boleh sama dengan post yang sudah ada',
                ]
            ],
            'konten_post' => [
                'label' => 'Isi Konten',
                'rules' => 'required|trim|min_length[5]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 5 karakter',
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
            'kode_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diplih salah satu',
                ]
            ],
            'status' => [
                'label' => 'Status Konten',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus ditentukan',
                ]
            ],
        ];

        // Validasi input user       
        if (!$this->validate($post)) {

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('posts/' . $id . '/edit')->withInput();
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
                    ->save('assets/img/img-post/' . $namaThumbnail);

                // Hapus file lama
                unlink('assets/img/img-post/' . $fileLama);
            } else {
                // Ganti nama file dengan nama random
                $namaThumbnail = $file->getRandomName();

                // Upload file baru dan resize
                $this->image->withFile($file)
                    ->resize(800, 533, true, 'width')
                    ->save('assets/img/img-post/' . $namaThumbnail);
            }
        }

        $data = [
            'slug' => url_title($post['judul_post'], '-', true),
            'judul_post' => $post['judul_post'],
            'kode_kategori' => $post['kode_kategori'],
            'konten_post' => $post['konten_post'],
            'thumbnail' => $namaThumbnail,
            'status' => $post['status'],
        ];

        $this->post->update($id, $data);

        $db = db_connect();

        // Cek apakah data berhasil diupdate?
        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Postingan baru berhasil diupdate');

            // Kembali ke halaman pages
            return redirect()->to('posts');
        } else {
            if ($namaThumbnail != $fileLama) {
                // Hapus file yang telah diupload
                unlink('assets/img/img-post/' . $namaThumbnail);
            }

            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Postingan gagal diupdate');

            // Kembali ke halaman pages
            return redirect()->to('posts');
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
        $this->post->delete($id);

        $db = db_connect();

        if ($db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'Post berhasil dihapus');

            // Kembali ke halaman pages
            return redirect()->to('posts');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'Post gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('posts');
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function trash()
    {
        // Ambil data post yang telah dihapus
        $query = $this->post
            ->select('blog_post.id AS id, blog_post.judul_post AS judul, kategori_blog.nama_kategori AS kategori, blog_post.thumbnail AS thumbnail, blog_post.konten_post AS isi, blog_post.deleted_at AS delete')
            ->join('kategori_blog', 'kategori_blog.slug = blog_post.kode_kategori')
            ->onlyDeleted()
            ->findAll();

        $data = [
            'title' => 'Postingan Dihapus',
            'subtitle' => 'Blog Post',
            'deskripsi' => 'Halaman manajemen blog post.',
            'posts' => $query,
        ];

        return view('admin/posts/trash', $data);
    }

    public function restore($id = null)
    {
        $db = db_connect();
        $builder = $db->table('blog_post');

        if ($id != null) {

            $query = $this->post->onlyDeleted()->find($id);

            if (count((array)$query) > 0) {

                $builder->set('deleted_at', null)->where('id', $id)->update();

                if ($db->affectedRows() > 0) {
                    // Set flash data untuk ditampilkan ke halaman pages
                    session()->setFlashdata('success', 'Post berhasil direstore');

                    // Kembali ke halaman pages
                    return redirect()->to('posts');
                } else {
                    // Set flash data untuk ditampilkan ke halaman pages
                    session()->setFlashdata('error', 'Post gagal direstore');

                    // Kembali ke halaman pages
                    return redirect()->to('posts');
                }
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            $builder->set('deleted_at', null)->where('deleted_at is NOT NULL', NULL, FALSE)->update();

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Post berhasil direstore');

                // Kembali ke halaman pages
                return redirect()->to('posts');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Post gagal direstore');

                // Kembali ke halaman pages
                return redirect()->to('posts');
            }
        }
    }

    public function delpermanent($id = null)
    {
        $db = db_connect();

        if ($id != null) {
            // cari data yang akan dihapus
            $query = $this->post->onlyDeleted()->find($id);
            // ambil nama thumbnailnya
            $thumbnail = $query->thumbnail;

            // jika nama file bukan imgpdefault.jpg maka hapus
            if ($thumbnail != 'img-default.jpg') {
                // Hpaus thumbnailnya
                unlink('assets/img/img-post/' . $thumbnail);
            }

            // Delete permanent dengan cara memberikan parameter kedua = true
            $this->post->delete($id, true);

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Post berhasil dihapus');

                // Kembali ke halaman pages
                return redirect()->to('posts/trash');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Post gagal dihapus');

                // Kembali ke halaman pages
                return redirect()->to('posts/trash');
            }
        } else {
            // Cari semua data yang ada deleted_at
            $query = $this->post->onlyDeleted()->findAll();

            // looping untuk menghapus data thumbnail
            foreach ($query as $key => $value) {
                // Ambil nama thumbnail
                $thumbnail = $value->thumbnail;

                // Cek apakah nama thumbnail img-default.jpg
                if ($thumbnail != 'img-default.jpg') {
                    // Jika tidka sama dengan img-default.jpg maka harus dihapus
                    unlink('assets/img/img-post/' . $thumbnail);
                }
            }

            // Fungsi purgeDeleted dignakan untuk menghapus semua data yang cretaed_at nya tidak null
            $this->post->purgeDeleted();

            if ($db->affectedRows() > 0) {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('success', 'Post berhasil dihapus seluruhnya');

                // Kembali ke halaman pages
                return redirect()->to('posts/trash');
            } else {
                // Set flash data untuk ditampilkan ke halaman pages
                session()->setFlashdata('error', 'Post gagal dihapus');

                // Kembali ke halaman pages
                return redirect()->to('posts/trash');
            }
        }
    }
}
