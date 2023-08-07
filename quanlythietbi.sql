-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 18, 2019 lúc 11:05 AM
-- Phiên bản máy phục vụ: 10.3.16-MariaDB
-- Phiên bản PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlythietbi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bieumau`
--

CREATE TABLE `bieumau` (
  `id` int(11) NOT NULL,
  `tenbieumau` text COLLATE utf8_unicode_ci NOT NULL,
  `ngaylap` date NOT NULL,
  `url` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `duyetl1` tinyint(1) DEFAULT NULL,
  `duyetl2` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donvi`
--

CREATE TABLE `donvi` (
  `id` int(11) NOT NULL,
  `tendonvi` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `tenviettat` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `donvi`
--

INSERT INTO `donvi` (`id`, `tendonvi`, `tenviettat`) VALUES
(1, 'Khoa công nghệ thông tin', 'CNTT'),
(2, 'Khoa cơ khí', 'CK'),
(19, 'Khoa điện - điện tử', 'DDT'),
(20, 'Khoa công nghệ thực phẩm', 'CNTP'),
(21, 'Khoa ô tô', 'OTO'),
(22, 'Khoa thú y', 'TY');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsumaymocthietbi`
--

CREATE TABLE `lichsumaymocthietbi` (
  `id` int(11) NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay` date NOT NULL,
  `mammtb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lichsuthietbidogo`
--

CREATE TABLE `lichsuthietbidogo` (
  `id` int(11) NOT NULL,
  `noidung` text COLLATE utf8_unicode_ci NOT NULL,
  `ngay` date NOT NULL,
  `matbdg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaimaymocthietbi`
--

CREATE TABLE `loaimaymocthietbi` (
  `id` int(11) NOT NULL,
  `tenloai` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaitaikhoan`
--

CREATE TABLE `loaitaikhoan` (
  `id` int(11) NOT NULL,
  `tenloai` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `mota` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaithietbidogo`
--

CREATE TABLE `loaithietbidogo` (
  `id` int(11) NOT NULL,
  `tenloai` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `maymocthietbi`
--

CREATE TABLE `maymocthietbi` (
  `id` int(11) NOT NULL,
  `tentb` text COLLATE utf8_unicode_ci NOT NULL,
  `maso` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mota` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `namsd` date DEFAULT NULL,
  `nguongoc` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `donvitinh` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `gia` double DEFAULT NULL,
  `chatluong` int(11) DEFAULT NULL,
  `ghichu` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `matinhtrang` int(11) DEFAULT NULL,
  `maphongkho` int(11) DEFAULT NULL,
  `malichsu` int(11) DEFAULT NULL,
  `maloai` int(11) DEFAULT NULL,
  `manhom` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhommaymocthietbi`
--

CREATE TABLE `nhommaymocthietbi` (
  `id` int(11) NOT NULL,
  `tennhom` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phong_kho`
--

CREATE TABLE `phong_kho` (
  `id` int(11) NOT NULL,
  `maphong` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `tenphong` text COLLATE utf8_unicode_ci NOT NULL,
  `khu` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lau` int(11) DEFAULT NULL,
  `sophong` int(11) DEFAULT NULL,
  `magvql` int(11) NOT NULL,
  `madonvi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quyenhan`
--

CREATE TABLE `quyenhan` (
  `id` int(11) NOT NULL,
  `tenquyenhan` text COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `hoten` text COLLATE utf8_unicode_ci NOT NULL,
  `cmnd` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `matkhau` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `chucvu` text COLLATE utf8_unicode_ci DEFAULT 'NULL',
  `maloaitk` int(11) NOT NULL,
  `maquyen` int(11) NOT NULL,
  `madonvi` int(11) NOT NULL,
  `hinhanh` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thietbidogo`
--

CREATE TABLE `thietbidogo` (
  `id` int(11) NOT NULL,
  `tenthietbi` text COLLATE utf8_unicode_ci NOT NULL,
  `maso` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `namsd` date DEFAULT NULL,
  `nguongoc` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `donvitinh` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `gia` tinyint(1) DEFAULT NULL,
  `chatluong` int(11) DEFAULT NULL,
  `ghichu` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `matinhtrang` int(11) DEFAULT NULL,
  `maphongkho` int(11) DEFAULT NULL,
  `malichsu` int(11) DEFAULT NULL,
  `maloai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tinhtrangthietbi`
--

CREATE TABLE `tinhtrangthietbi` (
  `id` int(11) NOT NULL,
  `tinhtrang` text COLLATE utf8_unicode_ci NOT NULL,
  `mota` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bieumau`
--
ALTER TABLE `bieumau`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `donvi`
--
ALTER TABLE `donvi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lichsumaymocthietbi`
--
ALTER TABLE `lichsumaymocthietbi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `lichsuthietbidogo`
--
ALTER TABLE `lichsuthietbidogo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaimaymocthietbi`
--
ALTER TABLE `loaimaymocthietbi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaitaikhoan`
--
ALTER TABLE `loaitaikhoan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaithietbidogo`
--
ALTER TABLE `loaithietbidogo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `maymocthietbi`
--
ALTER TABLE `maymocthietbi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mmtb_nhommmtb` (`manhom`),
  ADD KEY `fk_mmtb_tinhtrang` (`matinhtrang`),
  ADD KEY `fk_mmtb_phongkho` (`maphongkho`),
  ADD KEY `fk_mmtb_lichsu` (`malichsu`),
  ADD KEY `fk_mmtb_loaimmtb` (`maloai`);

--
-- Chỉ mục cho bảng `nhommaymocthietbi`
--
ALTER TABLE `nhommaymocthietbi`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `phong_kho`
--
ALTER TABLE `phong_kho`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `maphong` (`maphong`),
  ADD KEY `fk_phong_taikhoan` (`magvql`),
  ADD KEY `fk_phong_donvi` (`madonvi`);

--
-- Chỉ mục cho bảng `quyenhan`
--
ALTER TABLE `quyenhan`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_taikhoan_loaitaikhoan` (`maloaitk`),
  ADD KEY `fk_taikhoan_quyenhan` (`maquyen`),
  ADD KEY `fk_taikhoan_donvi` (`madonvi`);

--
-- Chỉ mục cho bảng `thietbidogo`
--
ALTER TABLE `thietbidogo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbdg_tinhtrang` (`matinhtrang`),
  ADD KEY `fk_tbdg_phongkho` (`maphongkho`),
  ADD KEY `fk_tbdg_lichsu` (`malichsu`),
  ADD KEY `fk_tbdg_loaitbdg` (`maloai`);

--
-- Chỉ mục cho bảng `tinhtrangthietbi`
--
ALTER TABLE `tinhtrangthietbi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bieumau`
--
ALTER TABLE `bieumau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `donvi`
--
ALTER TABLE `donvi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `lichsumaymocthietbi`
--
ALTER TABLE `lichsumaymocthietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `lichsuthietbidogo`
--
ALTER TABLE `lichsuthietbidogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loaimaymocthietbi`
--
ALTER TABLE `loaimaymocthietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loaitaikhoan`
--
ALTER TABLE `loaitaikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `loaithietbidogo`
--
ALTER TABLE `loaithietbidogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `maymocthietbi`
--
ALTER TABLE `maymocthietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `nhommaymocthietbi`
--
ALTER TABLE `nhommaymocthietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `phong_kho`
--
ALTER TABLE `phong_kho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `quyenhan`
--
ALTER TABLE `quyenhan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `thietbidogo`
--
ALTER TABLE `thietbidogo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tinhtrangthietbi`
--
ALTER TABLE `tinhtrangthietbi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `maymocthietbi`
--
ALTER TABLE `maymocthietbi`
  ADD CONSTRAINT `fk_mmtb_lichsu` FOREIGN KEY (`malichsu`) REFERENCES `lichsumaymocthietbi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mmtb_loaimmtb` FOREIGN KEY (`maloai`) REFERENCES `loaimaymocthietbi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mmtb_nhommmtb` FOREIGN KEY (`manhom`) REFERENCES `nhommaymocthietbi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mmtb_phongkho` FOREIGN KEY (`maphongkho`) REFERENCES `phong_kho` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mmtb_tinhtrang` FOREIGN KEY (`matinhtrang`) REFERENCES `tinhtrangthietbi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `phong_kho`
--
ALTER TABLE `phong_kho`
  ADD CONSTRAINT `fk_phong_donvi` FOREIGN KEY (`madonvi`) REFERENCES `donvi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_phong_taikhoan` FOREIGN KEY (`magvql`) REFERENCES `taikhoan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD CONSTRAINT `fk_taikhoan_donvi` FOREIGN KEY (`madonvi`) REFERENCES `donvi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_taikhoan_loaitaikhoan` FOREIGN KEY (`maloaitk`) REFERENCES `loaitaikhoan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_taikhoan_quyenhan` FOREIGN KEY (`maquyen`) REFERENCES `quyenhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `thietbidogo`
--
ALTER TABLE `thietbidogo`
  ADD CONSTRAINT `fk_tbdg_lichsu` FOREIGN KEY (`malichsu`) REFERENCES `lichsuthietbidogo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbdg_loaitbdg` FOREIGN KEY (`maloai`) REFERENCES `loaithietbidogo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbdg_phongkho` FOREIGN KEY (`maphongkho`) REFERENCES `phong_kho` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tbdg_tinhtrang` FOREIGN KEY (`matinhtrang`) REFERENCES `tinhtrangthietbi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
