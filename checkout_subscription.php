<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['plan_name'])) {
    header("Location: pricing.php");
    exit();
}

include 'header.php';


$plan_name = htmlspecialchars($_POST['plan_name']);
$plan_price = htmlspecialchars($_POST['plan_price']);
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

    .section-title {
        font-weight: 800;
        color: var(--fz-dark);
        margin-bottom: 25px;
        font-size: 1.5rem;
    }

    .form-control {
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
    }

    .form-control:focus {
        border-color: var(--fz-red);
        box-shadow: 0 0 0 3px rgba(230, 57, 70, 0.1);
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        color: #4b5563;
        font-weight: 500;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px dashed #e5e7eb;
        font-weight: 800;
        font-size: 1.25rem;
        color: var(--fz-dark);
    }

    .btn-pay {
        background-color: var(--fz-red);
        color: white;
        font-weight: 700;
        padding: 15px;
        border-radius: 10px;
        width: 100%;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: 0.3s ease;
        margin-top: 20px;
    }

    .btn-pay:hover {
        background-color: #c1121f;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(230, 57, 70, 0.2);
    }

    .secure-badge {
        text-align: center;
        color: #10b981;
        font-weight: 600;
        font-size: 0.85rem;
        margin-top: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
</style>

<div class="container checkout-wrapper">
    <div class="row mb-4 text-center">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--fz-dark);">Secure <span style="color: var(--fz-red);">Checkout</span></h2>
            <p class="text-muted">Upgrade your membership to unlock premium features.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card-custom">
                <h4 class="section-title"><i class="fa-regular fa-credit-card me-2 text-danger"></i> Payment Method</h4>

                <form action="process_subscription.php" method="POST" id="paymentForm">
                    <input type="hidden" name="plan_name" value="<?php echo $plan_name; ?>">

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Name on Card</label>
                            <input type="text" class="form-control" placeholder="Amal De Silva" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-muted text-uppercase">Card Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-brands fa-cc-visa text-primary fs-5"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" placeholder="0000 0000 0000 0000" maxlength="19" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">Expiry Date</label>
                            <input type="text" class="form-control" placeholder="MM/YY" maxlength="5" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted text-uppercase">CVV</label>
                            <input type="text" class="form-control" placeholder="123" maxlength="3" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-pay" id="payBtn">
                        <i class="fa-solid fa-lock me-2"></i> Pay LKR <?php echo number_format($plan_price); ?>
                    </button>

                    <div class="secure-badge"><i class="fa-solid fa-shield-halved"></i> 256-bit SSL Bank Grade Security</div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card-custom" style="background: var(--fz-dark); color: white;">
                <h4 class="fw-bold mb-4">Subscription Summary</h4>

                <div class="summary-item text-light opacity-75">
                    <span>Selected Plan</span>
                    <span class="fw-bold text-white text-uppercase"><?php echo $plan_name; ?></span>
                </div>
                <div class="summary-item text-light opacity-75">
                    <span>Billing Cycle</span>
                    <span class="fw-bold text-white">Monthly</span>
                </div>

                <div class="summary-total" style="border-top-color: rgba(255,255,255,0.1);">
                    <span>Total Due Today</span>
                    <span style="color: var(--fz-red);">LKR <?php echo number_format($plan_price); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('payBtn');
        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Processing Payment...';
        btn.style.opacity = '0.8';
        btn.style.pointerEvents = 'none';
    });
</script>

<?php include 'footer.php'; ?>