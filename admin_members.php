<?php
session_start();

// SECURITY: Only Admins can access this page
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php';

// Handle User Deletion if the admin clicks the trash can
if (isset($_GET['delete_id'])) {
    $delete_id = $conn->real_escape_string($_GET['delete_id']);
    // Ensure we don't accidentally delete the main admin account!
    if ($delete_id != $_SESSION['user_id']) {
        $conn->query("DELETE FROM users WHERE id = '$delete_id'");
        header("Location: admin_members.php?success=deleted");
        exit();
    }
}

// Fetch all users (Members and Trainers) ordered by newest first
$users_query = $conn->query("SELECT * FROM users WHERE role != 'admin' ORDER BY created_at DESC");
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

    /* Admin Sidebar */
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

    /* Table Card */
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
            <h2 class="fw-bold text-dark">Manage <span style="color: var(--fz-blue);">System Users</span></h2>
            <p class="text-muted">View, manage, and remove registered members and trainers.</p>

            <?php if (isset($_GET['success']) && $_GET['success'] == 'deleted'): ?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> User account permanently deleted!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="dash-sidebar">
                <a href="admin_dashboard.php" class="dash-nav-link"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                <a href="admin_members.php" class="dash-nav-link active"><i class="fa-solid fa-users"></i> Manage Members</a>
                <a href="admin_queries.php" class="dash-nav-link"><i class="fa-solid fa-envelope-open-text"></i> Customer Queries</a>
                <a href="admin_dashboard.php" class="dash-nav-link"><i class="fa-solid fa-dumbbell"></i> Class Schedule</a>
                <a href="logout.php" class="dash-nav-link logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="table-card">
                <h5 class="fw-bold mb-4">All Registered Users</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Role</th>
                                <th>Joined Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($users_query->num_rows > 0): ?>
                                <?php while ($user = $users_query->fetch_assoc()): ?>
                                    <tr>
                                        <td class="text-muted fw-bold">#<?php echo $user['id']; ?></td>
                                        <td class="fw-bold text-dark"><?php echo htmlspecialchars($user['fullname']); ?></td>
                                        <td><a href="mailto:<?php echo htmlspecialchars($user['email']); ?>" class="text-decoration-none text-muted"><?php echo htmlspecialchars($user['email']); ?></a></td>

                                        <td>
                                            <?php if ($user['role'] == 'trainer'): ?>
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-1">Trainer</span>
                                            <?php else: ?>
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary rounded-pill px-3 py-1">Member</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-muted small">
                                            <i class="fa-regular fa-calendar me-1"></i> <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                                        </td>

                                        <td>
                                            <a href="admin_members.php?delete_id=<?php echo $user['id']; ?>" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3" onclick="return confirm('Are you sure you want to permanently delete this user? All their data will be lost.');">
                                                <i class="fa-solid fa-trash-can"></i> Remove
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">No users found in the system.</td>
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