<?php
session_start();

// SECURITY: Only Admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php';

// Handle Booking Deletion directly on this page
if (isset($_GET['delete_id'])) {
    $delete_id = $conn->real_escape_string($_GET['delete_id']);
    $conn->query("DELETE FROM bookings WHERE id = '$delete_id'");
    header("Location: admin_schedule.php?success=deleted");
    exit();
}

// Fetch ALL bookings, ordered by closest upcoming date (ASCENDING)
$schedule_query = $conn->query("
    SELECT b.id, b.class_name, b.trainer_name, b.booking_date, b.booking_time, b.status, u.fullname AS member_name 
    FROM bookings b 
    JOIN users u ON b.user_id = u.id 
    ORDER BY b.booking_date ASC, b.booking_time ASC
");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    :root {
        --fz-red: #e63946;
        --fz-dark: #111827;
        --fz-blue: #2563eb;
    }

    body {
        background-color: #f4f6f9;
    }

    .dashboard-wrapper {
        margin-top: 100px;
        margin-bottom: 50px;
    }

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
        background-color: var(--fz-blue);
        color: #fff;
    }

    .dash-nav-link.logout {
        color: #f87171;
        margin-top: 30px;
        background-color: rgba(248, 113, 113, 0.1);
    }

    .dash-nav-link.logout:hover {
        background-color: #ef4444;
        color: #fff;
    }

    .table-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
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
            <h2 class="fw-bold text-dark">Master <span style="color: var(--fz-blue);">Class Schedule</span></h2>
            <p class="text-muted">View and manage the full timeline of upcoming gym classes.</p>
            <?php if (isset($_GET['success']) && $_GET['success'] == 'deleted'): ?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> Booking successfully removed from the schedule.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="dash-sidebar">
                <a href="admin_dashboard.php" class="dash-nav-link"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                <a href="admin_members.php" class="dash-nav-link"><i class="fa-solid fa-users"></i> Manage Members</a>
                <a href="admin_queries.php" class="dash-nav-link"><i class="fa-solid fa-envelope-open-text"></i> Customer Queries</a>
                <a href="admin_schedule.php" class="dash-nav-link active"><i class="fa-solid fa-dumbbell"></i> Class Schedule</a>
                <a href="logout.php" class="dash-nav-link logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="table-card">
                <h5 class="fw-bold mb-4"><i class="fa-regular fa-calendar-days me-2 text-primary"></i> Upcoming Timeline</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Booking ID</th>
                                <th>Class Info</th>
                                <th>Member Name</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($schedule_query->num_rows > 0): ?>
                                <?php while ($row = $schedule_query->fetch_assoc()): ?>
                                    <tr>
                                        <td class="text-muted fw-bold">#<?php echo str_pad($row['id'], 4, '0', STR_PAD_LEFT); ?></td>

                                        <td class="fw-bold text-dark">
                                            <?php echo htmlspecialchars($row['class_name']); ?><br>
                                            <span class="text-danger small fw-bold text-uppercase">Led by <?php echo htmlspecialchars($row['trainer_name']); ?></span>
                                        </td>

                                        <td class="text-primary fw-bold">
                                            <i class="fa-solid fa-user me-2 text-muted"></i><?php echo htmlspecialchars($row['member_name']); ?>
                                        </td>

                                        <td class="text-muted small">
                                            <i class="fa-regular fa-calendar text-primary me-1"></i> <?php echo date('M d, Y', strtotime($row['booking_date'])); ?><br>
                                            <i class="fa-regular fa-clock text-primary me-1"></i> <?php echo htmlspecialchars($row['booking_time']); ?>
                                        </td>

                                        <td>
                                            <?php if ($row['status'] == 'Confirmed'): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-1">Confirmed</span>
                                            <?php elseif ($row['status'] == 'Pending'): ?>
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3 py-1">Pending</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary rounded-pill px-3 py-1"><?php echo htmlspecialchars($row['status']); ?></span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <a href="admin_schedule.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3" onclick="return confirm('Are you sure you want to cancel and delete this booking?');">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fa-regular fa-calendar-xmark fs-2 mb-3 d-block opacity-50"></i>
                                        No upcoming classes scheduled.
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