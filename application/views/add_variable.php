<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($variable) ? 'Edit Variabel' : 'Tambah Variabel' ?></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   <link rel="stylesheet" href="<?php echo base_url('assets/styles.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h2><?= isset($variable) ? 'Edit Variabel' : 'Tambah Variabel' ?></h2>
        <form method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <label>Nama Variabel (Stok/Terjual)</label>
                <input type="text" name="nama" class="form-control" value="<?= isset($variable->nama) ? $variable->nama : '' ?>" required>
                <div class="invalid-feedback">Nama variabel wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Kategori (Rendah/Sedang/Tinggi)</label>
                <input type="text" name="kategori" class="form-control" value="<?= isset($variable->kategori) ? $variable->kategori : '' ?>" required>
                <div class="invalid-feedback">Kategori wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Batas Bawah</label>
                <input type="number" name="batas_bawah" class="form-control" value="<?= isset($variable->batas_bawah) ? $variable->batas_bawah : '' ?>" required>
                <div class="invalid-feedback">Batas bawah wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Batas Tengah</label>
                <input type="number" name="batas_tengah" class="form-control" value="<?= isset($variable->batas_tengah) ? $variable->batas_tengah : '' ?>" required>
                <div class="invalid-feedback">Batas tengah wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Batas Atas</label>
                <input type="number" name="batas_atas" class="form-control" value="<?= isset($variable->batas_atas) ? $variable->batas_atas : '' ?>" required>
                <div class="invalid-feedback">Batas atas wajib diisi.</div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?= base_url('roti/fuzzy_variables') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>