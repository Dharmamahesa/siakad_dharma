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
<<<<<<< HEAD
        /* --- GLASSMORPHISM UI THEME BY GEMINI --- */

        /* 1. Background Setup */
        .content-wrapper {
            /* Gambar Frieren sebagai background utama */
            background: url('https://a.storyblok.com/f/178900/920x518/1f22484fb6/frieren-beyond-journeys-end.jpg/m/filters:quality(95)format(webp)') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }
        /* Overlay Gelap agar konten terbaca */
=======
        /* (CSS kustom Anda dari sebelumnya bisa tetap di sini) */
        .content-wrapper {
            background: url('https://a.storyblok.com/f/178900/920x518/1f22484fb6/frieren-beyond-journeys-end.jpg/m/filters:quality(95)format(webp)') no-repeat center center;
            background-size: cover;
            position: relative;
        }
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
        .content-wrapper::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
<<<<<<< HEAD
            background-color: rgba(0, 0, 0, 0.6); /* Ubah angka 0.6 untuk mengatur kegelapan (0.0 - 1.0) */
            z-index: 0;
            pointer-events: none;
        }
        
        /* Pastikan konten berada di atas overlay */
=======
            background-color: rgba(0, 0, 0, 0.75);
            z-index: 1;
        }
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
        .content-header, .content {
            position: relative;
            z-index: 2;
        }
<<<<<<< HEAD

        /* 2. Glass Effect untuk Komponen Utama (Navbar, Sidebar, Card) */
        .main-header, 
        .main-sidebar, 
        .card, 
        .modal-content {
            background-color: rgba(255, 255, 255, 0.15) !important; /* Putih Transparan */
            backdrop-filter: blur(15px); /* Efek Kaca Buram */
            -webkit-backdrop-filter: blur(15px); /* Support Safari */
            border: 1px solid rgba(255, 255, 255, 0.2); /* Border tipis mengkilap */
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37); /* Bayangan soft */
            color: #ffffff !important; /* Paksa teks jadi putih */
        }

        /* 3. Penyesuaian Navbar Khusus */
        .main-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        }
        .main-header .nav-link {
            color: #ffffff !important;
        }

        /* 4. Penyesuaian Sidebar */
        .main-sidebar {
            /* Agar sidebar menyatu dengan glassmorphism */
            background-color: rgba(0, 0, 0, 0.3) !important; /* Sedikit lebih gelap untuk sidebar */
        }
        .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        }
        .user-panel {
            border-bottom: 1px solid rgba(255, 255, 255, 0.2) !important;
        }
        .nav-sidebar .nav-item .nav-link {
            color: #e0e0e0 !important;
        }
        .nav-sidebar .nav-item .nav-link.active {
            background-color: rgba(255, 255, 255, 0.3) !important;
            color: #fff !important;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* 5. Penyesuaian Card & Tabel */
        .card-header {
            background-color: rgba(255, 255, 255, 0.1) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        .table {
            color: #ffffff !important;
        }
        .table thead th {
            border-bottom: 2px solid rgba(255, 255, 255, 0.3) !important;
        }
        .table td, .table th {
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
        }
        /* Efek Hover pada baris tabel */
        .table-hover tbody tr:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.2) !important;
        }

        /* 6. Form Input Glass Style */
        .form-control {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            color: #ffffff;
            border-color: #fff;
        }
        /* Placeholder warna putih agak transparan */
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        /* 7. Typography (Text Shadow agar terbaca) */
        h1, h2, h3, h4, h5, h6, p, label, span, a {
            text-shadow: 0 2px 4px rgba(0,0,0,0.6);
        }
        .breadcrumb-item.active {
            color: #dcdcdc !important;
=======
        .content-header h1, .content-header .breadcrumb-item, .content-header .breadcrumb-item a {
            color: #ffffff !important;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<<<<<<< HEAD
  <nav class="main-header navbar navbar-expand navbar-dark">
=======
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
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
<<<<<<< HEAD
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style="background-color: rgba(255,255,255,0.9); backdrop-filter: none;">
=======
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
          <a href="<?= site_url('logout') ?>" class="dropdown-item text-danger">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?= site_url('logout') ?>" role="button" title="Logout" onclick="return confirm('Apakah Anda yakin ingin logout?')">
<<<<<<< HEAD
            <i class="fas fa-sign-out-alt text-danger" style="text-shadow: none;"></i>
=======
            <i class="fas fa-sign-out-alt text-danger"></i>
>>>>>>> 5a738fe68a8fafe098f17057aeb31207d86c45ae
        </a>
      </li>

    </ul>
  </nav>