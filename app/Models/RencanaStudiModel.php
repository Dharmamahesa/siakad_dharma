<?php

namespace App\Models;

use CodeIgniter\Model;

class RencanaStudiModel extends Model
{
    /**
     * Nama tabel database yang terhubung dengan model ini.
     * @var string
     */
    protected $table            = 'rencana_studi';

    /**
     * Nama kolom yang menjadi Primary Key.
     * @var string
     */
    protected $primaryKey       = 'id_rs';

    /**
     * Menentukan apakah Primary Key menggunakan auto-increment.
     * @var bool
     */
    protected $useAutoIncrement = true;

    /**
     * Tipe data yang akan dikembalikan saat mengambil data.
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Menentukan apakah data akan dihapus secara permanen atau hanya diberi tanda.
     * @var bool
     */
    protected $useSoftDeletes   = false;

    /**
     * Kolom-kolom yang diizinkan untuk diisi atau diubah.
     * @var array
     */
    protected $allowedFields    = ['id_mahasiswa', 'id_matkul', 'tahun_akademik', 'semester', 'status'];
    
    /**
     * Menentukan apakah Model harus mengelola timestamp secara otomatis.
     * @var bool
     */
    protected $useTimestamps = false;


    /**
     * FUNGSI KHUSUS: Mengambil detail Kartu Rencana Studi (KRS)
     * untuk satu mahasiswa tertentu, lengkap dengan detail mata kuliahnya.
     *
     * @param int $id_mahasiswa ID dari mahasiswa yang KRS-nya ingin dilihat.
     * @return array
     */
    public function getKrsByMahasiswa(int $id_mahasiswa)
    {
        // Menggunakan Query Builder untuk query yang lebih kompleks
        return $this->builder()
            
            // Pilih semua kolom dari 'rencana_studi' dan beberapa kolom dari 'mata_kuliah'
            ->select('rencana_studi.*, mata_kuliah.kode_matkul, mata_kuliah.nama_matkul, mata_kuliah.sks')
            
            // Gabungkan dengan tabel 'mata_kuliah' berdasarkan id_matkul
            ->join('mata_kuliah', 'mata_kuliah.id_matkul = rencana_studi.id_matkul', 'left')
            
            // Filter hasilnya HANYA untuk mahasiswa yang sedang login
            ->where('rencana_studi.id_mahasiswa', $id_mahasiswa)

            // Urutkan hasilnya berdasarkan nama mata kuliah
            ->orderBy('mata_kuliah.nama_matkul', 'ASC')
            
            // Eksekusi query dan kembalikan hasilnya sebagai array
            ->get()
            ->getResultArray();
    }
    public function getPesertaByMatkul(int $id_matkul)
    {
        return $this->builder()
            ->select('mahasiswa.nim, mahasiswa.nama_mahasiswa, mahasiswa.angkatan')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = rencana_studi.id_mahasiswa')
            ->where('rencana_studi.id_matkul', $id_matkul)
            ->orderBy('mahasiswa.nama_mahasiswa', 'ASC')
            ->get()
            ->getResultArray();
    }
}