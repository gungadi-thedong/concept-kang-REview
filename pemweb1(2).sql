-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2025 at 08:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pemweb1`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Laptop'),
(2, 'HP'),
(3, 'CPU'),
(4, 'GPU');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_review` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_review`, `id_user`, `username`, `komentar`) VALUES
(1, 1, 1, 'cj', 'gaskan beli gak sih'),
(2, 1, 1, 'cj', 'emang gg'),
(4, 1, 1, 'cj', 'dcrtf dcrfvtbghny '),
(5, 1, 1, 'cj', 'gk nyaangka bisa\r\n'),
(6, 1, 2, 'smokysmoke', 'thats my dog'),
(7, 1, 3, 'ninjastyle', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `id_user`, `password`, `permission`) VALUES
('cj', 1, 'ucokgrovestreet', 'penulis'),
('ninjastyle', 3, 'rydernibbaz', 'admin'),
('smokysmoke', 2, 'iambigsmoke', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_produk` varchar(55) NOT NULL,
  `nama_brand` varchar(35) NOT NULL,
  `nama_vendor` varchar(35) NOT NULL,
  `tanggal_rilis` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `nama_brand`, `nama_vendor`, `tanggal_rilis`) VALUES
(1, 4, 'RADEON MSI MECH 2X RX 6600 8G', 'MSI', 'AMD', '13 Oktober 2021');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id_review` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `judul` varchar(75) NOT NULL,
  `paragraf_buka` text NOT NULL,
  `gambar_1` varchar(75) NOT NULL,
  `paragraf_jelaskan` text NOT NULL,
  `paragraf_tutup` text NOT NULL,
  `gambar_2` varchar(75) NOT NULL,
  `rating` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id_review`, `id_user`, `id_produk`, `judul`, `paragraf_buka`, `gambar_1`, `paragraf_jelaskan`, `paragraf_tutup`, `gambar_2`, `rating`) VALUES
(1, 1, 1, 'RX 6600 Kartu budget terbaik sepanjang masa', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'rx-6600.jpg', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"', 'rx-gigabyte.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `review_test`
--

CREATE TABLE `review_test` (
  `id_review` int(11) NOT NULL,
  `nama_penulis` varchar(50) NOT NULL,
  `judul` text NOT NULL,
  `paragraf_buka` text NOT NULL,
  `gambar_1` varchar(100) NOT NULL,
  `paragraf_jelaskan` text NOT NULL,
  `paragraf_tutup` text NOT NULL,
  `gambar_2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review_test`
--

INSERT INTO `review_test` (`id_review`, `nama_penulis`, `judul`, `paragraf_buka`, `gambar_1`, `paragraf_jelaskan`, `paragraf_tutup`, `gambar_2`) VALUES
(3, 'ucok no 1', 'RX 6600', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'rx-gigabyte.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'rx-6600.jpg'),
(4, 'kontolodon ', 'SSD NVM 1TB BUDGET TERBAIK SEUMAT MANUSIA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget sollicitudin mauris. Cras iaculis enim ut sollicitudin lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nec purus venenatis sem dapibus facilisis. Nam non scelerisque sapien. Quisque suscipit nisi sit amet erat tempus consectetur. Maecenas quis dapibus nunc. Nullam enim odio, commodo a odio ut, vestibulum pulvinar arcu.', 'team-mp44L.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget sollicitudin mauris. Cras iaculis enim ut sollicitudin lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nec purus venenatis sem dapibus facilisis. Nam non scelerisque sapien. Quisque suscipit nisi sit amet erat tempus consectetur. Maecenas quis dapibus nunc. Nullam enim odio, commodo a odio ut, vestibulum pulvinar arcu.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget sollicitudin mauris. Cras iaculis enim ut sollicitudin lacinia. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas nec purus venenatis sem dapibus facilisis. Nam non scelerisque sapien. Quisque suscipit nisi sit amet erat tempus consectetur. Maecenas quis dapibus nunc. Nullam enim odio, commodo a odio ut, vestibulum pulvinar arcu.', 'team-mp44L-side.jpg'),
(5, 'kikir impek', 'SI MANTAP MASA GAK DI KANGENIN RX 7900 XTX', 'kartu impian gue  ni', 'rx-7900XTX.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget felis ultricies mauris pretium elementum quis a libero. Donec id nunc eu neque vestibulum condimentum. Donec sollicitudin mauris rutrum lacus venenatis egestas vulputate et nisi. Quisque eu aliquam ante, nec imperdiet nunc. Integer et dui non lacus aliquam vehicula. Praesent neque diam, aliquet imperdiet dui et, scelerisque dapibus nibh. Aliquam in dui ante. Pellentesque lobortis diam iaculis, tempor augue vitae, volutpat dolor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis in sodales orci, ut ultrices turpis. Integer semper justo sit amet lorem feugiat fermentum. Proin tincidunt porta nunc ut vulputate.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget felis ultricies mauris pretium elementum quis a libero. Donec id nunc eu neque vestibulum condimentum. Donec sollicitudin mauris rutrum lacus venenatis egestas vulputate et nisi. Quisque eu aliquam ante, nec imperdiet nunc. Integer et dui non lacus aliquam vehicula. Praesent neque diam, aliquet imperdiet dui et, scelerisque dapibus nibh. Aliquam in dui ante. Pellentesque lobortis diam iaculis, tempor augue vitae, volutpat dolor. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis in sodales orci, ut ultrices turpis. Integer semper justo sit amet lorem feugiat fermentum. Proin tincidunt porta nunc ut vulputate.', 'rx-7900XTX-sapphire-nitro.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email`) VALUES
(1, 'ucok', 'ucokgrove@gmail.com'),
(2, 'big smoke', 'smokecom'),
(3, 'ryder  nibba', 'iamageniusfool');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_review` (`id_review`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_login` (`username`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_user_2` (`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori_2` (`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id_review`),
  ADD UNIQUE KEY `id_produk` (`id_produk`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_produk_2` (`id_produk`);

--
-- Indexes for table `review_test`
--
ALTER TABLE `review_test`
  ADD PRIMARY KEY (`id_review`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_test`
--
ALTER TABLE `review_test`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_review`) REFERENCES `review` (`id_review`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_3` FOREIGN KEY (`username`) REFERENCES `login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
