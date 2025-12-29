<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik - Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23e9ecef' fill-opacity='0.4'%3E%3Cpath fill-rule='evenodd' d='M11 0l5 20H6l5-20zm42 31a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM0 72h40v4H0v-4zm0 8h40v4H0v-4zm72-72h8v4h-8v-4zM64 0h8v4h-8v-4zm-16 0h8v4h-8v-4zM40 0h8v4h-8v-4zm-8 0h8v4h-8v-4zm-24 0h8v4h-8v-4zM0 0h8v4H0v-4zm16 48h4v4h-4v-4zm-8 8h4v4h-4v-4zm-8 8h4v4H0v-4zm0 8h4v4H0v-4zM40 48h4v4h-4v-4zm8 8h4v4h-4v-4zm8 8h4v4h-4v-4zm8 8h4v4h-4v-4zM40 56h4v4h-4v-4zm8-8h4v4h-4v-4zm8-8h4v4h-4v-4zm8-8h4v4h-4v-4zM56 8h4v4h-4V8zm-8 8h4v4h-4v-4zm-8 8h4v4h-4v-4zm-8 8h4v4h-4v-4zM24 8h4v4h-4V8zm-8 8h4v4h-4v-4zm-8 8h4v4H8v-4zm0 8h4v4H8v-4zM8 8h4v4H8V8zM0 16h4v4H0v-4zm0 8h4v4H0v-4zm0 8h4v4H0v-4zM0 8h4v4H0V8zm8 72h4v4H8v-4zm8 0h4v4h-4v-4zm8 0h4v4h-4v-4zm8 0h4v4h-4v-4zm8 0h4v4h-4v-4zm8 0h4v4h-4v-4zm8 0h4v4h-4v-4zm0-8h4v4h-4v-4zm0-8h4v4h-4v-4zm0-8h4v4h-4v-4zm0-8h4v4h-4v-4zm-8 8h4v4h-4v-4zm-8 0h4v4h-4v-4zm-8 0h4v4h-4v-4zm-8 0h4v4h-4v-4zM24 72h4v4h-4v-4zm-8 0h4v4h-4v-4zM8 56h4v4H8v-4zm8-8h4v4h-4v-4zM0 40h4v4H0v-4zm8 0h4v4H8v-4zm8 0h4v4h-4v-4zm8 0h4v4h-4v-4zm8 0h4v4h-4v-4z'/%3E%3C/g%3E%3C/svg%3E");
        }
        .no-padding {
            padding: 0 !important;
        }
        .image-container {
            position: relative;
            background: url('https://www.gramedia.com/blog/content/images/2024/09/hero-party-anime-visual-v0-6jmpr7508y5b1-min--2-.jpg') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
        }
        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 40px;
            color: white;
            background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0));
        }
        .image-overlay .welcome-text {
            font-weight: 600;
            color: #d4e09b;
            letter-spacing: 1px;
        }
        .login-form-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 40px;
        }
        .login-form-wrapper {
            max-width: 400px;
            width: 100%;
        }
        .btn-google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 1px solid #ddd;
            background-color: white;
            color: #444;
            font-weight: 500;
        }
        .btn-google:hover {
            background-color: #f8f8f8;
            border-color: #ccc;
        }
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            color: #aaa;
            margin: 25px 0;
        }
        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
        }
        .separator:not(:empty)::before {
            margin-right: .25em;
        }
        .separator:not(:empty)::after {
            margin-left: .25em;
        }
        .btn-masuk {
            background-color: #0d6efd;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-7 d-none d-md-block no-padding">
            <div class="image-container">
                <div class="image-overlay">
                    <p class="welcome-text">SELAMAT DATANG</p>
                    <h1>Sistem Informasi Akademik</h1>
                    <h2>Unmerpas BY Dharma mahesa</h2>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="login-form-container">
                <div class="login-form-wrapper">

                    <div class="text-center mb-4">
                        <img src="https://i.pinimg.com/736x/c0/6f/7c/c06f7cbe90174663ca302ef514dd850a.jpg" alt="Logo SIAKAD" style="width: 100px;">
                    </div>
                    
                    <div class="text-center">
                        <h3 class="fw-bold">Masuk dan Verifikasi</h3>
                        <p class="text-muted">Nikmati kemudahan sistem autentikasi tunggal untuk mengakses semua layanan dengan satu akun.</p>
                    </div>

                    <a href="#" class="btn btn-google w-100 my-3">
                        <i class="bi bi-google"></i> Google
                    </a>

                    <div class="separator">
                        atau lanjutkan dengan
                    </div>

                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success" role="alert"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger" role="alert"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <?php if (service('validation')->getErrors()) : ?>
                         <div class="alert alert-danger" role="alert"><?= service('validation')->listErrors() ?></div>
                    <?php endif; ?>


                    <form action="<?= site_url('auth/process') ?>" method="post">
                        <?= csrf_field() ?> <div class="mb-3">
                            <label for="username" class="form-label">Email/akun pengguna*</label>
                            <input type="text" name="username" class="form-control form-control-lg" id="username" value="" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password*</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control form-control-lg" id="password" value="" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-slash"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-end mb-3">
                            <a href="#" class="text-decoration-none">Lupa kata sandi?</a>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg btn-masuk">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        const password = document.getElementById('password');
        const icon = this.querySelector('i');
        
        // Toggle tipe input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Toggle ikon mata
        icon.classList.toggle('bi-eye-slash');
        icon.classList.toggle('bi-eye');
    });
</script>

</body>
</html>