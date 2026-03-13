<?php include $_SERVER['DOCUMENT_ROOT'] . '/FitZone/header.php'; ?>

<style>
    /* Specific styling for the Register Page */
    .auth-section {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=1920&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        padding-top: 80px;
    }

    .auth-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 20, 32, 0.75);
    }

    .auth-container {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 450px;
        padding: 20px;
    }

    .auth-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 50px 40px;
        text-align: center;
        color: #fff;
        box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
    }

    .auth-card h2 {
        font-size: 2.2rem;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .text-red {
        color: #e63946;
    }

    .auth-form {
        text-align: left;
        margin-top: 25px;
    }

    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        display: block;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        color: #9ca3af;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 14px 18px;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        color: #fff;
        font-family: 'Poppins', sans-serif;
        outline: none;
        transition: 0.3s;
    }

    .form-group input:focus {
        border-color: #e63946;
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 0 4px rgba(230, 57, 70, 0.15);
    }

    .form-group select option {
        color: #374151;
        /* Dark text for dropdown options so they are readable */
    }

    .btn-auth {
        width: 100%;
        padding: 16px;
        background: #e63946;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        box-shadow: inset 0 0 0 0 #c1121f;
        transition: 0.4s ease-in-out;
        margin-top: 10px;
    }

    .btn-auth:hover {
        box-shadow: inset 450px 0 0 0 #c1121f;
    }

    .auth-footer {
        margin-top: 30px;
        font-size: 0.95rem;
        color: #9ca3af;
    }

    .auth-footer a {
        color: #e63946;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<section class="auth-section">
    <div class="auth-overlay"></div>
    <div class="auth-container">
        <div class="auth-card">
            <h2>Join the <span class="text-red">Tribe</span></h2>
            <p style="margin-bottom: 20px;">Start your transformation today.</p>

            <?php if (isset($_GET['error']) && $_GET['error'] == 'email_exists'): ?>
                <div style="background: rgba(230,57,70,0.2); border: 1px solid #e63946; color: #fff; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; font-size: 0.9rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i> This email is already registered. Please log in.
                </div>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == 'db_error'): ?>
                <div style="background: rgba(230,57,70,0.2); border: 1px solid #e63946; color: #fff; padding: 12px; border-radius: 8px; margin-bottom: 20px; text-align: left; font-size: 0.9rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i> A database error occurred. Please try again.
                </div>
            <?php endif; ?>
            <form action="process_register.php" method="POST" class="auth-form" style="margin-top: 10px;">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="fullname" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label>Fitness Goal</label>
                    <select name="goal">
                        <option value="weight_loss">Weight Loss</option>
                        <option value="muscle_gain">Muscle Gain</option>
                        <option value="flexibility">Flexibility & Yoga</option>
                        <option value="general">General Fitness</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-auth">Create Account</button>
            </form>

            <p class="auth-footer">Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>
</section>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/FitZone/footer.php'; ?>