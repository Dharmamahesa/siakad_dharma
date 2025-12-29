<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Tambah User Baru</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Tambah User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header"><h3 class="card-title">Form Pembuatan Akun</h3></div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('validation')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('validation')->listErrors() ?></div>
                    <?php endif; ?>

                    <form action="<?= site_url('admin/user/store') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label>Pilih Role</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="role_mahasiswa" value="mahasiswa" checked onclick="toggleDropdowns()">
                                <label class="form-check-label" for="role_mahasiswa">Mahasiswa</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="role_dosen" value="dosen" onclick="toggleDropdowns()">
                                <label class="form-check-label" for="role_dosen">Dosen</label>
                            </div>
                        </div>

                        <div class="form-group" id="mahasiswa_dropdown">
                            <label for="id_mahasiswa">Pilih Mahasiswa</label>
                            <select name="id_mahasiswa" id="id_mahasiswa" class="form-control">
                                <option value="">-- Pilih Mahasiswa yang Belum Punya Akun --</option>
                                <?php foreach ($mahasiswa_list as $mhs) : ?>
                                    <option value="<?= $mhs['id_mahasiswa'] ?>"><?= esc($mhs['nim']) ?> - <?= esc($mhs['nama_mahasiswa']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group" id="dosen_dropdown" style="display: none;">
                            <label for="id_dosen">Pilih Dosen</label>
                            <select name="id_dosen" id="id_dosen" class="form-control">
                                <option value="">-- Pilih Dosen yang Belum Punya Akun --</option>
                                <?php foreach ($dosen_list as $dosen) : ?>
                                    <option value="<?= $dosen['id_dosen'] ?>"><?= esc($dosen['nidn']) ?> - <?= esc($dosen['nama_dosen']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username..." required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        
                        <hr>
                        <button type="submit" class="btn btn-primary">Buat Akun</button>
                        <a href="<?= site_url('admin/dashboard') ?>" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>

<script>
// Fungsi JavaScript untuk menampilkan/menyembunyikan dropdown
function toggleDropdowns() {
    var isMahasiswa = document.getElementById('role_mahasiswa').checked;
    document.getElementById('mahasiswa_dropdown').style.display = isMahasiswa ? 'block' : 'none';
    document.getElementById('id_mahasiswa').required = isMahasiswa;

    var isDosen = document.getElementById('role_dosen').checked;
    document.getElementById('dosen_dropdown').style.display = isDosen ? 'block' : 'none';
    document.getElementById('id_dosen').required = isDosen;
}
// Panggil saat halaman pertama kali dimuat
toggleDropdowns();
</script>