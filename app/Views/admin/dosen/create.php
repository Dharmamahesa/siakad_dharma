<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Tambah Dosen Baru</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dosen') ?>">Dosen</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Form Tambah Dosen</h3></div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('validation')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('validation')->listErrors() ?></div>
                    <?php endif; ?>

                    <form action="<?= site_url('admin/dosen/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="nidn">NIDN</label>
                            <input type="text" name="nidn" id="nidn" class="form-control" value="<?= old('nidn') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_dosen">Nama Dosen</label>
                            <input type="text" name="nama_dosen" id="nama_dosen" class="form-control" value="<?= old('nama_dosen') ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kontak">Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="form-control" value="<?= old('kontak') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?= site_url('admin/dosen') ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>