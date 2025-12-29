<?= $this->extend('layouts/admin_header') ?>

<?= $this->section('content') ?>
<div class="content-wrapper" style="background: none;">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-white">📢 Kelola Pengumuman</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buat Pengumuman Baru</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/pengumuman/store') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" name="judul" class="form-control" required placeholder="Contoh: Libur Lebaran">
                                </div>
                                <div class="form-group">
                                    <label>Target Audience</label>
                                    <select name="target" class="form-control">
                                        <option value="semua">Semua User</option>
                                        <option value="mahasiswa">Hanya Mahasiswa</option>
                                        <option value="dosen">Hanya Dosen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Isi Pengumuman</label>
                                    <textarea name="isi" class="form-control" rows="4" required placeholder="Isi pesan..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-paper-plane"></i> Posting
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Riwayat Pengumuman</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Judul</th>
                                        <th>Target</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pengumuman as $p): ?>
                                    <tr>
                                        <td><?= date('d M Y', strtotime($p['tgl_posting'])) ?></td>
                                        <td>
                                            <strong><?= esc($p['judul']) ?></strong><br>
                                            <small><?= esc($p['isi']) ?></small>
                                        </td>
                                        <td>
                                            <?php if($p['target'] == 'semua'): ?>
                                                <span class="badge badge-info">Semua</span>
                                            <?php elseif($p['target'] == 'mahasiswa'): ?>
                                                <span class="badge badge-warning">Mhs</span>
                                            <?php else: ?>
                                                <span class="badge badge-success">Dosen</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/pengumuman/delete/'.$p['id_pengumuman']) ?>" 
                                               class="btn btn-sm btn-danger" 
                                               onclick="return confirm('Hapus pengumuman ini?')">
                                               <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>