<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $data['judul']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="<?= BASEURL; ?>/css/bootstrap.css" rel="stylesheet" />
    <style>
        .stat-card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .icon-large {
            font-size: 2rem;
        }

        /* body {
        
      } */
        footer {
            position: relative;
            bottom: 0%;
            left: 50%;
            /* Posisikan elemen di tengah secara horizontal */
            transform: translateX(-50%);
            /* Geser elemen ke kiri setengah lebarnya */
            background-color: #f8f9fa;
            padding: 1rem 0;
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body class="bg-light" style="max-height: 100rem;">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Beranda</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto" style="gap: 1.5rem">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>/Dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>/Nasabah">Kelola Nasabah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>/Pengelola">Kelola Pengelola</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASEURL; ?>/Kelola_harga_sampah">Kelola Harga Sampah</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="btn btn-danger">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>