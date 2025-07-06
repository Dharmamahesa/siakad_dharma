<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Detail Kelas</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('dosen/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('dosen/matakuliah') ?>">Mata Kuliah</a></li>
                        <li class="breadcrumb-item active">Detail Peserta</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peserta: <?= esc($matakuliah['nama_matkul']) ?> (<?= esc($matakuliah['kode_matkul']) ?>)</h3>
                </div>
                 <div class="card-header">
        <h3 class="card-title">Daftar Peserta: ... </h3>
        <div class="card-tools">
            <a href="<?= site_url('dosen/input-nilai/' . $matakuliah['id_matkul']) ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Input Nilai</a>
        </div>
    </div>
    <div class="card-body">
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr><th>#</th><th>NIM</th><th>Nama Mahasiswa</th><th>Angkatan</th></tr>
                        </thead>
                        <tbody>
                            <?php if(empty($peserta_list)): ?>
                                <tr><td colspan="4" class="text-center">Belum ada mahasiswa yang mengambil kelas ini.</td></tr>
                            <?php else: ?>
                                <?php foreach ($peserta_list as $key => $peserta): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= esc($peserta['nim']) ?></td>
                                    <td><?= esc($peserta['nama_mahasiswa']) ?></td>
                                    <td><?= esc($peserta['angkatan']) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>