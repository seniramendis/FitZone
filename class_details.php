<?php
include 'header.php';

// Master array linking classes to specific trainers and details
$classes_data = [
    1 => [
        'name' => 'Strength & Power',
        'image' => 'https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=1920&auto=format&fit=crop',
        'desc' => 'Build muscle and increase your raw power with our premium free weights and resistance machines. This class focuses on compound movements like squats, deadlifts, and bench presses. Perfect for those looking to build a strong foundation and increase overall body strength.',
        'trainer_name' => 'Nuwan Perera',
        'trainer_img' => 'https://images.unsplash.com/photo-1567013127542-490d757e51fc?q=80&w=600&auto=format&fit=crop',
        'trainer_id' => 1
    ],
    2 => [
        'name' => 'Cardio & HIIT',
        'image' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=1920&auto=format&fit=crop',
        'desc' => 'Burn calories fast and boost your endurance with high-intensity intervals and top-tier cardio equipment. This fast-paced session is designed to keep your heart rate up and maximize fat loss in a short amount of time.',
        'trainer_name' => 'Kavindu Jayawardena',
        'trainer_img' => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?q=80&w=600&auto=format&fit=crop',
        'trainer_id' => 3
    ],
    3 => [
        'name' => 'Yoga & Mobility',
        'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?q=80&w=1920&auto=format&fit=crop',
        'desc' => 'Enhance your flexibility, balance, and core strength in our guided, relaxing studio sessions. Learn breathing techniques and active stretching protocols to prevent injuries and improve posture.',
        'trainer_name' => 'Dilani Silva',
        'trainer_img' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?q=80&w=600&auto=format&fit=crop',
        'trainer_id' => 2
    ],
    4 => [
        'name' => 'Boxing & Martial Arts',
        'image' => 'https://images.unsplash.com/photo-1549833284-6a7df91c1f65?q=80&w=1920&auto=format&fit=crop',
        'desc' => 'Improve your agility, speed, and self-defense skills with our heavy bags and expert striking coaches. You will learn footwork, punching combinations, and defensive head movement while getting an incredible cardiovascular workout.',
        'trainer_name' => 'Roshan Silva',
        'trainer_img' => 'https://images.unsplash.com/photo-1581009146145-b5ef050c2e1e?q=80&w=600&auto=format&fit=crop',
        'trainer_id' => 5
    ],
    5 => [
        'name' => 'CrossFit & Conditioning',
        'image' => 'https://images.unsplash.com/photo-1538805060514-97d9cc17730c?q=80&w=1920&auto=format&fit=crop',
        'desc' => 'A hardcore mix of Olympic weightlifting, gymnastics, and aerobic exercise for ultimate functional fitness. Prepare your body for real-world physical challenges in this team-oriented, highly motivating class.',
        'trainer_name' => 'Malith Kumara',
        'trainer_img' => 'https://images.unsplash.com/photo-1558611848-73f7eb4001a1?q=80&w=600&auto=format&fit=crop',
        'trainer_id' => 6
    ],
    6 => [
        'name' => 'Zumba & Dance',
        'image' => 'https://images.unsplash.com/photo-1524594152303-9fd13543fe6e?q=80&w=1920&auto=format&fit=crop',
        'desc' => 'Burn calories while having a blast. A high-energy, rhythm-based workout perfect for all fitness levels. No rhythm required—just bring your energy and get ready to sweat to global beats!',
        'trainer_name' => 'Senuri Fernando',
        'trainer_img' => 'https://images.unsplash.com/photo-1518611012118-696072aa579a?q=80&w=600&auto=format&fit=crop',
        'trainer_id' => 4
    ]
];

$class_id = isset($_GET['id']) && array_key_exists($_GET['id'], $classes_data) ? $_GET['id'] : 1;
$class = $classes_data[$class_id];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --fz-red: #e63946;
        --fz-dark: #111827;
    }

    body {
        background-color: #f8f9fa;
    }

    /* Hero Header */
    .class-header {
        position: relative;
        width: 100%;
        height: 50vh;
        margin-top: 60px;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .class-header-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(17, 24, 39, 1) 0%, rgba(17, 24, 39, 0.6) 100%);
    }

    .class-header-content {
        position: relative;
        z-index: 2;
        color: #fff;
        padding: 0 20px;
        margin-top: 50px;
    }

    .content-wrapper {
        margin-top: -60px;
        margin-bottom: 80px;
        position: relative;
        z-index: 10;
    }

    /* Left Side - Details */
    .details-card {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    /* Assigned Trainer Mini-Profile */
    .assigned-trainer {
        display: flex;
        align-items: center;
        background: #f9fafb;
        padding: 20px;
        border-radius: 12px;
        margin-top: 30px;
        border: 1px solid #e5e7eb;
    }

    .assigned-trainer img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--fz-red);
        margin-right: 20px;
    }

    /* Right Side - Booking Form */
    .booking-card {
        background: var(--fz-dark);
        color: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #9ca3af;
        margin-top: 15px;
    }

    .form-control,
    .form-select {
        padding: 14px 18px;
        border-radius: 12px;
        border: none;
        background-color: rgba(255, 255, 255, 0.05);
        color: #fff;
    }

    .form-control:focus,
    .form-select:focus {
        background-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 0 4px rgba(230, 57, 70, 0.2);
        color: #fff;
    }

    .form-select option {
        color: #111827;
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
        width: 100%;
        margin-top: 30px;
        transition: 0.3s ease;
    }

    .btn-book:hover {
        background-color: #c1121f;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(230, 57, 70, 0.3);
    }

    /* Login Prompt Overlay */
    .login-prompt {
        background: rgba(255, 255, 255, 0.05);
        border: 1px dashed rgba(255, 255, 255, 0.2);
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        margin-top: 20px;
    }
</style>

<section class="class-header" style="background-image: url('<?php echo $class['image']; ?>');">
    <div class="class-header-overlay"></div>
    <div class="class-header-content">
        <h1 class="fw-bold display-4"><?php echo htmlspecialchars($class['name']); ?></h1>
    </div>
</section>

<div class="container content-wrapper">
    <div class="row g-4">

        <div class="col-lg-7">
            <div class="details-card">
                <h3 class="fw-bold mb-4">Class Overview</h3>
                <p class="text-muted lh-lg fs-5"><?php echo htmlspecialchars($class['desc']); ?></p>

                <h5 class="fw-bold mt-5 mb-3">Led by Fitness Expert</h5>
                <div class="assigned-trainer">
                    <img src="<?php echo $class['trainer_img']; ?>" alt="Trainer">
                    <div>
                        <h5 class="fw-bold mb-1 m-0"><?php echo htmlspecialchars($class['trainer_name']); ?></h5>
                        <p class="text-danger small fw-bold text-uppercase m-0 mb-2">Primary Instructor</p>
                        <a href="trainer_profile.php?id=<?php echo $class['trainer_id']; ?>" class="text-decoration-none fw-bold" style="color: #111827; font-size: 0.9rem;">View Full Profile <i class="fa-solid fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="booking-card">
                <h3 class="fw-bold mb-1">Reserve Your Spot</h3>
                <p class="text-muted mb-4">Secure your place in the next session.</p>

                <?php if (isset($_SESSION['user_id'])): ?>

                    <form action="process_booking.php" method="POST">
                        <input type="hidden" name="class_name" value="<?php echo htmlspecialchars($class['name']); ?>">
                        <input type="hidden" name="trainer_name" value="<?php echo htmlspecialchars($class['trainer_name']); ?>">

                        <label class="form-label">Selected Program</label>
                        <select class="form-select" disabled>
                            <option selected><?php echo htmlspecialchars($class['name']); ?></option>
                        </select>

                        <div class="row g-3 mt-1">
                            <div class="col-12">
                                <label class="form-label mt-0">Select Date</label>
                                <input type="date" class="form-control" name="booking_date" min="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label mt-0">Select Time Slot</label>
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

                <?php else: ?>

                    <div class="login-prompt">
                        <i class="fa-solid fa-lock fs-1 text-danger mb-3 opacity-75"></i>
                        <h5 class="fw-bold text-white mb-2">Members Only</h5>
                        <p class="text-muted small mb-4">You must be logged into your FitZone account to book classes.</p>
                        <a href="login.php" class="btn btn-outline-light w-100 rounded-pill fw-bold">Login to Book</a>
                        <p class="mt-3 mb-0 small text-muted">Don't have an account? <a href="register.php" class="text-danger text-decoration-none">Sign Up</a></p>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>