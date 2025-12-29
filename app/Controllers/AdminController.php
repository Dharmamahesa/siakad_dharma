<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\MataKuliahModel;

class AdminController extends BaseController
{
     public function index()
    {
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $dosenModel = new \App\Models\DosenModel();
        $mataKuliahModel = new \App\Models\MataKuliahModel();

        // Ambil data statistik angkatan dari model
        $angkatanStats = $mahasiswaModel->getAngkatanStats();

        $data = [
            'title'             => 'Dashboard Admin',
            'total_mahasiswa'   => $mahasiswaModel->countAllResults(),
            'total_dosen'       => $dosenModel->countAllResults(),
            'total_matakuliah'  => $mataKuliahModel->countAllResults(),
            'angkatan_stats'    => $angkatanStats // Kirim data statistik ke view
        ];
        
        return view('admin/dashboard', $data);
    }
    // --- CRUD MAHASISWA -------------------------------------------------
    
    public function mahasiswa_index()
    {
        $mahasiswaModel = new MahasiswaModel();
        $data = [
            'title'          => 'Manajemen Mahasiswa',
            'mahasiswa_list' => $mahasiswaModel->orderBy('nama_mahasiswa', 'ASC')->findAll()
        ];
        // PERBAIKAN: Memanggil nama file yang benar
        return view('mahasiswa/index', $data);
    }

    public function mahasiswa_create()
    {
        $data['title'] = 'Tambah Mahasiswa Baru';
        // PERBAIKAN: Memanggil nama file yang benar
        return view('mahasiswa/create', $data);
    }

    public function mahasiswa_store()
    {
        // ... (Logika store tidak berubah)
        $rules = [
            'nim'            => 'required|is_unique[mahasiswa.nim]',
            'nama_mahasiswa' => 'required|min_length[3]',
            'angkatan'       => 'required|integer|exact_length[4]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->save($this->request->getPost());
        return redirect()->to('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function mahasiswa_edit($id)
    {
        $mahasiswaModel = new MahasiswaModel();
        $data = [
            'title'     => 'Edit Mahasiswa',
            'mahasiswa' => $mahasiswaModel->find($id)
        ];
        if (empty($data['mahasiswa'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mahasiswa tidak ditemukan.');
        }
        // PERBAIKAN: Memanggil nama file yang benar
        return view('mahasiswa/edit', $data);
    }

    public function mahasiswa_update($id)
    {
        // ... (Logika update tidak berubah)
        $rules = [
            'nim'            => "required|is_unique[mahasiswa.nim,id_mahasiswa,{$id}]",
            'nama_mahasiswa' => 'required|min_length[3]',
            'angkatan'       => 'required|integer|exact_length[4]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function mahasiswa_delete($id)
    {
        // ... (Logika delete tidak berubah)
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->delete($id);
        return redirect()->to('/admin/mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
    // --- CRUD DOSEN -----------------------------------------------------

    public function dosen_index()
    {
        $dosenModel = new DosenModel();
        $data = [
            'title'      => 'Manajemen Dosen',
            'dosen_list' => $dosenModel->findAll()
        ];
        return view('admin/dosen/index', $data);
    }

    public function dosen_create()
    {
        $data['title'] = 'Tambah Dosen Baru';
        return view('admin/dosen/create', $data);
    }

    public function dosen_store()
    {
        $rules = [
            'nidn'       => 'required|is_unique[dosen.nidn]',
            'nama_dosen' => 'required|min_length[3]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $dosenModel = new DosenModel();
        $dosenModel->save($this->request->getPost());
        return redirect()->to('/admin/dosen')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function dosen_edit($id)
    {
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Edit Dosen',
            'dosen' => $dosenModel->find($id)
        ];
        if (empty($data['dosen'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Dosen tidak ditemukan.');
        }
        return view('admin/dosen/edit', $data);
    }

    public function dosen_update($id)
    {
        $rules = [
            'nidn'       => "required|is_unique[dosen.nidn,id_dosen,{$id}]",
            'nama_dosen' => 'required|min_length[3]',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $dosenModel = new DosenModel();
        $dosenModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/dosen')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function dosen_delete($id)
    {
        $dosenModel = new DosenModel();
        $dosenModel->delete($id);
        return redirect()->to('/admin/dosen')->with('success', 'Data dosen berhasil dihapus.');
    }

    // --- CRUD MATA KULIAH -----------------------------------------------

    public function matakuliah_index()
    {
        $matakuliahModel = new MataKuliahModel();
        $data = [
            'title'           => 'Manajemen Mata Kuliah',
            'matakuliah_list' => $matakuliahModel->getAllWithDosen()
        ];
        return view('admin/matakuliah/index', $data);
    }

    public function matakuliah_create()
    {
        $dosenModel = new DosenModel();
        $data = [
            'title'      => 'Tambah Mata Kuliah Baru',
            'dosen_list' => $dosenModel->findAll()
        ];
        return view('admin/matakuliah/create', $data);
    }

    public function matakuliah_store()
    {
        $rules = [
            'kode_matkul' => 'required|is_unique[mata_kuliah.kode_matkul]',
            'nama_matkul' => 'required|min_length[3]',
            'sks'         => 'required|integer',
            'id_dosen'    => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $matakuliahModel = new MataKuliahModel();
        $matakuliahModel->save($this->request->getPost());
        return redirect()->to('/admin/matakuliah')->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    public function matakuliah_edit($id)
    {
        $matakuliahModel = new MataKuliahModel();
        $dosenModel = new DosenModel();
        $data = [
            'title'      => 'Edit Mata Kuliah',
            'matakuliah' => $matakuliahModel->find($id),
            'dosen_list' => $dosenModel->findAll()
        ];
        if (empty($data['matakuliah'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Mata kuliah tidak ditemukan.');
        }
        return view('admin/matakuliah/edit', $data);
    }

    public function matakuliah_update($id)
    {
        $rules = [
            'kode_matkul' => "required|is_unique[mata_kuliah.kode_matkul,id_matkul,{$id}]",
            'nama_matkul' => 'required|min_length[3]',
            'sks'         => 'required|integer',
            'id_dosen'    => 'required'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $matakuliahModel = new MataKuliahModel();
        $matakuliahModel->update($id, $this->request->getPost());
        return redirect()->to('/admin/matakuliah')->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    public function matakuliah_delete($id)
    {
        $matakuliahModel = new MataKuliahModel();
        $matakuliahModel->delete($id);
        return redirect()->to('/admin/matakuliah')->with('success', 'Data mata kuliah berhasil dihapus.');
    }
     public function user_create()
    {
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $dosenModel = new \App\Models\DosenModel();
        
        $data = [
            'title' => 'Tambah User Baru',
            // Ambil mahasiswa yang belum punya akun
            'mahasiswa_list' => $mahasiswaModel->getUnlinkedMahasiswa(),
            // Ambil dosen yang belum punya akun
            'dosen_list' => $dosenModel->getUnlinkedDosen(),
        ];
        
        return view('admin/user/create', $data);
    }

    /**
     * Menyimpan data user baru ke database.
     */
    public function user_store()
    {
        // Validasi input dasar
        $rules = [
            'role'         => 'required|in_list[mahasiswa,dosen]',
            'username'     => 'required|is_unique[users.username]',
            'password'     => 'required|min_length[5]',
        ];

        // Tambahkan validasi kondisional berdasarkan role
        if ($this->request->getPost('role') === 'mahasiswa') {
            $rules['id_mahasiswa'] = 'required';
        } else {
            $rules['id_dosen'] = 'required';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Siapkan data untuk disimpan
        $role = $this->request->getPost('role');
        $dataToSave = [
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => $role,
            'id_mahasiswa' => ($role === 'mahasiswa') ? $this->request->getPost('id_mahasiswa') : null,
            'id_dosen'     => ($role === 'dosen') ? $this->request->getPost('id_dosen') : null,
        ];
        
        $userModel = new \App\Models\UserModel();
        $userModel->save($dataToSave);

        return redirect()->to('/admin/dashboard')->with('success', 'User untuk ' . $role . ' berhasil dibuat.');
    }
}