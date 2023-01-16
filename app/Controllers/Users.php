<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Entities\User;

class Users extends BaseController
{
    function __construct()
    {
        $this->db = db_connect();
    }

    public function index()
    {
        // Ceka apakah di group admin
        if (!auth()->user()->inGroup('admin')) {
            // Jika user bukan di group admin, maka kembalikan ke dashboard
            return redirect()->to('dashboard')->withInput();
        }

        $builder = $this->db->table('users');

        $query = $builder->select('users.id AS id, users.username AS username, users.active AS status, users.last_active AS last_login, auth_groups_users.group AS group')
            ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
            ->get()->getResult();

        $data = [
            'title' => 'Users',
            'subtitle' => 'Manajemen Users',
            'deskripsi' => 'Halaman manajemen users.',
            'users' => $query,

        ];

        return view('admin/users/index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah User Baru',
            'subtitle' => 'Tambah User Baru',
            'deskripsi' => 'Halaman tambah user baru.',
        ];

        return view('admin/users/new', $data);
    }

    public function create()
    {
        // Validasi input dari user
        if (!$this->validate('registration')) { //Validation di simpan pada Config\Validation.php

            // Jika validasi gagal akan kembali ke formulir pendaftaran dengan old input
            return redirect()->to('users/new')->withInput();
        }

        $data = $this->request->getPost();

        $users = model('UserModel');
        $user = new User([
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => $data['password'],
            'active' => true,
        ]);

        // Simpan user baru ke dalam database
        $users->save($user);

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        if ($this->db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'User baru berhasil ditambahkan');

            // Kembali ke halaman pages
            return redirect()->to('users');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'User gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('users');
        }
    }

    public function delete($id = null)
    {
        $users = model('UserModel');
        $users->delete($id, true);

        if ($this->db->affectedRows() > 0) {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('success', 'User berhasil dihapus');

            // Kembali ke halaman pages
            return redirect()->to('users');
        } else {
            // Set flash data untuk ditampilkan ke halaman pages
            session()->setFlashdata('error', 'User gagal dihapus');

            // Kembali ke halaman pages
            return redirect()->to('users');
        }
    }
}
