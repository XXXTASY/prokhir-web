<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Pembelian Tiket</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 style="margin-top: 54px;">Selamat Datang</h1>
    <div class="signin-container">
        <form action="" class="signup-form">
            <h2>Celestia Harmony</h2><br>
            <?php
            if (isset($_GET['pesan'])) {
                $messageClass = "";
                if ($_GET['pesan'] == "logout") {
                    $messageClass = "message success";
                    echo "<div class='$messageClass'>Anda telah berhasil LOGOUT</div>";
                } else if ($_GET['pesan'] == "belum_login") {
                    $messageClass = "message info";
                    echo "<div class='$messageClass'>Anda harus LOGIN dulu!</div>";
                }
            }
            ?>
            <div class="options">
                <a href="signup_buyer.php" class="signup-button">Buat Akun Baru</a>
                <a href="signin_buyer.php" class="signup-button">Masuk ke Akun</a>
                <a href="signin_admin.php" class="signup-button">Log In Sebagai Admin</a>
            </div>
        </form>
    </div>
</body>

</html>