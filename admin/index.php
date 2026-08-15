<?php
// admin/index.php - Admin Dashboard
$page_title = "Dashboard";
require_once __DIR__ . '/includes/header.php';

try {
    // 1. Total Products
    $totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();

    // 2. Total Orders
    $totalOrders = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();

    // 3. Total Sales (Excluding cancelled)
    $totalSales = $pdo->query("SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE status != 'Cancelled'")->fetchColumn();

    // 4. Total Available Stock
    $totalStock = $pdo->query("SELECT COALESCE(SUM(stock), 0) FROM products")->fetchColumn();

    // 5. Low Stock Count (Stock <= 5)
    $lowStockCount = $pdo->query("SELECT COUNT(*) FROM products WHERE stock <= 5")->fetchColumn();

    // 6. Recent Orders (Top 6)
    $recentOrdersStmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 6");
    $recentOrders = $recentOrdersStmt->fetchAll(PDO::FETCH_ASSOC);

    // 7. Low Stock Products
    $lowStockStmt = $pdo->query("SELECT * FROM products WHERE stock <= 5 ORDER BY stock ASC LIMIT 5");
    $lowStockProducts = $lowStockStmt->fetchAll(PDO::FETCH_ASSOC);

    // 8. Order Status Breakdown
    $statusPending = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Pending'")->fetchColumn();
    $statusProcessing = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Processing'")->fetchColumn();
    $statusCompleted = $pdo->query("SELECT COUNT(*) FROM orders WHERE status IN ('Completed', 'Delivered')")->fetchColumn();
    $statusCancelled = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Cancelled'")->fetchColumn();

    // 9. Category Statistics
    $catStmt = $pdo->query("SELECT category, COUNT(*) as p_count, SUM(stock) as cat_stock FROM products GROUP BY category ORDER BY p_count DESC LIMIT 5");
    $categoryStats = $catStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $dbError = $e->getMessage();
}
?>

<?php require_once __DIR__ . '/includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require_once __DIR__ . '/includes/topbar.php'; ?>

        <div class="container-fluid px-4">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Admin Dashboard</h1>
                    <p class="text-muted fs-7 mb-0">Overview of products, orders, stock inventory and store statistics.</p>
                </div>
                <a href="reports.php" class="btn btn-sm btn-primary shadow-sm rounded-pill px-3">
                    <i class="fas fa-download fa-sm text-white-50 me-1"></i> Generate Full Report
                </a>
            </div>

            <?php if (isset($dbError)): ?>
                <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($dbError); ?></div>
            <?php endif; ?>

            <!-- STATS CARDS ROW (SB Admin 2 Styled Cards) -->
            <div class="row g-3 mb-4">

                <!-- 1. Total Products Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-primary h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Products</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalProducts); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-boxes-stacked fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. Total Orders Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-success h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Orders</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo number_format($totalOrders); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 3. Total Sales / Revenue Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-info h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Sales / Revenue</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">Rs. <?php echo number_format($totalSales, 2); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4. Low Stock / Stock Alert Card -->
                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-warning h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Low Stock Alerts</div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo number_format($lowStockCount); ?> <span class="fs-7 text-muted font-normal">(In Stock: <?php echo number_format($totalStock); ?>)</span></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- SECOND ROW: ORDER STATUS BREAKDOWN & CATEGORY STATS -->
            <div class="row g-3 mb-4">
                
                <!-- Order Status Overview -->
                <div class="col-lg-6">
                    <div class="card card-admin h-100">
                        <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-chart-pie me-2"></i>Order Status Overview</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fs-7 font-weight-bold">Pending Orders</span>
                                    <span class="fs-7 text-muted"><?php echo $statusPending; ?> orders</span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $totalOrders > 0 ? ($statusPending/$totalOrders)*100 : 0; ?>%"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fs-7 font-weight-bold">Processing Orders</span>
                                    <span class="fs-7 text-muted"><?php echo $statusProcessing; ?> orders</span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $totalOrders > 0 ? ($statusProcessing/$totalOrders)*100 : 0; ?>%"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fs-7 font-weight-bold">Completed / Delivered Orders</span>
                                    <span class="fs-7 text-muted"><?php echo $statusCompleted; ?> orders</span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $totalOrders > 0 ? ($statusCompleted/$totalOrders)*100 : 0; ?>%"></div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fs-7 font-weight-bold">Cancelled Orders</span>
                                    <span class="fs-7 text-muted"><?php echo $statusCancelled; ?> orders</span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $totalOrders > 0 ? ($statusCancelled/$totalOrders)*100 : 0; ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Products Warning Table -->
                <div class="col-lg-6">
                    <div class="card card-admin h-100">
                        <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-warning"><i class="fa-solid fa-triangle-exclamation me-2"></i>Low Stock Products (Restock Needed)</h6>
                            <a href="products.php" class="btn btn-sm btn-outline-warning">Manage Products</a>
                        </div>
                        <div class="card-body p-0">
                            <?php if (empty($lowStockProducts)): ?>
                                <div class="p-4 text-center text-muted fs-7">
                                    <i class="fa-solid fa-circle-check text-success fs-3 d-block mb-2"></i> All products have healthy stock levels!
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-admin mb-0">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Remaining Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lowStockProducts as $lp): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img src="<?php echo htmlspecialchars(get_product_image_url($lp['image'])); ?>" class="product-img-thumb" alt="Product" onerror="this.onerror=null; this.src='../CSS-6-May/darazlogo.png';">
                                                            <span class="fw-semibold text-dark text-truncate" style="max-width: 180px;"><?php echo htmlspecialchars($lp['title']); ?></span>
                                                        </div>
                                                    </td>
                                                    <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($lp['category']); ?></span></td>
                                                    <td>Rs. <?php echo number_format($lp['price'], 2); ?></td>
                                                    <td>
                                                        <span class="badge bg-danger font-weight-bold px-2 py-1">Only <?php echo $lp['stock']; ?> left</span>
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

            <!-- THIRD ROW: RECENT ORDERS TABLE -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card card-admin">
                        <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-clock-rotate-left me-2"></i>Recent Customer Orders</h6>
                            <a href="orders.php" class="btn btn-sm btn-primary">View All Orders</a>
                        </div>
                        <div class="card-body p-0">
                            <?php if (empty($recentOrders)): ?>
                                <div class="p-4 text-center text-muted fs-7">
                                    No orders placed yet. Place an order on the Daraz website to test!
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-admin mb-0">
                                        <thead>
                                            <tr>
                                                <th>Order #</th>
                                                <th>Customer</th>
                                                <th>Phone</th>
                                                <th>Payment Method</th>
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recentOrders as $ro): ?>
                                                <?php
                                                    $statusClass = 'badge-pending';
                                                    if ($ro['status'] === 'Processing') $statusClass = 'badge-processing';
                                                    if ($ro['status'] === 'Shipped') $statusClass = 'badge-shipped';
                                                    if ($ro['status'] === 'Completed' || $ro['status'] === 'Delivered') $statusClass = 'badge-completed';
                                                    if ($ro['status'] === 'Cancelled') $statusClass = 'badge-cancelled';
                                                ?>
                                                <tr>
                                                    <td class="font-weight-bold text-primary"><?php echo htmlspecialchars($ro['order_number']); ?></td>
                                                    <td>
                                                        <span class="fw-bold text-dark d-block"><?php echo htmlspecialchars($ro['full_name']); ?></span>
                                                        <span class="fs-9 text-muted"><?php echo htmlspecialchars($ro['city'] ?? 'Karachi'); ?></span>
                                                    </td>
                                                    <td><?php echo htmlspecialchars($ro['phone']); ?></td>
                                                    <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($ro['payment_method']); ?></span></td>
                                                    <td class="fw-bold text-dark">Rs. <?php echo number_format($ro['total_amount'], 2); ?></td>
                                                    <td><span class="badge-status <?php echo $statusClass; ?>"><?php echo htmlspecialchars($ro['status']); ?></span></td>
                                                    <td><?php echo date('M d, Y h:i A', strtotime($ro['created_at'])); ?></td>
                                                    <td>
                                                        <a href="orders.php?view=<?php echo $ro['id']; ?>" class="btn btn-sm btn-outline-primary py-1 px-2 fs-7">
                                                            <i class="fa-solid fa-eye me-1"></i> Details
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

        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
