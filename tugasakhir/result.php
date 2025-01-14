<?php
session_start();
include 'php/koneksi.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}

if (isset($_GET['id'])) {
    $id_pembelian = $_GET['id'];

    $query = "SELECT * FROM pembelian WHERE id_pembelian = ?";
    $stmt = mysqli_prepare($konek, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id_pembelian);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "Data tidak ditemukan.";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Kode pembelian tidak ditemukan.";
    exit;
}

$kategoriArray = explode(", ", $data['kategori']);
$jmlpertiketArray = explode(", ", $data['jml_per_tiket']);
$hargapertiketArray = explode(", ", $data['harga_per_tiket']);

$tax_rate = 0.10;

function format_rupiah($rupiah)
{
    return 'IDR ' . number_format($rupiah, 0, ',', '.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <style>
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-radius: 5px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: cadetblue;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Music Concert</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasLightNavbar" aria-labelledby="offcanvasLightNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Harits ~ Jasmine</h5>
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
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
    </nav>
    <div class="container mt-5 pt-5">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="card-title pt-2">Rincian Tiket</h3>
            </div>
            <div class="card-body position-relative">
                <?php if ($data): ?>
                    <p><strong>Kode Pembelian:</strong> <?= htmlspecialchars($data['id_pembelian']); ?></p>
                    <p><strong>Tanggal Pembelian:</strong> <?= htmlspecialchars($data['tgl_pembelian']); ?></p>
                    <p><strong>Kategori:</strong> <?= htmlspecialchars($data['kategori']); ?></p>
                    <p><strong>Jumlah Tiket:</strong> <?= htmlspecialchars($data['jml_tiket']); ?></p>
                    <p><strong>Pajak Setiap Kategori:</strong> 10%</p>
                    <p><strong>Rincian Pembelian:</strong></p>
                    <table>
                        <tr>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Harga Tiket Satuan</th>
                            <th>Harga Tiket Total</th>
                            <th>Pajak</th>
                            <th>Harga Tiket Total dengan Pajak</th>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($kategoriArray); $i++) {
                            $jumlah = (int)$jmlpertiketArray[$i];
                            $harga = (int)$hargapertiketArray[$i];
                        ?>
                            <tr>
                                <td>
                                    <?= $kategoriArray[$i] ?>
                                </td>
                                <td>
                                    &times;<?= $jumlah ?>
                                </td>
                                <td>
                                    <?= format_rupiah($harga) ?>
                                </td>
                                <td>
                                    <?= format_rupiah($harga * $jumlah) ?>
                                </td>
                                <td>
                                    10%
                                </td>
                                <td>
                                    <?= format_rupiah($harga * $jumlah * (1 + $tax_rate)) ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($data['metode_pembayaran']); ?></p>
                    <p><strong>Total Harga:</strong> IDR <?= number_format($data['total_price'], 0, ',', '.'); ?></p>
                    <img
                        src="konser.png"
                        alt="QR Code"
                        class="position-absolute"
                        style="top: 48px; right: 130px; width: 130px; height: 130px;">
                <?php else: ?>
                    <p>Data pembelian tidak ditemukan.</p>
                <?php endif; ?>
            </div>
            <div class="card-footer">
                <a href="Retrieve.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>