<?php
// admin/orders.php - Order Management & Status Workflow
$page_title = "Orders Management";
require_once __DIR__ . '/includes/header.php';

$success_msg = '';
$error_msg = '';

// Handle Status Update Post
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $orderId = intval($_POST['order_id'] ?? 0);
    $newStatus = trim($_POST['status'] ?? '');

    $allowedStatuses = ['Pending', 'Processing', 'Shipped', 'Delivered', 'Cancelled'];

    if ($orderId > 0 && in_array($newStatus, $allowedStatuses)) {
        try {
            $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
            $stmt->execute([$newStatus, $orderId]);
            $success_msg = "Order status updated to '$newStatus' successfully!";
        } catch (PDOException $e) {
            $error_msg = "Database Error: " . $e->getMessage();
        }
    } else {
        $error_msg = "Invalid status selected.";
    }
}

// Fetch orders with optional status filter
$statusFilter = trim($_GET['status'] ?? '');
$searchFilter = trim($_GET['search'] ?? '');

$sql = "SELECT * FROM orders WHERE 1=1";
$params = [];

if (!empty($statusFilter)) {
    $sql .= " AND status = ?";
    $params[] = $statusFilter;
}

if (!empty($searchFilter)) {
    $sql .= " AND (order_number LIKE ? OR full_name LIKE ? OR phone LIKE ? OR email LIKE ?)";
    $searchTerm = "%$searchFilter%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
}

$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

// If single order detail requested via GET
$viewOrder = null;
$viewOrderItems = [];
if (isset($_GET['view'])) {
    $viewId = intval($_GET['view']);
    $oStmt = $pdo->prepare("SELECT * FROM orders WHERE id = ? LIMIT 1");
    $oStmt->execute([$viewId]);
    $viewOrder = $oStmt->fetch(PDO::FETCH_ASSOC);

    if ($viewOrder) {
        $itemsStmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $itemsStmt->execute([$viewId]);
        $viewOrderItems = $itemsStmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<?php require_once __DIR__ . '/includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require_once __DIR__ . '/includes/topbar.php'; ?>

        <div class="container-fluid px-4">

            <!-- Page Title -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Orders Management</h1>
                    <p class="text-muted fs-7 mb-0">Monitor customer orders, view items purchased, and update order statuses.</p>
                </div>
            </div>

            <!-- Alerts -->
            <?php if (!empty($success_msg)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i><?php echo htmlspecialchars($success_msg); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_msg)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-exclamation me-2"></i><?php echo htmlspecialchars($error_msg); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <!-- Search & Status Filter -->
            <div class="card card-admin mb-4">
                <div class="card-body">
                    <form method="GET" action="orders.php" class="row g-3">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input type="text" name="search" class="form-control bg-light border-start-0 fs-7" placeholder="Search by Order #, Customer Name, Phone..." value="<?php echo htmlspecialchars($searchFilter); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select fs-7" onchange="this.form.submit()">
                                <option value="">All Order Statuses</option>
                                <option value="Pending" <?php echo ($statusFilter === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Processing" <?php echo ($statusFilter === 'Processing') ? 'selected' : ''; ?>>Processing</option>
                                <option value="Shipped" <?php echo ($statusFilter === 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
                                <option value="Delivered" <?php echo ($statusFilter === 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                                <option value="Cancelled" <?php echo ($statusFilter === 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100 fs-7">Filter Orders</button>
                            <?php if (!empty($statusFilter) || !empty($searchFilter)): ?>
                                <a href="orders.php" class="btn btn-light border fs-7" title="Clear Filters"><i class="fa-solid fa-xmark"></i></a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Orders List Table -->
            <div class="card card-admin">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">All Customer Orders (<?php echo count($orders); ?> Orders)</h6>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($orders)): ?>
                        <div class="p-5 text-center text-muted fs-7">
                            <i class="fa-solid fa-box-open fs-1 text-muted d-block mb-3"></i>
                            No orders found matching your search.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-admin mb-0">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Customer Details</th>
                                        <th>Address & City</th>
                                        <th>Payment</th>
                                        <th>Total Amount</th>
                                        <th>Current Status</th>
                                        <th>Date & Time</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $o): ?>
                                        <?php
                                            $statusBadge = 'badge-pending';
                                            if ($o['status'] === 'Processing') $statusBadge = 'badge-processing';
                                            if ($o['status'] === 'Shipped') $statusBadge = 'badge-shipped';
                                            if ($o['status'] === 'Completed' || $o['status'] === 'Delivered') $statusBadge = 'badge-completed';
                                            if ($o['status'] === 'Cancelled') $statusBadge = 'badge-cancelled';
                                        ?>
                                        <tr>
                                            <td class="fw-bold text-primary"><?php echo htmlspecialchars($o['order_number']); ?></td>
                                            <td>
                                                <strong class="text-dark d-block"><?php echo htmlspecialchars($o['full_name']); ?></strong>
                                                <span class="fs-9 text-muted d-block"><i class="fa-solid fa-phone me-1"></i><?php echo htmlspecialchars($o['phone']); ?></span>
                                            </td>
                                            <td>
                                                <span class="fs-7 text-dark d-block text-truncate" style="max-width: 200px;"><?php echo htmlspecialchars($o['address']); ?></span>
                                                <span class="badge bg-light text-dark border fs-9"><?php echo htmlspecialchars($o['city'] ?? 'Karachi'); ?></span>
                                            </td>
                                            <td><span class="badge bg-light text-dark border fs-9"><?php echo htmlspecialchars($o['payment_method']); ?></span></td>
                                            <td class="fw-bold text-dark">Rs. <?php echo number_format($o['total_amount'], 2); ?></td>
                                            <td>
                                                <!-- Quick Inline Status Update Form -->
                                                <form method="POST" action="orders.php" class="d-inline">
                                                    <input type="hidden" name="action" value="update_status">
                                                    <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                                                    <select name="status" class="form-select form-select-sm fs-9 font-weight-bold" onchange="this.form.submit()" style="width: 120px;">
                                                        <option value="Pending" <?php echo ($o['status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="Processing" <?php echo ($o['status'] === 'Processing') ? 'selected' : ''; ?>>Processing</option>
                                                        <option value="Shipped" <?php echo ($o['status'] === 'Shipped') ? 'selected' : ''; ?>>Shipped</option>
                                                        <option value="Delivered" <?php echo ($o['status'] === 'Delivered') ? 'selected' : ''; ?>>Delivered</option>
                                                        <option value="Cancelled" <?php echo ($o['status'] === 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td><?php echo date('M d, Y h:i A', strtotime($o['created_at'])); ?></td>
                                            <td class="text-center">
                                                <a href="orders.php?view=<?php echo $o['id']; ?>" class="btn btn-sm btn-outline-primary fs-7">
                                                    <i class="fa-solid fa-file-invoice me-1"></i> View Order
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <!-- ORDER DETAILS MODAL (IF TRIGGERED VIA GET) -->
    <?php if ($viewOrder): ?>
        <div class="modal fade show d-block" id="viewOrderModal" tabindex="-1" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-receipt me-2"></i>Order Invoice #<?php echo htmlspecialchars($viewOrder['order_number']); ?></h5>
                        <a href="orders.php" class="btn-close btn-close-white"></a>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border">
                                    <h6 class="fw-bold text-primary mb-2"><i class="fa-solid fa-user me-1"></i> Customer Info</h6>
                                    <div><strong>Name:</strong> <?php echo htmlspecialchars($viewOrder['full_name']); ?></div>
                                    <div><strong>Phone:</strong> <?php echo htmlspecialchars($viewOrder['phone']); ?></div>
                                    <div><strong>Email:</strong> <?php echo htmlspecialchars($viewOrder['email'] ?? 'N/A'); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded border">
                                    <h6 class="fw-bold text-primary mb-2"><i class="fa-solid fa-truck-fast me-1"></i> Delivery Details</h6>
                                    <div><strong>Address:</strong> <?php echo htmlspecialchars($viewOrder['address']); ?></div>
                                    <div><strong>City/Province:</strong> <?php echo htmlspecialchars($viewOrder['city'] ?? 'Karachi'); ?>, <?php echo htmlspecialchars($viewOrder['province'] ?? 'Sindh'); ?></div>
                                    <div><strong>Payment Method:</strong> <span class="badge bg-secondary"><?php echo htmlspecialchars($viewOrder['payment_method']); ?></span></div>
                                </div>
                            </div>
                        </div>

                        <h6 class="fw-bold text-dark mb-2">Purchased Order Items:</h6>
                        <div class="table-responsive mb-3 border rounded">
                            <table class="table table-bordered mb-0 fs-7">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product Title</th>
                                        <th>Unit Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($viewOrderItems as $item): ?>
                                        <tr>
                                            <td class="fw-semibold"><?php echo htmlspecialchars($item['product_title']); ?></td>
                                            <td>Rs. <?php echo number_format($item['product_price'], 2); ?></td>
                                            <td><?php echo $item['quantity']; ?></td>
                                            <td class="fw-bold">Rs. <?php echo number_format($item['total_price'], 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-5">
                                <div class="bg-light p-3 rounded border">
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Subtotal:</span>
                                        <span>Rs. <?php echo number_format($viewOrder['total_amount'] - $viewOrder['delivery_fee'] - $viewOrder['platform_fee'], 2); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <span>Delivery Fee:</span>
                                        <span>Rs. <?php echo number_format($viewOrder['delivery_fee'], 2); ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Platform Fee:</span>
                                        <span>Rs. <?php echo number_format($viewOrder['platform_fee'], 2); ?></span>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex justify-content-between fw-bold text-dark fs-6">
                                        <span>Grand Total:</span>
                                        <span class="text-primary">Rs. <?php echo number_format($viewOrder['total_amount'], 2); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" onclick="window.print()"><i class="fa-solid fa-print me-1"></i> Print Invoice</button>
                        <a href="orders.php" class="btn btn-primary">Close</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
