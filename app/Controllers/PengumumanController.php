<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;

class PengumumanController extends BaseController
{
    protected $pengumumanModel;

    public function __construct()
    {
        $this->pengumumanModel = new PengumumanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Pengumuman',
            'pengumuman' => $this->pengumumanModel->orderBy('tgl_posting', 'DESC')->findAll()
        ];
        return view('admin/pengumuman/index', $data);
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate([
            'judul' => 'required',
            'isi'   => 'required',
            'target'=> 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->pengumumanModel->save([
            'judul'   => $this->request->getPost('judul'),
            'isi'     => $this->request->getPost('isi'),
            'target'  => $this->request->getPost('target'),
            'penulis' => session()->get('username') // Ambil dari sesi login
        ]);

        return redirect()->to('/admin/pengumuman')->with('success', 'Pengumuman berhasil diposting!');
    }

    public function delete($id)
    {
        $this->pengumumanModel->delete($id);
        return redirect()->to('/admin/pengumuman')->with('success', 'Pengumuman dihapus.');
    }
}