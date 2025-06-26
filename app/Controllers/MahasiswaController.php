<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\RencanaStudiModel;
use App\Models\MataKuliahModel;

class MahasiswaController extends BaseController
{
    /**
     * Menampilkan halaman dashboard utama untuk mahasiswa.
     */
    public function index()
    {
        $mahasiswaModel = new MahasiswaModel();
        
        // Ambil id_mahasiswa yang sudah kita simpan di session saat login
        $id_mahasiswa = session()->get('id_mahasiswa');

        $data = [
            'title' => 'Dashboard Mahasiswa',
            'mahasiswa' => $mahasiswaModel->find($id_mahasiswa)
        ];
        
        return view('mahasiswa/dashboard', $data);
    }

    //--------------------------------------------------------------------
    // MANAJEMEN RENCANA STUDI (KRS)
    //--------------------------------------------------------------------

    /**
     * Menampilkan daftar mata kuliah yang sudah diambil (KRS).
     */
    public function rencanaStudi_index()
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $id_mahasiswa = session()->get('id_mahasiswa');

        $data = [
            'title' => 'Kartu Rencana Studi',
            'krs_list' => $rencanaStudiModel->getKrsByMahasiswa($id_mahasiswa)
        ];

        return view('mahasiswa/rencana_studi/index', $data);
    }
    
    /**
     * Menampilkan halaman untuk memilih mata kuliah baru.
     */
    public function rencanaStudi_create()
    {
        $mataKuliahModel = new MataKuliahModel();
        
        $data = [
            'title' => 'Tambah Mata Kuliah KRS',
            'matakuliah_list' => $mataKuliahModel->findAll()
        ];
        
        return view('mahasiswa/rencana_studi/create', $data);
    }

    /**
     * Menyimpan mata kuliah yang dipilih ke dalam KRS.
     */
    public function rencanaStudi_store()
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $id_mahasiswa = session()->get('id_mahasiswa');
        
        // Ambil ID mata kuliah yang dipilih dari form (diasumsikan berupa array checkbox)
        $matkul_ids = $this->request->getPost('matkul_ids');

        if (empty($matkul_ids)) {
            return redirect()->back()->with('error', 'Tidak ada mata kuliah yang dipilih.');
        }

        foreach ($matkul_ids as $id_matkul) {
            $data = [
                'id_mahasiswa' => $id_mahasiswa,
                'id_matkul' => $id_matkul,
                'tahun_akademik' => '2024/2025', // Bisa dibuat dinamis nanti
                'semester' => 'Genap'           // Bisa dibuat dinamis nanti
            ];
            // Menggunakan insert, akan gagal jika sudah ada (karena UNIQUE constraint di DB)
            // Ini mencegah duplikasi data
            try {
                $rencanaStudiModel->insert($data);
            } catch (\Exception $e) {
                // Abaikan error jika mata kuliah sudah ada, lanjutkan ke berikutnya
                continue;
            }
        }

        return redirect()->to('/mahasiswa/krs')->with('success', 'KRS berhasil diperbarui.');
    }

    /**
     * Menghapus satu item mata kuliah dari KRS.
     * @param int $id_rs ID dari tabel rencana_studi
     */
    public function rencanaStudi_delete_item($id_rs)
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $id_mahasiswa = session()->get('id_mahasiswa');

        // Penting! Cek dulu apakah item KRS ini benar-benar milik mahasiswa yang login
        $item = $rencanaStudiModel->find($id_rs);
        if ($item && $item['id_mahasiswa'] == $id_mahasiswa) {
            $rencanaStudiModel->delete($id_rs);
            return redirect()->to('/mahasiswa/krs')->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
        }

        return redirect()->to('/mahasiswa/krs')->with('error', 'Aksi tidak diizinkan.');
    }

    //--------------------------------------------------------------------
    // UPLOAD LAPORAN
    //--------------------------------------------------------------------
    
    /**
     * Memproses upload file laporan akhir.
     */
    public function upload_process()
    {
        $validationRule = [
            'laporan_project' => [
                'label' => 'File Laporan',
                'rules' => 'uploaded[laporan_project]'
                    . '|ext_in[laporan_project,pdf]'
                    . '|max_size[laporan_project,2048]', // Max 2MB
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $file = $this->request->getFile('laporan_project');

        if ($file->isValid() && !$file->hasMoved()) {
            // Buat nama file baru yang unik berdasarkan NIM dan nama asli file
            $nim = session()->get('username');
            $newName = $nim . '_' . $file->getRandomName();
            
            // Pindahkan file ke folder writable/uploads
            $file->move(WRITEPATH . 'uploads', $newName);
            
            return redirect()->to('/mahasiswa/dashboard')->with('success', 'File laporan berhasil di-upload.');
        }

        return redirect()->to('/mahasiswa/dashboard')->with('error', 'Gagal meng-upload file.');
    }
}