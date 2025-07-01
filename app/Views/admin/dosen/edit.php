<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>
<div class="content-wrapper">
    <div class="content-header">
        </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h4>Form Edit Dosen</h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('admin/dosen/update/' . $dosen['id_dosen']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>NIDN</label>
                            <input type="text" name="nidn" class="form-control" value="<?= esc($dosen['nidn']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Nama Dosen</label>
                            <input type="text" name="nama_dosen" class="form-control" value="<?= esc($dosen['nama_dosen']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Kontak</label>
                            <input type="text" name="kontak" class="form-control" value="<?= esc($dosen['kontak']) ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= view('layouts/admin_footer') ?>