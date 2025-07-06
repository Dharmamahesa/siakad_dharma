<?php

namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    /**
     * Nama tabel database yang diwakili oleh model ini.
     * @var string
     */
    protected $table            = 'mata_kuliah';

    /**
     * Nama kolom yang menjadi Primary Key di tabel ini.
     * @var string
     */
    protected $primaryKey       = 'id_matkul';

    /**
     * Menentukan apakah Primary Key menggunakan auto-increment.
     * @var bool
     */
    protected $useAutoIncrement = true;

    /**
     * Tipe data yang dikembalikan dari query.
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Daftar kolom yang diizinkan untuk diisi saat menggunakan method save(), insert(), atau update().
     * @var array
     */
    protected $allowedFields = ['kode_matkul', 'nama_matkul', 'sks', 'id_dosen', 'hari', 'jam_mulai', 'jam_selesai', 'ruangan'];

    /**
     * Menentukan apakah Model harus mengelola timestamp `created_at` dan `updated_at`.
     * @var bool
     */
    protected $useTimestamps = false;


    /**
     * FUNGSI KHUSUS: Mengambil semua data mata kuliah beserta
     * nama dosen pengajarnya dengan melakukan JOIN.
     *
     * @return array
     */
    public function getAllWithDosen()
    {
        // Menggunakan Query Builder bawaan CodeIgniter
        return $this->builder()
            // Memilih semua kolom dari tabel 'mata_kuliah'
            ->select('mata_kuliah.*, dosen.nama_dosen, dosen.nidn') 
            
            // Menggabungkan (JOIN) dengan tabel 'dosen'
            // dimana 'dosen.id_dosen' sama dengan 'mata_kuliah.id_dosen'
            ->join('dosen', 'dosen.id_dosen = mata_kuliah.id_dosen', 'left') // 'left' join untuk jaga-jaga jika ada matkul tanpa dosen

            // Mengurutkan hasilnya berdasarkan nama mata kuliah
            ->orderBy('mata_kuliah.nama_matkul', 'ASC')

            // Eksekusi query
            ->get() 
            
            // Kembalikan hasilnya dalam bentuk array
            ->getResultArray(); 
    }
    public function getMatkulByDosen(int $id_dosen)
    {
        return $this->where('id_dosen', $id_dosen)
                    ->orderBy('nama_matkul', 'ASC')
                    ->findAll();
    }

}