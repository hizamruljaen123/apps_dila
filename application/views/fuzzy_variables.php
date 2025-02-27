<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfigurasi Variabel Fuzzy</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   <link rel="stylesheet" href="<?php echo base_url('assets/styles.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h2>Konfigurasi Variabel Fuzzy</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Batas Bawah</th>
                    <th>Batas Tengah</th>
                    <th>Batas Atas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($variables as $v): ?>
                <tr>
                    <td><?= $v->nama ?></td>
                    <td><?= $v->kategori ?></td>
                    <td><?= $v->batas_bawah ?></td>
                    <td><?= $v->batas_tengah ?></td>
                    <td><?= $v->batas_atas ?></td>
                    <td>
                        <a href="<?= base_url('roti/edit_variable/'.$v->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('roti/delete_variable/'.$v->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="<?= base_url('roti/add_variable') ?>" class="btn btn-primary">Tambah Variabel</a>
            <a href="<?= base_url('roti') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>
</html>