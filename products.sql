-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 12:34 PM
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
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `category_id`) VALUES
(1, 'Galaxy S24 Ultra', 1299, 'Display: 6.8-inch Dynamic AMOLED 2X, 120Hz\r\nChipset: Snapdragon 8 Gen 3\r\nBattery:5000 mAh\r\nStorage: 256GB, 512GB, 1TB\r\nRAM: 12GB\r\nCameras: Rear: 200 MP main, 12 MP ultra-wide, 10 MP periscope telephoto (10x optical zoom), 10 MP telephoto (3x optical zoom) Front: 12 MP', 'Images/Samsung/galaxys24ultra.jpg', 1),
(2, 'Galaxy S23 Ultra', 1199, 'Display: 6.8-inch Dynamic AMOLED 2X, 120Hz\r\nChipset: Qualcomm Snapdragon 8 Gen 2\r\nBattery:5000 mAh\r\nStorage: 256GB, 512GB, 1TB\r\nRAM: 8GB (256GB model), 12GB (512GB and 1TB models)\r\nCameras: Rear: 200 MP main, 12 MP ultra-wide, 10 MP periscope telephoto (10x optical zoom), 10 MP telephoto (3x optical zoom) Front: 12 MP', 'Images/Samsung/galaxy-s23-ultra-lavender.webp', 1),
(3, 'Galaxy S22 Ultra', 1000, 'Display: 6.8-inch Dynamic AMOLED 2X, 120Hz\r\nChipset: Qualcomm Snapdragon 8 Gen 2\r\nBattery:5000 mAh\r\nStorage: 128GB, 256GB, 512GB\r\nRAM: 8GB (256GB model), 12GB (512GB and 1TB models)\r\nCameras: Rear: 108 MP main, 12 MP ultra-wide, 10 MP periscope telephoto (10x optical zoom), 10 MP telephoto (3x optical zoom) Front: 40 MP', 'Images/Samsung/Samsung-Galaxy-S22-Ultra.jpg', 1),
(4, 'Galaxy S21 Ultra', 900, 'Display: 6.8-inch Dynamic AMOLED 2X, 120Hz\r\nChipset: Qualcomm Snapdragon 888 (Exynos 2100 in some regions)\r\nBattery:5000 mAh\r\nStorage: 128GB, 256GB, 512GB\r\nRAM: 12GB (128GB/256GB models), 16GB (512GB model)\r\nCameras: Rear: 108 MP main, 12 MP ultra-wide, 10 MP periscope telephoto (10x optical zoom), 10 MP telephoto (3x optical zoom) Front: 40 MP', 'Images/Samsung/samsung-galaxy-s21-ultra.jpg', 1),
(5, 'Galaxy S10 Plus', 550, 'Display: 6.4-inch Dynamic AMOLED, 1440 x 3040 pixels, HDR10+\r\nChipset: Qualcomm Snapdragon 855 (Exynos 9820 in some regions)\r\nBattery:4100 mAh\r\nStorage: 128GB, 512GB, 1TB\r\nRAM: 8GB (128GB/512GB models), 12GB (1TB model)\r\nCameras: Rear: Triple Camera Setup: 12 MP main (wide), 12 MP telephoto (2x optical zoom), 16 MP ultra-wide Front: Dual Camera Setup: 10 MP main, 8 MP depth sensor', 'Images/Samsung/s10plus.jpeg', 1),
(6, 'Galaxy S9 Plus', 375, 'Display: 6.2-inch Super AMOLED, 1440 x 2960 pixels, HDR10\r\nChipset:Qualcomm Snapdragon 845 (Exynos 9810 in some regions)\r\nBattery:3500 mAh\r\nStorage: 64GB, 128GB, 256GB\r\nRAM: 6GB\r\nCameras: Rear: Dual Camera Setup: 12 MP main (wide), 12 MP telephoto (2x optical zoom) Front: 8 MP', 'Images/Samsung/s9plus.jpeg', 1),
(7, 'Galaxy S8 Plus', 275, 'Display: 6.2-inch Super AMOLED, 1440 x 2960 pixels, HDR10\r\nChipset:Qualcomm Snapdragon 835 (Exynos 8895 in some regions)\r\nBattery:3500 mAh\r\nStorage: 64GB, 128GB\r\nRAM: 4GB , 6GB\r\nCameras: Rear: 12 MP (wide) Front: 8 MP', 'Images/Samsung/s8plus.jpeg', 1),
(8, 'Galaxy Note 10 Plus', 600, 'Display:6.8-inch Dynamic AMOLED, 1440 x 3040 pixels, HDR10+\r\nChipset: Qualcomm Snapdragon 855 (Exynos 9825 in some regions)\r\nBattery:4300 mAh\r\nStorage: 256GB, 512GB\r\nRAM: 12GB\r\nCameras: Rear: Quad Camera Setup: 12 MP main (wide), 12 MP telephoto (2x optical zoom), 16 MP ultra-wide, 0.3 MP DepthVision (TOF) sensor Front: 10 MP', 'Images/Samsung/note10plus.jpeg', 1),
(9, 'Iphone 15 Pro Max', 1349, 'Display: 6.7-inch Super Retina XDR, ProMotion (120Hz)\r\nChip: A17 Pro Bionic\r\nBattery:4441mAh\r\nStorage: 128GB, 256GB, 512GB, 1TB\r\nRAM: 8GB\r\nCameras: Rear: 48 MP main, 12 MP ultra-wide, 12 MP telephoto (5x optical zoom) Front: 12 MP', 'Images/Iphones/Iphone15promax.webp', 2),
(10, 'Iphone 14', 900, 'Display: 6.1-inch Super Retina XDR\r\nChip: A15 Bionic\r\nBattery:3,279mAh\r\nStorage: 128GB, 256GB, 512GB\r\nRAM: 6GB\r\nCameras: Rear: 12 MP main, 12 MP ultra-wide Front: 12 MP', 'Images/Iphones/Iphone14.webp', 2),
(11, 'Iphone 13', 699, 'Display: 6.1-inch Super Retina XDR\r\nChip: A15 Bionic\r\nBattery:3,240 mAh\r\nStorage: 128GB, 256GB, 512GB\r\nRAM: 4GB\r\nCameras: Rear: 12 MP main, 12 MP ultra-wide Front: 12 MP', 'Images/Iphones/iPhone13.webp', 2),
(12, 'Iphone 12 Pro', 650, 'Display: 6.1-inch Super Retina XDR OLED, 1170 x 2532 pixels, HDR10, Dolby Vision\r\nChip: Apple A14 Bionic\r\nBattery:2815 mAh\r\nStorage: 128GB, 256GB, 512GB\r\nRAM: 6GB\r\nCameras: Rear: Triple Camera Setup: 12 MP main (wide), 12 MP telephoto (2x optical zoom), 12 MP ultra-wide, LiDAR scanner for depth sensing Front: 12 MP', 'Images/Iphones/iPhone-12-Pro-Max.webp', 2),
(13, 'Iphone 11 Pro Max', 570, 'Display:6.5-inch Super Retina XDR OLED, 1242 x 2688 pixels, HDR10, Dolby Vision\r\nChip: Apple A13 Bionic\r\nBattery:3969 mAh\r\nStorage: 64GB, 256GB, 512GB\r\nRAM: 4GB\r\nCameras: Rear: Triple Camera Setup: 12 MP main (wide), 12 MP telephoto (2x optical zoom), 12 MP ultra-wide Front: 12 MP', 'Images/Iphones/iphone11promax.jpeg', 2),
(14, 'Iphone X', 300, 'Display: 6.5-inch Super Retina XDR OLED, 1242 x 2688 pixels, HDR10, Dolby Vision\r\nBattery:2716 mAh\r\nStorage: 64GB, 256GB\r\nRAM: 4GB\r\nCameras: Rear: Dual Camera Setup: 12 MP main (wide), 12 MP telephoto (2x optical zoom) Front: 7 MP', 'Images/Iphones/iphonex.webp', 2),
(15, 'Iphone XR', 200, 'Display: 6.1-inch Liquid Retina IPS LCD, 828 x 1792 pixels\r\nBattery:2716 mAh\r\nStorage: 64GB, 128GB, 256GB\r\nRAM: 4GB\r\nCameras: Rear: 12 MP main (wide) Front: 7 MP', 'Images/Iphones/iphonexr.webp', 2),
(16, 'Airpods Pro 2', 220, 'Audio: Active Noise Cancellation, Transparency Mode, Adaptive Transparency\r\nChipset: Apple H2 chip\r\nBattery Life:Up to 6 hours of listening time with a single charge, up to 30 hours with the MagSafe Charging Case\r\nConnectivity: Bluetooth 5.3\r\nCharging: MagSafe Charging Case, Lightning connector, wireless charging', 'Images/Headphones/apple airpods pro 2.webp', 3),
(17, 'Airpods Pro', 250, 'Audio: Active Noise Cancellation, Transparency Mode\r\nChipset: Apple H1 chip\r\nBattery Life:Up to 4.5 hours of listening time with a single charge, up to 24 hours with the wireless charging case\r\nConnectivity: Bluetooth 5.0\r\nCharging: Wireless Charging Case, Lightning connector', 'Images/Headphones/Apple-AirPods-Pro.jpg', 3),
(18, 'Airpods Max', 200, 'Audio: Active Noise Cancellation, Transparency Mode, Adaptive EQ, Spatial Audio with dynamic head tracking\r\nChip: Apple H1 chip (in each ear cup)\r\nBattery Life:Up to 20 hours of high-fidelity audio, talk time, or movie playback with Active Noise Cancellation and Spatial Audio enabled\r\nConnectivity: Bluetooth 5.0\r\nCharging: Lightning connector; 5 minutes of charge provides around 1.5 hours of listening time', 'Images/Headphones/airpods-max.webp', 3),
(19, 'Fantech HQ54 MARS II Gaming Headset | HQ54', 100, 'Audio: 50mm neodymium drivers for clear and immersive sound, built-in microphone\r\nMicrophone: Flexible and detachable noise-cancelling microphone\r\nConnectivity: Wired with 3.5mm audio jack\r\nLighting: RGB lighting effects', 'Images/Headphones/hg54__04972.png', 3),
(20, 'Lenovo GM2Pro Gaming', 30, 'Sensor: Pixart PMW3389 optical sensor\r\nChipset: Apple H2 chip\r\nBattery Life:Up to 6 hours of listening time with a single charge, up to 30 hours with the MagSafe Charging Case\r\nConnectivity: Bluetooth 5.3\r\nCharging: MagSafe Charging Case, Lightning connector, wireless charging', 'Images/Headphones/Lenovo-GM2-Pro.webp', 3),
(21, 'HyperX Earbuds 2', 30, 'Design: In-ear with ergonomic design for comfort\r\nMicrophone: Built-in omnidirectional microphone\r\nCable: Detachable cable\r\nConnectivity: 3.5mm audio jack\r\nControls: Inline remote with volume control and microphone mute', 'Images/Headphones/71_RmW878EL._SL1500.webp', 3),
(23, 'HP Laptop i7-16GB, 512GB 15.6 inch', 550, 'Processor: Intel® Core™ i7-1165G7 (up to 4.7 GHz, 12 MB L3 cache, 4 cores) + Intel® Iris® Xe Graphics\r\nOperating System: Window 10\r\nStorage: 512GB PCIe® NVMe™ M.2 SSD\r\nMemory: 8GB RAM\r\nBattery Recharge Time: Supports battery fast charge: approximately 50% in 45 minutes', 'Images/Laptop/HPLabtop.webp', 4),
(29, 'Lenovo V15 G4 15.6\" FHD Laptop - Intel Core i5', 450, '\r\nProcessor: Intel® Core™ i5-13420H, 8C (4P + 4E) / 12T, P-core 2.1 / 4.6GHz, E-core 1.5 / 3.4GHz, 12MB\r\nOperating System: Window 10\r\nStorage: 512GB SSD M.2 2242 PCIe® 4.0x4 NVMe\r\nMemory: 8GB RAM\r\nGraphics: Integrated Intel® UHD Graphics', 'Images/Laptop/lenovov15.webp', 4),
(34, 'Macbook M1 Pro', 1200, 'Processor: 10-core CPU (8 Performance cores + 2 Efficiency cores), up to 16-core GPU\r\nOperating System: macOS (latest version available)\r\nStorage: 512GB SSD\r\nMemory: 16GB RAM\r\nGraphics: Integrated Apple GPU (varies with M1 Pro or M1 Max configuration)', 'Images/Laptop/macbook-pro.jpg.crdownload', 4),
(35, 'Macbook Pro M1 Max', 3500, 'Processor: 10-core CPU (8 Performance cores + 2 Efficiency cores), up to 32-core GPU\r\nOperating System: macOS (latest version available)\r\nStorage: 512GB SSD\r\nMemory: 16GB RAM\r\nGraphics: Integrated Apple GPU (varies with M1 Pro or M1 Max configuration)', 'Images/Laptop/MacbookProM1Max.webp', 4),
(36, 'Lenovo Legion 5 16IRX9 16\" WQXGA Laptop', 1300, 'Processor: Intel® Core™ i7-14650HX, 16C (8P + 8E) / 24T, P-core 2.2 / 5.2GHz, E-core 1.6 / 3.7GHz, 30MB\r\nOperating System: Window 10\r\nStorage: 512GB SSD\r\nMemory: 16GB RAM\r\nGraphics:NVIDIA® GeForce RTX™ 4060 8GB GDDR6, Boost Clock 2370MHz, TGP 140W, 233 AI TOPS\r\n', 'Images/Laptop/Lenovo Legion 5.webp', 4),
(37, 'LENOVO LOQ 15IRH8', 1170, 'Processor: I7-13620H 2.4GHZ\r\nOperating System: DOS\r\nStorage: 512GB SSD\r\nMemory: 16GB RAM\r\nSCREEN: 144HZ - FHD - 15.6\r\nGraphics:RTX4060-8GB', 'Images/Laptop/LENOVO LOQ 15IRH8.webp', 4),
(41, 'Ipad Pro 11', 770, 'Resolution: 2388 x 1688 pixels, 266 PPI\r\nProcessor:Octa-core\r\nStorage: 128GB, 256GB, 512GB, 1TB\r\nRAM: 8GB\r\nMain Camera: 12 MP (PDAF)\r\nSecond Camera: 10 MP (Ultra-wide)\r\nThird Camera: ToF 3D depth sensing', 'Images/Ipads/ipadpro11.webp', 5),
(42, 'Ipad Pro 11 M2', 730, 'Resolution: 2388 x 1688 pixels, 266 PPI\r\nBattery: Li-Po 7538 mAh (28.65 Wh), non-removable\r\nStorage: 128GB, 256GB\r\nRAM: 8GB\r\nDisplay Size:\"11.0\" inches 1668 x 2388 pixels\r\nPrimary Camera: Triple 12MP + 10MP + TOF 3D\r\nFront Camera: Single 12MP', 'Images/Ipads/ipadpro11.m2.webp', 5),
(43, 'Ipad Pro M4', 975, 'Resolution: 1668 x 2388 pixels (~265 ppi density)\r\nProcessor:Octa-core\r\nStorage: 128GB, 256GB, 512GB\r\nRAM: 8GB\r\nCamera: Front 12MP Ultra Wide Camera\r\nRear 12MP & 10MP Cameras', 'Images/Ipads/ipadpr0m4.webp', 5),
(44, 'Ipad Pro 13 M4', 1640, 'Resolution: 2752 x 2064 Screen\r\nProcessor:10-Core GPU | 16-Core Neural Engine\r\nStorage: 128GB, 256GB, 512GB\r\nRAM: 8GB\r\nCamera: Front & Rear 12MP Ultra Wide Cameras', 'Images/Ipads/ipadpr0m4.webp', 5),
(45, 'Ipad 10th Generation', 335, '10.9\" Liquid Retina display - True Tone\r\nA14 Bionic chip\r\nSuperfast downloads, high-quality streaming\r\nTouch ID\r\nCamera: 12MP Wide camera', 'Images/Ipads/ipad10gen.webp', 5),
(46, 'Ipad 9th Generation', 300, '2160 x 1620 Screen Resolution (264 ppi)\r\nApple A13 Bionic Chip\r\nSuperfast downloads, high-quality streaming\r\nTouch ID\r\nCamera: Front 12MP Ultra-Wide Camera & Rear 8MP Camera', 'Images/Ipads/ipad9gen.webp', 5),
(47, 'Ipad Air 5', 450, '10.9-inch Liquid Retina display with True Tone and P3 wide color\r\nApple A13 Bionic Chip\r\nUltra-thin and lightweight design for maximum portability\r\nTouch ID for secure authentication and Apple Pay\r\nCamera: 12MP back camera and 7MP FaceTime HD front camera', 'Images/Ipads/ipadair5.webp', 5),
(48, 'Ipad Air 13', 890, '2732 x 2048 Screen Resolution (264 ppi)\r\nApple M2 8-Core Chip\r\n10-Core GPU | 16-Core Neural Engine\r\n8GB of RAM\r\nStorage: 128GB, 256GB\r\nCamera: 12MP back camera and 7MP FaceTime HD front camera', 'Images/Ipads/ipadair5.webp', 5),
(49, 'Xiaomi Redmi Watch 3 Active', 35, 'Ultra large 1.83\" LCD display\r\nSupports Bluetooth phone call\r\nBluetooth: Bluetooth 5.3\r\n100+ fitness modes, including 10 professional sports modes (outdoor running, treadmill, outdoor cycling, walking, trekking, trail run, hiking, elliptical, rower, jump rope)', 'Images/SmartWactch/rdm-gr__60795.webp', 6),
(50, 'Apple Watch Ultra 2', 715, 'Always-On Retina display\r\nHealth & Safety: Blood Oxygen app ECG app High and low heart rate notifications Irregular rhythm notifications Temperature sensing Cycle tracking with retrospective ovulation estimates\r\nGPS & Connectivity: Precision dual-frequency GPS Cellular connectivity\r\nBattery Life: Up to 36 hours of normal use', 'Images/SmartWactch/shopping.webp', 6),
(51, 'Apple Watch Ultra', 850, 'Always-On Retina display\r\nHealth & Safety: Blood Oxygen app ECG app High and low heart rate notifications Irregular rhythm notifications Temperature sensing Cycle tracking with retrospective ovulation estimates\r\nGPS & Connectivity: Precision dual-frequency GPS Cellular connectivity\r\nBattery Life: Up to 36 hours of normal use', 'Images/SmartWactch/shopping (1).webp', 6),
(52, 'Apple Watch Series 9', 350, 'Always-On Retina display\r\nHealth & Safety: Blood Oxygen app ECG app High and low heart rate notifications Irregular rhythm notifications Low cardio notifications Temperature sensing\r\nGPS & Connectivity: Precision dual-frequency GPS Cellular connectivity\r\nBattery Life: Up to 18 hours of normal use', 'Images/SmartWactch/shopping (2).webp', 6),
(53, 'HK9 Ultra max smartwatch 49mm', 20, '454x454 pixels (326ppi)\r\nHealth & Safety: Blood Oxygen app ECG app High and low heart rate notifications Irregular rhythm notifications Temperature sensing Cycle tracking with retrospective ovulation estimates\r\nGPS & Connectivity: Precision dual-frequency GPS Cellular connectivity\r\nBattery Life: A full day including multiple hours of sport session**', 'Images/SmartWactch/download.jpeg', 6),
(54, 'S9 Ultra smartwatch', 30, '1.82-inch IPS high-definition320*380 IP68 Waterproof aluminium AlloyCNC process,electroplated anti-fingerprint reinforced mineral glass mirror Food grade silicone strap Chipset: Silan 7A20 Bluetooth Version: 5.0 Multip watchface for choosing,Dynamic watch face push,customize watch face food grade silicone strap Multip sports mode:walking,running,climbing,Riding,etc', 'Images/SmartWactch/shopping (5).webp', 6),
(55, 'Itel Smart watch 1 GS', 55, 'Body temprature detection\r\nPhysical Health Reminde\r\nIP68 waterproof\r\nHeart rate reminder\r\nItel Smart watch 1 GS All-Day Fitness Tracking', 'Images/SmartWactch/isw-41.jpg', 6),
(56, 'Itel Smart watch 1 GS', 55, 'Body temprature detection\r\nPhysical Health Reminde\r\nIP68 waterproof\r\nHeart rate reminder\r\nItel Smart watch 1 GS All-Day Fitness Tracking', 'Images/SmartWactch/m9015-8154a6.jpg', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
