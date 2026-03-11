<?php include 'header.php'; ?>

<style>
    /* Specific styling for the Login Page */
    .auth-section {
        position: relative;
        width: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background-image: url('https://images.unsplash.com/photo-1540497077202-7c8a3999166f?q=80&w=1920&auto=format&fit=crop');
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
        max-width: 420px;
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
        margin-top: 35px;
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

    .form-group input {
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

    .form-options {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 25px;
        color: #9ca3af;
    }

    .form-options a {
        color: #e63946;
        text-decoration: none;
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
            <h2>Welcome <span class="text-red">Back</span></h2>
            <p>Ready to hit your targets today?</p>

            <form action="process_login.php" method="POST" class="auth-form">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <div class="form-options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-auth">Login</button>
            </form>

            <p class="auth-footer">New to FitZone? <a href="register.php">Sign Up</a></p>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>