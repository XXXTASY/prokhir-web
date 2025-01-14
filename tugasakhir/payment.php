<?php
session_start();
include 'php/koneksi.php';

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: index.php?pesan=belum_login");
    exit();
}

$price_ticket_1 = 500000;
$price_ticket_2 = 750000;
$price_ticket_3 = 1000000;
$price_ticket_4 = 1250000;

$tax_rate = 0.10;

$quantity_ticket_1 = isset($_POST['quantity_ticket_1']) ? (int)$_POST['quantity_ticket_1'] : 0;
$quantity_ticket_2 = isset($_POST['quantity_ticket_2']) ? (int)$_POST['quantity_ticket_2'] : 0;
$quantity_ticket_3 = isset($_POST['quantity_ticket_3']) ? (int)$_POST['quantity_ticket_3'] : 0;
$quantity_ticket_4 = isset($_POST['quantity_ticket_4']) ? (int)$_POST['quantity_ticket_4'] : 0;

$total_ticket_1 = $quantity_ticket_1 * $price_ticket_1 * (1 + $tax_rate);
$total_ticket_2 = $quantity_ticket_2 * $price_ticket_2 * (1 + $tax_rate);
$total_ticket_3 = $quantity_ticket_3 * $price_ticket_3 * (1 + $tax_rate);
$total_ticket_4 = $quantity_ticket_4 * $price_ticket_4 * (1 + $tax_rate);

$total_price = $total_ticket_1 + $total_ticket_2 + $total_ticket_3 + $total_ticket_4;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
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
                            <a class="nav-link" href="profile.php">Profile</a>
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
        <form action="process_payment.php" method="POST" class="form-dashboard bg-white p-4">
            <h3>Review Your Order</h3>
            <ul class="list-group">
                <?php if ($quantity_ticket_1 > 0): ?>
                    <li class="list-group-item">
                        Silver - Quantity: <?= $quantity_ticket_1; ?> - Total with Tax: IDR <?= number_format($total_ticket_1, 0, ',', '.'); ?>
                    </li>
                <?php endif; ?>

                <?php if ($quantity_ticket_2 > 0): ?>
                    <li class="list-group-item">
                        Festival - Quantity: <?= $quantity_ticket_2; ?> - Total with Tax: IDR <?= number_format($total_ticket_2, 0, ',', '.'); ?>
                    </li>
                <?php endif; ?>

                <?php if ($quantity_ticket_3 > 0): ?>
                    <li class="list-group-item">
                        Gold - Quantity: <?= $quantity_ticket_3; ?> - Total with Tax: IDR <?= number_format($total_ticket_3, 0, ',', '.'); ?>
                    </li>
                <?php endif; ?>

                <?php if ($quantity_ticket_4 > 0): ?>
                    <li class="list-group-item">
                        Platinum - Quantity: <?= $quantity_ticket_4; ?> - Total with Tax: IDR <?= number_format($total_ticket_4, 0, ',', '.'); ?>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="mt-3">
                <h4>Total Payment: IDR <?= number_format($total_price, 0, ',', '.'); ?></h4>
            </div>

            <input type="hidden" name="quantity_ticket_1" value="<?= $quantity_ticket_1; ?>">
            <input type="hidden" name="quantity_ticket_2" value="<?= $quantity_ticket_2; ?>">
            <input type="hidden" name="quantity_ticket_3" value="<?= $quantity_ticket_3; ?>">
            <input type="hidden" name="quantity_ticket_4" value="<?= $quantity_ticket_4; ?>">
            <input type="hidden" name="total_price" value="<?= $total_price; ?>">

            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select name="payment_method" id="payment_method" class="form-select mt-1" required>
                    <option value="" selected disabled>---Pilih Pembayaran---</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="E-Wallet">E-Wallet</option>
                </select>
            </div>

            <div id="payment_details" class="mt-3" style="display: none;">
                <div id="credit_card_details" style="display: none;">
                    <label for="">Credit Card Details:</label>
                    <input type="text" name="cc_number" placeholder="Card Number" class="form-control">
                    <input type="text" name="cc_expiry" placeholder="Expiry Date" class="form-control mt-2">
                    <input type="text" name="cc_cvv" placeholder="CVV" class="form-control mt-2">
                </div>

                <div id="bank_transfer_details" style="display: none;">
                    <label for="">Bank Transfer Details:</label>
                    <input type="text" name="bank_account" placeholder="Bank Account Number" class="form-control">
                </div>

                <div id="ewallet_details" style="display: none;">
                    <label for="">E-Wallet Details:</label>
                    <input type="text" name="ewallet_account" placeholder="E-Wallet ID" class="form-control">
                </div>
            </div>

            <div class="card-footer mt-3">
                <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Confirm Payment</button>
        </form>
    </div>

    <script>
        document.getElementById('payment_method').addEventListener('change', function() {
            const paymentDetails = document.getElementById('payment_details');
            const creditCardDetails = document.getElementById('credit_card_details');
            const bankTransferDetails = document.getElementById('bank_transfer_details');
            const ewalletDetails = document.getElementById('ewallet_details');

            paymentDetails.style.display = 'block';
            creditCardDetails.style.display = 'none';
            bankTransferDetails.style.display = 'none';
            ewalletDetails.style.display = 'none';

            if (this.value === 'Credit Card') {
                creditCardDetails.style.display = 'block';
            } else if (this.value === 'Bank Transfer') {
                bankTransferDetails.style.display = 'block';
            } else if (this.value === 'E-Wallet') {
                ewalletDetails.style.display = 'block';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>