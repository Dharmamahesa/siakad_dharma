<?= $this->extend('layouts/admin_header') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="background: transparent;">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-white" style="text-shadow: 0 2px 4px rgba(0,0,0,0.5);">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard Mahasiswa
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: transparent;">
                        <li class="breadcrumb-item"><a href="#" class="text-white">Home</a></li>
                        <li class="breadcrumb-item active text-white">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div></div>
    <section class="content">
        <div class="container-fluid">

            <?php if(!empty($pengumuman)): ?>
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title text-white">
                                <i class="fas fa-bullhorn mr-1"></i> Pengumuman Terbaru
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool text-white" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php foreach($pengumuman as $info): ?>
                                <div class="callout callout-info" style="background: rgba(255,255,255,0.1); border-left: 5px solid #17a2b8; margin-bottom: 15px;">
                                    <h5 class="text-white">
                                        <?= esc($info['judul']) ?> 
                                        <small class="float-right text-light" style="font-size: 12px">
                                            <i class="far fa-clock mr-1"></i> <?= date('d M Y, H:i', strtotime($info['tgl_posting'])) ?>
                                        </small>
                                    </h5>
                                    <p class="text-white"><?= nl2br(esc($info['isi'])) ?></p>
                                    <div class="text-right text-white small">
                                        <i class="fas fa-user-edit mr-1"></i> Posted by: <?= esc($info['penulis']) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if(!empty($mahasiswa['foto'])): ?>
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="<?= base_url('uploads/foto/' . $mahasiswa['foto']) ?>"
                                         alt="User profile picture"
                                         style="border: 3px solid rgba(255,255,255,0.5);">
                                <?php else: ?>
                                    <div class="text-center mb-3">
                                        <i class="fas fa-user-circle fa-5x text-white"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <h3 class="profile-username text-center text-white"><?= esc($mahasiswa['nama_mahasiswa']) ?></h3>
                            <p class="text-white text-center mb-1"><?= esc($mahasiswa['nim']) ?></p>
                            <p class="text-white text-center badge badge-primary d-block">Mahasiswa Aktif</p>

                            <ul class="list-group list-group-unbordered mb-3 mt-4">
                                <li class="list-group-item" style="background: transparent; border-bottom: 1px solid rgba(255,255,255,0.2);">
                                    <b class="text-white">Program Studi</b> 
                                    <a class="float-right text-white"><?= esc($mahasiswa['prodi']) ?></a>
                                </li>
                                <li class="list-group-item" style="background: transparent; border-bottom: 1px solid rgba(255,255,255,0.2);">
                                    <b class="text-white">Angkatan</b> 
                                    <a class="float-right text-white"><?= esc($mahasiswa['angkatan']) ?></a>
                                </li>
                                <li class="list-group-item" style="background: transparent; border-bottom: 0;">
                                    <b class="text-white">Email</b> 
                                    <a class="float-right text-white"><?= esc($mahasiswa['email']) ?></a>
                                </li>
                            </ul>
                            
                            <a href="<?= base_url('mahasiswa/profil') ?>" class="btn btn-primary btn-block">
                                <i class="fas fa-user-cog"></i> Edit Profil
                            </a>
                        </div>
                        </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title text-white">
                                <i class="far fa-calendar-alt mr-1"></i> Jadwal Kuliah Saya
                            </h3>
                            <div class="card-tools">
                                <a href="<?= base_url('mahasiswa/jadwal') ?>" class="btn btn-tool btn-sm">
                                    <i class="fas fa-external-link-alt"></i> Lihat Semua
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Ruang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(empty($jadwal_list)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-white py-4">
                                                <i class="fas fa-calendar-times mb-2" style="font-size: 2rem; opacity: 0.5;"></i><br>
                                                Belum ada jadwal mata kuliah yang diambil.<br>
                                                Silakan isi KRS terlebih dahulu.
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php 
                                        // Batasi tampilan dashboard hanya 5 jadwal pertama
                                        $limit_jadwal = array_slice($jadwal_list, 0, 5);
                                        foreach($limit_jadwal as $j): 
                                        ?>
                                        <tr>
                                            <td>
                                                <span class="badge badge-info"><?= esc($j['hari']) ?></span>
                                            </td>
                                            <td class="text-white"><?= esc($j['jam_mulai']) ?> - <?= esc($j['jam_selesai']) ?></td>
                                            <td>
                                                <strong class="text-white"><?= esc($j['nama_matkul']) ?></strong><br>
                                                <small class="text-light"><?= esc($j['nama_dosen']) ?></small>
                                            </td>
                                            <td class="text-white"><?= esc($j['sks']) ?></td>
                                            <td class="text-white"><?= esc($j['ruangan']) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <a href="<?= base_url('mahasiswa/krs') ?>" class="btn btn-app bg-success btn-block" style="height: auto; padding: 15px; color: white !important;">
                                <i class="fas fa-edit" style="font-size: 24px;"></i> 
                                <span style="display: block; margin-top: 5px; font-weight: bold;">Isi KRS Semester Ini</span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="<?= base_url('mahasiswa/khs') ?>" class="btn btn-app bg-info btn-block" style="height: auto; padding: 15px; color: white !important;">
                                <i class="fas fa-file-alt" style="font-size: 24px;"></i> 
                                <span style="display: block; margin-top: 5px; font-weight: bold;">Lihat Hasil Studi (KHS)</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            </div></section>
    </div>
<?= $this->endSection() ?>