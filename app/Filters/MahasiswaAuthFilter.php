<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah session 'isLoggedIn' TIDAK ADA,
        // ATAU session 'role' BUKAN 'mahasiswa'
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'mahasiswa') {
            // Jika tidak memenuhi syarat, lempar kembali ke halaman login
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah request
    }
}