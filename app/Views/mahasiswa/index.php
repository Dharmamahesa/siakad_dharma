<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manajemen Mahasiswa</h1>
                </div><div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Mahasiswa</li>
                    </ol>
                </div></div></div></div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="<?= site_url('admin/mahasiswa/create') ?>" class="btn btn-primary">
                        <i class="fas fa-plus mr-2"></i>Tambah Mahasiswa
                    </a>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>

                    <table id="mahasiswa-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px;">#</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Angkatan</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($mahasiswa_list)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data mahasiswa.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($mahasiswa_list as $key => $mahasiswa) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= esc($mahasiswa['nim']) ?></td>
                                        <td><?= esc($mahasiswa['nama_mahasiswa']) ?></td>
                                        <td><?= esc($mahasiswa['angkatan']) ?></td>
                                        <td>
                                            <a href="<?= site_url('admin/mahasiswa/edit/' . $mahasiswa['id_mahasiswa']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= site_url('admin/mahasiswa/delete/' . $mahasiswa['id_mahasiswa']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini? Ini tidak dapat diurungkan.')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div></div>
    </div>
<?= view('layouts/admin_footer') ?>