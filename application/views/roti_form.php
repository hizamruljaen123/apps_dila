<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($roti) ? 'Edit Roti' : 'Tambah Roti' ?></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   <link rel="stylesheet" href="<?php echo base_url('assets/styles.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h2><?= isset($roti) ? 'Edit Roti' : 'Tambah Roti' ?></h2>
        <form method="post" class="needs-validation" novalidate>
            <div class="form-group">
                <label>Nama Roti</label>
                <input type="text" name="nama" class="form-control" value="<?= isset($roti->nama) ? $roti->nama : '' ?>" required>
                <div class="invalid-feedback">Nama roti wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= isset($roti->stok) ? $roti->stok : '' ?>" required>
                <div class="invalid-feedback">Stok wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Terjual</label>
                <input type="number" name="terjual" class="form-control" value="<?= isset($roti->terjual) ? $roti->terjual : '' ?>" required>
                <div class="invalid-feedback">Jumlah terjual wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Sisa</label>
                <input type="number" name="sisa" class="form-control" value="<?= isset($roti->sisa) ? $roti->sisa : '' ?>" required>
                <div class="invalid-feedback">Sisa stok wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control" value="<?= isset($roti->harga) ? $roti->harga : '' ?>" required>
                <div class="invalid-feedback">Harga wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Jumlah Pembeli</label>
                <input type="number" name="pembeli" class="form-control" value="<?= isset($roti->pembeli) ? $roti->pembeli : '' ?>" required>
                <div class="invalid-feedback">Jumlah pembeli wajib diisi.</div>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= isset($roti->tanggal) ? $roti->tanggal : '' ?>" required>
                <div class="invalid-feedback">Tanggal wajib diisi.</div>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?= base_url('roti') ?>" class="btn btn-secondary">Kembali</a>
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