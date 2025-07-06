<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Mata Kuliah Baru</h1>
                </div><div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/matakuliah') ?>">Mata Kuliah</a></li>
                        <li class="breadcrumb-item active">Tambah Baru</li>
                    </ol>
                </div></div></div></div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Mata Kuliah</h3>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('validation')) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('validation')->listErrors() ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('admin/matakuliah/store') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label for="kode_matkul">Kode Mata Kuliah</label>
                            <input type="text" name="kode_matkul" id="kode_matkul" class="form-control" value="<?= old('kode_matkul') ?>" placeholder="Contoh: MK001" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_matkul">Nama Mata Kuliah</label>
                            <input type="text" name="nama_matkul" id="nama_matkul" class="form-control" value="<?= old('nama_matkul') ?>" placeholder="Contoh: Pemrograman Web Lanjut" required>
                        </div>
                        <div class="form-group">
                            <label for="sks">Jumlah SKS</label>
                            <input type="number" name="sks" id="sks" class="form-control" value="<?= old('sks') ?>" placeholder="Contoh: 3" required>
                        </div>
                        <div class="form-group">
                            <label for="id_dosen">Dosen Pengajar</label>
                            <select name="id_dosen" id="id_dosen" class="form-control" required>
                                <option value="">-- Pilih Dosen --</option>
                                <?php if (!empty($dosen_list)): ?>
                                    <?php foreach ($dosen_list as $dosen) : ?>
                                        <option value="<?= $dosen['id_dosen'] ?>" <?= (old('id_dosen') == $dosen['id_dosen']) ? 'selected' : '' ?>>
                                            <?= esc($dosen['nama_dosen']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        <div class="form-group">
    <label for="hari">Hari</label>
    <select name="hari" id="hari" class="form-control">
        <option value="">-- Pilih Hari --</option>
        <option value="Senin" <?= (old('hari') == 'Senin') ? 'selected' : '' ?>>Senin</option>
        <option value="Selasa" <?= (old('hari') == 'Selasa') ? 'selected' : '' ?>>Selasa</option>
        <option value="Rabu" <?= (old('hari') == 'Rabu') ? 'selected' : '' ?>>Rabu</option>
        <option value="Kamis" <?= (old('hari') == 'Kamis') ? 'selected' : '' ?>>Kamis</option>
        <option value="Jumat" <?= (old('hari') == 'Jumat') ? 'selected' : '' ?>>Jumat</option>
        <option value="Sabtu" <?= (old('hari') == 'Sabtu') ? 'selected' : '' ?>>Sabtu</option>
    </select>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="jam_mulai">Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="<?= old('jam_mulai') ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="jam_selesai">Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="<?= old('jam_selesai') ?>">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="ruangan">Ruangan</label>
    <input type="text" name="ruangan" id="ruangan" class="form-control" value="<?= old('ruangan') ?>" placeholder="Contoh: G.2.1">
</div>
<hr>
<button type="submit" class="btn btn-primary">Simpan</button>