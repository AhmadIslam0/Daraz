<?php
// api/get_products.php - Fetch Products from Database for Daraz Frontend
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY id ASC");
    $rawProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $products = [];
    foreach ($rawProducts as $p) {
        $products[] = [
            'id' => $p['product_code'],
            'db_id' => intval($p['id']),
            'title' => $p['title'],
            'price' => floatval($p['price']),
            'oldPrice' => $p['old_price'] ? floatval($p['old_price']) : floatval($p['price']),
            'discount' => $p['discount'] ? $p['discount'] : '',
            'image' => $p['image'],
            'rating' => floatval($p['rating']),
            'ratingCount' => intval($p['rating_count']),
            'soldCount' => intval($p['sold_count']),
            'brand' => $p['brand'],
            'category' => $p['category'],
            'thumbnails' => [$p['image']],
            'description' => $p['description'] ? $p['description'] : '<p>High quality official product on Daraz.</p>',
            'stock' => intval($p['stock']),
            'isFlashSale' => intval($p['is_flash_sale']),
            'isJustForYou' => intval($p['is_just_for_you'])
        ];
    }

    echo json_encode([
        'success' => true,
        'count' => count($products),
        'products' => $products
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch products: ' . $e->getMessage()
    ]);
}
?>
