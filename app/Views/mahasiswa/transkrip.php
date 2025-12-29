<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Transkrip Nilai Sementara</h1>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mahasiswa</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>NIM:</strong> <?= esc($mahasiswa['nim'] ?? '') ?></p>
                            <p><strong>Nama Lengkap:</strong> <?= esc($mahasiswa['nama_mahasiswa'] ?? '') ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Angkatan:</strong> <?= esc($mahasiswa['angkatan'] ?? '') ?></p>
                            <p><strong>Status:</strong> Aktif</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Studi</h3>
                    <div class="card-tools">
                        <button class="btn btn-primary btn-sm" onclick="window.print()"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($course_list)): ?>
                                <tr><td colspan="5" class="text-center">Belum ada riwayat studi.</td></tr>
                            <?php else: ?>
                                <?php foreach ($course_list as $key => $course): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= esc($course['kode_matkul']) ?></td>
                                        <td><?= esc($course['nama_matkul']) ?></td>
                                        <td><?= esc($course['sks']) ?></td>
                                        <td><?= esc($course['grade_huruf']) ?? '-' ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="font-weight-bold">
                            <tr>
                                <td colspan="2" class="text-right">Total SKS Diambil</td>
                                <td><?= esc($total_sks) ?></td>
                                <td class="text-right">IPK</td>
                                <td><span class="badge badge-success" style="font-size:1rem;"><?= esc($ipk) ?></span></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>