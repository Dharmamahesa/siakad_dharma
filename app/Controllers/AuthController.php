<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class AuthController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = Services::session();
        helper(['form', 'url']);
    }

    public function login()
    {
        if ($this->session->get('isLoggedIn')) {
            $role = $this->session->get('role');
            if ($role === 'admin') { return redirect()->to('/admin/dashboard'); } 
            elseif ($role === 'mahasiswa') { return redirect()->to('/mahasiswa/dashboard'); } 
            elseif ($role === 'dosen') { return redirect()->to('/dosen/dashboard'); }
        }
        return view('auth/login');
    }

    public function processLogin()
    {
        $rules = ['username' => 'required', 'password' => 'required'];
        if (!$this->validate($rules)) {
            return redirect()->to('/')->withInput()->with('error', 'Username dan Password wajib diisi.');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
           $sessionData = [
                'id_user'       => $user['id_user'],
                'username'      => $user['username'],
                'role'          => $user['role'],
                'isLoggedIn'    => true,
                'id_mahasiswa'  => $user['id_mahasiswa'],
                'id_dosen'      => $user['id_dosen'] // <-- Kunci perbaikannya ada di sini
            ];
            
            $this->session->set($sessionData);
            $role = $user['role'];
            if ($role === 'admin') { return redirect()->to('/admin/dashboard'); } 
            elseif ($role === 'mahasiswa') { return redirect()->to('/mahasiswa/dashboard'); } 
            elseif ($role === 'dosen') { return redirect()->to('/dosen/dashboard'); }
        }

        return redirect()->to('/')->withInput()->with('error', 'Username atau Password yang Anda masukkan salah.');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Anda berhasil logout.');
    }
}