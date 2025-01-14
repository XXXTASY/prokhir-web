<?php include 'a_navbar.php'; ?>
<?php
session_start();
include 'php/koneksi.php';
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}
$id = $_GET['id'];
$sql = "SELECT pembelian.*, pembeli.nama, pembeli.email, pembeli.no_telp FROM pembelian 
        JOIN pembeli ON pembelian.id_pembeli = pembeli.id_pembeli WHERE pembelian.id_pembelian = $id";
$result = $konek->query($sql);
$data = $result->fetch_assoc();

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
    <link rel="stylesheet" href="style.css">
    <title>Detail Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleadmin.css" />
</head>

<body>
    <div class="card">
        <div class="card-header bg-white text-black">
            <h3 class="card-title pt-2">Detail Pembelian</h3>
        </div>
        <div class="card-body position-relative">
            <?php if ($data): ?>
                <p><strong>Nama:</strong> <?= htmlspecialchars($data['nama']); ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($data['email']); ?></p>
                <p><strong>No Telp:</strong> <?= htmlspecialchars($data['no_telp']); ?></p>
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
        <div class="card-footer bg-white">
            <a href="data_pembelian.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>