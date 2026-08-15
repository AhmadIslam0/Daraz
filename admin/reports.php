<?php
// admin/reports.php - Reports & Inventory Analytics
$page_title = "Analytics & Reports";
require_once __DIR__ . '/includes/header.php';

try {
    // 1. Total Inventory Valuation
    $totalInventoryValue = $pdo->query("SELECT COALESCE(SUM(price * stock), 0) FROM products")->fetchColumn();

    // 2. Total Product & Category Counts
    $totalProducts = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    $totalCategories = $pdo->query("SELECT COUNT(DISTINCT category) FROM products")->fetchColumn();

    // 3. Sales & Revenue Metrics
    $totalRevenue = $pdo->query("SELECT COALESCE(SUM(total_amount), 0) FROM orders WHERE status != 'Cancelled'")->fetchColumn();
    $totalCompletedOrders = $pdo->query("SELECT COUNT(*) FROM orders WHERE status IN ('Completed', 'Delivered')")->fetchColumn();
    $avgOrderValue = $totalCompletedOrders > 0 ? ($totalRevenue / $totalCompletedOrders) : 0;

    // 4. Category Breakdown Report
    $catReportStmt = $pdo->query("
        SELECT 
            category, 
            COUNT(*) as product_count, 
            COALESCE(SUM(stock), 0) as total_stock,
            COALESCE(AVG(price), 0) as avg_price,
            COALESCE(SUM(price * stock), 0) as total_value
        FROM products 
        GROUP BY category 
        ORDER BY total_value DESC
    ");
    $categoryReports = $catReportStmt->fetchAll(PDO::FETCH_ASSOC);

    // 5. Low Stock Health Report
    $lowStockStmt = $pdo->query("SELECT * FROM products WHERE stock <= 10 ORDER BY stock ASC");
    $lowStockItems = $lowStockStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $dbError = $e->getMessage();
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
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Inventory & Sales Reports</h1>
                    <p class="text-muted fs-7 mb-0">Detailed breakdown of product inventory valuation, category health, and order analytics.</p>
                </div>
                <button type="button" class="btn btn-primary shadow-sm rounded-pill px-3" onclick="window.print()">
                    <i class="fas fa-print me-1"></i> Print / Export Report
                </button>
            </div>

            <?php if (isset($dbError)): ?>
                <div class="alert alert-danger mb-4"><?php echo htmlspecialchars($dbError); ?></div>
            <?php endif; ?>

            <!-- OVERVIEW METRIC CARDS -->
            <div class="row g-3 mb-4">

                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-primary h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Inventory Asset Value</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">Rs. <?php echo number_format($totalInventoryValue, 2); ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-success h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Revenue Earned</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">Rs. <?php echo number_format($totalRevenue, 2); ?></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-info h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Products / Categories</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800"><?php echo $totalProducts; ?> <span class="fs-7 text-muted font-normal">(<?php echo $totalCategories; ?> Categories)</span></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card card-admin border-left-warning h-100 py-2">
                        <div class="card-body">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Average Order Value</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">Rs. <?php echo number_format($avgOrderValue, 2); ?></div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CATEGORY ANALYSIS TABLE -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card card-admin">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-layer-group me-2"></i>Inventory Breakdown by Category</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-admin mb-0">
                                    <thead>
                                        <tr>
                                            <th>Category Name</th>
                                            <th>Product Count</th>
                                            <th>Total Inventory Stock</th>
                                            <th>Avg. Product Price</th>
                                            <th>Category Valuation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categoryReports as $cr): ?>
                                            <tr>
                                                <td class="fw-bold text-dark"><?php echo htmlspecialchars($cr['category']); ?></td>
                                                <td><span class="badge bg-light text-dark border"><?php echo $cr['product_count']; ?> products</span></td>
                                                <td class="fw-semibold"><?php echo number_format($cr['total_stock']); ?> units</td>
                                                <td>Rs. <?php echo number_format($cr['avg_price'], 2); ?></td>
                                                <td class="fw-bold text-primary">Rs. <?php echo number_format($cr['total_value'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- LOW STOCK & REORDER SUGGESTIONS TABLE -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card card-admin">
                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-danger"><i class="fa-solid fa-truck-ramp-box me-2"></i>Inventory Health & Low Stock Alert Report</h6>
                            <a href="products.php" class="btn btn-sm btn-outline-danger">Update Stock</a>
                        </div>
                        <div class="card-body p-0">
                            <?php if (empty($lowStockItems)): ?>
                                <div class="p-4 text-center text-muted fs-7">
                                    All inventory stock levels are healthy!
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-admin mb-0">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Unit Price</th>
                                                <th>Current Stock</th>
                                                <th>Stock Status / Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($lowStockItems as $lsi): ?>
                                                <tr>
                                                    <td><code><?php echo htmlspecialchars($lsi['product_code']); ?></code></td>
                                                    <td class="fw-bold text-dark"><?php echo htmlspecialchars($lsi['title']); ?></td>
                                                    <td><span class="badge bg-light text-dark border"><?php echo htmlspecialchars($lsi['category']); ?></span></td>
                                                    <td>Rs. <?php echo number_format($lsi['price'], 2); ?></td>
                                                    <td>
                                                        <span class="fw-bold text-danger"><?php echo $lsi['stock']; ?> units</span>
                                                    </td>
                                                    <td>
                                                        <?php if ($lsi['stock'] <= 0): ?>
                                                            <span class="badge bg-danger">CRITICAL: Out of Stock</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-warning text-dark">WARNING: Low Stock</span>
                                                        <?php endif; ?>
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
