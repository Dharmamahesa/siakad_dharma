<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('admin/dashboard') ?>" class="brand-link">
      <img src="https://i.pinimg.com/736x/c0/6f/7c/c06f7cbe90174663ca302ef514dd850a.jpg" alt="SIAKAD Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">SIAKAD Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- Ganti dengan avatar dinamis jika perlu -->
          <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= esc(session()->get('username')) ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= site_url('admin/dashboard') ?>" class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-header">MANAJEMEN DATA</li>

          <li class="nav-item">
            <a href="<?= site_url('admin/mahasiswa') ?>" class="nav-link <?= (strpos(uri_string(), 'admin/mahasiswa') !== false) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users"></i>
              <p>Mahasiswa</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Dosen <span class="right badge badge-warning">Segera</span></p>
            </a>
          </li>
           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Mata Kuliah <span class="right badge badge-warning">Segera</span></p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>