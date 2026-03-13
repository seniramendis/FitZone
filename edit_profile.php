<?php
// 1. START SESSION & SECURITY CHECK
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'db_config.php';
$user_id = $_SESSION['user_id'];

// 2. PROCESS THE FORM SUBMISSION
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Grab and sanitize the new inputs
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $goal = $conn->real_escape_string($_POST['goal']);

    // Update the core user data in the database
    $update_sql = "UPDATE users SET fullname = '$fullname', email = '$email', goal = '$goal' WHERE id = $user_id";

    if ($conn->query($update_sql) === TRUE) {

        // 🔥 REAL-TIME UPDATE: Update the session variable immediately! 
        $_SESSION['fullname'] = $fullname;

        // 3. OPTIONAL PASSWORD UPDATE
        if (!empty($_POST['new_password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $conn->query("UPDATE users SET password = '$new_password' WHERE id = $user_id");
        }

        // THE FIX: Force the page to redirect and reload so the header updates instantly
        header("Location: edit_profile.php?success=updated");
        exit();
    } else {
        header("Location: edit_profile.php?error=db");
        exit();
    }
}

// 4. FETCH CURRENT USER DATA TO PRE-FILL THE FORM
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$user_data = $result->fetch_assoc();

include 'header.php';
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

    .profile-wrapper {
        margin-top: 120px;
        margin-bottom: 80px;
        min-height: 70vh;
    }

    .edit-profile-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        border: none;
    }

    .edit-profile-card h3 {
        font-weight: 800;
        color: var(--fz-dark);
        margin-bottom: 30px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6b7280;
    }

    .form-control,
    .form-select {
        padding: 14px 18px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        background-color: #f9fafb;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--fz-red);
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(230, 57, 70, 0.1);
    }

    .btn-save {
        background-color: var(--fz-red);
        color: white;
        font-weight: 700;
        padding: 14px 30px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 20px;
    }

    .btn-save:hover {
        background-color: #c1121f;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(230, 57, 70, 0.2);
    }

    .password-section {
        background: #fdf2f2;
        border: 1px solid rgba(230, 57, 70, 0.2);
        padding: 20px;
        border-radius: 12px;
        margin-top: 30px;
    }
</style>

<div class="container profile-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="edit-profile-card">
                <h3>Edit <span style="color: var(--fz-red);">Profile</span></h3>

                <?php if (isset($_GET['success']) && $_GET['success'] == 'updated'): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> Your profile has been updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (isset($_GET['error']) && $_GET['error'] == 'db'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> A database error occurred.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="edit_profile.php" method="POST">

                    <div class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="fullname" value="<?php echo htmlspecialchars($user_data['fullname']); ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user_data['email']); ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Primary Fitness Goal</label>
                        <select class="form-select" name="goal" required>
                            <option value="weight_loss" <?php if ($user_data['goal'] == 'weight_loss') echo 'selected'; ?>>Weight Loss</option>
                            <option value="muscle_gain" <?php if ($user_data['goal'] == 'muscle_gain') echo 'selected'; ?>>Muscle Gain</option>
                            <option value="flexibility" <?php if ($user_data['goal'] == 'flexibility') echo 'selected'; ?>>Flexibility & Yoga</option>
                            <option value="general" <?php if ($user_data['goal'] == 'general') echo 'selected'; ?>>General Fitness</option>
                        </select>
                    </div>

                    <div class="password-section">
                        <h6 class="fw-bold text-danger mb-3"><i class="fa-solid fa-lock me-2"></i> Security Settings</h6>
                        <label class="form-label">New Password (Leave blank to keep current)</label>
                        <input type="password" class="form-control" name="new_password" placeholder="Enter a new password...">
                    </div>

                    <button type="submit" class="btn-save">Save Changes</button>

                </form>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>