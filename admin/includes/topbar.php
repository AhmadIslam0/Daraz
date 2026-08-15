<?php
// admin/includes/topbar.php - Admin Panel Top Navbar
$admin_name = isset($_SESSION['admin_name']) ? $_SESSION['admin_name'] : 'Admin';
$admin_email = isset($_SESSION['admin_email']) ? $_SESSION['admin_email'] : 'admin@daraz.pk';
?>
<nav class="topbar mb-4">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link text-dark me-3 d-md-none">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Title -->
    <div class="d-none d-sm-inline-block">
        <h5 class="mb-0 fw-bold text-dark fs-6"><i class="fa-solid fa-gauge text-primary me-2"></i>E-Commerce Admin System</h5>
    </div>

    <!-- Topbar Navbar Right -->
    <ul class="navbar-nav ms-auto flex-row align-items-center gap-3">

        <li class="nav-item">
            <a href="../index.php" target="_blank" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                <i class="fa-solid fa-globe me-1"></i> Visit Daraz Store
            </a>
        </li>

        <div class="topbar-divider d-none d-sm-block border-end h-50 mx-2"></div>

        <!-- User Information -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-decoration-none" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="text-end d-none d-lg-block">
                    <span class="d-block fw-bold text-dark fs-7"><?php echo htmlspecialchars($admin_name); ?></span>
                    <span class="d-block text-muted fs-9">Super Admin</span>
                </div>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 38px; height: 38px;">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
            </a>
            <!-- Dropdown - User Information -->
            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in border-0" aria-labelledby="userDropdown">
                <li class="dropdown-header">
                    <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($admin_name); ?></h6>
                    <small class="text-muted"><?php echo htmlspecialchars($admin_email); ?></small>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item fs-7" href="index.php">
                        <i class="fas fa-tachometer-alt fa-sm fa-fw me-2 text-gray-400"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a class="dropdown-item fs-7" href="products.php">
                        <i class="fas fa-box fa-sm fa-fw me-2 text-gray-400"></i> Products
                    </a>
                </li>
                <li>
                    <a class="dropdown-item fs-7" href="orders.php">
                        <i class="fas fa-shopping-bag fa-sm fa-fw me-2 text-gray-400"></i> Orders
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item fs-7 text-danger" href="logout.php">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-danger"></i> Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
