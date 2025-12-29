<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\RencanaStudiModel;
use App\Models\MataKuliahModel;
<<<<<<< HEAD
use App\Models\PengumumanModel; // Tambahan: Import Model Pengumuman
=======
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae

class MahasiswaController extends BaseController
{
    /**
     * Menampilkan dashboard utama mahasiswa.
     */
    public function index()
    {
<<<<<<< HEAD
        $mahasiswaModel = new MahasiswaModel();
        $rencanaStudiModel = new RencanaStudiModel();
        
        // Tambahan: Inisialisasi Model Pengumuman
        $pengumumanModel = new PengumumanModel();

=======
        $mahasiswaModel = new \App\Models\MahasiswaModel();
        $rencanaStudiModel = new \App\Models\RencanaStudiModel();
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
        $id_mahasiswa = session()->get('id_mahasiswa');

        // 1. Ambil data KRS lengkap
        $allKrsData = $rencanaStudiModel->getKHS($id_mahasiswa);
        
        // 2. Olah data untuk jadwal
        $flat_list = [];
        foreach ($allKrsData as $semesterData) {
            foreach ($semesterData as $course) {
                if (!empty($course['hari'])) { // Hanya ambil yang punya jadwal
                    $flat_list[] = $course;
                }
            }
        }

        // 3. Urutkan jadwal berdasarkan hari dan jam
        $hari_urutan = array_flip(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
        usort($flat_list, function ($a, $b) use ($hari_urutan) {
            $pos_a = $hari_urutan[$a['hari']] ?? 99;
            $pos_b = $hari_urutan[$b['hari']] ?? 99;
            if ($pos_a == $pos_b) {
                return strcmp($a['jam_mulai'], $b['jam_mulai']);
            }
            return $pos_a <=> $pos_b;
        });

<<<<<<< HEAD
        // 4. Tambahan: Ambil Pengumuman untuk Dashboard
        // Mengambil data dari tabel pengumuman dengan target 'semua' atau 'mahasiswa'
        $list_pengumuman = $pengumumanModel->getPengumumanForUser('mahasiswa');

        // 5. Siapkan semua data untuk dikirim ke view
        $data = [
            'title'       => 'Dashboard Mahasiswa',
            'mahasiswa'   => $mahasiswaModel->find($id_mahasiswa),
            'jadwal_list' => $flat_list,      // Data jadwal
            'pengumuman'  => $list_pengumuman // Data pengumuman baru
=======
        // 4. Siapkan semua data untuk dikirim ke view
        $data = [
            'title' => 'Dashboard Mahasiswa',
            'mahasiswa' => $mahasiswaModel->find($id_mahasiswa),
            'jadwal_list' => $flat_list, // Kirim data jadwal yang sudah diolah
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
        ];
        
        return view('mahasiswa/dashboard', $data);
    }
    
    /**
     * Menampilkan halaman utama Kartu Rencana Studi (KRS).
     */
    public function rencanaStudi_index()
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $id_mahasiswa = session()->get('id_mahasiswa');
        $data = [
            'title' => 'Kartu Rencana Studi',
            'krs_list' => $rencanaStudiModel->getKrsByMahasiswa($id_mahasiswa),
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
            'matakuliah_list' => $mataKuliahModel->findAll(),
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
        $matkul_ids = $this->request->getPost('matkul_ids');

        if (empty($matkul_ids)) {
            return redirect()->back()->with('error', 'Tidak ada mata kuliah yang dipilih.');
        }
        foreach ($matkul_ids as $id_matkul) {
            $dataToSave = [
                'id_mahasiswa'   => $id_mahasiswa,
                'id_matkul'      => $id_matkul,
                'tahun_akademik' => '2024/2025',
                'semester'       => 'Genap',
            ];
            try {
                $rencanaStudiModel->insert($dataToSave);
            } catch (\Exception $e) {
                // Abaikan error jika data sudah ada, lanjutkan ke matkul berikutnya
                continue;
            }
        }
        return redirect()->to('/mahasiswa/krs')->with('success', 'KRS berhasil diperbarui.');
    }

    /**
     * Menghapus satu mata kuliah dari KRS.
     */
    public function rencanaStudi_delete_item($id_rs)
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $id_mahasiswa = session()->get('id_mahasiswa');
        $item = $rencanaStudiModel->find($id_rs);
        if ($item && $item['id_mahasiswa'] == $id_mahasiswa) {
            $rencanaStudiModel->delete($id_rs);
            return redirect()->to('/mahasiswa/krs')->with('success', 'Mata kuliah berhasil dihapus dari KRS.');
        }
        return redirect()->to('/mahasiswa/krs')->with('error', 'Aksi tidak diizinkan.');
    }

    /**
     * Menampilkan halaman Kartu Hasil Studi (KHS).
     */
     public function khs()
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $id_mahasiswa = session()->get('id_mahasiswa');

        $khsData = $rencanaStudiModel->getKHS($id_mahasiswa);

        $total_sks_x_bobot = 0;
        $total_sks = 0;
        foreach ($khsData as $semesterData) {
            foreach ($semesterData as $course) {
                if (isset($course['sks_x_bobot'])) {
                    $total_sks_x_bobot += $course['sks_x_bobot'];
                    $total_sks += $course['sks'];
                }
            }
        }
        $ipk = ($total_sks > 0) ? $total_sks_x_bobot / $total_sks : 0;

        $data = [
            'title' => 'Kartu Hasil Studi',
            'khs_data' => $khsData,
            'ipk' => number_format($ipk, 2)
        ];
        return view('mahasiswa/khs', $data);
    }

    /**
<<<<<<< HEAD
     * Menampilkan Transkrip Nilai Sementara.
=======
     * FUNGSI TRANSKRIP YANG DIPERBAIKI
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
     */
    public function transkrip()
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $mahasiswaModel = new MahasiswaModel();
        $id_mahasiswa = session()->get('id_mahasiswa');
        $allKrsData = $rencanaStudiModel->getKHS($id_mahasiswa);
        $mahasiswaInfo = $mahasiswaModel->find($id_mahasiswa);

        $flat_list = [];
        foreach ($allKrsData as $semesterData) {
            foreach ($semesterData as $course) {
                $flat_list[] = $course;
            }
        }
        
        $total_sks_x_bobot = 0;
        $total_sks = 0;
        foreach ($flat_list as $course) {
            if (isset($course['sks_x_bobot'])) {
                $total_sks_x_bobot += $course['sks_x_bobot'];
                $total_sks += $course['sks'];
            }
        }
        $ipk = ($total_sks > 0) ? $total_sks_x_bobot / $total_sks : 0;

        $data = [
            'title' => 'Transkrip Nilai Sementara',
            'course_list' => $flat_list,
            'mahasiswa' => $mahasiswaInfo,
            'total_sks' => $total_sks,
            'ipk' => number_format($ipk, 2)
        ];
        return view('mahasiswa/transkrip', $data);
    }

    /**
<<<<<<< HEAD
     * Menampilkan Jadwal Kuliah.
=======
     * FUNGSI JADWAL YANG DIPERBAIKI
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
     */
    public function jadwal()
    {
        $rencanaStudiModel = new RencanaStudiModel();
        $id_mahasiswa = session()->get('id_mahasiswa');
        $allKrsData = $rencanaStudiModel->getKHS($id_mahasiswa);
        
        $flat_list = [];
        foreach ($allKrsData as $semesterData) {
            foreach ($semesterData as $course) {
                if (!empty($course['hari'])) {
                    $flat_list[] = $course;
                }
            }
        }

        $hari_urutan = array_flip(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']);
        usort($flat_list, function ($a, $b) use ($hari_urutan) {
            $pos_a = $hari_urutan[$a['hari']] ?? 99;
            $pos_b = $hari_urutan[$b['hari']] ?? 99;
            if ($pos_a == $pos_b) {
                return strcmp($a['jam_mulai'], $b['jam_mulai']);
            }
            return $pos_a <=> $pos_b;
        });

        $data = [
            'title' => 'Jadwal Kuliah',
            'jadwal_list' => $flat_list,
        ];

        return view('mahasiswa/jadwal', $data);
    }
}