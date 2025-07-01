<?php

namespace App\Controllers;

// Impor semua class yang dibutuhkan di awal
use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class AuthController extends BaseController
{
    /**
     * Variabel untuk menampung service session.
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * Konstruktor untuk inisialisasi.
     */
    public function __construct()
    {
        // Menginisialisasi service session agar bisa dipakai di seluruh controller
        $this->session = Services::session();
        
        // Memuat helper yang dibutuhkan
        helper(['form', 'url']);
    }

    /**
     * Menampilkan halaman form login.
     * Jika user sudah login, akan langsung diarahkan ke dashboard.
     */
    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            if ($this->session->get('role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/mahasiswa/dashboard');
            }
        }
        
        return view('auth/login');
    }

    /**
     * Memproses data yang dikirim dari form login.
     */
    public function processLogin()
    {
        // 1. Aturan Validasi
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        // 2. Lakukan Validasi
        if (!$this->validate($rules)) {
            return redirect()->to('/')->withInput()->with('validation', 'Username dan Password wajib diisi.');
        }

        // 3. Ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 4. Inisialisasi Model dan cari user
        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);
        // if ($user && password_verify($password, $user['password'])) { ...
        // 5. Verifikasi User dan Password
        if ($user && password_verify($password, $user['password'])) {
            // Jika user ditemukan DAN password cocok:
            $sessionData = [
                'id_user'       => $user['id_user'],
                'username'      => $user['username'],
                'role'          => $user['role'],
                'isLoggedIn'    => true,
                'id_mahasiswa'  => $user['id_mahasiswa'] // Penting untuk MahasiswaController
            ];
            
            $this->session->set($sessionData);

            // Arahkan ke dashboard yang sesuai
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/mahasiswa/dashboard');
            }
        } else {
            // Jika user tidak ditemukan atau password salah, kembalikan ke login
            return redirect()->to('/')->withInput()->with('error', 'Username atau Password yang Anda masukkan salah.');
        }
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Anda berhasil logout.');
    }
}