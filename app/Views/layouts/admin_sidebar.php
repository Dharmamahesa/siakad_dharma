<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= (session()->get('role') === 'admin') ? site_url('admin/dashboard') : site_url(session()->get('role') . '/dashboard') ?>" class="brand-link">
        <img src="https://i.pinimg.com/736x/c0/6f/7c/c06f7cbe90174663ca302ef514dd850a.jpg" alt="SIAKAD Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIAKAD Panel</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('username')) ?>&background=0D8ABC&color=fff" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block text-capitalize"><?= esc(session()->get('username')) ?> (<?= esc(session()->get('role')) ?>)</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <?php if (session()->get('role') === 'admin'): ?>
                    <li class="nav-item">
                        <a href="<?= site_url('admin/dashboard') ?>" class="nav-link <?= (uri_string() === 'admin/dashboard') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header">MANAJEMEN DATA MASTER</li>
                    <li class="nav-item <?= (strpos(uri_string(), 'admin/mahasiswa') !== false) ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= (strpos(uri_string(), 'admin/mahasiswa') !== false) ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i><p>Mahasiswa<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= site_url('admin/mahasiswa') ?>" class="nav-link <?= (uri_string() === 'admin/mahasiswa') ? 'active' : '' ?>"><i class="far fa-circle nav-icon"></i><p>Daftar Mahasiswa</p></a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= site_url('admin/mahasiswa/create') ?>" class="nav-link <?= (uri_string() === 'admin/mahasiswa/create') ? 'active' : '' ?>"><i class="far fa-circle nav-icon"></i><p>Tambah Mahasiswa</p></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('admin/dosen') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/dosen') !== false) ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-tie"></i><p>Dosen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= site_url('admin/matakuliah') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/matakuliah') !== false) ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book"></i><p>Mata Kuliah</p>
                        </a>
                    </li>
                    <li class="nav-header">MANAJEMEN PENGGUNA</li>
                    <li class="nav-item">
                        <a href="<?= site_url('admin/user/create') ?>" class="nav-link <?= (uri_string() === 'admin/user/create') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-plus"></i><p>Tambah User</p>
                        </a>
                    </li>
                
                <?php elseif (session()->get('role') === 'dosen'): ?>
                    <li class="nav-item">
                        <a href="<?= site_url('dosen/dashboard') ?>" class="nav-link <?= (uri_string() === 'dosen/dashboard') ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-header">AKADEMIK</li>
                    <li class="nav-item">
                        <a href="<?= site_url('dosen/matakuliah') ?>" class="nav-link <?= (strpos(uri_string(), 'dosen/matakuliah') !== false) ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-chalkboard-teacher"></i><p>Mata Kuliah Diampu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link disabled">
                            <i class="nav-icon fas fa-check-square"></i><p>Input Nilai</p>
                        </a>
                    </li>


                // di dalam file app/Views/layouts/admin_sidebar.php

            <?php elseif (session()->get('role') === 'mahasiswa'): ?>
                <li class="nav-item">
                    <a href="<?= site_url('mahasiswa/dashboard') ?>" class="nav-link ...">
                        <i class="nav-icon fas fa-user-graduate"></i><p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('mahasiswa/profil') ?>" class="nav-link <?= (strpos(uri_string(), 'mahasiswa/profil') !== false) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-circle"></i><p>Profil Saya</p>
                    </a>
                </li>
                <li class="nav-header">AKADEMIK</li>
                <li class="nav-item">
                    <a href="<?= site_url('mahasiswa/krs') ?>" class="nav-link ...">
                        <i class="nav-icon fas fa-edit"></i><p>Kartu Rencana Studi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('mahasiswa/khs') ?>" class="nav-link ...">
                        <i class="nav-icon fas fa-poll"></i><p>Hasil Studi (KHS)</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('mahasiswa/transkrip') ?>" class="nav-link ...">
                        <i class="nav-icon fas fa-file-alt"></i><p>Transkrip Nilai</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('mahasiswa/jadwal') ?>" class="nav-link <?= (strpos(uri_string(), 'mahasiswa/jadwal') !== false) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-calendar-alt"></i><p>Jadwal Kuliah</p>
                    </a>
                </li>
            <?php endif; ?>

                <li class="nav-item mt-3">
                    <a href="<?= site_url('logout') ?>" class="nav-link bg-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        </div>
    </aside>