<?php
session_start();
include 'php/koneksi.php';
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <nav class="navbar navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Music Concert</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLightNavbar" aria-controls="offcanvasLightNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <div class="navbar navbar-light bg-light fixed-top bg-transparent">
        <div class="offcanvas offcanvas-end text-bg-light" tabindex="-1" id="offcanvasLightNavbar" aria-labelledby="offcanvasLightNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasLightNavbarLabel">Harits ~ Jasmine</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body offcanvas-light bg-light">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="php/logout.php">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="container mt-4 pt-5">
        <!-- Button Row -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="#tiket" class="btn btn-primary"><i class="bi bi-ticket-perforated"></i> Buy Ticket Now</a>
            <a href="retrieve.php" class="btn btn-success"><i class="bi bi-ticket-detailed"></i> Retrieve Ticket</a>
        </div>
        <form action="payment.php" method="post" class="form-dashboard bg-white">
            <!-- Event Title and Navigation Tabs -->
            <h2 class="h2-event mb-4 pt-3">Informatics Event</h2>
            <ul class="nav nav-tabs custom-tab" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="ticket-tab" data-bs-toggle="tab" data-bs-target="#ticket" type="button" role="tab" aria-controls="ticket" aria-selected="true">Ticket</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Details</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="organizer-tab" data-bs-toggle="tab" data-bs-target="#organizer" type="button" role="tab" aria-controls="organizer" aria-selected="false">Organizer</button>
                </li>
                <div class="indicator">

                </div>
            </ul>

            <!-- Tabs Content -->
            <div class="tab-content mt-3" id="myTabContent">
                <div class="tab-pane fade show active" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="pinkconcert.png" class="d-block w-100" alt="info">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="category.png" class="d-block w-100" alt="seat">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card p-3">
                                <h5>Concert Information</h5>
                                <img src="konser.png" class="img-fluid mb-2 small-qr" alt="QR Code">
                                <h7><strong>Scan and Share</strong></h7>
                                <p>Scan the qr to open and share in mobile</p>
                                <table style="text-align: left;">
                                    <tr>
                                        <td><strong>Date</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>19 November 2024, 13:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Location</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>Kampus Unit II (Prodi Teknik Informatika)</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td><strong>:</strong></td>
                                        <td>Jl. Babarsari 2, Janti, Caturtunggal</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Category</strong></td>
                                        <td><strong>:</strong></td>
                                        <td style="font-style: italic;">#Concerts, #Fairs, #Expo Event</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container mt-5" id="tiket" style="scroll-margin-top: 64px;">
                        <div class="event-date">
                            <h5>Event Date : Celestia Harmony - Exclusive (19 November 2024)</h5>
                        </div>

                        <!-- Ticket 1 -->
                        <div class="ticket-card">
                            <h6>Silver</h6>
                            <p>*Ticket Price includes Government Tax 10%.</p>
                            <p>Price: <strong>IDR 500.000</strong></p>
                            <select name="quantity_ticket_1" class="form-select" aria-label="Quantity for Ticket 1">
                                <?php for ($i = 0; $i <= 5; $i++): ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Ticket 2 -->
                        <div class="ticket-card">
                            <h6>Festival</h6>
                            <p>*Ticket Price includes Government Tax 10%.</p>
                            <p>Price: <strong>IDR 750.000</strong></p>
                            <select name="quantity_ticket_2" class="form-select" aria-label="Quantity for Ticket 2">
                                <?php for ($i = 0; $i <= 5; $i++): ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Ticket 3 -->
                        <div class="ticket-card">
                            <h6>Gold</h6>
                            <p>*Ticket Price includes Government Tax 10%.</p>
                            <p>Price: <strong>IDR 1.000.000</strong></p>
                            <select name="quantity_ticket_3" class="form-select" aria-label="Quantity for Ticket 3">
                                <?php for ($i = 0; $i <= 5; $i++): ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Ticket 4 -->
                        <div class="ticket-card">
                            <h6>Platinum</h6>
                            <p>*Ticket Price includes Government Tax 10%.</p>
                            <p>Price: <strong>IDR 1.250.000</strong></p>
                            <select name="quantity_ticket_4" class="form-select" aria-label="Quantity for Ticket 4">
                                <?php for ($i = 0; $i <= 5; $i++): ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <!-- Buy Button -->
                        <button type="submit" class="btn buy-btn">Buy Ticket Now</button>

                    </div>
                </div>

                <!-- Details Tab Content -->
                <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                    <h5><i class="bi bi-envelope-heart"></i><strong>Deskripsi Acara</strong></h5>
                    <p>
                    Bersiaplah untuk merasakan malam spektakuler yang penuh gemerlap bintang dalam Celestia Harmony, sebuah konser megah yang menghadirkan harmoni sempurna antara musik, cahaya, dan emosi. Konser ini adalah pengalaman emosional dan visual yang dirancang untuk mengguncang hati para penonton. Dengan tata panggung futuristik, pertunjukan cahaya spektakuler, dan kualitas suara terbaik, setiap momen dalam acara ini akan membawa Anda lebih dekat ke magisnya dunia musik.
                    </p><br>
                    <h5><i class="bi bi-info-square"></i><strong>Informasi Ticketing</strong></h5>
                    <p>
                        Seluruh pengunjung wajib memiliki tiket gelang untuk masuk. Harap melakukan pembelian tiket di platform KonserGokil.id yang telah bekerja sama dengan Harits & Jasmine. Kami tidak bertanggung jawab atas pembelian tiket di luar platform tersebut atau yang tidak terkait dengan kerjasama Harits & Jasmine. Kunjungi Official Instagram, Official Facebook Page, dan Official Twitter Harits & Jasmine untuk mengetahui informasi dan berita terkini.
                    </p><br>
                    <h5><i class="bi bi-tags"></i><strong>Harga Tiket</strong></h5>
                    <p>
                        <strong>Harga sudah termasuk pajak pemerintah sebesar 10% dan belum termasuk biaya platform.</strong><br>
                        1. Harga Tiket Silver adalah IDR 500.000 per orang. <br>
                        2. Harga Tiket Festival adalah IDR 750.000 per orang. <br>
                        3. Harga Tiket Gold adalah IDR 1.000.000 per orang. <br>
                        4. Harga Tiket Platinum adalah IDR 1.250.000 per orang. <br>
                    </p><br>
                    <h5><i class="bi bi-geo-alt"></i><strong> Waktu & Lokasi</strong></h5>
                    <p>
                        Selasa, 19 November 2024. <br>
                        Pukul 13.00-15.00 WIB. <br>
                        Kampus Unit II (Prodi Teknik Informatika). Jl. Babarsari 2, Janti, Caturtunggal, Depok, Sleman Regency, Special Region of Yogyakarta 55281.
                    </p><br>
                    <h5><i class="bi bi-hammer"></i><strong>Terms and Conditions</strong></h5>
                    <p>
                        <strong>Pemberitahuan Penting:</strong><br>
                        1. Pastikan penulisan email yang dimasukan sudah benar, karena e-voucher tiket akan dikirimkan melalui email. <br>
                        2. Satu anak mulai dari usia 2 tahun wajib memiliki tiket gelang untuk syarat masuk. <br>
                        3. Apabila terjadi kerusakan pada tiket gelang atau kesalahan dalam pembelian, maka tiket yang telah dibeli tidak dapat ditukar atau dikembalikan. <br>
                        4. Jika tiket hilang, peserta wajib membeli kembali tiket baru untuk masuk. <br>
                        5. Mohon diperhatikan bahwa penjualan di tempat dengan pembayaran tunai (tiket OTS) tidak lagi tersedia di Harits & Jasmine. Namun, pembelian tiket masih tersedia pada hari pelaksanaan konser melalui platform resmi KonserGokil dengan pembelian online. <br>
                        6. Harap dipahami bahwa tiket yang tersedia terbatas untuk alasan keamanan dan kapasitas venue. <br>
                        7. Jam buka untuk penukaran Tiket Masuk Reguler hanya berlaku sesuai hari acara pada saat jam buka tiket booth jam 09.00-14.30 WIB. <br>
                        8. Ketentuan dan pemberitahuan penting pada acara konser silahkan merujuk pada halaman ticketing masing-masing. <br>
                    </p>
                </div>

                <!-- Organizer Tab Content -->
                <div class="tab-pane fade" id="organizer" role="tabpanel" aria-labelledby="organizer-tab">
                    <div class="card" style="width: 24rem; margin: auto;">
                        <img src="musicconcert.png" class="card-img-top" alt="Profile Picture">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td><strong>Organizer</strong></td>
                                    <td>:</td>
                                    <td>Harits & Jasmine</td>
                                </tr>
                                <tr>
                                    <td><strong>Contact</strong></td>
                                    <td>:</td>
                                    <td>info.haritsandjasmine@gmail.com</td>
                                </tr>
                                <tr>
                                    <td><strong>Phone</strong></td>
                                    <td>:</td>
                                    <td>+62 812-3456-7890</td>
                                </tr>
                                <tr>
                                    <td><strong>Website</strong></td>
                                    <td>:</td>
                                    <td><a href="https://youtu.be/xvFZjo5PgG0?si=IfjLjz8CMHfOUC2x">https://KonserGokil.id</a></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="footer">
        <div class="footer-content">
            <h5>informatics event</h5>
            <p>Event held by Informatics Engineering of Universitas Pembangunan Nasional "Veteran" Yogyakarta. Presented by Harits & Jasmine from Informatics 23. Ticket in collaboration of Informatics UPNVYK x KonserGokil.</p>
        </div>
        <div class="footer-links">
            <h5>Information</h5>
            <ul>
                <li>info.haritsandjasmine@gmail.com</li>
                <li>+62 812-3456-7890</li>
                <li><a href="https://youtu.be/xvFZjo5PgG0?si=IfjLjz8CMHfOUC2x">https://KonserGokil.id</a></li>
            </ul>
        </div>
        <div class="footer-links">
            <h5>opening hours</h5>
            <ul>
                <li>Tuesday: <span>13.00 - 15.00</span></li>
                <li>Date: <span>November 19th, 2024</span></li>
            </ul>
        </div>
        <div class="footer-bottom">
            © 2024 Copyright: KonserGokil.id
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.addEventListener("scroll", () => {
            const nav = document.querySelector("nav")
            if (window.scrollY) {
                nav.classList.add("harits-navbar-blur");
                nav.classList.remove("navbar-light");
                nav.classList.remove("bg-light")
                nav.dataset.bsTheme = "dark";
            } else {
                nav.classList.remove("harits-navbar-blur");
                nav.classList.add("navbar-light");
                nav.classList.add("bg-light")
                nav.dataset.bsTheme = undefined;
            }
            console.log(window.scrollY)
        })
    </script>
</body>

</html>