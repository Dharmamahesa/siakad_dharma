<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= site_url('admin/dashboard') ?>" class="brand-link">
      <img src="https://i.pinimg.com/736x/c0/6f/7c/c06f7cbe90174663ca302ef514dd850a.jpg" alt="SIAKAD Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SIAKAD Panel</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-capitalize"><?= esc(session()->get('username')) ?> (<?= esc(session()->get('role')) ?>)</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= site_url('admin/dashboard') ?>" class="nav-link <?= (uri_string() === 'admin/dashboard') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-header">MANAJEMEN DATA MASTER</li>

          <li class="nav-item <?= (strpos(uri_string(), 'admin/mahasiswa') !== false) ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= (strpos(uri_string(), 'admin/mahasiswa') !== false) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Mahasiswa
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= site_url('admin/mahasiswa') ?>" class="nav-link <?= (uri_string() === 'admin/mahasiswa') ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Mahasiswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= site_url('admin/mahasiswa/create') ?>" class="nav-link <?= (uri_string() === 'admin/mahasiswa/create') ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Mahasiswa</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?= site_url('admin/dosen') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/dosen') !== false) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Dosen</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('admin/matakuliah') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/matakuliah') !== false) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-book"></i>
              <p>Mata Kuliah</p>
            </a>
          </li>
        </ul>
      </nav>
      </div>
    </aside>