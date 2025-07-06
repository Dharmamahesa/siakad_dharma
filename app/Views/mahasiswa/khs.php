<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                 <h1 class="m-0">Kartu Hasil Studi (KHS)</h1>
                 <h4>IPK: <span class="badge badge-success"><?= $ipk ?></span></h4>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <?php if (empty($khs_data)): ?>
                <div class="alert alert-info">Belum ada data nilai yang bisa ditampilkan.</div>
            <?php else: ?>
                <?php foreach ($khs_data as $semester => $courses): ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold">Semester: <?= esc($semester) ?></h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Kode MK</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Nilai</th>
                                    <th>Bobot</th>
                                    <th>SKS x Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $total_sks_semester = 0;
                                    $total_sks_x_bobot_semester = 0;
                                ?>
                                <?php foreach ($courses as $course): ?>
                                    <tr>
                                        <td><?= esc($course['kode_matkul']) ?></td>
                                        <td><?= esc($course['nama_matkul']) ?></td>
                                        <td><?= esc($course['sks']) ?></td>
                                        <td><?= esc($course['grade_huruf']) ?? '-' ?></td>
                                        <td><?= esc($course['bobot']) ?></td>
                                        <td><?= esc($course['sks_x_bobot']) ?></td>
                                    </tr>
                                    <?php 
                                        if($course['grade_huruf'] != null){
                                            $total_sks_semester += $course['sks'];
                                            $total_sks_x_bobot_semester += $course['sks_x_bobot'];
                                        }
                                    ?>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="font-weight-bold">
                                <?php $ip_semester = ($total_sks_semester > 0) ? $total_sks_x_bobot_semester / $total_sks_semester : 0; ?>
                                <tr>
                                    <td colspan="2">Total Semester Ini</td>
                                    <td><?= $total_sks_semester ?></td>
                                    <td colspan="2" class="text-right">Indeks Prestasi (IP):</td>
                                    <td><span class="badge badge-primary"><?= number_format($ip_semester, 2) ?></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>