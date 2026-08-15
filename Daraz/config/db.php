<?php
// config/db.php - Database Connection Configuration for Daraz

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'daraz_db';

try {
    // Connect to MySQL server first to ensure database exists
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbname` ");

    // Create tables if they do not exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_number VARCHAR(50) NOT NULL UNIQUE,
            user_id INT NULL,
            full_name VARCHAR(150) NOT NULL,
            phone VARCHAR(50) NOT NULL,
            province VARCHAR(100) DEFAULT NULL,
            city VARCHAR(100) DEFAULT NULL,
            building VARCHAR(255) DEFAULT NULL,
            area VARCHAR(100) DEFAULT NULL,
            colony VARCHAR(255) DEFAULT NULL,
            address TEXT NOT NULL,
            delivery_label VARCHAR(20) DEFAULT 'HOME',
            payment_method VARCHAR(100) DEFAULT 'Cash on Delivery',
            subtotal DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            delivery_fee DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            platform_fee DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            total_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            status VARCHAR(50) DEFAULT 'Pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS order_items (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            product_id VARCHAR(100) NOT NULL,
            product_title VARCHAR(255) NOT NULL,
            product_price DECIMAL(10,2) NOT NULL,
            quantity INT NOT NULL DEFAULT 1,
            total_price DECIMAL(10,2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            email VARCHAR(150) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            full_name VARCHAR(150) NOT NULL,
            role VARCHAR(50) DEFAULT 'Admin',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_code VARCHAR(100) NOT NULL UNIQUE,
            title VARCHAR(255) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            old_price DECIMAL(10,2) DEFAULT NULL,
            discount VARCHAR(20) DEFAULT NULL,
            image VARCHAR(255) NOT NULL,
            rating DECIMAL(2,1) DEFAULT 4.5,
            rating_count INT DEFAULT 0,
            sold_count INT DEFAULT 0,
            brand VARCHAR(100) DEFAULT 'Daraz',
            category VARCHAR(100) DEFAULT 'General',
            description TEXT,
            stock INT NOT NULL DEFAULT 20,
            is_flash_sale TINYINT(1) DEFAULT 0,
            is_just_for_you TINYINT(1) DEFAULT 1,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");

    // Auto-seed or update Admin user with exact required credentials
    $stmt = $pdo->prepare("SELECT id FROM admins WHERE email = ? LIMIT 1");
    $stmt->execute(['rshehrozmehmood@gmail.com']);
    $shehrozPass = password_hash('shery381', PASSWORD_DEFAULT);
    
    if ($stmt->rowCount() == 0) {
        $insStmt = $pdo->prepare("INSERT INTO admins (username, email, password, full_name, role) VALUES (?, ?, ?, ?, ?)");
        $insStmt->execute(['shehroz', 'rshehrozmehmood@gmail.com', $shehrozPass, 'Shehroz Mehmood', 'Super Admin']);
    } else {
        $updStmt = $pdo->prepare("UPDATE admins SET password = ? WHERE email = ?");
        $updStmt->execute([$shehrozPass, 'rshehrozmehmood@gmail.com']);
    }

    // Auto-seed initial products if products table is empty
    $prodCount = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
    if ($prodCount == 0) {
        $initialProducts = [
            [
                'product_code' => 'loreal-shampoo',
                'title' => "L'Oreal Paris Elvive Hyaluron Pure Shampoo - For Oily Scalp 175ML",
                'price' => 467.00,
                'old_price' => 599.00,
                'discount' => '-22%',
                'image' => './loreal_shampoo.png',
                'rating' => 4.8,
                'rating_count' => 153,
                'sold_count' => 207,
                'brand' => "L'Oreal Paris",
                'category' => 'Beauty & Skincare',
                'description' => "Innovative dual-action formula with salicylic and hyaluronic acids removes up to 100 percent of residue leaving the scalp feeling refreshed and reinvigorated for up to 72H.",
                'stock' => 45,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'ztr-treadmill',
                'title' => "ZTR-15 Treadmill Heavy Duty Exercise Machine",
                'price' => 96499.00,
                'old_price' => 320000.00,
                'discount' => '-70%',
                'image' => './ZTR-15 Treadmill.webp',
                'rating' => 4.7,
                'rating_count' => 89,
                'sold_count' => 142,
                'brand' => 'ZTR',
                'category' => 'Sports & Fitness',
                'description' => "Heavy duty electric treadmill with multi-functional LCD screen, heart rate monitor, foldability, and shock absorption system.",
                'stock' => 5,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'ensure-milk',
                'title' => "Ensure Chocolate Milk Powder 400g",
                'price' => 2899.00,
                'old_price' => 3135.00,
                'discount' => '-8%',
                'image' => './Ensure.webp',
                'rating' => 4.9,
                'rating_count' => 310,
                'sold_count' => 520,
                'brand' => 'Abbott Ensure',
                'category' => 'Groceries',
                'description' => "Complete balanced nutrition milk powder with delicious chocolate flavor. Rich in 28 essential vitamins & minerals.",
                'stock' => 28,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'sereno-massage-chair',
                'title' => "Sereno Presage Massage Chair, Full Body Massage, Zero Gravity, 12 Auto Programs",
                'price' => 155899.00,
                'old_price' => 290000.00,
                'discount' => '-46%',
                'image' => './mass.webp',
                'rating' => 4.9,
                'rating_count' => 42,
                'sold_count' => 65,
                'brand' => 'Sereno',
                'category' => 'Health & Beauty',
                'description' => "Ultimate luxury massage chair featuring zero gravity recliner, 3D body scan, 12 automated programs, and full body airbag therapy.",
                'stock' => 3,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'repair-tape',
                'title' => "Waterproof Leakage Repair Tape Heavy Duty Super Strong",
                'price' => 61.00,
                'old_price' => 100.00,
                'discount' => '-39%',
                'image' => './Tape.webp',
                'rating' => 4.3,
                'rating_count' => 540,
                'sold_count' => 1200,
                'brand' => 'Generic',
                'category' => 'Home Improvement',
                'description' => "Super strong waterproof tape suitable for pipe repair, roof leak sealing, hose bonding and emergency fixes.",
                'stock' => 120,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'silicon-ice-roller',
                'title' => "Silicone Ice Cube Roller Massager for Face, Eyes and Neck Naturally Conditioning",
                'price' => 166.00,
                'old_price' => 250.00,
                'discount' => '-34%',
                'image' => './Silicon Ice.webp',
                'rating' => 4.6,
                'rating_count' => 230,
                'sold_count' => 610,
                'brand' => 'Skincare Essentials',
                'category' => 'Beauty & Skincare',
                'description' => "Reusable silicone ice roller for facial massage, puffiness reduction, skin tightening, and pore minimization.",
                'stock' => 50,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'mini-book-light',
                'title' => "Mini Book Light LED Clamp Reading Lamp Night Lights Bookmark Desk",
                'price' => 239.00,
                'old_price' => 618.00,
                'discount' => '-61%',
                'image' => './minibook.webp',
                'rating' => 4.5,
                'rating_count' => 180,
                'sold_count' => 430,
                'brand' => 'LitUp',
                'category' => 'Electronics',
                'description' => "Flexible clip-on LED reading lamp with adjustable brightness, perfect for reading books at night without disturbing others.",
                'stock' => 35,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'black-tea',
                'title' => "Premium Leaf Black Tea 500G Strong Refreshing Flavor",
                'price' => 526.00,
                'old_price' => 799.00,
                'discount' => '-34%',
                'image' => './tea.webp',
                'rating' => 4.8,
                'rating_count' => 390,
                'sold_count' => 890,
                'brand' => 'Tealand',
                'category' => 'Groceries',
                'description' => "Selected high-quality black tea leaves delivering rich aroma, deep amber color and authentic karak chai flavor.",
                'stock' => 60,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'xiaomi-tv-43',
                'title' => "Xiaomi TV A 43″ FHD Smart Google TV (2026) – Bezel-less Metal Design",
                'price' => 57898.00,
                'old_price' => 71999.00,
                'discount' => '-20%',
                'image' => './xiomi.avif',
                'rating' => 4.9,
                'rating_count' => 210,
                'sold_count' => 340,
                'brand' => 'Xiaomi',
                'category' => 'Electronics',
                'description' => "43 inch Full HD Smart Google TV with Dolby Audio, 20W stereo speakers, voice remote control, Chromecast built-in and 2 years official warranty.",
                'stock' => 8,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'homecure-cream',
                'title' => "Home cure cream & sachet combo (guaranteed results in just 2 days)",
                'price' => 1154.00,
                'old_price' => 1412.00,
                'discount' => '-18%',
                'image' => './homecure.webp',
                'rating' => 4.4,
                'rating_count' => 95,
                'sold_count' => 210,
                'brand' => 'HomeCure',
                'category' => 'Beauty & Skincare',
                'description' => "Herbal skincare cream & sachet combo for clear, glowing, spot-free skin texture.",
                'stock' => 15,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'butterfly-massager',
                'title' => "Mini Butterfly Body Massager – Rechargeable EMS Electric Muscle Massage Pad",
                'price' => 318.00,
                'old_price' => 700.00,
                'discount' => '-55%',
                'image' => './butterfly.webp',
                'rating' => 4.6,
                'rating_count' => 340,
                'sold_count' => 800,
                'brand' => 'EMS Health',
                'category' => 'Health & Beauty',
                'description' => "Portable pulse electric massager for neck, back, shoulders, and legs.",
                'stock' => 40,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'derma-roller',
                'title' => "Derma Roller With 540 Micro Needle Skin Therapy 0.5mm",
                'price' => 163.00,
                'old_price' => 300.00,
                'discount' => '-46%',
                'image' => './roller.webp',
                'rating' => 4.5,
                'rating_count' => 290,
                'sold_count' => 600,
                'brand' => 'DermaCare',
                'category' => 'Beauty & Skincare',
                'description' => "Micro needle roller for collagen stimulation, skin regeneration, acne scar reduction.",
                'stock' => 22,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'mesh-tape',
                'title' => "Window Screen Repair Tape Self Adhesive Mesh Net Fix Patch",
                'price' => 133.00,
                'old_price' => 399.00,
                'discount' => '-67%',
                'image' => './repairtape.webp',
                'rating' => 4.2,
                'rating_count' => 150,
                'sold_count' => 380,
                'brand' => 'Generic',
                'category' => 'Home Improvement',
                'description' => "Self-adhesive glass fiber mesh patch tape for quickly repairing holes and tears.",
                'stock' => 80,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'tapal-danedar',
                'title' => "Tapal Danedar 430gm Pouch CP-Save Rs 70",
                'price' => 819.00,
                'old_price' => 830.00,
                'discount' => '-1%',
                'image' => './danadar.webp',
                'rating' => 4.9,
                'rating_count' => 820,
                'sold_count' => 1500,
                'brand' => 'Tapal',
                'category' => 'Groceries',
                'description' => "Pakistan's favorite tea brand! Tapal Danedar offering strong taste and rich color.",
                'stock' => 95,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'pack-powders',
                'title' => "Pack of 5 Powders + 2 Free | Rice, Multani, Rose, Orange Peel, Neem Powder",
                'price' => 431.00,
                'old_price' => 999.00,
                'discount' => '-57%',
                'image' => './pack.webp',
                'rating' => 4.7,
                'rating_count' => 180,
                'sold_count' => 400,
                'brand' => 'Pure Herbs',
                'category' => 'Beauty & Skincare',
                'description' => "100% natural organic powder set for homemade face masks and skincare packs.",
                'stock' => 30,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'tresemme-shampoo',
                'title' => "Tresemme Keratin Smooth And Straight Shampoo 360ML",
                'price' => 751.00,
                'old_price' => 930.00,
                'discount' => '-19%',
                'image' => './Tresseme.webp',
                'rating' => 4.8,
                'rating_count' => 410,
                'sold_count' => 850,
                'brand' => 'Tresemme',
                'category' => 'Beauty & Skincare',
                'description' => "Infused with Keratin and Argan Oil for smooth, shiny, frizz-controlled hair.",
                'stock' => 40,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'door-dust-stopper',
                'title' => "Door Dust Stopper Draft & Insect Twin Guard Seal",
                'price' => 50.00,
                'old_price' => 399.00,
                'discount' => '-87%',
                'image' => './Door Dust.webp',
                'rating' => 4.4,
                'rating_count' => 670,
                'sold_count' => 2100,
                'brand' => 'TwinGuard',
                'category' => 'Home Improvement',
                'description' => "Double-sided door bottom seal strip to prevent dust, insects, cold air leaks.",
                'stock' => 150,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'zext-pillow',
                'title' => "ZEXT Cozy Travel Pillow U Shaped Neck Cushion Car Neck Pillow",
                'price' => 654.00,
                'old_price' => 899.00,
                'discount' => '-27%',
                'image' => './zext.webp',
                'rating' => 4.6,
                'rating_count' => 130,
                'sold_count' => 290,
                'brand' => 'ZEXT',
                'category' => 'Travel & Lifestyle',
                'description' => "Soft memory foam U-shaped neck travel pillow for ergonomic support.",
                'stock' => 25,
                'is_flash_sale' => 1,
                'is_just_for_you' => 0
            ],
            [
                'product_code' => 'magsafe-case',
                'title' => "MAGSAFE JELLY CASE FOR SAMSUNG A06, A15, A56, S23, S24, S25 Ultra",
                'price' => 299.00,
                'old_price' => 450.00,
                'discount' => '-34%',
                'image' => './cse.avif',
                'rating' => 4.7,
                'rating_count' => 310,
                'sold_count' => 750,
                'brand' => 'CasePro',
                'category' => 'Electronics',
                'description' => "Transparent shockproof corner jelly case supporting MagSafe wireless charging.",
                'stock' => 65,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'foldable-fan',
                'title' => "Mini Desktop Foldable Fan Portable USB Rechargeable Retractable Mute Fan",
                'price' => 1599.00,
                'old_price' => 2500.00,
                'discount' => '-36%',
                'image' => './foldable fan.avif',
                'rating' => 4.6,
                'rating_count' => 190,
                'sold_count' => 420,
                'brand' => 'CoolBreeze',
                'category' => 'Electronics',
                'description' => "Height adjustable telescopic folding fan with long battery backup.",
                'stock' => 18,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'track-suit-white',
                'title' => "Billionaire printed summer track suit for men white",
                'price' => 807.00,
                'old_price' => 1500.00,
                'discount' => '-46%',
                'image' => './track.avif',
                'rating' => 4.5,
                'rating_count' => 140,
                'sold_count' => 310,
                'brand' => 'Billionaire',
                'category' => 'Fashion',
                'description' => "Lightweight breathable summer cotton tracksuit set featuring stylish chest print logo.",
                'stock' => 12,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'soap-holder',
                'title' => "Luxury Soap Holder with Drain Tray, Waterproof Wall Mounted Soap Box",
                'price' => 166.00,
                'old_price' => 395.00,
                'discount' => '-58%',
                'image' => './soap.avif',
                'rating' => 4.7,
                'rating_count' => 520,
                'sold_count' => 1300,
                'brand' => 'HomeDeco',
                'category' => 'Home Improvement',
                'description' => "Wall mounted drill-free soap dish with flip lid cover and removable drainage tray.",
                'stock' => 90,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'camelo-sandals',
                'title' => "Camelo Sandals for Men Summer High-Quality Stylish Business Style",
                'price' => 292.00,
                'old_price' => 1500.00,
                'discount' => '-81%',
                'image' => './sandals.avif',
                'rating' => 4.8,
                'rating_count' => 460,
                'sold_count' => 980,
                'brand' => 'Camelo',
                'category' => 'Fashion',
                'description' => "Comfortable cushioned sole men's summer sandals crafted with durable synthetic leather straps.",
                'stock' => 35,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'glass-water-bottle',
                'title' => "Beautiful Glass Water Bottle with Vacuum Sleeve & Carrying Loop (400 ML)",
                'price' => 345.00,
                'old_price' => 1200.00,
                'discount' => '-71%',
                'image' => './bottle.avif',
                'rating' => 4.6,
                'rating_count' => 280,
                'sold_count' => 670,
                'brand' => 'HydroFit',
                'category' => 'Home Improvement',
                'description' => "BPA-free heat resistant borosilicate glass water bottle with protective silicone sleeve.",
                'stock' => 40,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'mini-handheld-fan',
                'title' => "Mini Fan Rechargeable / Handheld Desktop USB Fan Electric Portable",
                'price' => 467.00,
                'old_price' => 800.00,
                'discount' => '-42%',
                'image' => './Mini Fan.avif',
                'rating' => 4.7,
                'rating_count' => 390,
                'sold_count' => 890,
                'brand' => 'CoolBreeze',
                'category' => 'Electronics',
                'description' => "Compact rechargeable USB pocket fan with removable base stand for desktop or outdoor handheld use.",
                'stock' => 50,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'dell-laptop-sleeve',
                'title' => "Dell Pro Sleeve 13\" Laptop Case Original Waterproof Cushion",
                'price' => 2899.00,
                'old_price' => 5500.00,
                'discount' => '-47%',
                'image' => './Dell pro.avif',
                'rating' => 4.8,
                'rating_count' => 160,
                'sold_count' => 330,
                'brand' => 'Dell',
                'category' => 'Electronics',
                'description' => "Original Dell protective laptop sleeve with soft fleece interior lining.",
                'stock' => 14,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'bathroom-slippers',
                'title' => "Non-Slip Washroom & Bathroom Slippers for Men & Women Quick-Dry",
                'price' => 229.00,
                'old_price' => 600.00,
                'discount' => '-62%',
                'image' => './chapal.avif',
                'rating' => 4.7,
                'rating_count' => 840,
                'sold_count' => 1900,
                'brand' => 'ComfortFoot',
                'category' => 'Fashion',
                'description' => "Ultra soft EVA anti-slip shower slides with drain holes for quick drying.",
                'stock' => 110,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'chill-dumbbells',
                'title' => "CHILL FITNESS Rubber Coated Dumbbells with Anti Slip Metal Handles",
                'price' => 182.00,
                'old_price' => 600.00,
                'discount' => '-70%',
                'image' => './Dumbbells.avif',
                'rating' => 4.9,
                'rating_count' => 610,
                'sold_count' => 1400,
                'brand' => 'CHILL FITNESS',
                'category' => 'Sports & Fitness',
                'description' => "Rubber hex dumbbell with knurled chrome steel handle for secure non-slip grip.",
                'stock' => 70,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ],
            [
                'product_code' => 'screen-magnifier',
                'title' => "F3 Mobile Screen Magnifier 3D Enlarged Display Stand for Smartphones",
                'price' => 460.00,
                'old_price' => 900.00,
                'discount' => '-49%',
                'image' => './F3 Mobile.avif',
                'rating' => 4.5,
                'rating_count' => 220,
                'sold_count' => 500,
                'brand' => 'F3 Optics',
                'category' => 'Electronics',
                'description' => "3D HD phone screen amplifier stand that enlarges your phone screen 3-4 times.",
                'stock' => 45,
                'is_flash_sale' => 0,
                'is_just_for_you' => 1
            ]
        ];

        $insStmt = $pdo->prepare("
            INSERT INTO products (
                product_code, title, price, old_price, discount, image, rating, rating_count, sold_count, brand, category, description, stock, is_flash_sale, is_just_for_you
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ");

        foreach ($initialProducts as $p) {
            $insStmt->execute([
                $p['product_code'],
                $p['title'],
                $p['price'],
                $p['old_price'],
                $p['discount'],
                $p['image'],
                $p['rating'],
                $p['rating_count'],
                $p['sold_count'],
                $p['brand'],
                $p['category'],
                $p['description'],
                $p['stock'],
                $p['is_flash_sale'],
                $p['is_just_for_you']
            ]);
        }
    }

} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $e->getMessage()
    ]);
    exit;
}
?>
