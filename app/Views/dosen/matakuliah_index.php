<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Mata Kuliah Diampu</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('dosen/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Mata Kuliah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Daftar Mata Kuliah yang Anda Ajar</h3></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr><th>#</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php if(empty($matakuliah_list)): ?>
                                <tr><td colspan="5" class="text-center">Anda tidak mengampu mata kuliah apapun.</td></tr>
                            <?php else: ?>
                                <?php foreach ($matakuliah_list as $key => $matkul): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= esc($matkul['kode_matkul']) ?></td>
                                    <td><?= esc($matkul['nama_matkul']) ?></td>
                                    <td><?= esc($matkul['sks']) ?></td>
                                    <td><a href="<?= site_url('dosen/kelas/detail/' . $matkul['id_matkul']) ?>" class="btn btn-sm btn-info">Lihat Peserta Kelas</a></td>
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