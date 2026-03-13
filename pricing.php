<?php
session_start();
include 'header.php';

// Check if the user is logged in
$is_logged_in = isset($_SESSION['user_id']);
?>

<style>
    .page-header {
        position: relative;
        width: 100%;
        height: 40vh;
        margin-top: 60px;
        background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1920&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .page-header-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 20, 32, 0.85);
    }

    .page-header-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 0 20px;
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #fff;
    }

    .page-header h1 span {
        color: #e63946;
    }
</style>

<section class="page-header">
    <div class="page-header-overlay"></div>
    <div class="page-header-content">
        <h1>Membership <span>Plans</span></h1>
    </div>
</section>

<section class="pricing-section">
    <div class="pricing-grid">

        <div class="pricing-card">
            <h3>Basic</h3>
            <div class="price">LKR 3,500<span>/mo</span></div>
            <ul class="plan-features">
                <li><i class="fa-solid fa-check"></i> Gym Access (6 AM - 8 PM)</li>
                <li><i class="fa-solid fa-check"></i> Standard Equipment</li>
                <li><i class="fa-solid fa-xmark" style="color:#9ca3af"></i> Group Classes</li>
                <li><i class="fa-solid fa-xmark" style="color:#9ca3af"></i> Personal Trainer</li>
            </ul>

            <?php if ($is_logged_in): ?>
                <form action="checkout_subscription.php" method="POST" class="m-0">
                    <input type="hidden" name="plan_name" value="Basic">
                    <input type="hidden" name="plan_price" value="3500">
                    <button type="submit" class="btn-plan w-100 border-0" style="cursor: pointer;">Upgrade Now</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="btn-plan">Get Started</a>
            <?php endif; ?>
        </div>

        <div class="pricing-card popular">
            <div class="popular-badge">Most Popular</div>
            <h3>Pro</h3>
            <div class="price">LKR 5,500<span>/mo</span></div>
            <ul class="plan-features">
                <li><i class="fa-solid fa-check" style="color:#fff;"></i> 24/7 Gym Access</li>
                <li><i class="fa-solid fa-check" style="color:#fff;"></i> Premium Equipment</li>
                <li><i class="fa-solid fa-check" style="color:#fff;"></i> All Group Classes</li>
                <li><i class="fa-solid fa-xmark" style="color:#9ca3af"></i> Personal Trainer</li>
            </ul>

            <?php if ($is_logged_in): ?>
                <form action="checkout_subscription.php" method="POST" class="m-0">
                    <input type="hidden" name="plan_name" value="Pro">
                    <input type="hidden" name="plan_price" value="5500">
                    <button type="submit" class="btn-primary w-100 border-0" style="cursor: pointer;">Upgrade Now</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="btn-primary" style="display:block; text-align:center;">Get Started</a>
            <?php endif; ?>
        </div>

        <div class="pricing-card">
            <h3>VIP</h3>
            <div class="price">LKR 10,000<span>/mo</span></div>
            <ul class="plan-features">
                <li><i class="fa-solid fa-check"></i> 24/7 Gym Access</li>
                <li><i class="fa-solid fa-check"></i> Premium Equipment</li>
                <li><i class="fa-solid fa-check"></i> All Group Classes</li>
                <li><i class="fa-solid fa-check"></i> 4 PT Sessions / Month</li>
            </ul>

            <?php if ($is_logged_in): ?>
                <form action="checkout_subscription.php" method="POST" class="m-0">
                    <input type="hidden" name="plan_name" value="VIP">
                    <input type="hidden" name="plan_price" value="10000">
                    <button type="submit" class="btn-plan w-100 border-0" style="cursor: pointer;">Upgrade Now</button>
                </form>
            <?php else: ?>
                <a href="register.php" class="btn-plan">Get Started</a>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php include 'footer.php'; ?>