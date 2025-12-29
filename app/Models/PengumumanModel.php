<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table            = 'pengumuman';
    protected $primaryKey       = 'id_pengumuman';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['judul', 'isi', 'tgl_posting', 'target', 'penulis'];
    
    // Untuk mengambil pengumuman berdasarkan role user yang login
    public function getPengumumanForUser($role)
    {
        return $this->whereIn('target', ['semua', $role])
                    ->orderBy('tgl_posting', 'DESC')
                    ->findAll(5); // Ambil 5 terbaru
    }
}