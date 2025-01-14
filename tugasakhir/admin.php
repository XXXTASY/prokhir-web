<?php include 'a_navbar.php'; ?>
<?php
session_start();
include 'php/koneksi.php';
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleadmin.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .card {
            background-color: #34495e;
            color: white;
            text-align: center;
            padding: 30px;
            border-radius: 10px;
        }

        .card:hover {
            background-color: #2c3e50;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Selamat Datang, Admin!</h1>
        <p align="center">Gunakan menu di bawah untuk melihat data pembeli dan mengelola data pembelian.</p>
        <div class="row justify-content-center align-items-center" style="min-height: 25vh;">
            <div class="col-sm-5 mb-3 mb-sm-0">
                <div class="card" onclick="window.location.href='data_pembeli.php';">
                    <h4>Informasi Akun Pembeli</h4>
                    <p class="card-text">Lihat akun yang telah mendaftar.</p>
                </div>
            </div>
            <div class="col-sm-5 mb-3 mb-sm-0">
                <div class="card" onclick="window.location.href='data_pembelian.php';">
                    <h4>Informasi Data Pembelian Tiket</h4>
                    <p class="card-text">Lihat detail pembelian tiket.</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>