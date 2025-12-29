<?= view('layouts/admin_header') ?>
<?= view('layouts/admin_sidebar') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"><h1 class="m-0">Dashboard</h1></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Mahasiswa</span>
                            <span class="info-box-number"><?= esc($total_mahasiswa ?? 0) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-tie"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Dosen</span>
                            <span class="info-box-number"><?= esc($total_dosen ?? 0) ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-book"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Mata Kuliah</span>
                            <span class="info-box-number"><?= esc($total_matakuliah ?? 0) ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Mahasiswa per Angkatan</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="angkatanChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aktivitas Terbaru</h3>
                        </div>
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                <li class="item">
                                    <div class="product-info">
                                        <a href="#" class="product-title">Admin menambahkan mahasiswa baru</a>
                                        <span class="product-description">Budi Santoso (NIM: 2023001)</span>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product-info">
                                        <a href="#" class="product-title">Admin mengubah data dosen</a>
                                        <span class="product-description">Dr. Indah, M.Kom.</span>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product-info">
                                        <a href="#" class="product-title">Mahasiswa login</a>
                                        <span class="product-description">S10104_Angga</span>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product-info">
                                        <a href="#" class="product-title">Admin menambah mata kuliah</a>
                                        <span class="product-description">Basis Data Lanjut</span>
                                    </div>
                                </li>
                                <li class="item">
                                    <div class="product-info">
                                        <a href="#" class="product-title">Logout berhasil</a>
                                        <span class="product-description">Admin</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                         <div class="card-footer text-center">
                            <a href="#" class="uppercase">Lihat Semua Log</a>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('layouts/admin_footer') ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Data dari Controller
    var angkatanData = <?= json_encode($angkatan_stats) ?>;

    // Proses data untuk Chart.js
    var labels = angkatanData.map(function(item) {
        return item.angkatan;
    });
    var data = angkatanData.map(function(item) {
        return item.jumlah;
    });

    var ctx = document.getElementById('angkatanChart').getContext('2d');
    var angkatanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Mahasiswa',
                data: data,
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        // Hanya tampilkan angka bulat di sumbu Y
                        stepSize: 1
                    }
                }
            }
        }
    });
});
</script>