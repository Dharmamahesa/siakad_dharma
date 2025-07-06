<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Kartu Rencana Studi (KRS)</h1>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
             <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <a href="<?= site_url('mahasiswa/krs/tambah') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Mata Kuliah</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr><th>#</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php if (empty($krs_list)): ?>
                                <tr><td colspan="5" class="text-center">Anda belum mengambil mata kuliah.</td></tr>
                            <?php else: ?>
                                <?php foreach ($krs_list as $key => $krs): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= esc($krs['kode_matkul']) ?></td>
                                        <td><?= esc($krs['nama_matkul']) ?></td>
                                        <td><?= esc($krs['sks']) ?></td>
                                        <td><a href="<?= site_url('mahasiswa/krs/hapus/' . $krs['id_rs']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus mata kuliah ini dari KRS?')"><i class="fas fa-trash"></i></a></td>
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