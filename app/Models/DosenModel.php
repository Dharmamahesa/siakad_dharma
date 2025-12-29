<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    /**
     * Nama tabel database yang terhubung dengan model ini.
     * @var string
     */
    protected $table            = 'dosen';
    
    /**
     * Nama kolom yang menjadi Primary Key.
     * @var string
     */
    protected $primaryKey       = 'id_dosen';

    /**
     * Menentukan apakah Primary Key menggunakan auto-increment.
     * @var bool
     */
    protected $useAutoIncrement = true;

    /**
     * Tipe data yang akan dikembalikan saat mengambil data.
     * 'array' adalah pilihan yang paling umum dan fleksibel.
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Menentukan apakah data akan dihapus secara permanen atau hanya diberi tanda.
     * 'false' berarti data akan dihapus permanen.
     * @var bool
     */
    protected $useSoftDeletes   = false;

    /**
     * Kolom-kolom yang diizinkan untuk diisi atau diubah melalui method save(), insert(), atau update().
     * Ini adalah fitur keamanan penting untuk mencegah Mass Assignment.
     * @var array
     */
    protected $allowedFields    = ['nidn', 'nama_dosen', 'kontak'];

    /**
     * Menentukan apakah Model harus mengelola timestamp `created_at` dan `updated_at` secara otomatis.
     * Kita set 'false' karena tabel kita hanya memiliki `created_at` yang diatur oleh database.
     * @var bool
     */
    protected $useTimestamps = false;

     /**
     * Mengambil daftar dosen yang belum memiliki akun di tabel users.
     * @return array
     */
    public function getUnlinkedDosen()
    {
        return $this->builder()
            ->select('dosen.id_dosen, dosen.nidn, dosen.nama_dosen')
            ->join('users', 'users.id_dosen = dosen.id_dosen', 'left')
            ->where('users.id_user IS NULL') // Cari yang tidak punya pasangan di tabel users
            ->orderBy('dosen.nama_dosen', 'ASC')
            ->get()
            ->getResultArray();
    }

    // Seperti halnya MahasiswaModel, tidak perlu menulis fungsi CRUD manual
    // karena semuanya sudah otomatis diwarisi dari class Model bawaan CodeIgniter.
}