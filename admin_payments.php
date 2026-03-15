<?php
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php';


$payments_query = $conn->query("
    SELECT p.id, p.amount, p.transaction_type, p.created_at, u.fullname, u.email 
    FROM payments p 
    JOIN users u ON p.user_id = u.id 
    ORDER BY p.created_at DESC
");


$total_revenue_query = $conn->query("SELECT SUM(amount) as total FROM payments");
$real_revenue = $total_revenue_query->fetch_assoc()['total'];
$real_revenue = $real_revenue ? $real_revenue : 0;
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

    .revenue-box {
        background: rgba(245, 158, 11, 0.1);
        border: 2px solid #f59e0b;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 25px;
    }

    .revenue-box h3 {
        color: #f59e0b;
        font-weight: 800;
        margin: 0;
        font-size: 2rem;
    }

    .revenue-box p {
        color: var(--fz-dark);
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
</style>

<div class="container dashboard-wrapper">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold text-dark">Payment <span style="color: var(--fz-blue);">Ledger</span></h2>
            <p class="text-muted">Track all revenue and transaction histories.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="dash-sidebar">
                <a href="admin_dashboard.php" class="dash-nav-link"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                <a href="admin_members.php" class="dash-nav-link"><i class="fa-solid fa-users"></i> Manage Members</a>
                <a href="admin_queries.php" class="dash-nav-link"><i class="fa-solid fa-envelope-open-text"></i> Customer Queries</a>
                <a href="admin_schedule.php" class="dash-nav-link"><i class="fa-solid fa-dumbbell"></i> Class Schedule</a>
                <a href="admin_payments.php" class="dash-nav-link active"><i class="fa-solid fa-credit-card"></i> Payment Ledger</a>
                <a href="logout.php" class="dash-nav-link logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <div class="col-lg-9">

            <div class="revenue-box">
                <p>Total Processed Revenue</p>
                <h3>LKR <?php echo number_format($real_revenue); ?></h3>
            </div>

            <div class="table-card">
                <h5 class="fw-bold mb-4"><i class="fa-solid fa-receipt me-2 text-primary"></i> Transaction History</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Receipt ID</th>
                                <th>Customer</th>
                                <th>Description</th>
                                <th>Amount</th>
                                <th>Date & Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($payments_query->num_rows > 0): ?>
                                <?php while ($row = $payments_query->fetch_assoc()): ?>
                                    <tr>
                                        <td class="text-muted fw-bold">#TXN-<?php echo str_pad($row['id'], 5, '0', STR_PAD_LEFT); ?></td>

                                        <td class="fw-bold text-dark">
                                            <?php echo htmlspecialchars($row['fullname']); ?><br>
                                            <span class="text-muted small fw-normal"><?php echo htmlspecialchars($row['email']); ?></span>
                                        </td>

                                        <td class="text-primary fw-bold">
                                            <?php echo htmlspecialchars($row['transaction_type']); ?>
                                        </td>

                                        <td class="fw-bold text-success">
                                            LKR <?php echo number_format($row['amount']); ?>
                                        </td>

                                        <td class="text-muted small">
                                            <i class="fa-regular fa-calendar me-1"></i> <?php echo date('M d, Y', strtotime($row['created_at'])); ?><br>
                                            <i class="fa-regular fa-clock me-1"></i> <?php echo date('h:i A', strtotime($row['created_at'])); ?>
                                        </td>

                                        <td>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-1">Paid</span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-file-invoice-dollar fs-2 mb-3 d-block opacity-50"></i>
                                        No transactions have been processed yet.
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