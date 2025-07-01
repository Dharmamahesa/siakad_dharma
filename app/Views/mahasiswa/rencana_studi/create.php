<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
       <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Mata Kuliah</h1>
                </div>
                 <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('mahasiswa/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('mahasiswa/krs') ?>">KRS</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Pilih Mata Kuliah yang Tersedia</h3>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('mahasiswa/krs/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Pilih</th>
                                    <th>Kode MK</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>SKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($matakuliah_list as $matkul) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="matkul_ids[]" value="<?= $matkul['id_matkul'] ?>">
                                            </div>
                                        </td>
                                        <td><?= esc($matkul['kode_matkul']) ?></td>
                                        <td><?= esc($matkul['nama_matkul']) ?></td>
                                        <td><?= esc($matkul['sks']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                        <a href="<?= site_url('mahasiswa/krs') ?>" class="btn btn-secondary">Kembali ke KRS</a>
                        <button type="submit" class="btn btn-primary">Simpan ke KRS</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>