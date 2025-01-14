<?php
session_start();
include 'php/koneksi.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}

$id_pembeli = $_SESSION['user_id'];
$nama = $email = $no_telp = $password = "";

$query = "SELECT nama, email, no_telp, password FROM pembeli WHERE id_pembeli = ?";
$stmt = $konek->prepare($query);
$stmt->bind_param("i", $id_pembeli);
$stmt->execute();
$stmt->bind_result($nama, $email, $no_telp, $password);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    $password = $_POST['password']; 

    $update_query = "UPDATE pembeli SET nama = ?, no_telp = ?, password = ? WHERE id_pembeli = ?";
    $update_stmt = $konek->prepare($update_query);
    $update_stmt->bind_param("sssi", $nama, $no_telp, $password, $id_pembeli);

    if ($update_stmt->execute()) {
        header("Location: profile.php?pesan=updated");
    } else {
        header("Location: profile.php?pesan=gagal");
    }

    $update_stmt->close();
    $konek->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
                            <a class="nav-link active" href="profile.php">Profile</a>
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
        <form action="" method="POST" class="form-dashboard bg-white p-4">
            <h2>Edit Profile</h2>
            <?php
            if (isset($_GET['pesan'])) {
                if ($_GET['pesan'] == "gagal") {
                    echo "<div class='alert alert-danger'>Gagal mengupdate profil!</div>";
                } else if ($_GET['pesan'] == "updated") {
                    echo "<div class='alert alert-success'>Profil berhasil diperbarui!</div>";
                }
            }
            ?>

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo htmlspecialchars($nama); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input type="text" id="no_telp" name="no_telp" class="form-control" value="<?php echo htmlspecialchars($no_telp); ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" value="<?php echo htmlspecialchars($password); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
