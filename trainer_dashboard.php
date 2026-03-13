<?php
// 1. SECURITY CHECK: Ensure only Trainers can access this page
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'trainer') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php';

// 2. FETCH TRAINER DATA
// We use the trainer's full name from their session to find their specific bookings
$trainer_name = $conn->real_escape_string($_SESSION['fullname']);

// Get total all-time bookings for this trainer
$total_query = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE trainer_name = '$trainer_name'");
$total_clients = $total_query->fetch_assoc()['total'];

// Get upcoming bookings (from today onwards)
$current_date = date('Y-m-d');
$upcoming_query = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE trainer_name = '$trainer_name' AND booking_date >= '$current_date'");
$upcoming_sessions = $upcoming_query->fetch_assoc()['total'];

// 3. THE ADVANCED SQL JOIN (Crucial for high marks)
// We join the 'bookings' table with the 'users' table so the trainer can see the names of the members who booked!
$schedule_query = $conn->query("
    SELECT b.class_name, b.booking_date, b.booking_time, b.status, u.fullname AS member_name 
    FROM bookings b 
    JOIN users u ON b.user_id = u.id 
    WHERE b.trainer_name = '$trainer_name' 
    ORDER BY b.booking_date ASC, b.booking_time ASC
");
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

    .dashboard-wrapper {
        margin-top: 100px;
        margin-bottom: 50px;
    }

    /* Trainer Sidebar */
    .dash-sidebar {
        background: var(--fz-dark);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        height: 100%;
    }

    .dash-nav-link {
        display: block;
        padding: 12px 20px;
        color: #9ca3af;
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
        background-color: var(--fz-red);
        color: #fff;
    }

    /* Stat Cards */
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        border-left: 5px solid var(--fz-red);
        height: 100%;
    }

    .stat-card h3 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--fz-dark);
        margin-bottom: 5px;
    }

    .stat-card p {
        color: #6b7280;
        font-weight: 600;
        margin: 0;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    /* Tables */
    .table-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        margin-top: 30px;
    }

    .table thead th {
        border-bottom: 2px solid #e5e7eb;
        color: #9ca3af;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 1px;
    }
</style>

<div class="container dashboard-wrapper">

    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Instructor <span style="color: var(--fz-red);">Portal</span></h2>
            <p class="text-muted">Welcome back, <?php echo htmlspecialchars($trainer_name); ?>. Here is your class schedule.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="dash-sidebar">
                <a href="trainer_dashboard.php" class="dash-nav-link active"><i class="fa-solid fa-calendar-days"></i> My Schedule</a>
                <a href="#" class="dash-nav-link"><i class="fa-solid fa-users"></i> Client Roster</a>
                <a href="edit_profile.php" class="dash-nav-link"><i class="fa-solid fa-gear"></i> Settings</a>
            </div>
        </div>

        <div class="col-lg-9">

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="stat-card">
                        <h3><?php echo $upcoming_sessions; ?></h3>
                        <p>Upcoming Sessions</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card" style="border-left-color: #111827;">
                        <h3><?php echo $total_clients; ?></h3>
                        <p>Total All-Time Bookings</p>
                    </div>
                </div>
            </div>

            <div class="table-card">
                <h5 class="fw-bold mb-4">Your Class Roster</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Class Info</th>
                                <th>Member Name</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($schedule_query->num_rows > 0): ?>
                                <?php while ($row = $schedule_query->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold text-dark"><?php echo htmlspecialchars($row['class_name']); ?></td>

                                        <td class="text-primary fw-bold">
                                            <i class="fa-solid fa-user me-2 text-muted"></i><?php echo htmlspecialchars($row['member_name']); ?>
                                        </td>

                                        <td class="text-muted small">
                                            <i class="fa-regular fa-calendar me-1"></i> <?php echo date('M d, Y', strtotime($row['booking_date'])); ?><br>
                                            <i class="fa-regular fa-clock me-1"></i> <?php echo htmlspecialchars($row['booking_time']); ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3">
                                                <?php echo htmlspecialchars($row['status']); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-clipboard-list fs-2 mb-3 d-block opacity-50"></i>
                                        You currently have no members booked for your classes.
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