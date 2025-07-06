<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Tambah Mata Kuliah ke KRS</h1>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header"><h3 class="card-title">Pilih Mata Kuliah yang Tersedia</h3></div>
                <div class="card-body">
                    <form action="<?= site_url('mahasiswa/krs/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr><th>Pilih</th><th>Kode MK</th><th>Nama Mata Kuliah</th><th>SKS</th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($matakuliah_list as $matkul): ?>
                                    <tr>
                                        <td class="text-center"><input type="checkbox" name="matkul_ids[]" value="<?= $matkul['id_matkul'] ?>"></td>
                                        <td><?= esc($matkul['kode_matkul']) ?></td>
                                        <td><?= esc($matkul['nama_matkul']) ?></td>
                                        <td><?= esc($matkul['sks']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <hr>
                        <a href="<?= site_url('mahasiswa/krs') ?>" class="btn btn-secondary">Kembali ke KRS</a>
                        <button type="submit" class="btn btn-primary">Simpan Pilihan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>