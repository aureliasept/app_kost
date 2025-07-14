<?php
require_once '../includes/auth.php';
if (!is_admin_logged_in()) {
    header('Location: login.php');
    exit;
}
require_once '../includes/db.php';
$jumlah_penghuni = $conn->query("SELECT COUNT(*) FROM tb_penghuni")->fetch_row()[0];
$jumlah_kamar = $conn->query("SELECT COUNT(*) FROM tb_kamar")->fetch_row()[0];
$jumlah_barang = $conn->query("SELECT COUNT(*) FROM tb_barang")->fetch_row()[0];
$jumlah_tagihan = $conn->query("SELECT COUNT(*) FROM tb_tagihan")->fetch_row()[0];
$jumlah_bayar = $conn->query("SELECT COUNT(*) FROM tb_bayar")->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            background:
                linear-gradient(135deg, rgba(224,231,255,0.85) 0%, rgba(248,250,252,0.85) 100%),
                url('https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=1200&q=80') center center/cover no-repeat;
        }
        .stat-card, .menu-card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 2px 12px #b6b6b6a0;
            transition: transform 0.2s, box-shadow 0.2s;
            background: #fff;
            text-align: center;
            min-width: 180px;
            min-height: 180px;
            max-width: 220px;
            max-height: 220px;
            width: 100%;
            aspect-ratio: 1/1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1.5rem 1rem;
        }
        .stat-card:hover, .menu-card:hover {
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 4px 24px #2563eb55;
        }
        .stat-icon, .menu-icon {
            font-size: 2.5rem;
            color: #2563eb;
            margin-bottom: 0.5rem;
        }
        .stat-title, .menu-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.2rem;
        }
        .stat-count {
            font-size: 1.7rem;
            font-weight: 700;
            color: #2563eb;
        }
        @media (max-width: 767px) {
            .stat-card, .menu-card {
                min-width: 120px;
                min-height: 120px;
                max-width: 160px;
                max-height: 160px;
                padding: 1rem 0.5rem;
            }
            .stat-icon, .menu-icon {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Kost</a>
            <div class="d-flex">
                <span class="navbar-text me-3">Halo, <?= $_SESSION['admin_username'] ?></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container pb-5">
        <!-- Statistik Baris -->
        <div class="row g-4 mb-4 justify-content-center">
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa fa-users"></i></div>
                    <div class="stat-title">Penghuni</div>
                    <div class="stat-count"><?= $jumlah_penghuni ?></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa fa-door-closed"></i></div>
                    <div class="stat-title">Kamar</div>
                    <div class="stat-count"><?= $jumlah_kamar ?></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa fa-box"></i></div>
                    <div class="stat-title">Barang</div>
                    <div class="stat-count"><?= $jumlah_barang ?></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa fa-file-invoice"></i></div>
                    <div class="stat-title">Tagihan</div>
                    <div class="stat-count"><?= $jumlah_tagihan ?></div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fa fa-money-bill-wave"></i></div>
                    <div class="stat-title">Pembayaran</div>
                    <div class="stat-count"><?= $jumlah_bayar ?></div>
                </div>
            </div>
        </div>
        <!-- Menu Navigasi Baris -->
        <div class="row g-4 justify-content-center">
            <div class="col-12 col-sm-6 col-lg-2">
                <a href="penghuni.php" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon"><i class="fa fa-users"></i></div>
                        <div class="menu-label">Kelola Penghuni</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <a href="kamar.php" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon"><i class="fa fa-door-closed"></i></div>
                        <div class="menu-label">Kelola Kamar</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <a href="barang.php" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon"><i class="fa fa-box"></i></div>
                        <div class="menu-label">Kelola Barang</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <a href="tagihan.php" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon"><i class="fa fa-file-invoice"></i></div>
                        <div class="menu-label">Kelola Tagihan</div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-6 col-lg-2">
                <a href="bayar.php" class="text-decoration-none">
                    <div class="menu-card">
                        <div class="menu-icon"><i class="fa fa-money-bill-wave"></i></div>
                        <div class="menu-label">Kelola Pembayaran</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html> 