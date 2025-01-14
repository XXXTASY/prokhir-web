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
    "SELECT * FROM pembeli WHERE email LIKE '%$search%'" : 
    "SELECT * FROM pembeli";
$result = $konek->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pembeli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styleadmin.css" />
</head>
<body>
    <div class="container">
        <h1>Data Pembeli</h1>
        <form method="get" action="">
            <input type="text" name="search" placeholder="Cari email..." value="<?= $search ?>">
            <button type="submit">Cari</button>
        </form>
        <?php if ($search && $result->num_rows === 0): ?>
            <p style="color: red; text-align: center;">Email tidak ditemukan.</p>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No Telp</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['no_telp'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
