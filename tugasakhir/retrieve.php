<?php
session_start();
include 'php/koneksi.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}

$id_pembeli = $_SESSION['user_id'];

$sql = "SELECT * FROM pembelian WHERE id_pembeli = '$id_pembeli'";
$result = mysqli_query($konek, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Music Concert</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="navbar navbar-light bg-light fixed-top bg-transparent">
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasLightNavbar" aria-labelledby="offcanvasLightNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Harits ~ Jasmine</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body offcanvas-light bg-light">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container mt-5 pt-5">
        <form action="" method="POST" class="form-dashboard bg-white p-4">
            <h2 class="mb-4">Daftar Pembelian Tiket</h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pembelian</th>
                        <th>Tanggal Pembelian</th>
                        <th>Kategori</th>
                        <th>Jumlah Tiket</th>
                        <th>Jumlah Per Tiket</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['id_pembelian']); ?></td>
                                <td><?= htmlspecialchars($row['tgl_pembelian']); ?></td>
                                <td><?= htmlspecialchars($row['kategori']); ?></td>
                                <td><?= htmlspecialchars($row['jml_tiket']); ?></td>
                                <td><?= $row['jml_per_tiket']; ?></td>
                                <td><?= htmlspecialchars($row['metode_pembayaran']); ?></td>
                                <td>IDR <?= number_format($row['total_price'], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="result.php?id=<?= urlencode($row['id_pembelian']); ?>" class="btn btn-primary btn-sm me-1">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada daftar pembelian.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="card-footer">
                <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script>
        window.addEventListener("scroll", () => {
            const nav = document.querySelector("nav")
            if (window.scrollY) {
                nav.classList.add("harits-navbar-blur");
                nav.classList.remove("navbar-light");
                nav.classList.remove("bg-light")
                nav.dataset.bsTheme = "dark";
            } else {
                nav.classList.remove("harits-navbar-blur");
                nav.classList.add("navbar-light");
                nav.classList.add("bg-light")
                nav.dataset.bsTheme = undefined;
            }
            console.log(window.scrollY)
        })
    </script>
</body>

</html>