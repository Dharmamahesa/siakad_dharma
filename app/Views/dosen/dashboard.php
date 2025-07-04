<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Dashboard Dosen</h1>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= esc($total_matakuliah ?? 0) ?></h3>
                            <p>Mata Kuliah Diampu</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <a href="<?= site_url('dosen/matakuliah') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">Selamat Datang, Dosen!</h3>
                </div>
                <div class="card-body">
                    <p>Anda telah berhasil login sebagai Dosen. Gunakan menu di samping untuk mengakses fitur yang tersedia.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>