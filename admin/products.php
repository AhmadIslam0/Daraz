<?php
// admin/products.php - Complete Product CRUD & Stock Management
$page_title = "Products Management";
require_once __DIR__ . '/includes/header.php';

$success_msg = '';
$error_msg = '';

// Handle Actions (Create, Update, Delete, Stock Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add_product') {
        $title = trim($_POST['title'] ?? '');
        $code = trim($_POST['product_code'] ?? '');
        $brand = trim($_POST['brand'] ?? 'Daraz');
        $category = trim($_POST['category'] ?? 'General');
        $price = floatval($_POST['price'] ?? 0);
        $oldPrice = !empty($_POST['old_price']) ? floatval($_POST['old_price']) : NULL;
        $discount = trim($_POST['discount'] ?? '');
        $stock = intval($_POST['stock'] ?? 10);
        $description = trim($_POST['description'] ?? '');
        $isFlashSale = isset($_POST['is_flash_sale']) ? 1 : 0;
        $isJustForYou = isset($_POST['is_just_for_you']) ? 1 : 1;
        $imageUrl = trim($_POST['image_url'] ?? '');

        // Handle Image File Upload if provided
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image_file']['tmp_name'];
            $fileName = $_FILES['image_file']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            
            $uploadFileDir = __DIR__ . '/../CSS-6-May/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imageUrl = './' . $newFileName;
            }
        }

        if (empty($imageUrl)) {
            $imageUrl = './darazlogo.png';
        }

        if (empty($code)) {
            $code = 'prod-' . time() . '-' . rand(100, 999);
        }

        if (empty($title) || $price <= 0) {
            $error_msg = "Product Title and a valid Price are required.";
        } else {
            try {
                $stmt = $pdo->prepare("
                    INSERT INTO products (
                        product_code, title, brand, category, price, old_price, discount, stock, image, description, is_flash_sale, is_just_for_you
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([
                    $code, $title, $brand, $category, $price, $oldPrice, $discount, $stock, $imageUrl, $description, $isFlashSale, $isJustForYou
                ]);
                $success_msg = "Product '$title' added successfully! Changes are live on the Daraz website.";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    }

    elseif ($action === 'edit_product') {
        $id = intval($_POST['product_id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $code = trim($_POST['product_code'] ?? '');
        $brand = trim($_POST['brand'] ?? 'Daraz');
        $category = trim($_POST['category'] ?? 'General');
        $price = floatval($_POST['price'] ?? 0);
        $oldPrice = !empty($_POST['old_price']) ? floatval($_POST['old_price']) : NULL;
        $discount = trim($_POST['discount'] ?? '');
        $stock = intval($_POST['stock'] ?? 0);
        $description = trim($_POST['description'] ?? '');
        $isFlashSale = isset($_POST['is_flash_sale']) ? 1 : 0;
        $isJustForYou = isset($_POST['is_just_for_you']) ? 1 : 0;
        $imageUrl = trim($_POST['image_url'] ?? '');

        // Handle Image Upload if new file uploaded
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['image_file']['tmp_name'];
            $fileName = $_FILES['image_file']['name'];
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            
            $uploadFileDir = __DIR__ . '/../CSS-6-May/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $imageUrl = './' . $newFileName;
            }
        }

        if ($id <= 0 || empty($title) || $price <= 0) {
            $error_msg = "Invalid product details for update.";
        } else {
            try {
                $sql = "UPDATE products SET title = ?, product_code = ?, brand = ?, category = ?, price = ?, old_price = ?, discount = ?, stock = ?, description = ?, is_flash_sale = ?, is_just_for_you = ?";
                $params = [$title, $code, $brand, $category, $price, $oldPrice, $discount, $stock, $description, $isFlashSale, $isJustForYou];

                if (!empty($imageUrl)) {
                    $sql .= ", image = ?";
                    $params[] = $imageUrl;
                }

                $sql .= " WHERE id = ?";
                $params[] = $id;

                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);

                $success_msg = "Product updated successfully!";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    }

    elseif ($action === 'delete_product') {
        $id = intval($_POST['product_id'] ?? 0);
        if ($id > 0) {
            try {
                $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
                $stmt->execute([$id]);
                $success_msg = "Product deleted successfully from database!";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    }

    elseif ($action === 'update_stock') {
        $id = intval($_POST['product_id'] ?? 0);
        $newStock = intval($_POST['new_stock'] ?? 0);
        if ($id > 0 && $newStock >= 0) {
            try {
                $stmt = $pdo->prepare("UPDATE products SET stock = ? WHERE id = ?");
                $stmt->execute([$newStock, $id]);
                $success_msg = "Stock quantity updated successfully!";
            } catch (PDOException $e) {
                $error_msg = "Database Error: " . $e->getMessage();
            }
        }
    }
}

// Fetch all products with filter & search
$searchQuery = trim($_GET['search'] ?? '');
$categoryFilter = trim($_GET['category'] ?? '');

$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($searchQuery)) {
    $sql .= " AND (title LIKE ? OR product_code LIKE ? OR brand LIKE ?)";
    $searchTerm = "%$searchQuery%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
    $params[] = $searchTerm;
}

if (!empty($categoryFilter)) {
    $sql .= " AND category = ?";
    $params[] = $categoryFilter;
}

$sql .= " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get distinct categories for filter dropdown
$categoriesStmt = $pdo->query("SELECT DISTINCT category FROM products ORDER BY category ASC");
$categories = $categoriesStmt->fetchAll(PDO::FETCH_COLUMN);
?>

<?php require_once __DIR__ . '/includes/sidebar.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <?php require_once __DIR__ . '/includes/topbar.php'; ?>

        <div class="container-fluid px-4">

            <!-- Header Title -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h1 class="h3 mb-0 text-gray-800 fw-bold">Products Management</h1>
                    <p class="text-muted fs-7 mb-0">Create, view, update, delete, and manage product inventory & stock.</p>
                </div>
                <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fa-solid fa-plus me-1"></i> Add New Product
                </button>
            </div>

            <!-- Flash Alerts -->
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

            <!-- Search & Filter Card -->
            <div class="card card-admin mb-4">
                <div class="card-body">
                    <form method="GET" action="products.php" class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input type="text" name="search" class="form-control bg-light border-start-0 fs-7" placeholder="Search by title, code or brand..." value="<?php echo htmlspecialchars($searchQuery); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="category" class="form-select fs-7" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo htmlspecialchars($cat); ?>" <?php echo ($categoryFilter === $cat) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($cat); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100 fs-7">Search</button>
                            <?php if (!empty($searchQuery) || !empty($categoryFilter)): ?>
                                <a href="products.php" class="btn btn-light border fs-7" title="Clear Filters"><i class="fa-solid fa-xmark"></i></a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Products Table Card -->
            <div class="card card-admin">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">All Products List (<?php echo count($products); ?> Products)</h6>
                </div>
                <div class="card-body p-0">
                    <?php if (empty($products)): ?>
                        <div class="p-5 text-center text-muted fs-7">
                            <i class="fa-solid fa-box-open fs-1 text-muted d-block mb-3"></i>
                            No products found matching your search criteria.
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-admin mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Title / Code</th>
                                        <th>Brand & Category</th>
                                        <th>Price</th>
                                        <th>Stock Status</th>
                                        <th>Flash Sale</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $p): ?>
                                        <tr>
                                            <td class="fw-bold">#<?php echo $p['id']; ?></td>
                                            <td>
                                                <img src="<?php echo htmlspecialchars(get_product_image_url($p['image'])); ?>" class="product-img-thumb" alt="<?php echo htmlspecialchars($p['title']); ?>" onerror="this.onerror=null; this.src='../CSS-6-May/darazlogo.png';">
                                            </td>
                                            <td>
                                                <strong class="text-dark d-block text-truncate" style="max-width: 260px;"><?php echo htmlspecialchars($p['title']); ?></strong>
                                                <code class="fs-9 text-muted"><?php echo htmlspecialchars($p['product_code']); ?></code>
                                            </td>
                                            <td>
                                                <span class="fw-semibold text-dark d-block"><?php echo htmlspecialchars($p['brand']); ?></span>
                                                <span class="badge bg-light text-dark border fs-9"><?php echo htmlspecialchars($p['category']); ?></span>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-primary">Rs. <?php echo number_format($p['price'], 2); ?></div>
                                                <?php if ($p['old_price']): ?>
                                                    <small class="text-decoration-line-through text-muted me-1">Rs. <?php echo number_format($p['old_price'], 2); ?></small>
                                                    <span class="badge bg-danger fs-9"><?php echo htmlspecialchars($p['discount']); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($p['stock'] <= 0): ?>
                                                    <span class="badge bg-danger px-2 py-1">Out of Stock (0)</span>
                                                <?php elseif ($p['stock'] <= 5): ?>
                                                    <span class="badge bg-warning text-dark px-2 py-1">Low Stock (<?php echo $p['stock']; ?>)</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success px-2 py-1"><?php echo $p['stock']; ?> In Stock</span>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-link btn-sm p-0 ms-1 text-decoration-none" title="Update Stock" onclick="openStockModal(<?php echo $p['id']; ?>, <?php echo $p['stock']; ?>, '<?php echo addslashes($p['title']); ?>')">
                                                    <i class="fa-solid fa-pen-to-square text-muted fs-8"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <?php if ($p['is_flash_sale']): ?>
                                                    <span class="badge bg-warning text-dark"><i class="fa-solid fa-bolt me-1"></i>YES</span>
                                                <?php else: ?>
                                                    <span class="badge bg-light text-muted border">NO</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <button type="button" class="btn btn-outline-info" title="View Details" onclick="openViewModal(<?php echo htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8'); ?>)">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-primary" title="Edit Product" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8'); ?>)">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger" title="Delete Product" onclick="openDeleteModal(<?php echo $p['id']; ?>, '<?php echo addslashes($p['title']); ?>')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
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

    <!-- MODAL 1: ADD NEW PRODUCT -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-plus me-2"></i>Add New Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="products.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add_product">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fs-7 fw-bold">Product Title *</label>
                                <input type="text" name="title" class="form-control" placeholder="e.g. Wireless Bluetooth Earbuds" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Product Code / Slug</label>
                                <input type="text" name="product_code" class="form-control" placeholder="e.g. bluetooth-earbuds">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold">Brand</label>
                                <input type="text" name="brand" class="form-control" placeholder="e.g. Sony, Samsung, Generic" value="Generic">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold">Category *</label>
                                <input type="text" name="category" class="form-control" placeholder="e.g. Electronics, Fashion, Beauty" value="Electronics" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Price (Rs.) *</label>
                                <input type="number" step="0.01" name="price" class="form-control" placeholder="e.g. 1500" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Old Original Price (Rs.)</label>
                                <input type="number" step="0.01" name="old_price" class="form-control" placeholder="e.g. 2000">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Discount Text</label>
                                <input type="text" name="discount" class="form-control" placeholder="e.g. -25%">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Initial Stock Quantity *</label>
                                <input type="number" name="stock" class="form-control" value="25" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fs-7 fw-bold">Image URL or Path</label>
                                <input type="text" name="image_url" class="form-control" placeholder="e.g. ./loreal_shampoo.png or https://...">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fs-7 fw-bold">Or Upload Image File from Computer</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fs-7 fw-bold">Description</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Product details, features, specifications..."></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_flash_sale" id="addFlashSale">
                                    <label class="form-check-label fs-7 fw-bold" for="addFlashSale">Feature in 8.8 Flash Sale</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_just_for_you" id="addJustForYou" checked>
                                    <label class="form-check-label fs-7 fw-bold" for="addJustForYou">Show in Just For You section</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Save & Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 2: EDIT PRODUCT -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="products.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit_product">
                    <input type="hidden" name="product_id" id="edit_id">
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label fs-7 fw-bold">Product Title *</label>
                                <input type="text" name="title" id="edit_title" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Product Code</label>
                                <input type="text" name="product_code" id="edit_code" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold">Brand</label>
                                <input type="text" name="brand" id="edit_brand" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fs-7 fw-bold">Category *</label>
                                <input type="text" name="category" id="edit_category" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Price (Rs.) *</label>
                                <input type="number" step="0.01" name="price" id="edit_price" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Old Original Price (Rs.)</label>
                                <input type="number" step="0.01" name="old_price" id="edit_old_price" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Discount Text</label>
                                <input type="text" name="discount" id="edit_discount" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fs-7 fw-bold">Stock Quantity *</label>
                                <input type="number" name="stock" id="edit_stock" class="form-control" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label fs-7 fw-bold">Image URL or Path</label>
                                <input type="text" name="image_url" id="edit_image_url" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fs-7 fw-bold">Replace Image File</label>
                                <input type="file" name="image_file" class="form-control" accept="image/*">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fs-7 fw-bold">Description</label>
                                <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_flash_sale" id="edit_flash_sale">
                                    <label class="form-check-label fs-7 fw-bold" for="edit_flash_sale">Flash Sale Product</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" name="is_just_for_you" id="edit_just_for_you">
                                    <label class="form-check-label fs-7 fw-bold" for="edit_just_for_you">Just For You Product</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary fw-bold px-4">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 3: VIEW PRODUCT DETAILS -->
    <div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-eye me-2"></i>Product Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <img id="view_image" src="" class="img-fluid rounded mb-3 border p-1" style="max-height: 200px; object-fit: contain;" onerror="this.onerror=null; this.src='../CSS-6-May/darazlogo.png';">
                    <h5 id="view_title" class="fw-bold text-dark mb-1"></h5>
                    <p class="text-muted fs-7 mb-2">Code: <code id="view_code"></code> | Category: <span id="view_category" class="badge bg-light text-dark border"></span></p>
                    
                    <div class="bg-light p-3 rounded mb-3 text-start">
                        <div class="row g-2">
                            <div class="col-6"><strong>Price:</strong> <span id="view_price" class="text-primary font-weight-bold"></span></div>
                            <div class="col-6"><strong>Old Price:</strong> <span id="view_old_price" class="text-decoration-line-through text-muted"></span></div>
                            <div class="col-6"><strong>Brand:</strong> <span id="view_brand"></span></div>
                            <div class="col-6"><strong>Available Stock:</strong> <span id="view_stock" class="fw-bold"></span></div>
                            <div class="col-6"><strong>Total Sold:</strong> <span id="view_sold"></span></div>
                            <div class="col-6"><strong>Rating:</strong> <span id="view_rating" class="text-warning"></span></div>
                        </div>
                    </div>
                    <div class="text-start">
                        <h6>Description:</h6>
                        <div id="view_description" class="fs-7 text-muted border p-2 rounded bg-light"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL 4: DELETE CONFIRMATION -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-trash me-2"></i>Delete Product</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="products.php">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" name="product_id" id="delete_id">
                    <div class="modal-body p-4 text-center">
                        <i class="fa-solid fa-circle-exclamation text-danger display-4 mb-3"></i>
                        <h5>Are you sure you want to delete this product?</h5>
                        <p class="text-muted fs-7 mb-0" id="delete_title_text"></p>
                        <p class="text-danger fs-8 fw-bold mt-2">This change will immediately remove the product from the main Daraz website!</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger fw-bold px-4">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL 5: UPDATE STOCK -->
    <div class="modal fade" id="updateStockModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-boxes-stacked me-2"></i>Manage Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="products.php">
                    <input type="hidden" name="action" value="update_stock">
                    <input type="hidden" name="product_id" id="stock_id">
                    <div class="modal-body p-3">
                        <p id="stock_product_title" class="fs-7 fw-bold text-dark mb-2 text-truncate"></p>
                        <label class="form-label fs-7 font-weight-bold">New Inventory Stock Count:</label>
                        <input type="number" name="new_stock" id="stock_input" class="form-control form-control-lg text-center font-weight-bold" min="0" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning btn-sm fw-bold">Update Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
function getProductImageUrl(path) {
    if (!path) return '../CSS-6-May/darazlogo.png';
    if (/^(https?:\/\/|data:|\/\/)/i.test(path)) return path;
    if (path.indexOf('../CSS-6-May/') === 0) return path;
    var clean = path.replace(/^\.[\/\\]?/, '').replace(/^[\/\\]/, '');
    if (clean.indexOf('CSS-6-May/') === 0) return '../' + clean;
    return '../CSS-6-May/' + clean;
}

function openViewModal(p) {
    document.getElementById('view_title').innerText = p.title;
    document.getElementById('view_code').innerText = p.product_code;
    document.getElementById('view_category').innerText = p.category;
    document.getElementById('view_brand').innerText = p.brand;
    document.getElementById('view_price').innerText = 'Rs. ' + parseFloat(p.price).toLocaleString();
    document.getElementById('view_old_price').innerText = p.old_price ? ('Rs. ' + parseFloat(p.old_price).toLocaleString()) : 'N/A';
    document.getElementById('view_stock').innerText = p.stock + ' units';
    document.getElementById('view_sold').innerText = p.sold_count + ' sold';
    document.getElementById('view_rating').innerText = p.rating + ' / 5.0';
    document.getElementById('view_image').src = getProductImageUrl(p.image);
    document.getElementById('view_description').innerHTML = p.description || 'No description available.';

    new bootstrap.Modal(document.getElementById('viewProductModal')).show();
}

function openEditModal(p) {
    document.getElementById('edit_id').value = p.id;
    document.getElementById('edit_title').value = p.title;
    document.getElementById('edit_code').value = p.product_code;
    document.getElementById('edit_brand').value = p.brand;
    document.getElementById('edit_category').value = p.category;
    document.getElementById('edit_price').value = p.price;
    document.getElementById('edit_old_price').value = p.old_price || '';
    document.getElementById('edit_discount').value = p.discount || '';
    document.getElementById('edit_stock').value = p.stock;
    document.getElementById('edit_image_url').value = p.image;
    document.getElementById('edit_description').value = p.description || '';
    document.getElementById('edit_flash_sale').checked = (parseInt(p.is_flash_sale) === 1);
    document.getElementById('edit_just_for_you').checked = (parseInt(p.is_just_for_you) === 1);

    new bootstrap.Modal(document.getElementById('editProductModal')).show();
}

function openDeleteModal(id, title) {
    document.getElementById('delete_id').value = id;
    document.getElementById('delete_title_text').innerText = '"' + title + '"';

    new bootstrap.Modal(document.getElementById('deleteProductModal')).show();
}

function openStockModal(id, currentStock, title) {
    document.getElementById('stock_id').value = id;
    document.getElementById('stock_input').value = currentStock;
    document.getElementById('stock_product_title').innerText = title;

    new bootstrap.Modal(document.getElementById('updateStockModal')).show();
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
