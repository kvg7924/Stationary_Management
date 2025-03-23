
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_name`, `admin_email`, `admin_image`, `admin_password`) VALUES
(1, 'mihar', 'mihar@gmail.com', 'logo after 3d_2.png', '$2y$10$M/A/r5j/GSeJrAZxI8NtRu9eG5yNltfgTrfQVoClfSIF/pzNUXa2W'),
(4, 'nup', 'nup@gmail.com', 'IMG-20240722-WA0052.jpg', '$2y$10$h/4rV9sjF7sX2pnEOveLw.x4F6ChJlEl7F3ObRxKdWON6CQyeoWRy'),
(5, 'kvg', 'kvg@gmail.com', 'bgregister.png', '$2y$10$QyhAFg4Nmij/4xrOGXRRr.LorevBWvSfprlVJsJYiFoFpK3/8Xe/O');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(2, 'Casio'),
(4, 'Pentel'),
(5, 'Five Star'),
(6, 'Tri-Art Mfg'),
(14, 'Pelikan Erasers AS-40'),
(15, 'Faber-Castell'),
(16, 'Moleskine'),
(17, 'Stabilo');

-- --------------------------------------------------------

--
-- Table structure for table `card_details`
--

CREATE TABLE `card_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Notebooks '),
(2, 'Books'),
(3, 'Stationary'),
(4, 'Boards & Planning Tools'),
(5, 'Writing Instruments'),
(6, 'Art & Craft Supplies'),
(7, 'Calculators '),
(8, 'Pencils');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 1, 312346784, 1, 3, 'pending'),
(2, 1, 312346784, 2, 1, 'pending'),
(3, 1, 312346784, 4, 1, 'pending'),
(4, 1, 1918753782, 3, 2, 'pending'),
(5, 1, 351837813, 1, 2, 'pending'),
(6, 1, 410162768, 2, 1, 'pending'),
(7, 1, 1679698018, 3, 5, 'pending'),
(8, 1, 397854606, 2, 1, 'pending'),
(9, 1, 397854606, 3, 1, 'pending'),
(10, 1, 397854606, 9, 1, 'pending'),
(11, 1, 2054593820, 3, 1, 'pending'),
(12, 1, 775783111, 5, 1, 'pending'),
(13, 1, 775783111, 11, 1, 'pending'),
(14, 1, 1613463308, 1, 1, 'pending'),
(15, 1, 1613463308, 5, 1, 'pending'),
(16, 1, 1613463308, 7, 1, 'pending'),
(17, 1, 641033000, 8, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(120) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image_one` varchar(255) NOT NULL,
  `product_image_two` varchar(255) NOT NULL,
  `product_image_three` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image_one`, `product_image_two`, `product_image_three`, `product_price`, `date`, `status`) VALUES
(1, 'Scientific Calculator ', 'Handles algebra, trigonometry, logarithms, and exponential calculations.', 'Mathematical Functions Trigonometry (sin, cos, tan) Logarithms (log, ln)', 7, 2, 'CASIO WEW Worldwide Education Website.jfif', 'Casio FX-115 Advanced Scientific Calculator.jfif', 'Casio fx-570ES PLUS.jfif', 40, '2025-02-22 10:16:10', 'true'),
(2, 'Pencils', ' writing, sketching, shading, and technical drawing.', 'Graphite Core Wooden Pencil , Mechanical Pencil ,H B Scale (HB, 2B, 4B, H, 2H, etc.)', 8, 4, 'Tombow 2558 Pencil w_ Eraser - HB _ Single.jfif', 'Tombow 2558 Pencil w_ Eraser - HB _ Single.jfif', 'Custom engraved pencils, back to school pencils, personalized pencils, pencils with name, Ticonderoga pencils, teacher class set.jfif', 3, '2025-02-22 10:35:09', 'true'),
(3, 'Books ', 'A must-read book with an engaging story and premium quality print.', 'Fiction, Non-Fiction, Mystery, Romance, Thriller, Fantasy, Science Fiction, Biography, Self-Help, Historical Fiction', 2, 5, 'd38dd8c6-9c00-4efc-a334-2fd52050cad3.jfif', 'Download premium image of Huge bookshelf fullframe publication furniture bookcase_  about backgrounds, book, wooden, person, and furniture 12971452.jfif', 'Free Enchanting Book Stack Image _ Download at StockCake.jfif', 30, '2025-02-22 10:42:52', 'true'),
(4, 'Art & Craft ', 'Based in Kingston, Ontario, Tri-Art produces a wide range of paints and art materials.', 'DIY Art Kits ,Painting Supplies , Drawing Tools', 6, 6, 'ac40de77-ea95-4ba4-9f48-852445f7285b.jfif', 'a7825119-114d-4a76-a8ba-a74ae18e69e9.jfif', 'Desk Collection.jfif', 25, '2025-02-22 10:49:23', 'true'),
(5, 'Eraser', 'Premium Dust-Free Eraser – Smooth & Precise Erasing', 'soft eraser ', 3, 14, 'Untitled design.png', 'Untitled design (1).png', 'Untitled design.png', 5, '2025-03-16 15:46:52', 'true'),
(6, 'sharpener', 'Smooth, break-free sharpening for perfect points every time!', 'High-Quality Pencil Sharpener', 3, 15, '7677518.jpg', '25608.jpg', '46575.jpg', 5, '2025-03-16 15:53:20', 'true'),
(7, 'Notebooks ', ' Ideal for pen, pencil, and markers.', 'Premium Writing Notebook', 1, 16, 'Untitled design (3).png', 'Untitled design (4).png', 'Untitled design (3).png', 8, '2025-03-16 15:58:31', 'true'),
(8, 'Highlighters', 'Bright & Smooth Highlighters', 'Smudge-Free Highlighters', 3, 17, 'Untitled design (6).png', 'Untitled design (6).png', 'Untitled design (6).png', 5, '2025-03-16 16:03:26', 'true'),
(9, 'Acrylic Paints', 'long lasting paints ', 'easy to use ', 3, 5, 'Untitled design (7).png', 'Untitled design (7).png', 'Untitled design (7).png', 10, '2025-03-16 16:05:47', 'true'),
(10, 'Clipboards', 'Durable & Lightweight Clipboards ', 'Heavy-Duty Clipboard', 3, 16, 'Untitled design (8).png', 'Untitled design (8).png', 'Untitled design (8).png', 12, '2025-03-16 16:08:35', 'true'),
(11, 'Sticky Notes', 'Sticky Notes are small, rectangular or square ', 'small and accurate ', 3, 5, 'Untitled design (9).png', 'Untitled design (9).png', 'Untitled design (9).png', 3, '2025-03-16 16:25:11', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 1160, 312346784, 3, '2023-10-22 15:31:20', 'paid'),
(4, 1, 3, 410162768, 1, '2025-03-19 10:39:11', 'paid'),
(5, 1, 150, 1679698018, 1, '2025-02-24 12:16:29', 'pending'),
(6, 1, 43, 397854606, 3, '2025-03-19 08:13:32', 'pending'),
(7, 1, 30, 2054593820, 1, '2025-03-19 08:23:19', 'pending'),
(8, 1, 8, 775783111, 2, '2025-03-19 10:05:02', 'pending'),
(9, 1, 53, 1613463308, 3, '2025-03-19 10:26:56', 'pending'),
(10, 1, 5, 641033000, 1, '2025-03-19 12:10:57', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`) VALUES
(1, 'mihar', 'mihar@gmail.com', '$2y$10$5ynby9fq7wf2ZmHlkvehu.JGbK6r7zZLtLzuJz9Jt5FP03rGZ9Mj.', 'new logo after Edit1920.png', '::1', 'Cairo', '123456789'),
(4, 'kvg', 'kvg@gmail.com', '$2y$10$nyKGnKwwDljapPtw6lplXeJ.lgxfl3fz/uc/NOxpD51pEUhopPFjO', 'bgregister.png', '::1', 'kvg', 'kvg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `card_details`
--
ALTER TABLE `card_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
