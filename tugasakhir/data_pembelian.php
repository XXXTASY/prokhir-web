<?php include 'a_navbar.php'; ?>
<?php
session_start();
include 'php/koneksi.php';
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}

$search = $_GET['search'] ?? '';

$sql = $search ? 
    "SELECT pembelian.*, pembeli.nama, pembeli.email, pembeli.no_telp FROM pembelian 
     JOIN pembeli ON pembelian.id_pembeli = pembeli.id_pembeli 
     WHERE pembeli.email LIKE '%$search%'" : 
    "SELECT pembelian.*, pembeli.nama, pembeli.email, pembeli.no_telp FROM pembelian 
     JOIN pembeli ON pembelian.id_pembeli = pembeli.id_pembeli";

$result = $konek->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembelian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleadmin.css" />
</head>
<body>
    <h1>Data Pembelian</h1>

    <form method="get" action="">
        <input type="text" name="search" placeholder="Cari email..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Cari</button>
    </form>

    <?php if ($search && $result->num_rows === 0): ?>
        <p>Email tidak ditemukan.</p>
    <?php endif; ?>

    <form method="post" action="save.php">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Kategori Tiket</th>
                    <th>Kode Pembelian</th>
                    <th>Accept</th>
                    <th>Lihat Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="<?= $row['status'] === 'accepted' ? 'accepted' : '' ?>">
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['no_telp']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td><?= htmlspecialchars($row['id_pembelian']) ?></td>
                            <td>
                                <?php if ($row['status'] !== 'accepted'): ?>
                                    <input type="checkbox" name="accepted_ids[]" value="<?= $row['id_pembelian'] ?>">
                                <?php else: ?>
                                    <span>✔️</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="detail_pembelian.php?id=<?= $row['id_pembelian'] ?>">Lihat Detail</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">Tidak ada data ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button type="submit">Save</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
