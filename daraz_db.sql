-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2026 at 09:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `daraz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `role` varchar(50) DEFAULT 'Admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `full_name`, `role`, `created_at`) VALUES
(1, 'Ahmad Islam', 'ahmadislam0003@gmail.com', '$2y$10$Mbbx7CdAfoIjq0jHhzhMOutWf6jQQFP7ur3WYOTQhWBVzoGKB53MK', 'Ahmad Islam', 'Super Admin', '2026-08-13 08:33:59'),
(2, 'shehroz', 'rshehrozmehmood@gmail.com', '$2y$10$lbXE0tg2CjlG8GzAiAVsbujgX4KjpQxuqftMUv2Rh/LZ3Tn37bfdq', 'Shehroz Mehmood', 'Super Admin', '2026-08-13 08:37:42');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `colony` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `delivery_label` varchar(20) DEFAULT 'HOME',
  `payment_method` varchar(100) DEFAULT 'Cash on Delivery',
  `subtotal` decimal(10,2) NOT NULL DEFAULT 0.00,
  `delivery_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `platform_fee` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `full_name`, `phone`, `province`, `city`, `building`, `area`, `colony`, `address`, `delivery_label`, `payment_method`, `subtotal`, `delivery_fee`, `platform_fee`, `total_amount`, `status`, `created_at`) VALUES
(1, 'PK-351828', 1, 'Ahmad Islam-80', '0347456589', 'Punjab', 'Lahore', 'Imamia Colony St no.5 Gojra', 'Gulshan-e-Iqbal', '123', 'Imamia Colony St no.5 Gojra', 'HOME', 'Cash on Delivery (COD)', 467.00, 190.00, 10.00, 667.00, 'Pending', '2026-08-10 20:05:53'),
(2, 'PK-592225', NULL, 'Ahmad Islam-80', '0347456589', 'Punjab', 'Lahore', 'Imamia Colony St no.5 Gojra', 'Johar', 'Gojra', 'Imamia Colony St no.5 Gojra', 'HOME', 'Cash on Delivery (COD)', 155899.00, 190.00, 10.00, 156099.00, 'Processing', '2026-08-11 11:15:00'),
(3, 'PK-969969', NULL, 'Ahmad Islam-80', '0347456589', 'Punjab', 'Lahore', 'Imamia Colony St no.5 Gojra', 'Gulshan-e-Iqbal', 'Gojra', 'Imamia Colony St no.5 Gojra', 'HOME', 'Cash on Delivery (COD)', 155899.00, 190.00, 10.00, 156099.00, 'Delivered', '2026-08-11 11:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_title`, `product_price`, `quantity`, `total_price`, `created_at`) VALUES
(1, 1, 'loreal-shampoo', 'L\'Oreal Paris Elvive Hyaluron Pure Shampoo - For Oily Scalp 175ML', 467.00, 1, 467.00, '2026-08-10 20:05:53'),
(2, 2, 'sereno-massage-chair', 'Sereno Presage Massage Chair, Full Body Massage, Zero Gravity, 12 Auto Programs', 155899.00, 1, 155899.00, '2026-08-11 11:15:00'),
(3, 3, 'sereno-massage-chair', 'Sereno Presage Massage Chair, Full Body Massage, Zero Gravity, 12 Auto Programs', 155899.00, 1, 155899.00, '2026-08-11 11:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `discount` varchar(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `rating` decimal(2,1) DEFAULT 4.5,
  `rating_count` int(11) DEFAULT 0,
  `sold_count` int(11) DEFAULT 0,
  `brand` varchar(100) DEFAULT 'Daraz',
  `category` varchar(100) DEFAULT 'General',
  `description` text DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 20,
  `is_flash_sale` tinyint(1) DEFAULT 0,
  `is_just_for_you` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_code`, `title`, `price`, `old_price`, `discount`, `image`, `rating`, `rating_count`, `sold_count`, `brand`, `category`, `description`, `stock`, `is_flash_sale`, `is_just_for_you`, `created_at`, `updated_at`) VALUES
(1, 'loreal-shampoo', 'L\'Oreal Paris Elvive Hyaluron Pure Shampoo - For Oily Scalp 175ML', 467.00, 599.00, '-22%', './loreal_shampoo.png', 4.8, 153, 207, 'L\'Oreal Paris', 'Beauty & Skincare', 'Innovative dual-action formula with salicylic and hyaluronic acids removes up to 100 percent of residue leaving the scalp feeling refreshed and reinvigorated for up to 72H.', 45, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(2, 'ztr-treadmill', 'ZTR-15 Treadmill Heavy Duty Exercise Machine', 96499.00, 320000.00, '-70%', './ZTR-15 Treadmill.webp', 4.7, 89, 142, 'ZTR', 'Sports & Fitness', 'Heavy duty electric treadmill with multi-functional LCD screen, heart rate monitor, foldability, and shock absorption system.', 5, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(3, 'ensure-milk', 'Ensure Chocolate Milk Powder 400g', 2899.00, 3135.00, '-8%', './Ensure.webp', 4.9, 310, 520, 'Abbott Ensure', 'Groceries', 'Complete balanced nutrition milk powder with delicious chocolate flavor. Rich in 28 essential vitamins & minerals.', 28, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(4, 'sereno-massage-chair', 'Sereno Presage Massage Chair, Full Body Massage, Zero Gravity, 12 Auto Programs', 155899.00, 290000.00, '-46%', './mass.webp', 4.9, 42, 65, 'Sereno', 'Health & Beauty', 'Ultimate luxury massage chair featuring zero gravity recliner, 3D body scan, 12 automated programs, and full body airbag therapy.', 3, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(5, 'repair-tape', 'Waterproof Leakage Repair Tape Heavy Duty Super Strong', 61.00, 100.00, '-39%', './Tape.webp', 4.3, 540, 1200, 'Generic', 'Home Improvement', 'Super strong waterproof tape suitable for pipe repair, roof leak sealing, hose bonding and emergency fixes.', 120, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(6, 'silicon-ice-roller', 'Silicone Ice Cube Roller Massager for Face, Eyes and Neck Naturally Conditioning', 166.00, 250.00, '-34%', './Silicon Ice.webp', 4.6, 230, 610, 'Skincare Essentials', 'Beauty & Skincare', 'Reusable silicone ice roller for facial massage, puffiness reduction, skin tightening, and pore minimization.', 50, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(7, 'mini-book-light', 'Mini Book Light LED Clamp Reading Lamp Night Lights Bookmark Desk', 239.00, 618.00, '-61%', './minibook.webp', 4.5, 180, 430, 'LitUp', 'Electronics', 'Flexible clip-on LED reading lamp with adjustable brightness, perfect for reading books at night without disturbing others.', 35, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(8, 'black-tea', 'Premium Leaf Black Tea 500G Strong Refreshing Flavor', 526.00, 799.00, '-34%', './tea.webp', 4.8, 390, 890, 'Tealand', 'Groceries', 'Selected high-quality black tea leaves delivering rich aroma, deep amber color and authentic karak chai flavor.', 60, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(9, 'xiaomi-tv-43', 'Xiaomi TV A 43″ FHD Smart Google TV (2026) – Bezel-less Metal Design', 57898.00, 71999.00, '-20%', './xiomi.avif', 4.9, 210, 340, 'Xiaomi', 'Electronics', '43 inch Full HD Smart Google TV with Dolby Audio, 20W stereo speakers, voice remote control, Chromecast built-in and 2 years official warranty.', 8, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(10, 'homecure-cream', 'Home cure cream & sachet combo (guaranteed results in just 2 days)', 1154.00, 1412.00, '-18%', './homecure.webp', 4.4, 95, 210, 'HomeCure', 'Beauty & Skincare', 'Herbal skincare cream & sachet combo for clear, glowing, spot-free skin texture.', 15, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(11, 'butterfly-massager', 'Mini Butterfly Body Massager – Rechargeable EMS Electric Muscle Massage Pad', 318.00, 700.00, '-55%', './butterfly.webp', 4.6, 340, 800, 'EMS Health', 'Health & Beauty', 'Portable pulse electric massager for neck, back, shoulders, and legs.', 40, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(12, 'derma-roller', 'Derma Roller With 540 Micro Needle Skin Therapy 0.5mm', 163.00, 300.00, '-46%', './roller.webp', 4.5, 290, 600, 'DermaCare', 'Beauty & Skincare', 'Micro needle roller for collagen stimulation, skin regeneration, acne scar reduction.', 22, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(13, 'mesh-tape', 'Window Screen Repair Tape Self Adhesive Mesh Net Fix Patch', 133.00, 399.00, '-67%', './repairtape.webp', 4.2, 150, 380, 'Generic', 'Home Improvement', 'Self-adhesive glass fiber mesh patch tape for quickly repairing holes and tears.', 80, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(14, 'tapal-danedar', 'Tapal Danedar 430gm Pouch CP-Save Rs 70', 819.00, 830.00, '-1%', './danadar.webp', 4.9, 820, 1500, 'Tapal', 'Groceries', 'Pakistan\'s favorite tea brand! Tapal Danedar offering strong taste and rich color.', 95, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(15, 'pack-powders', 'Pack of 5 Powders + 2 Free | Rice, Multani, Rose, Orange Peel, Neem Powder', 431.00, 999.00, '-57%', './pack.webp', 4.7, 180, 400, 'Pure Herbs', 'Beauty & Skincare', '100% natural organic powder set for homemade face masks and skincare packs.', 30, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(16, 'tresemme-shampoo', 'Tresemme Keratin Smooth And Straight Shampoo 360ML', 751.00, 930.00, '-19%', './Tresseme.webp', 4.8, 410, 850, 'Tresemme', 'Beauty & Skincare', 'Infused with Keratin and Argan Oil for smooth, shiny, frizz-controlled hair.', 40, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(17, 'door-dust-stopper', 'Door Dust Stopper Draft & Insect Twin Guard Seal', 50.00, 399.00, '-87%', './Door Dust.webp', 4.4, 670, 2100, 'TwinGuard', 'Home Improvement', 'Double-sided door bottom seal strip to prevent dust, insects, cold air leaks.', 150, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(18, 'zext-pillow', 'ZEXT Cozy Travel Pillow U Shaped Neck Cushion Car Neck Pillow', 654.00, 899.00, '-27%', './zext.webp', 4.6, 130, 290, 'ZEXT', 'Travel & Lifestyle', 'Soft memory foam U-shaped neck travel pillow for ergonomic support.', 25, 1, 0, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(19, 'magsafe-case', 'MAGSAFE JELLY CASE FOR SAMSUNG A06, A15, A56, S23, S24, S25 Ultra', 299.00, 450.00, '-34%', './cse.avif', 4.7, 310, 750, 'CasePro', 'Electronics', 'Transparent shockproof corner jelly case supporting MagSafe wireless charging.', 65, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(20, 'foldable-fan', 'Mini Desktop Foldable Fan Portable USB Rechargeable Retractable Mute Fan', 1599.00, 2500.00, '-36%', './foldable fan.avif', 4.6, 190, 420, 'CoolBreeze', 'Electronics', 'Height adjustable telescopic folding fan with long battery backup.', 18, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(21, 'track-suit-white', 'Billionaire printed summer track suit for men white', 807.00, 1500.00, '-46%', './track.avif', 4.5, 140, 310, 'Billionaire', 'Fashion', 'Lightweight breathable summer cotton tracksuit set featuring stylish chest print logo.', 12, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(22, 'soap-holder', 'Luxury Soap Holder with Drain Tray, Waterproof Wall Mounted Soap Box', 166.00, 395.00, '-58%', './soap.avif', 4.7, 520, 1300, 'HomeDeco', 'Home Improvement', 'Wall mounted drill-free soap dish with flip lid cover and removable drainage tray.', 90, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(23, 'camelo-sandals', 'Camelo Sandals for Men Summer High-Quality Stylish Business Style', 292.00, 1500.00, '-81%', './sandals.avif', 4.8, 460, 980, 'Camelo', 'Fashion', 'Comfortable cushioned sole men\'s summer sandals crafted with durable synthetic leather straps.', 35, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(24, 'glass-water-bottle', 'Beautiful Glass Water Bottle with Vacuum Sleeve & Carrying Loop (400 ML)', 345.00, 1200.00, '-71%', './bottle.avif', 4.6, 280, 670, 'HydroFit', 'Home Improvement', 'BPA-free heat resistant borosilicate glass water bottle with protective silicone sleeve.', 40, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(25, 'mini-handheld-fan', 'Mini Fan Rechargeable / Handheld Desktop USB Fan Electric Portable', 467.00, 800.00, '-42%', './Mini Fan.avif', 4.7, 390, 890, 'CoolBreeze', 'Electronics', 'Compact rechargeable USB pocket fan with removable base stand for desktop or outdoor handheld use.', 50, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(26, 'dell-laptop-sleeve', 'Dell Pro Sleeve 13\" Laptop Case Original Waterproof Cushion', 2899.00, 5500.00, '-47%', './Dell pro.avif', 4.8, 160, 330, 'Dell', 'Electronics', 'Original Dell protective laptop sleeve with soft fleece interior lining.', 14, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(27, 'bathroom-slippers', 'Non-Slip Washroom & Bathroom Slippers for Men & Women Quick-Dry', 229.00, 600.00, '-62%', './chapal.avif', 4.7, 840, 1900, 'ComfortFoot', 'Fashion', 'Ultra soft EVA anti-slip shower slides with drain holes for quick drying.', 110, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(28, 'chill-dumbbells', 'CHILL FITNESS Rubber Coated Dumbbells with Anti Slip Metal Handles', 182.00, 600.00, '-70%', './Dumbbells.avif', 4.9, 610, 1400, 'CHILL FITNESS', 'Sports & Fitness', 'Rubber hex dumbbell with knurled chrome steel handle for secure non-slip grip.', 70, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59'),
(29, 'screen-magnifier', 'F3 Mobile Screen Magnifier 3D Enlarged Display Stand for Smartphones', 460.00, 900.00, '-49%', './F3 Mobile.avif', 4.5, 220, 500, 'F3 Optics', 'Electronics', '3D HD phone screen amplifier stand that enlarges your phone screen 3-4 times.', 45, 0, 1, '2026-08-13 08:33:59', '2026-08-13 08:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'Ahmad123', 'ahmadislam0003@gmail.com', '$2y$10$0e4KALxQATNtOCNv9lZpOeXqxhfiAXHsMHF4b9TBuU/ejoOZ0J1ke', '2026-08-10 20:04:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
