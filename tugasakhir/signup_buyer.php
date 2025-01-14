<?php
include 'php/koneksi.php';

$nama_error = $email_error = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($konek, $_POST['nama']);
    $email = mysqli_real_escape_string($konek, $_POST['email']);
    $no_telp = mysqli_real_escape_string($konek, $_POST['no_telp']);
    $password = mysqli_real_escape_string($konek, $_POST['password']);

    $checkQuery = "SELECT * FROM pembeli WHERE nama = '$nama' OR email = '$email'";
    $result = mysqli_query($konek, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        $message = "Nama atau email sudah terdaftar. Gunakan nama atau email lain.";
    } else {
        $insertQuery = "INSERT INTO pembeli (nama, email, no_telp, password) VALUES ('$nama', '$email', '$no_telp', '$password')";

        if (mysqli_query($konek, $insertQuery)) {
            header("Location: signin_buyer.php");
            exit();
        } else {
            $message = "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Pembeli</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 style="margin-top: 54px;">Celestia Harmony</h1>
    <div class="signin-container">
        <?php if ($message): ?>
            <p class="message"><?= $message; ?></p>
        <?php endif; ?>
        <form action="signup_buyer.php" method="POST" class="signup-form">
            <h2>Sign Up Akun Pembeli</h2>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="no_telp">No Telepon</label>
            <input type="text" id="no_telp" name="no_telp" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="signin-button">Sign Up</button>
            <a href="signin_buyer.php" class="signin-button">Sudah punya akun?</a>
        </form>
    </div>
</body>

</html>