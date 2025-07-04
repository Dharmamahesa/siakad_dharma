<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MataKuliahModel;
use App\Models\RencanaStudiModel;

class DosenController extends BaseController
{
    public function index()
    {
        $matakuliahModel = new MataKuliahModel();
        $id_dosen = session()->get('id_dosen');

        // Pengecekan keamanan sesi
        if (!$id_dosen) {
            return redirect()->to('/logout')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }

        $data = [
            'title' => 'Dashboard Dosen',
            'total_matakuliah' => $matakuliahModel->where('id_dosen', $id_dosen)->countAllResults(),
        ];
        
        return view('dosen/dashboard', $data);
    }

    public function matakuliah()
    {
        $matakuliahModel = new MataKuliahModel();
        $id_dosen = session()->get('id_dosen');

        // Pengecekan keamanan sesi
        if (!$id_dosen) {
            return redirect()->to('/logout')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }

        $data = [
            'title' => 'Mata Kuliah Diampu',
            'matakuliah_list' => $matakuliahModel->getMatkulByDosen($id_dosen)
        ];

        return view('dosen/matakuliah_index', $data);
    }

    public function kelas_detail($id_matkul)
    {
        $matakuliahModel = new MataKuliahModel();
        $rencanaStudiModel = new RencanaStudiModel();
        $id_dosen = session()->get('id_dosen');

        // Pengecekan keamanan sesi
        if (!$id_dosen) {
            return redirect()->to('/logout')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }

        $matkul = $matakuliahModel->find($id_matkul);
        if (!$matkul || $matkul['id_dosen'] != $id_dosen) {
            return redirect()->to('/dosen/matakuliah')->with('error', 'Anda tidak memiliki akses ke kelas ini.');
        }

        $data = [
            'title' => 'Detail Kelas',
            'matakuliah' => $matkul,
            'peserta_list' => $rencanaStudiModel->getPesertaByMatkul($id_matkul)
        ];

        return view('dosen/kelas_detail', $data);
    }
}