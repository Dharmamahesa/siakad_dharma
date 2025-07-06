<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Mahasiswa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <h5>Selamat Datang, <strong><?= esc($mahasiswa['nama_mahasiswa'] ?? 'Mahasiswa') ?>!</strong></h5>
                            <p>Berikut adalah jadwal kuliah Anda untuk semester ini.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i>Jadwal Kuliah Semester Ini</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Ruangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($jadwal_list)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                Jadwal belum tersedia.
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($jadwal_list as $jadwal): ?>
                                            <tr>
                                                <td class="font-weight-bold"><?= esc($jadwal['hari']) ?></td>
                                                <td><?= esc(date('H:i', strtotime($jadwal['jam_mulai']))) ?> - <?= esc(date('H:i', strtotime($jadwal['jam_selesai']))) ?></td>
                                                <td><?= esc($jadwal['nama_matkul']) ?> <br><small class="text-muted"><?= esc($jadwal['kode_matkul']) ?></small></td>
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
            </div></div>
    </div>
<?= view('layouts/admin_footer') ?>