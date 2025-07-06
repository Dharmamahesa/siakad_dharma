<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Profil Saya</h1>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                             src="https://ui-avatars.com/api/?name=<?= urlencode($mahasiswa['nama_mahasiswa']) ?>&size=128&background=0D8ABC&color=fff"
                             alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center"><?= esc($mahasiswa['nama_mahasiswa']) ?></h3>
                    <p class="text-muted text-center">Mahasiswa</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>NIM</b> <a class="float-right"><?= esc($mahasiswa['nim']) ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Angkatan</b> <a class="float-right"><?= esc($mahasiswa['angkatan']) ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Username</b> <a class="float-right"><?= esc(session()->get('username')) ?></a>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary btn-block disabled"><b>Edit Profil</b> (Coming Soon)</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>