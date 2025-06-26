<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    /**
     * Nama tabel yang akan diwakili oleh model ini.
     * @var string
     */
    protected $table            = 'users';

    /**
     * Nama primary key dari tabel 'users'.
     * @var string
     */
    protected $primaryKey       = 'id_user';

    /**
     * Menandakan apakah primary key menggunakan auto-increment.
     * @var bool
     */
    protected $useAutoIncrement = true;

    /**
     * Tipe data yang akan dikembalikan oleh method.
     * @var string
     */
    protected $returnType       = 'array';

    /**
     * Daftar kolom yang diizinkan untuk diisi melalui operasi
     * insert atau update.
     * @var array
     */
    protected $allowedFields    = ['username', 'password', 'role', 'id_mahasiswa'];

    /**
     * Menentukan apakah Model harus mengelola timestamp.
     * @var bool
     */
    protected $useTimestamps = false;


    /**
     * Mengambil data user berdasarkan username.
     * Method ini akan dipanggil di AuthController saat proses login.
     *
     * @param string $username Username yang akan dicari.
     * @return array|null Mengembalikan data user dalam bentuk array jika ditemukan, atau null jika tidak.
     */
    public function getUserByUsername(string $username)
    {
        // Menggunakan Query Builder bawaan CodeIgniter Model
        // Sama dengan "SELECT * FROM users WHERE username = ? LIMIT 1"
        return $this->where('username', $username)->first();
    }
}