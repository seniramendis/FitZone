<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php';

// Mark Query as Resolved
if (isset($_GET['resolve_id'])) {
    $resolve_id = $conn->real_escape_string($_GET['resolve_id']);
    $conn->query("UPDATE queries SET status = 'Resolved' WHERE id = '$resolve_id'");
    header("Location: admin_queries.php?success=resolved");
    exit();
}

// Delete Query
if (isset($_GET['delete_id'])) {
    $delete_id = $conn->real_escape_string($_GET['delete_id']);
    $conn->query("DELETE FROM queries WHERE id = '$delete_id'");
    header("Location: admin_queries.php?success=deleted");
    exit();
}

// Fetch all queries
$queries_result = $conn->query("SELECT * FROM queries ORDER BY id DESC");
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
</style>

<div class="container dashboard-wrapper">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Customer <span style="color: var(--fz-blue);">Queries</span></h2>
            <p class="text-muted">Respond to messages sent from the Contact Us page.</p>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> Query successfully updated!
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
                <a href="admin_queries.php" class="dash-nav-link active"><i class="fa-solid fa-envelope-open-text"></i> Customer Queries</a>
                <a href="admin_dashboard.php" class="dash-nav-link"><i class="fa-solid fa-dumbbell"></i> Class Schedule</a>
                <a href="logout.php" class="dash-nav-link logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="table-card">
                <h5 class="fw-bold mb-4">Inbox</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Name / Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($queries_result->num_rows > 0): ?>
                                <?php while ($query = $queries_result->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold text-dark">
                                            <?php echo htmlspecialchars($query['name']); ?><br>
                                            <a href="mailto:<?php echo htmlspecialchars($query['email']); ?>" class="text-primary small fw-normal"><?php echo htmlspecialchars($query['email']); ?></a>
                                        </td>
                                        <td class="fw-bold text-secondary"><?php echo htmlspecialchars($query['subject']); ?></td>
                                        <td class="text-muted small" style="max-width: 250px;"><?php echo htmlspecialchars($query['message']); ?></td>
                                        <td>
                                            <?php if (empty($query['status']) || $query['status'] == 'pending'): ?>
                                                <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                                            <?php else: ?>
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-1">Resolved</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <?php if (empty($query['status']) || $query['status'] == 'pending'): ?>
                                                    <a href="admin_queries.php?resolve_id=<?php echo $query['id']; ?>" class="btn btn-sm btn-success rounded-pill px-3">Resolve</a>
                                                <?php endif; ?>
                                                <a href="admin_queries.php?delete_id=<?php echo $query['id']; ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Delete this query?');"><i class="fa-solid fa-trash-can"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">No customer queries found.</td>
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