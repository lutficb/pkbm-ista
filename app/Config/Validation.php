<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;
use CodeIgniter\Shield\Authentication\Passwords\ValidationRules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        ValidationRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------

    public $kategori_rules = [
        'nama_kategori' => [
            'label' => 'Nama Kategori',
            'rules' => 'required|trim|min_length[3]|is_unique[kategori_blog.nama_kategori]',
            'errors' => [
                'required' => '{field} harus diisi',
                'is_unique' => '{field} tidak boleh sama dengan kategori yang sudah ada',
                'min_length' => '{field} minimal 3 karakter',
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

    public $post = [
        'judul_post' => [
            'label' => 'Judul Post',
            'rules' => 'required|trim|min_length[3]|is_unique[sarpras.judul_gambar]',
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

    public $sarpras = [
        'judul_gambar' => [
            'label' => 'Judul Gambar',
            'rules' => 'required|trim|min_length[3]|is_unique[sarpras.judul_gambar]',
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

    public $kegiatan = [
        'nama_kegiatan' => [
            'label' => 'Nama Kegiatan',
            'rules' => 'required|trim|min_length[3]|is_unique[kegiatan_siswa.nama_kegiatan]',
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

    //--------------------------------------------------------------------
    // Rules For Add User
    //--------------------------------------------------------------------
    public $registration = [
        'username' => [
            'label' =>  'Username',
            'rules' => 'required|max_length[30]|min_length[3]|regex_match[/\A[a-zA-Z0-9\.]+\z/]|is_unique[users.username]',
        ],
        'email' => [
            'label' =>  'Email',
            'rules' => 'required|max_length[254]|valid_email|is_unique[auth_identities.secret]',
        ],
        'password' => [
            'label' =>  'Password',
            'rules' => 'required|strong_password',
        ],
        'password_confirm' => [
            'label' =>  'Password Confirm',
            'rules' => 'required|matches[password]',
        ],
    ];
}
