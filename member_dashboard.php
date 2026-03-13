<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'member') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php'; // Required to fetch the user's live bookings!

$user_id = $_SESSION['user_id'];

// Fetch the user's bookings from the database, ordered by closest date first
$bookings_query = $conn->query("SELECT * FROM bookings WHERE user_id = '$user_id' ORDER BY booking_date ASC, booking_time ASC");

// Calculate how many upcoming classes the user has booked
$current_date = date('Y-m-d');
$classes_count_query = $conn->query("SELECT COUNT(*) as total FROM bookings WHERE user_id = '$user_id' AND booking_date >= '$current_date'");
$total_upcoming = $classes_count_query->fetch_assoc()['total'];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    :root {
        --fz-red: #e63946;
        --fz-dark: #111827;
        --fz-light: #f8f9fa;
    }

    body {
        background-color: #f4f6f9;
    }

    .dashboard-wrapper {
        margin-top: 100px;
        margin-bottom: 50px;
    }

    .dash-sidebar {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        height: 100%;
    }

    .dash-nav-link {
        display: block;
        padding: 12px 20px;
        color: #4b5563;
        text-decoration: none;
        font-weight: 600;
        border-radius: 10px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }

    .dash-nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .dash-nav-link:hover,
    .dash-nav-link.active {
        background-color: rgba(230, 57, 70, 0.1);
        color: var(--fz-red);
    }

    .dash-nav-link.logout {
        color: #dc3545;
        margin-top: 30px;
        background-color: rgba(220, 53, 69, 0.1);
    }

    .dash-nav-link.logout:hover {
        background-color: #dc3545;
        color: #fff;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        border-left: 5px solid var(--fz-red);
        height: 100%;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card h3 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--fz-dark);
        margin-bottom: 5px;
    }

    .stat-card p {
        color: #6b7280;
        font-weight: 500;
        margin: 0;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .table-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
        margin-top: 30px;
    }

    .table thead th {
        border-bottom: 2px solid #e5e7eb;
        color: #9ca3af;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }

    .badge-status {
        background: rgba(46, 204, 113, 0.2);
        color: #2ecc71;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-waitlist {
        background: rgba(241, 196, 15, 0.2);
        color: #f39c12;
        padding: 6px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
    }
</style>

<div class="container dashboard-wrapper">

    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold" style="color: var(--fz-dark);">
                Welcome back, <span style="color: var(--fz-red);"><?php echo htmlspecialchars(explode(' ', trim($_SESSION['fullname']))[0]); ?></span>!
            </h2>
            <p class="text-muted">Here is your fitness overview for today.</p>

            <?php if (isset($_GET['success']) && $_GET['success'] == 'booked'): ?>
                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> Class successfully booked!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="dash-sidebar">
                <a href="member_dashboard.php" class="dash-nav-link active"><i class="fa-solid fa-house"></i> Overview</a>
                <a href="classes.php" class="dash-nav-link"><i class="fa-solid fa-calendar-check"></i> Book Class</a>
                <a href="edit_profile.php" class="dash-nav-link"><i class="fa-solid fa-gear"></i> Settings</a>
                <a href="logout.php" class="dash-nav-link logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <div class="col-lg-9">

            <div class="row g-3">
                <div class="col-md-4">
                    <div class="stat-card">
                        <h3>Pro</h3>
                        <p>Current Plan</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-left-color: #111827;">
                        <h3><?php echo $total_upcoming; ?></h3>
                        <p>Upcoming Classes</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card" style="border-left-color: #2ecc71;">
                        <h3>Active</h3>
                        <p>Account Status</p>
                    </div>
                </div>
            </div>

            <div class="table-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold m-0">Your Class Schedule</h4>
                    <a href="classes.php" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3">Book New Class</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Class & Trainer</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($bookings_query->num_rows > 0): ?>
                                <?php while ($booking = $bookings_query->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold text-dark">
                                            <?php echo htmlspecialchars($booking['class_name']); ?><br>
                                            <span class="text-danger small fw-bold text-uppercase">with <?php echo htmlspecialchars($booking['trainer_name']); ?></span>
                                        </td>
                                        <td class="text-muted">
                                            <i class="fa-regular fa-calendar me-2"></i> <?php echo date('M d, Y', strtotime($booking['booking_date'])); ?><br>
                                            <i class="fa-regular fa-clock me-2"></i> <?php echo htmlspecialchars($booking['booking_time']); ?>
                                        </td>
                                        <td>
                                            <?php if ($booking['status'] == 'Confirmed'): ?>
                                                <span class="badge-status"><i class="fa-solid fa-check me-1"></i> Confirmed</span>
                                            <?php else: ?>
                                                <span class="badge-waitlist"><?php echo htmlspecialchars($booking['status']); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-light text-danger border"><i class="fa-solid fa-xmark"></i> Cancel</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fa-regular fa-calendar-xmark fs-2 mb-3 d-block opacity-50"></i>
                                        You have no upcoming classes.<br>
                                        <a href="classes.php" class="text-danger fw-bold text-decoration-none mt-2 d-inline-block">Book one now</a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>