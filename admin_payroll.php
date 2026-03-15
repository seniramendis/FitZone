<?php
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'header.php';
require 'db_config.php';


$payroll_query = $conn->query("
    SELECT trainer_name, 
           COUNT(id) AS classes_taught, 
           (COUNT(id) * 2000) AS total_owed 
    FROM bookings 
    WHERE status = 'Confirmed' 
    GROUP BY trainer_name 
    ORDER BY total_owed DESC
");


$total_payout_query = $conn->query("SELECT (COUNT(id) * 2000) AS master_total FROM bookings WHERE status = 'Confirmed'");
$master_total = $total_payout_query->fetch_assoc()['master_total'];
$master_total = $master_total ? $master_total : 0;
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

    .payout-box {
        background: rgba(220, 53, 69, 0.05);
        border: 2px solid var(--fz-red);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 25px;
    }

    .payout-box h3 {
        color: var(--fz-red);
        font-weight: 800;
        margin: 0;
        font-size: 2rem;
    }

    .payout-box p {
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
            <h2 class="fw-bold text-dark">Staff <span style="color: var(--fz-blue);">Payroll</span></h2>
            <p class="text-muted">Manage commissions and earnings for your trainers.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="dash-sidebar">
                <a href="admin_dashboard.php" class="dash-nav-link"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                <a href="admin_members.php" class="dash-nav-link"><i class="fa-solid fa-users"></i> Manage Members</a>
                <a href="admin_queries.php" class="dash-nav-link"><i class="fa-solid fa-envelope-open-text"></i> Customer Queries</a>
                <a href="admin_schedule.php" class="dash-nav-link"><i class="fa-solid fa-dumbbell"></i> Class Schedule</a>
                <a href="admin_payments.php" class="dash-nav-link"><i class="fa-solid fa-credit-card"></i> Payment Ledger</a>
                <a href="admin_payroll.php" class="dash-nav-link active"><i class="fa-solid fa-file-invoice-dollar"></i> Trainer Payroll</a>
                <a href="logout.php" class="dash-nav-link logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </div>

        <div class="col-lg-9">

            <div class="payout-box">
                <p>Total Outstanding Payroll</p>
                <h3>LKR <?php echo number_format($master_total); ?></h3>
            </div>

            <div class="table-card">
                <h5 class="fw-bold mb-4"><i class="fa-solid fa-users-gear me-2 text-primary"></i> Earnings by Trainer</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Instructor Name</th>
                                <th>Confirmed Classes Taught</th>
                                <th>Rate Per Class</th>
                                <th>Total Owed</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($payroll_query->num_rows > 0): ?>
                                <?php while ($row = $payroll_query->fetch_assoc()): ?>
                                    <tr>
                                        <td class="fw-bold text-dark">
                                            <i class="fa-solid fa-user-ninja text-muted me-2"></i><?php echo htmlspecialchars($row['trainer_name']); ?>
                                        </td>

                                        <td class="text-muted fw-bold">
                                            <?php echo $row['classes_taught']; ?> Classes
                                        </td>

                                        <td class="text-muted small">
                                            LKR 2,000
                                        </td>

                                        <td class="fw-bold text-danger fs-5">
                                            LKR <?php echo number_format($row['total_owed']); ?>
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm" onclick="alert('In a live production environment, this would transfer funds to the instructor\'s bank account!');">
                                                <i class="fa-solid fa-money-bill-transfer me-1"></i> Pay Now
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-bed fs-2 mb-3 d-block opacity-50"></i>
                                        No trainers have confirmed classes yet.
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