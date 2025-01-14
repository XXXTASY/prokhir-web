<?php
session_start();
include 'php/koneksi.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($konek, $_POST['username']);
    $password = mysqli_real_escape_string($konek, $_POST['password']);

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($konek, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id_admin'];

        header("Location: admin.php");
        exit();
    } else {
        header("Location: signin_admin.php?pesan=gagal");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Admin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1 style="margin-top: 54px;">Celestia Harmony</h1>
    <div class="signin-container">
        <form action="signin_admin.php" method="POST" class="signup-form">

            <h2>Sign In Admin</h2>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

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
            <a href="signin_buyer.php" class="signin-button">Bukan Admin?</a>
        </form>
    </div>
</body>

</html>