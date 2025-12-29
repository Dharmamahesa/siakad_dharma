<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Input Nilai: <?= esc($matakuliah['nama_matkul']) ?></h1>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <form action="<?= site_url('dosen/simpan-nilai') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="id_matkul" value="<?= $matakuliah['id_matkul'] ?>">
                <div class="card">
                    <div class="card-header"><h3 class="card-title">Daftar Peserta Kelas</h3></div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th width="15%">Nilai Tugas</th>
                                    <th width="15%">Nilai UTS</th>
                                    <th width="15%">Nilai UAS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($peserta_list as $key => $peserta): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><?= esc($peserta['nim']) ?></td>
                                    <td><?= esc($peserta['nama_mahasiswa']) ?></td>
                                    <td>
                                        <input type="number" name="nilai[<?= $peserta['id_rs'] ?>][tugas]" class="form-control" value="<?= esc($peserta['nilai_tugas']) ?>">
                                    </td>
                                    <td>
                                        <input type="number" name="nilai[<?= $peserta['id_rs'] ?>][uts]" class="form-control" value="<?= esc($peserta['nilai_uts']) ?>">
                                    </td>
                                    <td>
                                        <input type="number" name="nilai[<?= $peserta['id_rs'] ?>][uas]" class="form-control" value="<?= esc($peserta['nilai_uas']) ?>">
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="<?= site_url('dosen/kelas/detail/' . $matakuliah['id_matkul']) ?>" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Semua Nilai</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>