<?php
// 1. SECURITY CHECK: Ensure only Admins can access this page
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php'; // Need this to fetch data from the database!

// 2. FETCH DASHBOARD STATISTICS
// Get total members
$member_query = $conn->query("SELECT COUNT(id) AS total FROM users WHERE role = 'member'");
$total_members = $member_query->fetch_assoc()['total'];

// Get total pending queries
$queries_query = $conn->query("SELECT COUNT(id) AS total FROM queries WHERE status = 'pending'");
$total_queries = $queries_query->fetch_assoc()['total'];

// Fetch the 5 most recent customer queries
$recent_queries = $conn->query("SELECT * FROM queries ORDER BY created_at DESC LIMIT 5");

// Fetch the 5 most recently registered users
$recent_users = $conn->query("SELECT * FROM users WHERE role = 'member' ORDER BY created_at DESC LIMIT 5");
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
        background-color: var(--fz-red);
        color: #fff;
    }

    /* Admin Stat Cards */
    .admin-stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .admin-stat-card .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .bg-red-light {
        background: rgba(230, 57, 70, 0.1);
        color: var(--fz-red);
    }

    .bg-blue-light {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .admin-stat-card h3 {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0;
        color: var(--fz-dark);
    }

    .admin-stat-card p {
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
            <h2 class="fw-bold text-dark">Management <span style="color: var(--fz-red);">Portal</span></h2>
            <p class="text-muted">System Overview & Administration</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="dash-sidebar">
                <a href="admin_dashboard.php" class="dash-nav-link active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                <a href="#" class="dash-nav-link"><i class="fa-solid fa-users"></i> Manage Members</a>
                <a href="#" class="dash-nav-link"><i class="fa-solid fa-envelope-open-text"></i> Customer Queries</a>
                <a href="#" class="dash-nav-link"><i class="fa-solid fa-dumbbell"></i> Class Schedule</a>
            </div>
        </div>

        <div class="col-lg-9">

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="admin-stat-card">
                        <div>
                            <p>Total Registered Members</p>
                            <h3><?php echo $total_members; ?></h3>
                        </div>
                        <div class="icon-box bg-blue-light">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="admin-stat-card">
                        <div>
                            <p>Pending Contact Queries</p>
                            <h3><?php echo $total_queries; ?></h3>
                        </div>
                        <div class="icon-box bg-red-light">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-card">
                <h5 class="fw-bold mb-4">Recent Customer Queries</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($recent_queries->num_rows > 0): ?>
                                <?php while ($query = $recent_queries->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo htmlspecialchars($query['name']); ?></td>
                                        <td><?php echo htmlspecialchars($query['subject']); ?></td>
                                        <td class="text-muted small"><?php echo substr(htmlspecialchars($query['message']), 0, 40) . '...'; ?></td>
                                        <td>
                                            <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                                        </td>
                                        <td><button class="btn btn-sm btn-outline-secondary">View</button></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No pending queries found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-card">
                <h5 class="fw-bold mb-4">Newest Members</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Fitness Goal</th>
                                <th>Joined Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($recent_users->num_rows > 0): ?>
                                <?php while ($user = $recent_users->fetch_assoc()): ?>
                                    <tr>
                                        <td>#<?php echo $user['id']; ?></td>
                                        <td class="fw-bold"><?php echo htmlspecialchars($user['fullname']); ?></td>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                        <td><span class="badge bg-light text-dark border"><?php echo ucwords(str_replace('_', ' ', $user['goal'])); ?></span></td>
                                        <td class="text-muted"><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No members registered yet.</td>
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