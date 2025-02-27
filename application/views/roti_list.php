<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Roti</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   <link rel="stylesheet" href="<?php echo base_url('assets/styles.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h2>Daftar Roti</h2>
        <table class="table table-bordered table-striped">
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
                        <a href="<?= base_url('roti/edit/'.$r->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('roti/delete/'.$r->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="<?= base_url('roti/create') ?>" class="btn btn-primary">Tambah Roti</a>
            <a href="<?= base_url('roti/fuzzy_variables') ?>" class="btn btn-secondary">Konfigurasi Variabel Fuzzy</a>
            <a href="<?= base_url('roti/fuzzy_rules') ?>" class="btn btn-secondary">Konfigurasi Aturan Fuzzy</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>