<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'SIAKAD') ?> | Admin Panel</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <style>
        /* (CSS kustom Anda dari sebelumnya bisa tetap di sini) */
        .content-wrapper {
            background: url('https://depotkamera.com/wp-content/uploads/2022/03/Picture1-2.png') no-repeat center center;
            background-size: cover;
            position: relative;
        }
        .content-wrapper::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.75);
            z-index: 1;
        }
        .content-header, .content {
            position: relative;
            z-index: 2;
        }
        .content-header h1, .content-header .breadcrumb-item, .content-header .breadcrumb-item a {
            color: #ffffff !important;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user-circle"></i>
          <span class="d-none d-md-inline ml-1"><?= esc(session()->get('username')) ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a href="<?= site_url('logout') ?>" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('logout') ?>" role="button" title="Logout" onclick="return confirm('Apakah Anda yakin ingin logout?')">
            <i class="fas fa-sign-out-alt text-danger"></i>
        </a>
      </li>

    </ul>
  </nav>