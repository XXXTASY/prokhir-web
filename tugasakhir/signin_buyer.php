<?php
session_start();
include 'php/koneksi.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($konek, $_POST['email']);
    $password = mysqli_real_escape_string($konek, $_POST['password']);

    $query = "SELECT * FROM pembeli WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($konek, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['user_id'] = $user['id_pembeli'];

        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: signin_buyer.php?pesan=gagal");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Pembeli</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 style="margin-top: 54px;">Celestia Harmony</h1>
    <div class="signin-container">
        <form action="signin_buyer.php" method="POST" class="signup-form">

            <h2>Sign In Akun Pembeli</h2>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <?php
            if (isset($_GET['pesan'])) {
                $messageClass = "";
                if ($_GET['pesan'] == "gagal") {
                    $messageClass = "message error";
                    echo "<div class='$messageClass'>Username atau Password salah!</div>";
                }
            }
            ?>

            <button type="submit" class="signin-button">Sign In</button>
            <a href="signup_buyer.php" class="signin-button">Belum punya akun?</a>
            <a href="signin_admin.php" class="signin-button">Log In Sebagai Admin</a>
        </form>
    </div>
</body>

</html>