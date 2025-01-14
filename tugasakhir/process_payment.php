<?php
session_start();
include 'php/koneksi.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}

$total_price = $_POST['total_price'];
$quantity_ticket_1 = $_POST['quantity_ticket_1'];
$quantity_ticket_2 = $_POST['quantity_ticket_2'];
$quantity_ticket_3 = $_POST['quantity_ticket_3'];
$quantity_ticket_4 = $_POST['quantity_ticket_4'];

$price_ticket_1 = 500000;
$price_ticket_2 = 750000;
$price_ticket_3 = 1000000;
$price_ticket_4 = 1250000;

$kategori = [];
$quantity_per_ticket = [];
$price_per_ticket = [];
if ($quantity_ticket_1 > 0) {
    $kategori[] = "Silver";
    $quantity_per_ticket[] = $quantity_ticket_1;
    $price_per_ticket[] = $price_ticket_1;
}
if ($quantity_ticket_2 > 0) {
    $kategori[] = "Festival";
    $quantity_per_ticket[] = $quantity_ticket_2;
    $price_per_ticket[] = $price_ticket_2;
}
if ($quantity_ticket_3 > 0) {
    $kategori[] = "Gold";
    $quantity_per_ticket[] = $quantity_ticket_3;
    $price_per_ticket[] = $price_ticket_3;
}
if ($quantity_ticket_4 > 0) {
    $kategori[] = "Platinum";
    $quantity_per_ticket[] = $quantity_ticket_4;
    $price_per_ticket[] = $price_ticket_4;
}
$kategori = implode(", ", $kategori);
$quantity_per_ticket = implode(", ", $quantity_per_ticket);
$price_per_ticket = implode(", ", $price_per_ticket);

$jumlah_tiket = $quantity_ticket_1 + $quantity_ticket_2 + $quantity_ticket_3 + $quantity_ticket_4;

$metode_pembayaran = $_POST['payment_method'];

$sql = "INSERT INTO pembelian (tgl_pembelian, kategori, jml_tiket, metode_pembayaran, id_pembeli, total_price, jml_per_tiket, harga_per_tiket)
        VALUES (NOW(), '$kategori', '$jumlah_tiket', '$metode_pembayaran', '{$_SESSION['user_id']}', '$total_price', '$quantity_per_ticket', '$price_per_ticket')";

if (mysqli_query($konek, $sql)) {
    $id_pembelian = mysqli_insert_id($konek);
    header("Location: purchase_receipt.php?id_pembelian=" . $id_pembelian);
    exit();
} else {
    echo "Error: " . mysqli_error($konek);
}
?>
