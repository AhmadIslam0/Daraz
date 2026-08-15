<?php
// api/checkout.php - Checkout & Order Processing Endpoint for Daraz

header('Content-Type: application/json');
session_start();

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$inputRaw = file_get_contents('php://input');
$data = json_decode($inputRaw, true);

if (!$data) {
    $data = $_POST;
}

$fullName = isset($data['full_name']) ? trim($data['full_name']) : (isset($data['name']) ? trim($data['name']) : '');
$phone = isset($data['phone']) ? trim($data['phone']) : '';
$address = isset($data['address']) ? trim($data['address']) : '';
$province = isset($data['province']) ? trim($data['province']) : '';
$city = isset($data['city']) ? trim($data['city']) : '';
$building = isset($data['building']) ? trim($data['building']) : '';
$area = isset($data['area']) ? trim($data['area']) : '';
$colony = isset($data['colony']) ? trim($data['colony']) : '';
$deliveryLabel = isset($data['delivery_label']) ? trim($data['delivery_label']) : 'HOME';
$paymentMethod = isset($data['payment_method']) ? trim($data['payment_method']) : 'Cash on Delivery (COD)';

$items = isset($data['items']) && is_array($data['items']) ? $data['items'] : [];
$subtotal = isset($data['subtotal']) ? floatval($data['subtotal']) : 0.00;
$deliveryFee = isset($data['delivery_fee']) ? floatval($data['delivery_fee']) : 0.00;
$platformFee = isset($data['platform_fee']) ? floatval($data['platform_fee']) : 0.00;
$totalAmount = isset($data['total_amount']) ? floatval($data['total_amount']) : ($subtotal + $deliveryFee + $platformFee);

// Validations
if (empty($fullName)) {
    echo json_encode(['success' => false, 'message' => 'Full name is required.']);
    exit;
}

if (empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Mobile phone number is required.']);
    exit;
}

if (empty($address)) {
    echo json_encode(['success' => false, 'message' => 'Delivery address is required.']);
    exit;
}

if (empty($items)) {
    echo json_encode(['success' => false, 'message' => 'Your cart is empty. Please add items before checking out.']);
    exit;
}

try {
    // Generate unique order number
    $orderNumber = 'PK-' . rand(100000, 999999);
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    // Begin database transaction
    $pdo->beginTransaction();

    // Insert Order
    $stmt = $pdo->prepare("
        INSERT INTO orders (
            order_number, user_id, full_name, phone, province, city, building, area, colony, address, delivery_label, payment_method, subtotal, delivery_fee, platform_fee, total_amount
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    
    $stmt->execute([
        $orderNumber,
        $userId,
        $fullName,
        $phone,
        $province,
        $city,
        $building,
        $area,
        $colony,
        $address,
        $deliveryLabel,
        $paymentMethod,
        $subtotal,
        $deliveryFee,
        $platformFee,
        $totalAmount
    ]);

    $orderId = $pdo->lastInsertId();

    // Insert Order Items and Update Product Stock
    $itemStmt = $pdo->prepare("
        INSERT INTO order_items (
            order_id, product_id, product_title, product_price, quantity, total_price
        ) VALUES (?, ?, ?, ?, ?, ?)
    ");

    $updateStockStmt = $pdo->prepare("
        UPDATE products 
        SET stock = GREATEST(0, stock - ?), sold_count = sold_count + ? 
        WHERE product_code = ? OR id = ?
    ");

    foreach ($items as $item) {
        $productId = isset($item['id']) ? $item['id'] : 'prod_item';
        $productTitle = isset($item['title']) ? $item['title'] : 'Daraz Product';
        $productPrice = isset($item['price']) ? floatval($item['price']) : 0.00;
        $quantity = isset($item['quantity']) ? intval($item['quantity']) : 1;
        $totalPrice = $productPrice * $quantity;

        $itemStmt->execute([
            $orderId,
            $productId,
            $productTitle,
            $productPrice,
            $quantity,
            $totalPrice
        ]);

        // Decrement inventory stock in DB
        $updateStockStmt->execute([$quantity, $quantity, $productId, $productId]);
    }

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'order_number' => $orderNumber,
        'order_id' => $orderId,
        'message' => 'Order placed successfully!'
    ]);

} catch (PDOException $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
