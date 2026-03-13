<?php
session_start();
// Security check: Only logged-in users can book a class
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?error=login_required");
    exit();
}

include 'header.php';

// Check if a specific class was passed through the URL (e.g., from classes.php)
$pre_selected_class = isset($_GET['class']) ? $_GET['class'] : '';
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

    .booking-wrapper {
        margin-top: 120px;
        margin-bottom: 80px;
        min-height: 70vh;
    }

    .booking-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        border: none;
    }

    .booking-card h3 {
        font-weight: 800;
        color: var(--fz-dark);
        margin-bottom: 10px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #6b7280;
        margin-top: 15px;
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

    .btn-book {
        background-color: var(--fz-red);
        color: white;
        font-weight: 700;
        padding: 16px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        border: none;
        transition: all 0.3s ease;
        width: 100%;
        margin-top: 30px;
    }

    .btn-book:hover {
        background-color: #c1121f;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(230, 57, 70, 0.2);
    }
</style>

<div class="container booking-wrapper">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="booking-card">
                <h3>Book a <span style="color: var(--fz-red);">Class</span></h3>
                <p class="text-muted mb-4">Reserve your spot in our upcoming sessions.</p>

                <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check me-2"></i> Class successfully booked! Check your dashboard.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (isset($_GET['error']) && $_GET['error'] == 'db_error'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Something went wrong. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="process_booking.php" method="POST">

                    <label class="form-label">Select Program</label>
                    <select class="form-select" name="class_name" required>
                        <option value="" disabled <?php if (empty($pre_selected_class)) echo 'selected'; ?>>Choose a class...</option>
                        <option value="Strength & Power" <?php if ($pre_selected_class == 'Strength & Power') echo 'selected'; ?>>Strength & Power</option>
                        <option value="Cardio & HIIT" <?php if ($pre_selected_class == 'Cardio & HIIT') echo 'selected'; ?>>Cardio & HIIT</option>
                        <option value="Yoga & Mobility" <?php if ($pre_selected_class == 'Yoga & Mobility') echo 'selected'; ?>>Yoga & Mobility</option>
                        <option value="Boxing & Martial Arts" <?php if ($pre_selected_class == 'Boxing & Martial Arts') echo 'selected'; ?>>Boxing & Martial Arts</option>
                        <option value="CrossFit & Conditioning" <?php if ($pre_selected_class == 'CrossFit & Conditioning') echo 'selected'; ?>>CrossFit & Conditioning</option>
                        <option value="Zumba & Dance" <?php if ($pre_selected_class == 'Zumba & Dance') echo 'selected'; ?>>Zumba & Dance</option>
                    </select>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label mt-0">Date</label>
                            <input type="date" class="form-control" name="booking_date" min="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label mt-0">Time Slot</label>
                            <select class="form-select" name="booking_time" required>
                                <option value="" disabled selected>Select time...</option>
                                <option value="06:00 AM">06:00 AM - Early Bird</option>
                                <option value="09:00 AM">09:00 AM - Morning Burn</option>
                                <option value="05:30 PM">05:30 PM - After Work</option>
                                <option value="07:30 PM">07:30 PM - Night Shift</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn-book">Confirm Booking</button>

                </form>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>