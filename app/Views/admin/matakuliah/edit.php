<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Mata Kuliah</h1>
                </div>
                 <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/matakuliah') ?>">Mata Kuliah</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                 <div class="card-header">
                    <h3 class="card-title">Form Edit Mata Kuliah</h3>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('validation')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('validation')->listErrors() ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?= site_url('admin/matakuliah/update/' . $matakuliah['id_matkul']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="kode_matkul">Kode Mata Kuliah</label>
                            <input type="text" name="kode_matkul" id="kode_matkul" class="form-control" value="<?= esc($matakuliah['kode_matkul']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_matkul">Nama Mata Kuliah</label>
                            <input type="text" name="nama_matkul" id="nama_matkul" class="form-control" value="<?= esc($matakuliah['nama_matkul']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="sks">SKS</label>
                            <input type="number" name="sks" id="sks" class="form-control" value="<?= esc($matakuliah['sks']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="id_dosen">Dosen Pengajar</label>
                            <select name="id_dosen" id="id_dosen" class="form-control" required>
                                <option value="">-- Pilih Dosen --</option>
                                <?php foreach ($dosen_list as $dosen) : ?>
                                    <option value="<?= $dosen['id_dosen'] ?>" <?= ($matakuliah['id_dosen'] == $dosen['id_dosen']) ? 'selected' : '' ?>>
                                        <?= esc($dosen['nama_dosen']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <a href="<?= site_url('admin/matakuliah') ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>