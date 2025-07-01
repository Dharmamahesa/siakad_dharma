<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kartu Rencana Studi (KRS)</h1>
                </div>
                 <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('mahasiswa/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">KRS</li>
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
            <div class="card">
                <div class="card-header">
                    <a href="<?= site_url('mahasiswa/krs/tambah') ?>" class="btn btn-primary">Tambah Mata Kuliah</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($krs_list)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Anda belum mengambil mata kuliah apapun.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($krs_list as $key => $krs) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= esc($krs['kode_matkul']) ?></td>
                                        <td><?= esc($krs['nama_matkul']) ?></td>
                                        <td><?= esc($krs['sks']) ?></td>
                                        <td><span class="badge badge-info"><?= esc($krs['status']) ?></span></td>
                                        <td>
                                            <a href="<?= site_url('mahasiswa/krs/hapus/' . $krs['id_rs']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini dari KRS?')">Hapus</a>
                                        </td>
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