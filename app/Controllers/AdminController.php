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
        $mahasiswaModel = new MahasiswaModel();
        $dosenModel = new DosenModel();
        $mataKuliahModel = new MataKuliahModel();

        $data = [
            'title' => 'Dashboard Admin',
            'total_mahasiswa' => $mahasiswaModel->countAllResults(),
            'total_dosen' => $dosenModel->countAllResults(),
            'total_matakuliah' => $mataKuliahModel->countAllResults()
        ];
        
        return view('admin/dashboard', $data);
    }

    // ====================================================================
    // FUNGSI CRUD MAHASISWA (Sudah ada, tidak perlu diubah)
    // ====================================================================
    public function mahasiswa_index() { /* ... kode Anda saat ini ... */ }
    public function mahasiswa_create() { /* ... kode Anda saat ini ... */ }
    public function mahasiswa_store() { /* ... kode Anda saat ini ... */ }
    public function mahasiswa_edit($id) { /* ... kode Anda saat ini ... */ }
    public function mahasiswa_update($id) { /* ... kode Anda saat ini ... */ }
    public function mahasiswa_delete($id) { /* ... kode Anda saat ini ... */ }


    // ====================================================================
    // !! FUNGSI BARU UNTUK CRUD DOSEN !!
    // ====================================================================

    public function dosen_index()
    {
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Manajemen Dosen',
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
            'nidn' => 'required|is_unique[dosen.nidn]',
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
            'nidn' => "required|is_unique[dosen.nidn,id_dosen,{$id}]",
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


    // ====================================================================
    // !! FUNGSI BARU UNTUK CRUD MATA KULIAH !!
    // ====================================================================

    public function matakuliah_index()
    {
        $matakuliahModel = new MataKuliahModel();
        $data = [
            'title' => 'Manajemen Mata Kuliah',
            // Gunakan method custom kita untuk mendapatkan nama dosen
            'matakuliah_list' => $matakuliahModel->getAllWithDosen()
        ];
        return view('admin/matakuliah/index', $data);
    }

    public function matakuliah_create()
    {
        $dosenModel = new DosenModel();
        $data = [
            'title' => 'Tambah Mata Kuliah Baru',
            'dosen_list' => $dosenModel->findAll() // Untuk mengisi dropdown
        ];
        return view('admin/matakuliah/create', $data);
    }

    public function matakuliah_store()
    {
        $rules = [
            'kode_matkul' => 'required|is_unique[mata_kuliah.kode_matkul]',
            'nama_matkul' => 'required|min_length[3]',
            'sks' => 'required|integer',
            'id_dosen' => 'required'
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
            'title' => 'Edit Mata Kuliah',
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
            'sks' => 'required|integer',
            'id_dosen' => 'required'
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
}