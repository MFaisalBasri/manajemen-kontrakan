<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light fixed-top">
        <div class="container">
            <img src="<?php echo base_url(); ?>assets/img/kost/logo-kontrakan.jpg" alt="" style="width: 15px;">
            <a class="navbar-brand ms-2" href=" #">SISTEM INFORMASI PENYEWAAN KONTRAKAN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link  <?= $title == 'Sistem KOST' ? 'active' : ''; ?>" aria-current="page" href="<?php echo base_url(); ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $title == 'Informasi Kontrakan' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>info-kontrakan">Info Kontrakan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $title == 'Login' ? 'active' : ''; ?>" href="<?php echo base_url(); ?>login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>