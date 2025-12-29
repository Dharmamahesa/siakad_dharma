<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    /**
     * Nama tabel database yang terhubung dengan model ini.
     * @var string
     */
    protected $table            = 'mahasiswa';

    /**
     * Nama kolom yang menjadi Primary Key.
     * @var string
     */
    protected $primaryKey       = 'id_mahasiswa';

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
    protected $allowedFields    = ['nim', 'nama_mahasiswa', 'prodi', 'angkatan', 'foto'];

    /**
     * Menentukan apakah Model harus mengelola timestamp `created_at` dan `updated_at` secara otomatis.
     * Kita set 'false' karena tabel kita hanya memiliki `created_at` yang diatur oleh database.
     * @var bool
     */
    protected $useTimestamps = false;
    
    // Tidak perlu menambahkan fungsi kustom seperti find(), findAll(), save(), delete(), dll.
    // karena semuanya sudah otomatis diwarisi dari `CodeIgniter\Model`.
    // di dalam file app/Models/MahasiswaModel.php

    /**
     * Mengambil daftar mahasiswa yang belum memiliki akun di tabel users.
     * @return array
     */
    public function getUnlinkedMahasiswa()
    {
        return $this->builder()
            ->select('mahasiswa.id_mahasiswa, mahasiswa.nim, mahasiswa.nama_mahasiswa')
            ->join('users', 'users.id_mahasiswa = mahasiswa.id_mahasiswa', 'left')
            ->where('users.id_user IS NULL')
            ->orderBy('mahasiswa.nama_mahasiswa', 'ASC')
            ->get()
            ->getResultArray();
    }
    /**
     * Menghitung jumlah mahasiswa per angkatan untuk data grafik.
     * @return array
     */
    public function getAngkatanStats()
    {
        return $this->builder()
            ->select('angkatan, COUNT(id_mahasiswa) as jumlah')
            ->groupBy('angkatan')
            ->orderBy('angkatan', 'ASC')
            ->get()
            ->getResultArray();
    }
}