<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['class_name'])) {
    header("Location: classes.php");
    exit();
}

include 'header.php';

$class_name = htmlspecialchars($_POST['class_name']);
$trainer_name = htmlspecialchars($_POST['trainer_name']);
$booking_date = htmlspecialchars($_POST['booking_date']);
$booking_time = htmlspecialchars($_POST['booking_time']);


$service_fee = 2000;
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --fz-red: #e63946;
        --fz-dark: #111827;
    }

    body {
        background-color: #f4f6f9;
    }

    .checkout-wrapper {
        margin-top: 100px;
        margin-bottom: 80px;
    }

    .card-custom {
        background: #fff;
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        padding: 30px;
    }

    .btn-pay {
        background-color: var(--fz-red);
        color: white;
        font-weight: 700;
        padding: 15px;
        border-radius: 10px;
        width: 100%;
        text-transform: uppercase;
        border: none;
        margin-top: 20px;
    }
</style>

<div class="container checkout-wrapper">
    <div class="row mb-4 text-center">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--fz-dark);">Service <span style="color: var(--fz-red);">Checkout</span></h2>
            <p class="text-muted">Complete payment to secure your trainer and class slot.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card-custom">
                <h4 class="fw-bold mb-4"><i class="fa-regular fa-credit-card me-2 text-danger"></i> Payment Method</h4>
                <form action="process_booking.php" method="POST" id="paymentForm">
                    <input type="hidden" name="class_name" value="<?php echo $class_name; ?>">
                    <input type="hidden" name="trainer_name" value="<?php echo $trainer_name; ?>">
                    <input type="hidden" name="booking_date" value="<?php echo $booking_date; ?>">
                    <input type="hidden" name="booking_time" value="<?php echo $booking_time; ?>">

                    <div class="row g-3">
                        <div class="col-12"><input type="text" class="form-control" placeholder="Name on Card" required></div>
                        <div class="col-12"><input type="text" class="form-control" placeholder="Card Number (0000 0000 0000 0000)" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="MM/YY" required></div>
                        <div class="col-md-6"><input type="text" class="form-control" placeholder="CVV" required></div>
                    </div>
                    <button type="submit" class="btn-pay" id="payBtn"><i class="fa-solid fa-lock me-2"></i> Pay LKR <?php echo number_format($service_fee); ?></button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card-custom" style="background: var(--fz-dark); color: white;">
                <h4 class="fw-bold mb-4">Booking Summary</h4>
                <div class="d-flex justify-content-between mb-2 text-light opacity-75"><span>Service</span><span class="fw-bold text-white"><?php echo $class_name; ?></span></div>
                <div class="d-flex justify-content-between mb-2 text-light opacity-75"><span>Instructor</span><span class="fw-bold text-white"><?php echo $trainer_name; ?></span></div>
                <div class="d-flex justify-content-between mb-4 text-light opacity-75"><span>Date & Time</span><span class="fw-bold text-white"><?php echo $booking_date . ' @ ' . $booking_time; ?></span></div>

                <div class="d-flex justify-content-between mt-4 pt-4 border-top">
                    <span class="fw-bold">Trainer Service Fee</span>
                    <span class="fw-bold" style="color: var(--fz-red);">LKR <?php echo number_format($service_fee); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('paymentForm').addEventListener('submit', function() {
        const btn = document.getElementById('payBtn');
        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Processing...';
        btn.style.opacity = '0.8';
        btn.style.pointerEvents = 'none';
    });
</script>
<?php include 'footer.php'; ?>