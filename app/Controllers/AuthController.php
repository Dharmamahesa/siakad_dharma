<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel; // Memanggil UserModel
use Config\Services;      // Memanggil Services untuk session

class AuthController extends BaseController
{
    /**
     * Variabel untuk menampung service session.
     * @var \CodeIgniter\Session\Session
     */
    protected $session;

    /**
     * Konstruktor. Dijalankan setiap kali AuthController dibuat.
     * Cocok untuk inisialisasi properti dan helper.
     */
    public function __construct()
    {
        // Menginisialisasi service session
        $this->session = Services::session();
        
        // Memuat helper yang dibutuhkan di seluruh controller ini
        helper(['form', 'url']);
    }

    /**
     * Menampilkan halaman form login.
     * Disempurnakan: Jika user sudah login, langsung arahkan ke dashboard.
     */
    public function login()
    {
        // Cek apakah session 'isLoggedIn' sudah ada
        if ($this->session->get('isLoggedIn')) {
            // Arahkan berdasarkan role yang tersimpan di session
            if ($this->session->get('role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/mahasiswa/dashboard');
            }
        }
        
        // Jika belum login, tampilkan view login yang baru
        return view('auth/login');
    }

    /**
     * Memproses data yang dikirim dari form login.
     */
    public function processLogin()
    {
        // 1. Aturan Validasi Input
        $rules = [
            'username' => 'required',
            'password' => 'required|min_length[5]', // Minimal 5 karakter untuk password
        ];

        // 2. Lakukan Validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke form login dengan pesan error validasi
            // withInput() akan menyimpan input sebelumnya agar tidak perlu mengetik ulang
            return redirect()->to('/')->withInput()->with('validation', $this->validator);
        }

        // 3. Ambil data dari form jika validasi berhasil
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 4. Inisialisasi UserModel dan cek data user
        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        // 5. Verifikasi User dan Password
        if ($user && password_verify($password, $user['password'])) {
            // Jika user ditemukan DAN password cocok:
            
            // a. Siapkan data untuk disimpan ke dalam session
            $sessionData = [
                'id_user'       => $user['id_user'],
                'username'      => $user['username'],
                'role'          => $user['role'],
                'isLoggedIn'    => true,
                'id_mahasiswa'  => $user['id_mahasiswa'] // <-- TAMBAHKAN BARIS INI
            ];

            // b. Simpan data ke session
            $this->session->set($sessionData);

            // c. Arahkan (redirect) ke dashboard yang sesuai dengan rolenya
            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/mahasiswa/dashboard');
            }
        } else {
            // Jika username tidak ditemukan atau password salah
            // Kembalikan ke halaman login dengan pesan error umum
            return redirect()->to('/')->withInput()->with('error', 'Username atau Password yang Anda masukkan salah.');
        }
    }

    /**
     * Proses Logout
     */
    public function logout()
    {
        // Hancurkan semua data session
        $this->session->destroy();
        
        // Arahkan kembali ke halaman login dengan pesan sukses
        return redirect()->to('/')->with('success', 'Anda berhasil logout.');
    }
}