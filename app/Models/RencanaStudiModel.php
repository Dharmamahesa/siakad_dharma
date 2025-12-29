<?php
<<<<<<< HEAD

namespace App\Models;

=======
namespace App\Models;
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
use CodeIgniter\Model;

class RencanaStudiModel extends Model
{
    protected $table            = 'rencana_studi';
    protected $primaryKey       = 'id_rs';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_mahasiswa', 'id_matkul', 'tahun_akademik', 'semester', 'status'];
<<<<<<< HEAD
    protected $useTimestamps    = false;

    /**
     * Mengambil KRS Mahasiswa beserta detail Matkul dan Dosennya
     */
    public function getKrsByMahasiswa(int $id_mahasiswa)
    {
        return $this->builder()
            ->select('rencana_studi.*, mata_kuliah.kode_matkul, mata_kuliah.nama_matkul, mata_kuliah.sks, mata_kuliah.hari, mata_kuliah.jam_mulai, mata_kuliah.jam_selesai, mata_kuliah.ruangan, dosen.nama_dosen')
            ->join('mata_kuliah', 'mata_kuliah.id_matkul = rencana_studi.id_matkul', 'left')
            ->join('dosen', 'dosen.id_dosen = mata_kuliah.id_dosen', 'left') // JOIN DOSEN DITAMBAHKAN
=======
    protected $useTimestamps = false;

    public function getKrsByMahasiswa(int $id_mahasiswa)
    {
        return $this->builder()
            ->select('rencana_studi.*, mata_kuliah.kode_matkul, mata_kuliah.nama_matkul, mata_kuliah.sks')
            ->join('mata_kuliah', 'mata_kuliah.id_matkul = rencana_studi.id_matkul', 'left')
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
            ->where('rencana_studi.id_mahasiswa', $id_mahasiswa)
            ->orderBy('mata_kuliah.nama_matkul', 'ASC')
            ->get()->getResultArray();
    }
    
<<<<<<< HEAD
    /**
     * Mengambil daftar peserta dalam satu mata kuliah (Untuk Dosen)
     */
=======
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
    public function getPesertaByMatkul(int $id_matkul)
    {
        return $this->builder()
            ->select('mahasiswa.nim, mahasiswa.nama_mahasiswa, mahasiswa.angkatan, rencana_studi.id_rs, nilai.nilai_tugas, nilai.nilai_uts, nilai.nilai_uas')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = rencana_studi.id_mahasiswa')
            ->join('nilai', 'nilai.id_rs = rencana_studi.id_rs', 'left')
            ->where('rencana_studi.id_matkul', $id_matkul)
            ->orderBy('mahasiswa.nama_mahasiswa', 'ASC')
            ->get()->getResultArray();
    }

    /**
<<<<<<< HEAD
     * Mengambil KHS dan Jadwal (Digunakan di Dashboard & Transkrip)
     * PERBAIKAN: Menambahkan join ke tabel dosen agar 'nama_dosen' muncul.
=======
     * FUNGSI YANG DIPERBAIKI: Mengambil data KHS dan mengelompokkannya per semester.
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
     */
    public function getKHS(int $id_mahasiswa)
    {
        $rawData = $this->builder()
<<<<<<< HEAD
            ->select('rencana_studi.*, 
                      mata_kuliah.kode_matkul, mata_kuliah.nama_matkul, mata_kuliah.sks, 
                      mata_kuliah.hari, mata_kuliah.jam_mulai, mata_kuliah.jam_selesai, mata_kuliah.ruangan, 
                      dosen.nama_dosen, 
                      nilai.grade_huruf')
            ->join('mata_kuliah', 'mata_kuliah.id_matkul = rencana_studi.id_matkul')
            ->join('dosen', 'dosen.id_dosen = mata_kuliah.id_dosen', 'left') // JOIN DOSEN PENTING DI SINI
=======
            ->select('rencana_studi.*, mata_kuliah.kode_matkul, mata_kuliah.nama_matkul, mata_kuliah.sks, mata_kuliah.hari, mata_kuliah.jam_mulai, mata_kuliah.jam_selesai, mata_kuliah.ruangan, nilai.grade_huruf')
            ->join('mata_kuliah', 'mata_kuliah.id_matkul = rencana_studi.id_matkul')
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
            ->join('nilai', 'nilai.id_rs = rencana_studi.id_rs', 'left')
            ->where('rencana_studi.id_mahasiswa', $id_mahasiswa)
            ->orderBy('rencana_studi.tahun_akademik, rencana_studi.semester', 'ASC')
            ->get()->getResultArray();

<<<<<<< HEAD
        // Grouping data per semester
        $khs = [];
        foreach ($rawData as $row) {
            $semesterKey = $row['tahun_akademik'] . ' - ' . $row['semester'];
            
            // Hitung Bobot Nilai
            $bobot = 0;
            if (isset($row['grade_huruf'])) {
                switch ($row['grade_huruf']) {
                    case 'A': $bobot = 4; break;
                    case 'B': $bobot = 3; break;
                    case 'C': $bobot = 2; break;
                    case 'D': $bobot = 1; break;
                    default:  $bobot = 0;
                }
            }
            
            $row['bobot'] = $bobot;
            $row['sks_x_bobot'] = $row['sks'] * $bobot;
            
            // Masukkan ke array
            $khs[$semesterKey][] = $row;
        }
        
=======
        $khs = [];
        foreach ($rawData as $row) {
            $semesterKey = $row['tahun_akademik'] . ' - ' . $row['semester'];
            $bobot = 0;
            switch ($row['grade_huruf']) {
                case 'A': $bobot = 4; break;
                case 'B': $bobot = 3; break;
                case 'C': $bobot = 2; break;
                case 'D': $bobot = 1; break;
                default:  $bobot = 0;
            }
            $row['bobot'] = $bobot;
            $row['sks_x_bobot'] = $row['sks'] * $bobot;
            $khs[$semesterKey][] = $row;
        }
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
        return $khs;
    }
}