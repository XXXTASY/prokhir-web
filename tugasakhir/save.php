<?php
include 'php/koneksi.php';

if ($konek->connect_error) {
    die("Koneksi gagal: " . $konek->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accepted_ids = $_POST['accepted_ids'] ?? [];

    if (!empty($accepted_ids)) {
        foreach ($accepted_ids as $id_pembelian) {
            $sql = "UPDATE pembelian SET status = 'accepted' WHERE id_pembelian = ?";
            $stmt = $konek->prepare($sql);
            $stmt->bind_param('i', $id_pembelian);
            $stmt->execute();
        }
    }

    header("Location: data_pembelian.php?saved=true");
    exit();
}
?>