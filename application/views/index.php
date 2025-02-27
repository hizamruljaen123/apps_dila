<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Roti</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/styles.css') ?>">
</head>
<body>
    <!-- Jumbotron untuk Header -->
    <div class="jumbotron jumbotron-fluid bg-light text-dark mb-4">
        <div class="container">
            <h1 class="display-4">Dashboard Roti</h1>
            <p class="lead">Selamat datang di dashboard pengelolaan roti. Pantau ringkasan data, potensi penjualan, dan konfigurasikan sistem fuzzy dengan mudah di sini.</p>
        </div>
    </div>

    <div class="container">
        <!-- Navigasi Cepat -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('roti/create') ?>">Tambah Roti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('roti/fuzzy_variables') ?>">Konfigurasi Variabel Fuzzy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('roti/fuzzy_rules') ?>">Konfigurasi Aturan Fuzzy</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Ringkasan Data dengan Card Kolom -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary">
                    <div class="card-header">Total Roti</div>
                    <div class="card-body text-center">
                        <h5 class="card-title display-4"><?= $total_roti ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success">
                    <div class="card-header">Rata-rata Stok</div>
                    <div class="card-body text-center">
                        <h5 class="card-title display-4"><?= round($avg_stok, 2) ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-info">
                    <div class="card-header">Rata-rata Terjual</div>
                    <div class="card-body text-center">
                        <h5 class="card-title display-4"><?= round($avg_terjual, 2) ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Potensi Penjualan dengan Card -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4>Distribusi Potensi Penjualan</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="potensiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar Roti dengan Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h4>Daftar Roti</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive-sm table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Terjual</th>
                                    <th>Sisa</th>
                                    <th>Harga</th>
                                    <th>Pembeli</th>
                                    <th>Tanggal</th>
                                    <th>Potensi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($roti as $r): ?>
                                <tr>
                                    <td><?= $r->nama ?></td>
                                    <td><?= $r->stok ?></td>
                                    <td><?= $r->terjual ?></td>
                                    <td><?= $r->sisa ?></td>
                                    <td><?= number_format($r->harga, 2) ?></td>
                                    <td><?= $r->pembeli ?></td>
                                    <td><?= $r->tanggal ?></td>
                                    <td><?= round($r->potensi, 2) ?></td>
                                    <td>
                                        <a href="<?= base_url('roti/edit/'.$r->id) ?>" class="btn btn-sm btn-warning mr-1">Edit</a>
                                        <a href="<?= base_url('roti/delete/'.$r->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer dengan Tautan Aksi -->
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="<?= base_url('roti/create') ?>" class="btn btn-primary btn-lg mr-2">Tambah Roti</a>
                <a href="<?= base_url('roti/fuzzy_variables') ?>" class="btn btn-secondary btn-lg mr-2">Konfigurasi Variabel Fuzzy</a>
                <a href="<?= base_url('roti/fuzzy_rules') ?>" class="btn btn-secondary btn-lg">Konfigurasi Aturan Fuzzy</a>
            </div>
        </div>
    </div>

    <!-- Skrip untuk Grafik -->
    <script>
        var potensiData = {
            labels: ['Tidak Laris', 'Sedang', 'Laris', 'Sangat Laris'],
            datasets: [{
                label: 'Jumlah Roti',
                data: [<?= $tidak_laris ?>, <?= $sedang ?>, <?= $laris ?>, <?= $sangat_laris ?>],
                backgroundColor: ['#dc3545', '#ffc107', '#28a745', '#007bff'],
                borderWidth: 1
            }]
        };

        var ctx = document.getElementById('potensiChart').getContext('2d');
        var potensiChart = new Chart(ctx, {
            type: 'bar',
            data: potensiData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Jumlah' }
                    },
                    x: {
                        title: { display: true, text: 'Potensi Penjualan' }
                    }
                },
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>