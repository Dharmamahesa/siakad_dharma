<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Dosen</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dosen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="<?= site_url('admin/dosen/create') ?>" class="btn btn-primary">Tambah Dosen</a>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                    <?php endif; ?>

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIDN</th>
                                <th>Nama Dosen</th>
                                <th>Kontak</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($dosen_list)): ?>
                                <tr><td colspan="5" class="text-center">Belum ada data dosen.</td></tr>
                            <?php else: ?>
                                <?php foreach ($dosen_list as $key => $dosen) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= esc($dosen['nidn']) ?></td>
                                        <td><?= esc($dosen['nama_dosen']) ?></td>
                                        <td><?= esc($dosen['kontak']) ?></td>
                                        <td>
                                            <a href="<?= site_url('admin/dosen/edit/' . $dosen['id_dosen']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="<?= site_url('admin/dosen/delete/' . $dosen['id_dosen']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
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