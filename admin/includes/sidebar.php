<?php
// admin/includes/sidebar.php - Admin Panel Sidebar Navigation (SB Admin 2)
$current_page = basename($_SERVER['PHP_SELF']);
?>
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="index.php">
        <div class="sidebar-brand-icon">
            <i class="fa-solid fa-store text-warning"></i>
        </div>
        <div class="sidebar-brand-text mx-2">DARAZ <sup>ADMIN</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Management</div>

    <!-- Nav Item - Products -->
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_page == 'products.php') ? 'active' : ''; ?>" href="products.php">
            <i class="fas fa-fw fa-boxes-stacked"></i>
            <span>Products</span>
        </a>
    </li>

    <!-- Nav Item - Orders -->
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_page == 'orders.php') ? 'active' : ''; ?>" href="orders.php">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Analytics</div>

    <!-- Nav Item - Reports -->
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>" href="reports.php">
            <i class="fas fa-fw fa-chart-line"></i>
            <span>Reports</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">Website & Account</div>

    <!-- Link to View Customer Website -->
    <li class="nav-item">
        <a class="nav-link" href="../index.php" target="_blank">
            <i class="fas fa-fw fa-external-link-alt text-info"></i>
            <span>View User Website</span>
        </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link text-danger" href="logout.php" onclick="return confirm('Are you sure you want to log out from Admin Panel?');">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

</ul>
