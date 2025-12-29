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

        $data = [
            'title' => 'Dashboard Dosen',
            // Kita tambahkan pengecekan di sini agar tidak error jika id_dosen null
            'total_matakuliah' => $id_dosen ? $matakuliahModel->where('id_dosen', $id_dosen)->countAllResults() : 0,
        ];
        
        return view('dosen/dashboard', $data);
    }

    public function matakuliah()
{
    $matakuliahModel = new \App\Models\MataKuliahModel();
    $id_dosen = session()->get('id_dosen');

    if (!$id_dosen) {
        return redirect()->to('/logout')->with('error', 'Sesi tidak valid.');
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

        $matkul = $matakuliahModel->find($id_matkul);
        // Pengecekan keamanan tetap di sini, ini penting
        if (!$matkul || $matkul['id_dosen'] != $id_dosen) {
            return redirect()->to('/dosen/matakuliah')->with('error', 'Anda tidak memiliki hak akses ke kelas ini.');
        }

        $data = [
            'title' => 'Detail Kelas',
            'matakuliah' => $matkul,
            'peserta_list' => $rencanaStudiModel->getPesertaByMatkul($id_matkul)
        ];

        return view('dosen/kelas_detail', $data);
    }
    public function input_nilai($id_matkul)
    {
        $matakuliahModel = new \App\Models\MataKuliahModel();
        $rencanaStudiModel = new \App\Models\RencanaStudiModel();
        $id_dosen = session()->get('id_dosen');

        // Verifikasi kepemilikan kelas
        $matkul = $matakuliahModel->find($id_matkul);
        if (!$matkul || $matkul['id_dosen'] != $id_dosen) {
            return redirect()->to('/dosen/matakuliah')->with('error', 'Akses ditolak.');
        }

        $data = [
            'title' => 'Input Nilai',
            'matakuliah' => $matkul,
            // Panggil fungsi yang sudah di-join dengan tabel nilai
            'peserta_list' => $rencanaStudiModel->getPesertaByMatkul($id_matkul)
        ];

        return view('dosen/input_nilai', $data);
    }

    /**
     * FUNGSI BARU: Menyimpan data nilai yang disubmit dari form.
     */
    public function simpan_nilai()
    {
        $nilaiModel = new \App\Models\NilaiModel();
        $id_matkul = $this->request->getPost('id_matkul');

        // Ambil semua data nilai dari form
        $nilai_data = $this->request->getPost('nilai');

        foreach ($nilai_data as $id_rs => $nilai) {
            $dataToSave = [
                'id_rs' => $id_rs,
                'nilai_tugas' => $nilai['tugas'],
                'nilai_uts' => $nilai['uts'],
                'nilai_uas' => $nilai['uas'],
                // Di sini Anda bisa menambahkan logika untuk menghitung nilai akhir dan grade
            ];

            // Cek apakah sudah ada nilai untuk id_rs ini
            $existingNilai = $nilaiModel->where('id_rs', $id_rs)->first();

            if ($existingNilai) {
                // Jika sudah ada, update
                $nilaiModel->update($existingNilai['id_nilai'], $dataToSave);
            } else {
                // Jika belum ada, insert
                $nilaiModel->insert($dataToSave);
            }
        }

        return redirect()->to('/dosen/kelas/detail/' . $id_matkul)->with('success', 'Nilai berhasil disimpan/diperbarui.');
    }
}