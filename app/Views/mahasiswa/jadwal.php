<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Jadwal Kuliah Semester Ini</h1>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jadwal Kuliah Anda</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Hari</th>
                                <th>Jam</th>
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Ruangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($jadwal_list)): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Jadwal tidak tersedia. <br>
                                        <small>Pastikan Anda sudah mengisi KRS dan admin telah mengatur jadwal untuk mata kuliah tersebut.</small>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($jadwal_list as $jadwal): ?>
                                    <tr>
                                        <td class="font-weight-bold"><?= esc($jadwal['hari']) ?></td>
                                        <td><?= esc(date('H:i', strtotime($jadwal['jam_mulai']))) ?> - <?= esc(date('H:i', strtotime($jadwal['jam_selesai']))) ?></td>
                                        <td><?= esc($jadwal['kode_matkul']) ?></td>
                                        <td><?= esc($jadwal['nama_matkul']) ?></td>
                                        <td><?= esc($jadwal['sks']) ?></td>
                                        <td><span class="badge bg-success"><?= esc($jadwal['ruangan']) ?></span></td>
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