<?php
// Ganti layout header dan footer ini jika Anda membuat layout khusus untuk mahasiswa
echo view('layouts/admin_header'); 
echo view('layouts/admin_sidebar'); 
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title">Informasi Mahasiswa</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Nama:</strong> <?= esc($mahasiswa['nama_mahasiswa'] ?? 'Tidak Ditemukan') ?></p>
                            <p><strong>NIM:</strong> <?= esc($mahasiswa['nim'] ?? 'Tidak Ditemukan') ?></p>
                            <p><strong>Angkatan:</strong> <?= esc($mahasiswa['angkatan'] ?? 'Tidak Ditemukan') ?></p>
                            <a href="<?= site_url('mahasiswa/krs') ?>" class="btn btn-primary">Lihat Kartu Rencana Studi (KRS)</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Upload Laporan Final Project</h5>
                        </div>
                        <div class="card-body">
                            <p>Silakan upload file laporan akhir Anda dalam format PDF (Maksimal 2MB).</p>
                            
                            <?php if (session()->getFlashdata('validation')) : ?>
                                <div class="alert alert-danger">
                                    <?= session()->getFlashdata('validation')->listErrors() ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= site_url('mahasiswa/upload') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="laporan_project">Pilih File PDF</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="laporan_project" name="laporan_project" required>
                                            <label class="custom-file-label" for="laporan_project">Pilih file...</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success">Upload File</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo view('layouts/admin_footer'); 
?>