<?php
echo view('layouts/admin_header');
echo view('layouts/admin_sidebar');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div></div></div></div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Mahasiswa</span>
                            <span class="info-box-number"><?= esc($total_mahasiswa ?? 0) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Dosen</span>
                            <span class="info-box-number"><?= esc($total_dosen ?? 0) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Mata Kuliah</span>
                            <span class="info-box-number"><?= esc($total_matakuliah ?? 0) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                     <div class="card card-primary card-outline dashboard-card">
                        <div class="card-header">
                            <h3 class="card-title">Selamat Datang, <?= esc(session()->get('username')) ?>!</h3>
                        </div>
                        <div class="card-body">
                            <p>Anda telah login sebagai Administrator. Gunakan menu di samping untuk mengelola data master sistem.</p>
                            <hr style="border-top: 1px solid rgba(255,255,255,.5);">
                            <h4>Saran Pengembangan Dashboard:</h4>
                            <ul>
                                <li><strong>Grafik Mahasiswa Baru per Angkatan:</strong> Tambahkan grafik batang untuk memvisualisasikan jumlah mahasiswa yang mendaftar setiap tahunnya.</li>
                                <li><strong>Daftar Aktivitas Terbaru:</strong> Buat sebuah tabel log yang menampilkan 5 aktivitas terakhir yang terjadi di sistem.</li>
                                <li><strong>Notifikasi Persetujuan:</strong> Jika sistem dikembangkan, dashboard ini adalah tempat yang tepat untuk menampilkan notifikasi penting.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div></div>
    </div>
<?php
echo view('layouts/admin_footer');
?>