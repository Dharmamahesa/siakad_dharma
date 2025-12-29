<?php

namespace App\Models;

use CodeIgniter\Model;

class RencanaStudiModel extends Model
{
    protected $table            = 'rencana_studi';
    protected $primaryKey       = 'id_rs';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['id_mahasiswa', 'id_matkul', 'tahun_akademik', 'semester', 'status'];
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
            ->where('rencana_studi.id_mahasiswa', $id_mahasiswa)
            ->orderBy('mata_kuliah.nama_matkul', 'ASC')
            ->get()->getResultArray();
    }
    
    /**
     * Mengambil daftar peserta dalam satu mata kuliah (Untuk Dosen)
     */
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
     * Mengambil KHS dan Jadwal (Digunakan di Dashboard & Transkrip)
     * PERBAIKAN: Menambahkan join ke tabel dosen agar 'nama_dosen' muncul.
     */
    public function getKHS(int $id_mahasiswa)
    {
        $rawData = $this->builder()
            ->select('rencana_studi.*, 
                      mata_kuliah.kode_matkul, mata_kuliah.nama_matkul, mata_kuliah.sks, 
                      mata_kuliah.hari, mata_kuliah.jam_mulai, mata_kuliah.jam_selesai, mata_kuliah.ruangan, 
                      dosen.nama_dosen, 
                      nilai.grade_huruf')
            ->join('mata_kuliah', 'mata_kuliah.id_matkul = rencana_studi.id_matkul')
            ->join('dosen', 'dosen.id_dosen = mata_kuliah.id_dosen', 'left') // JOIN DOSEN PENTING DI SINI
            ->join('nilai', 'nilai.id_rs = rencana_studi.id_rs', 'left')
            ->where('rencana_studi.id_mahasiswa', $id_mahasiswa)
            ->orderBy('rencana_studi.tahun_akademik, rencana_studi.semester', 'ASC')
            ->get()->getResultArray();

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
        
        return $khs;
    }
}