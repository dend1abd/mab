-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2016 at 04:56 PM
-- Server version: 5.5.47-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_config`
--

CREATE TABLE IF NOT EXISTS `app_config` (
  `id` int(11) NOT NULL,
  `jurnal_purchase_tunai_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_tunai_kredit` varchar(50) DEFAULT NULL,
  `jurnal_purchase_hutang_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_hutang_kredit` varchar(50) DEFAULT NULL,
  `jurnal_purchase_disc_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_disc_kredit` varchar(50) DEFAULT NULL,
  `jurnal_purchase_ppn_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_ppn_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_tunai_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_tunai_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_piutang_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_piutang_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_disc_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_disc_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_ppn_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_ppn_kredit` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_tunai_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_tunai_kredit` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_piutang_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_piutang_kredit` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_disc_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_disc_kredit` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_ppn_debet` varchar(50) DEFAULT NULL,
  `jurnal_purchase_return_ppn_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_tunai_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_tunai_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_hutang_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_hutang_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_disc_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_disc_kredit` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_ppn_debet` varchar(50) DEFAULT NULL,
  `jurnal_sales_return_ppn_kredit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_config`
--

INSERT INTO `app_config` (`id`, `jurnal_purchase_tunai_debet`, `jurnal_purchase_tunai_kredit`, `jurnal_purchase_hutang_debet`, `jurnal_purchase_hutang_kredit`, `jurnal_purchase_disc_debet`, `jurnal_purchase_disc_kredit`, `jurnal_purchase_ppn_debet`, `jurnal_purchase_ppn_kredit`, `jurnal_sales_tunai_debet`, `jurnal_sales_tunai_kredit`, `jurnal_sales_piutang_debet`, `jurnal_sales_piutang_kredit`, `jurnal_sales_disc_debet`, `jurnal_sales_disc_kredit`, `jurnal_sales_ppn_debet`, `jurnal_sales_ppn_kredit`, `jurnal_purchase_return_tunai_debet`, `jurnal_purchase_return_tunai_kredit`, `jurnal_purchase_return_piutang_debet`, `jurnal_purchase_return_piutang_kredit`, `jurnal_purchase_return_disc_debet`, `jurnal_purchase_return_disc_kredit`, `jurnal_purchase_return_ppn_debet`, `jurnal_purchase_return_ppn_kredit`, `jurnal_sales_return_tunai_debet`, `jurnal_sales_return_tunai_kredit`, `jurnal_sales_return_hutang_debet`, `jurnal_sales_return_hutang_kredit`, `jurnal_sales_return_disc_debet`, `jurnal_sales_return_disc_kredit`, `jurnal_sales_return_ppn_debet`, `jurnal_sales_return_ppn_kredit`) VALUES
(1, '111', '11', '222', '222', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `combo_data`
--

CREATE TABLE IF NOT EXISTS `combo_data` (
  `kode` varchar(50) NOT NULL,
  `query` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `combo_data`
--

INSERT INTO `combo_data` (`kode`, `query`) VALUES
('rsArtikel', 'select kodereff, reff from mst_reff where tipereff=23 order by reff'),
('rsCustomer', 'SELECT contact_code, CONCAT(contact_code,'' - '', contact_name) FROM mst_contact where contact_tipe = 3'),
('rsGudang', 'SELECT contact_code, CONCAT(contact_code,'' - '', contact_name) FROM mst_contact where contact_tipe = 5'),
('rsJenisBarang', 'select kodereff, reff from mst_reff where tipereff=17 order by reff'),
('rsJenisKelamin', 'select kodereff, reff from mst_reff where tipereff=19 order by reff'),
('rsKaryawan', 'SELECT contact_code, CONCAT(contact_code,'' - '', contact_name) FROM mst_contact where contact_tipe = 4'),
('rsKelBarang', 'select kodereff, reff from mst_reff where tipereff=16 order by reff'),
('rsKelBeli', 'select kodereff, reff from mst_reff where tipereff=21 order by reff'),
('rsKelJual', 'select kodereff, reff from mst_reff where tipereff=21 order by reff'),
('rsKelSize', 'select kode_size, kode_size from mst_size order by kode_size'),
('rsKota', 'select kodereff, reff from mst_reff where tipereff=11 order by reff'),
('rsMerekBarang', 'select kodereff, reff from mst_reff where tipereff=18 order by reff'),
('rsMesin', 'select kodereff, reff from mst_reff where tipereff=22 order by reff'),
('rsNegara', 'select kodereff, reff from mst_reff where tipereff=12 order by reff'),
('rsSatBarang', 'select kodereff, reff from mst_reff where tipereff=24 order by reff'),
('rsStatusKerja', 'select kodereff, reff from mst_reff where tipereff=20 order by reff'),
('rsSupplier', 'SELECT contact_code, CONCAT(contact_code,'' - '', contact_name) FROM mst_contact where contact_tipe = 2'),
('rsUnitBarang', 'select kodereff, reff from mst_reff where tipereff=25 order by reff'),
('rsWarna', 'select kodereff, reff from mst_reff where tipereff=14 order by reff');

-- --------------------------------------------------------

--
-- Table structure for table `form_generator`
--

CREATE TABLE IF NOT EXISTS `form_generator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formNo` int(11) DEFAULT NULL,
  `tableName` varchar(50) DEFAULT NULL,
  `sortNo` int(11) DEFAULT NULL,
  `TitleName` varchar(50) DEFAULT NULL,
  `FieldName` varchar(50) DEFAULT NULL,
  `FieldType` varchar(50) DEFAULT NULL,
  `FieldLen` int(11) DEFAULT NULL,
  `FieldInput` varchar(50) DEFAULT NULL,
  `ComboData` varchar(51) DEFAULT NULL,
  `isMandatory` varchar(20) DEFAULT NULL,
  `disableEdit` varchar(20) DEFAULT NULL,
  `other` varchar(20) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `kolom` int(11) DEFAULT NULL,
  `haveSum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=383 ;

--
-- Dumping data for table `form_generator`
--

INSERT INTO `form_generator` (`id`, `formNo`, `tableName`, `sortNo`, `TitleName`, `FieldName`, `FieldType`, `FieldLen`, `FieldInput`, `ComboData`, `isMandatory`, `disableEdit`, `other`, `section`, `kolom`, `haveSum`) VALUES
(16, 2, 'customer', 1, 'Kode Customer', 'contact_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(17, 2, 'customer', 2, 'Nama Customer', 'contact_name', 'varchar', 100, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(18, 2, 'customer', 3, 'Alamat', 'alamat', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 2, 'customer', 4, 'Kota', 'kota', 'varchar', 50, 'combobox', 'rsKota', '1', NULL, NULL, NULL, NULL, NULL),
(20, 2, 'customer', 5, 'Kodepos', 'kode_pos', 'varchar', 10, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 2, 'customer', 6, 'Negara', 'negara', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 2, 'customer', 7, 'Telp', 'telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 2, 'customer', 8, 'Fax', 'fax', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 2, 'customer', 9, 'Email', 'email', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 2, 'customer', 10, 'Website', 'website', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 2, 'customer', 11, 'Hubungi', 'hubungi_nama', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 2, 'customer', 12, 'Telp Hubungi', 'hubungi_telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 2, 'customer', 13, 'No Rekening', 'no_rek', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 2, 'customer', 14, 'NPWP', 'npwp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 2, 'customer', 15, 'Keterangan', 'ket', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 3, 'supplier', 1, 'Kode Supplier', 'contact_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(32, 3, 'supplier', 2, 'Nama Supplier', 'contact_name', 'varchar', 100, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(33, 3, 'supplier', 3, 'Alamat', 'alamat', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 3, 'supplier', 4, 'Kota', 'kota', 'varchar', 50, 'combobox', 'rsKota', '1', NULL, NULL, NULL, NULL, NULL),
(35, 2, 'supplier', 5, 'Kodepos', 'kode_pos', 'varchar', 10, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 3, 'supplier', 6, 'Negara', 'negara', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 3, 'supplier', 7, 'Telp', 'telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 3, 'supplier', 8, 'Fax', 'fax', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 3, 'supplier', 9, 'Email', 'email', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 3, 'supplier', 10, 'Website', 'website', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 3, 'supplier', 11, 'Hubungi', 'hubungi_nama', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 3, 'supplier', 12, 'Telp Hubungi', 'hubungi_telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 3, 'supplier', 13, 'No Rekening', 'no_rek', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 3, 'supplier', 14, 'NPWP', 'npwp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 3, 'supplier', 15, 'Keterangan', 'ket', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 4, 'karyawan', 1, 'NIK', 'contact_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(47, 4, 'karyawan', 2, 'Nama Karyawan', 'contact_name', 'varchar', 255, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(48, 4, 'karyawan', 3, 'Jenis Kelamin', 'jenis_kelamin', 'varchar', 1, 'combobox', 'rsJenisKelamin', NULL, NULL, NULL, NULL, NULL, NULL),
(49, 4, 'karyawan', 4, 'Tgl Lahir', 'tgl_lahir', 'date', 20, 'datepicker', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 4, 'karyawan', 5, 'Alamat', 'alamat', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 4, 'karyawan', 6, 'Tgl Masuk', 'tgl_masuk', 'date', 20, 'datepicker', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 4, 'karyawan', 7, 'Status Kerja', 'status_kerja', 'varchar', 20, 'combobox', 'rsStatusKerja', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 4, 'karyawan', 8, 'Jabatan', 'jabatan', 'varchar', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 4, 'karyawan', 9, 'No Rekening', 'no_rek', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 4, 'karyawan', 10, 'NPWP', 'npwp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 4, 'karyawan', 11, 'Keterangan', 'ket', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 5, 'trx_terima', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(58, 5, 'trx_terima', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(59, 5, 'trx_terima', 3, 'Gudang', 'gudang_kode', 'varchar', 50, 'combobox', 'rsGudang', NULL, NULL, NULL, 1, 2, NULL),
(60, 5, 'trx_terima', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(61, 5, 'trx_terima', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(62, 6, 'trx_terima_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(63, 6, 'trx_terima_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(64, 6, 'trx_terima_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(65, 6, 'trx_terima_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(66, 6, 'trx_terima_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(67, 6, 'trx_terima_detail', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(68, 6, 'trx_terima_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(69, 6, 'trx_terima_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(70, 6, 'trx_terima_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 7, 'trx_gudang_bahan_in', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(72, 7, 'trx_gudang_bahan_in', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(73, 7, 'trx_gudang_bahan_in', 3, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(74, 7, 'trx_gudang_bahan_in', 4, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(75, 8, 'trx_gudang_bahan_in_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(76, 8, 'trx_gudang_bahan_in_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(77, 8, 'trx_gudang_bahan_in_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(78, 8, 'trx_gudang_bahan_in_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(79, 8, 'trx_gudang_bahan_in_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(80, 8, 'trx_gudang_bahan_in_detail', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(81, 8, 'trx_gudang_bahan_in_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(82, 8, 'trx_gudang_bahan_in_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(83, 8, 'trx_gudang_bahan_in_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 9, 'trx_gudang_bahan_out', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(85, 9, 'trx_gudang_bahan_out', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(86, 9, 'trx_gudang_bahan_out', 3, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(87, 9, 'trx_gudang_bahan_out', 4, 'Penerima', 'petugas_kode2', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(88, 9, 'trx_gudang_bahan_out', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(89, 10, 'trx_gudang_bahan_out_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(90, 10, 'trx_gudang_bahan_out_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(91, 10, 'trx_gudang_bahan_out_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(92, 10, 'trx_gudang_bahan_out_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(93, 10, 'trx_gudang_bahan_out_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(94, 10, 'trx_gudang_bahan_out_detail', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(95, 10, 'trx_gudang_bahan_out_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(96, 10, 'trx_gudang_bahan_out_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(97, 10, 'trx_gudang_bahan_out_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 11, 'trx_keluar', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(99, 11, 'trx_keluar', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(100, 11, 'trx_keluar', 3, 'Gudang', 'gudang_kode', 'varchar', 50, 'combobox', 'rsGudang', NULL, NULL, NULL, 1, 2, NULL),
(101, 11, 'trx_keluar', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(102, 11, 'trx_keluar', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(103, 12, 'trx_keluar_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(104, 12, 'trx_keluar_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(105, 12, 'trx_keluar_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(106, 12, 'trx_keluar_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(107, 12, 'trx_keluar_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(108, 12, 'trx_keluar_detail', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(109, 12, 'trx_keluar_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(110, 12, 'trx_keluar_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(111, 12, 'trx_keluar_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 13, 'trx_beli_non_order', 1, 'No. Nota Beli', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(113, 13, 'trx_beli_non_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(114, 13, 'trx_beli_non_order', 3, 'Divisi', 'kode_divisi', 'varchar', 50, 'combobox', 'rsArtikel', '1', '1', NULL, 1, 1, NULL),
(115, 13, 'trx_beli_non_order', 4, 'Supplier', 'contact_code', 'varchar', 50, 'combobox', 'rsSupplier', '1', NULL, NULL, 1, 2, NULL),
(116, 13, 'trx_beli_non_order', 5, 'No. Nota Supplier', 'no_invoice', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(117, 13, 'trx_beli_non_order', 6, 'Tgl Nota Supplier', 'tgl_invoice', 'varchar', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(118, 13, 'trx_beli_non_order', 7, 'Petugas', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(119, 13, 'trx_beli_non_order', 8, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(120, 13, 'trx_beli_non_order', 9, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(121, 13, 'trx_beli_non_order', 10, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(122, 13, 'trx_beli_non_order', 11, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(123, 13, 'trx_beli_non_order', 12, 'Netto', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(124, 13, 'trx_beli_non_order', 13, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(125, 13, 'trx_beli_non_order', 14, 'Sisa', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(126, 13, 'trx_beli_non_order', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(127, 14, 'trx_beli_non_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(128, 14, 'trx_beli_non_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(129, 14, 'trx_beli_non_order_detail', 4, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(130, 14, 'trx_beli_non_order_detail', 5, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(131, 14, 'trx_beli_non_order_detail', 6, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(132, 14, 'trx_beli_non_order_detail', 7, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 14, 'trx_beli_non_order_detail', 8, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(134, 14, 'trx_beli_non_order_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(135, 14, 'trx_beli_non_order_detail', 10, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 15, 'trx_retur_beli', 1, 'No Retur Pembelian', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(137, 15, 'trx_retur_beli', 2, 'Tgl Retur Pembelian', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(138, 15, 'trx_retur_beli', 3, 'Supplier', 'contact_code', 'varchar', 50, 'combobox', 'rsSupplier', '1', NULL, NULL, 1, 1, NULL),
(139, 15, 'trx_retur_beli', 4, 'Divisi', 'kode_divisi', 'varchar', 50, 'combobox', 'rsArtikel', NULL, '1', NULL, 1, 1, NULL),
(140, 15, 'trx_retur_beli', 5, 'Kode Pembelian', 'no_reff', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, 1, 2, NULL),
(141, 15, 'trx_retur_beli', 6, 'Tgl Pembelian', 'tgl_reff', 'date', 50, 'datepicker', NULL, '1', NULL, NULL, 1, 2, NULL),
(142, 15, 'trx_retur_beli', 7, 'No Invoice', 'no_invoice', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(143, 15, 'trx_retur_beli', 8, 'Tgl Invoice', 'tgl_invoice', 'date', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(144, 15, 'trx_retur_beli', 9, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(145, 15, 'trx_retur_beli', 10, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(146, 15, 'trx_retur_beli', 11, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(147, 15, 'trx_retur_beli', 12, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(148, 15, 'trx_retur_beli', 13, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', '1', NULL, 2, 2, NULL),
(149, 15, 'trx_retur_beli', 14, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(150, 15, 'trx_retur_beli', 15, 'Hutang', 'sisa', 'money', 30, 'textbox', NULL, '1', '1', NULL, 2, 2, NULL),
(151, 15, 'trx_retur_beli', 16, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(152, 16, 'trx_retur_beli_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(153, 16, 'trx_retur_beli_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(154, 16, 'trx_retur_beli_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(155, 16, 'trx_retur_beli_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(156, 16, 'trx_retur_beli_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(157, 16, 'trx_retur_beli_detail', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 16, 'trx_retur_beli_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(159, 16, 'trx_retur_beli_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(160, 16, 'trx_retur_beli_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 17, 'trx_order_jual', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(162, 17, 'trx_order_jual', 2, 'Tgl Order', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(163, 17, 'trx_order_jual', 3, 'Divisi', 'kode_divisi', 'varchar', 50, 'combobox', 'rsArtikel', '1', '1', NULL, 1, 1, NULL),
(164, 17, 'trx_order_jual', 4, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 2, NULL),
(165, 17, 'trx_order_jual', 5, 'Rencana Tgl Kirim', 'tgl_reff', 'date', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(166, 17, 'trx_order_jual', 6, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(167, 17, 'trx_order_jual', 7, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(168, 17, 'trx_order_jual', 8, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(169, 17, 'trx_order_jual', 9, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(170, 17, 'trx_order_jual', 10, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(171, 17, 'trx_order_jual', 11, 'Biaya Kirim', 'biaya_kirim', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(172, 17, 'trx_order_jual', 12, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(173, 17, 'trx_order_jual', 13, 'Uang Muka', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(174, 17, 'trx_order_jual', 14, 'Sisa', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(175, 17, 'trx_order_jual', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(176, 18, 'trx_order_jual_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(177, 18, 'trx_order_jual_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(178, 18, 'trx_order_jual_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(179, 18, 'trx_order_jual_detail', 5, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(180, 18, 'trx_order_jual_detail', 6, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(181, 18, 'trx_order_jual_detail', 7, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 18, 'trx_order_jual_detail', 8, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(183, 18, 'trx_order_jual_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(184, 18, 'trx_order_jual_detail', 10, 'Ket', 'ket_detail', 'varchar', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 19, 'trx_jual_by_order', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(186, 19, 'trx_jual_by_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(187, 19, 'trx_jual_by_order', 5, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 1, NULL),
(188, 19, 'trx_jual_by_order', 6, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(189, 19, 'trx_jual_by_order', 9, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(190, 19, 'trx_jual_by_order', 10, 'Discount', 'disc_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(191, 19, 'trx_jual_by_order', 11, 'PPN %', 'ppn_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(192, 19, 'trx_jual_by_order', 12, 'PPN', 'ppn_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(193, 19, 'trx_jual_by_order', 13, 'Biaya Kirim', 'biaya_kirim', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(194, 19, 'trx_jual_by_order', 14, 'Total', 'total', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(195, 19, 'trx_jual_by_order', 15, 'Pembayaran', 'bayar', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(196, 19, 'trx_jual_by_order', 16, 'Sisa', 'sisa', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(197, 19, 'trx_jual_by_order', 17, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(198, 20, 'trx_jual_by_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(199, 20, 'trx_jual_by_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(200, 20, 'trx_jual_by_order_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(201, 20, 'trx_jual_by_order_detail', 5, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(202, 20, 'trx_jual_by_order_detail', 6, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(203, 20, 'trx_jual_by_order_detail', 7, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 20, 'trx_jual_by_order_detail', 8, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(205, 20, 'trx_jual_by_order_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(206, 20, 'trx_jual_by_order_detail', 10, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 20, 'trx_jual_by_order_detail', 11, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 21, 'trx_jual_non_order', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(209, 21, 'trx_jual_non_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(210, 21, 'trx_jual_non_order', 5, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 2, NULL),
(211, 21, 'trx_jual_non_order', 6, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(212, 21, 'trx_jual_non_order', 7, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(213, 21, 'trx_jual_non_order', 8, 'Discount', 'disc_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(214, 21, 'trx_jual_non_order', 9, 'PPN %', 'ppn_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(215, 21, 'trx_jual_non_order', 10, 'PPN', 'ppn_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(216, 21, 'trx_jual_non_order', 11, 'Biaya Kirim', 'biaya_kirim', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(217, 21, 'trx_jual_non_order', 12, 'Total', 'total', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(218, 21, 'trx_jual_non_order', 13, 'Pembayaran', 'bayar', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(219, 21, 'trx_jual_non_order', 14, 'Sisa', 'sisa', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(220, 21, 'trx_jual_non_order', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(221, 22, 'trx_jual_non_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(222, 22, 'trx_jual_non_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(223, 22, 'trx_jual_non_order_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(224, 22, 'trx_jual_non_order_detail', 5, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(225, 22, 'trx_jual_non_order_detail', 6, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(226, 22, 'trx_jual_non_order_detail', 7, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 22, 'trx_jual_non_order_detail', 8, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(228, 22, 'trx_jual_non_order_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(229, 22, 'trx_jual_non_order_detail', 10, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 23, 'trx_retur_jual', 1, 'No Retur Penjualan', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(231, 23, 'trx_retur_jual', 2, 'Tgl Retur Penjualan', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(232, 23, 'trx_retur_jual', 3, 'No Faktur', 'no_reff', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, 1, 1, NULL),
(233, 23, 'trx_retur_jual', 4, 'Tgl Faktur', 'tgl_reff', 'varchar', 50, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(234, 23, 'trx_retur_jual', 6, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 2, NULL),
(235, 23, 'trx_retur_jual', 7, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(236, 23, 'trx_retur_jual', 10, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(237, 23, 'trx_retur_jual', 11, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(238, 23, 'trx_retur_jual', 12, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(239, 23, 'trx_retur_jual', 13, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(240, 23, 'trx_retur_jual', 14, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', '1', NULL, 2, 2, NULL),
(241, 23, 'trx_retur_jual', 15, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(242, 23, 'trx_retur_jual', 16, 'Hutang', 'sisa', 'money', 30, 'textbox', NULL, '1', '1', NULL, 2, 2, NULL),
(243, 23, 'trx_retur_jual', 17, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(244, 24, 'trx_retur_jual_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(245, 24, 'trx_retur_jual_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(246, 24, 'trx_retur_jual_detail', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(247, 24, 'trx_retur_jual_detail', 5, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(248, 24, 'trx_retur_jual_detail', 6, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(249, 24, 'trx_retur_jual_detail', 7, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 24, 'trx_retur_jual_detail', 8, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(251, 24, 'trx_retur_jual_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(252, 24, 'trx_retur_jual_detail', 10, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 25, 'barang_upload', 1, 'Judul', 'judul', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(254, 25, 'barang_upload', 2, 'Nama File', 'nama_file', 'varchar', 50, 'filebox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(255, 26, 'trx_gd_pro_in_by_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(256, 26, 'trx_gd_pro_in_by_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(257, 26, 'trx_gd_pro_in_by_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 2, NULL),
(258, 26, 'trx_gd_pro_in_by_order', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(259, 26, 'trx_gd_pro_in_by_order', 5, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(260, 27, 'trx_gd_pro_in_by_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(261, 27, 'trx_gd_pro_in_by_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(262, 27, 'trx_gd_pro_in_by_order_det', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(263, 27, 'trx_gd_pro_in_by_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(264, 27, 'trx_gd_pro_in_by_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 27, 'trx_gd_pro_in_by_order_det', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 27, 'trx_gd_pro_in_by_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(267, 27, 'trx_gd_pro_in_by_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(268, 27, 'trx_gd_pro_in_by_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(269, 27, 'trx_gd_pro_in_by_order_det', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(270, 28, 'trx_gd_pro_out_by_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(271, 28, 'trx_gd_pro_out_by_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(272, 28, 'trx_gd_pro_out_by_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 2, NULL),
(273, 28, 'trx_gd_pro_out_by_order', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(274, 28, 'trx_gd_pro_out_by_order', 5, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(275, 29, 'trx_gd_pro_out_by_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(276, 29, 'trx_gd_pro_out_by_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(277, 29, 'trx_gd_pro_out_by_order_det', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(278, 29, 'trx_gd_pro_out_by_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(279, 29, 'trx_gd_pro_out_by_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 29, 'trx_gd_pro_out_by_order_det', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(281, 29, 'trx_gd_pro_out_by_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(282, 29, 'trx_gd_pro_out_by_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(283, 29, 'trx_gd_pro_out_by_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(284, 29, 'trx_gd_pro_out_by_order_det', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(285, 30, 'trx_gd_pro_in_non_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(286, 30, 'trx_gd_pro_in_non_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(287, 30, 'trx_gd_pro_in_non_order', 4, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(288, 30, 'trx_gd_pro_in_non_order', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(289, 31, 'trx_gd_pro_in_non_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(290, 31, 'trx_gd_pro_in_non_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(291, 31, 'trx_gd_pro_in_non_order_det', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(292, 31, 'trx_gd_pro_in_non_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(293, 31, 'trx_gd_pro_in_non_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(294, 31, 'trx_gd_pro_in_non_order_det', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(295, 31, 'trx_gd_pro_in_non_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(296, 31, 'trx_gd_pro_in_non_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(297, 31, 'trx_gd_pro_in_non_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(298, 32, 'trx_gd_pro_out_non_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(299, 32, 'trx_gd_pro_out_non_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(300, 32, 'trx_gd_pro_out_non_order', 4, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(301, 32, 'trx_gd_pro_out_non_order', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(302, 33, 'trx_gd_pro_out_non_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(303, 33, 'trx_gd_pro_out_non_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(304, 33, 'trx_gd_pro_out_non_order_det', 3, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(305, 33, 'trx_gd_pro_out_non_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(306, 33, 'trx_gd_pro_out_non_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(307, 33, 'trx_gd_pro_out_non_order_det', 6, 'Disc %', 'disc_persen', 'real', 5, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(308, 33, 'trx_gd_pro_out_non_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(309, 33, 'trx_gd_pro_out_non_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(310, 33, 'trx_gd_pro_out_non_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(312, 30, 'trx_gd_pro_in_non_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', NULL, NULL, NULL, 1, 2, NULL),
(313, 30, 'trx_gd_pro_out_non_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', NULL, NULL, NULL, 1, 2, NULL),
(315, 19, 'trx_delivery_order', 1, 'No DO', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(316, 19, 'trx_delivery_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(319, 19, 'trx_delivery_order', 5, 'Nama Supir', 'supir_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(320, 19, 'trx_delivery_order', 6, 'No Polisi Mobil', 'no_mobil', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(321, 19, 'trx_delivery_order', 17, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(322, 18, 'trx_order_jual_detail', 4, 'Satuan', 'satuan', 'varchar', 7, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(323, 20, 'trx_jual_by_order_detail', 4, 'Satuan', 'satuan', 'varchar', 7, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(324, 22, 'trx_jual_non_order_detail', 4, 'Satuan', 'satuan', 'varchar', 7, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(325, 24, 'trx_retur_jual_detail', 4, 'Satuan', 'satuan', 'varchar', 7, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(326, 19, 'trx_jual_by_order', 7, 'No PO', 'no_reff', 'text', 20, 'textbox', NULL, NULL, '1', NULL, 1, 2, NULL),
(327, 19, 'trx_jual_by_order', 8, 'Tgl PO', 'tgl_reff', 'text', 20, 'textbox', NULL, NULL, '1', NULL, 1, 2, NULL),
(328, 27, 'trx_do_detail', 1, 'Kode Barang', 'product_code', 'varchar', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(329, 27, 'trx_do_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(330, 27, 'trx_do_detail', 3, 'Satuan', 'satuan', 'varchar', 10, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(331, 27, 'trx_do_detail', 4, 'Qty', 'qty', 'integer', 6, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(332, 27, 'trx_do_detail', 5, 'Ket', 'ket_detail', 'varchar', 20, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(333, 27, 'trx_do_detail', 6, 'No Order', 'no_order', 'varchar', 20, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(334, 27, 'trx_do_detail', 7, 'Kode Cust', 'kode_cust', 'varchar', 20, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(363, 1, 'barang', 1, 'Divisi', 'kode_artikel', 'varchar', 30, 'combobox', 'rsArtikel', '1', NULL, NULL, NULL, NULL, NULL),
(364, 1, 'barang', 2, 'Kelompok Barang', 'kode_kelompok', 'varchar', 30, 'combobox', 'rsKelBarang', '1', NULL, NULL, NULL, NULL, NULL),
(365, 1, 'barang', 3, 'Jenis Barang', 'kode_jenis', 'varchar', 30, 'combobox', 'rsJenisBarang', '1', NULL, NULL, NULL, NULL, NULL),
(366, 1, 'barang', 4, 'Counter', 'counter', 'varchar', 10, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(367, 1, 'barang', 5, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(368, 1, 'barang', 6, 'Nama Barang', 'product_name', 'varchar', 100, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(369, 1, 'barang', 7, 'Satuan', 'kode_sat', 'varchar', 30, 'combobox', 'rsSatBarang', NULL, NULL, NULL, NULL, NULL, NULL),
(370, 1, 'barang', 8, 'Unit', 'kode_unit', 'varchar', 30, 'combobox', 'rsUnitBarang', NULL, NULL, NULL, NULL, NULL, NULL),
(371, 1, 'barang', 9, 'Merek Barang', 'kode_merek', 'varchar', 30, 'combobox', 'rsMerekBarang', NULL, NULL, NULL, NULL, NULL, NULL),
(372, 1, 'barang', 10, 'Harga Jual', 'harga_jual', 'money', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(373, 1, 'barang', 11, 'Harga Pokok', 'harga_beli', 'money', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(374, 1, 'barang', 12, 'Supplier', 'kode_supplier', 'varchar', 50, 'combobox', 'rsSupplier', NULL, NULL, NULL, NULL, NULL, NULL),
(375, 1, 'barang', 13, 'Negara', 'kode_negara', 'varchar', 30, 'combobox', 'rsNegara', NULL, NULL, NULL, NULL, NULL, NULL),
(376, 1, 'barang', 14, 'Saldo Awal', 'saldo_awal', 'integer', 20, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(377, 1, 'barang', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(378, 19, 'trx_delivery_order', 3, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', NULL, '1', NULL, 1, 1, NULL),
(379, 19, 'trx_jual_by_order', 4, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', NULL, '1', NULL, 1, 1, NULL),
(381, 21, 'trx_jual_non_order', 3, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', NULL, '1', NULL, 1, 1, NULL),
(382, 23, 'trx_retur_jual', 5, 'Divisi', 'kode_divisi', 'varchar', 20, 'combobox', 'rsArtikel', NULL, '1', NULL, 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_generator_20160215`
--

CREATE TABLE IF NOT EXISTS `form_generator_20160215` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formNo` int(11) DEFAULT NULL,
  `tableName` varchar(50) DEFAULT NULL,
  `sortNo` int(11) DEFAULT NULL,
  `TitleName` varchar(50) DEFAULT NULL,
  `FieldName` varchar(50) DEFAULT NULL,
  `FieldType` varchar(50) DEFAULT NULL,
  `FieldLen` int(11) DEFAULT NULL,
  `FieldInput` varchar(50) DEFAULT NULL,
  `ComboData` varchar(51) DEFAULT NULL,
  `isMandatory` varchar(20) DEFAULT NULL,
  `disableEdit` varchar(20) DEFAULT NULL,
  `other` varchar(20) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `kolom` int(11) DEFAULT NULL,
  `haveSum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5046 ;

--
-- Dumping data for table `form_generator_20160215`
--

INSERT INTO `form_generator_20160215` (`id`, `formNo`, `tableName`, `sortNo`, `TitleName`, `FieldName`, `FieldType`, `FieldLen`, `FieldInput`, `ComboData`, `isMandatory`, `disableEdit`, `other`, `section`, `kolom`, `haveSum`) VALUES
(4161, 2, 'customer', 1, 'Kode Customer', 'contact_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4162, 2, 'customer', 2, 'Nama Customer', 'contact_name', 'varchar', 100, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4163, 2, 'customer', 3, 'Alamat', 'alamat', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4164, 2, 'customer', 4, 'Kota', 'kota', 'varchar', 50, 'combobox', 'rsKota', '1', NULL, NULL, NULL, NULL, NULL),
(4165, 2, 'customer', 5, 'Kodepos', 'kode_pos', 'varchar', 10, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4166, 2, 'customer', 6, 'Negara', 'negara', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4167, 2, 'customer', 7, 'Telp', 'telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4168, 2, 'customer', 8, 'Fax', 'fax', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4169, 2, 'customer', 9, 'Email', 'email', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4170, 2, 'customer', 10, 'Website', 'website', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4171, 2, 'customer', 11, 'Hubungi', 'hubungi_nama', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4172, 2, 'customer', 12, 'Telp Hubungi', 'hubungi_telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4173, 2, 'customer', 13, 'No Rekening', 'no_rek', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4174, 2, 'customer', 14, 'NPWP', 'npwp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4175, 2, 'customer', 15, 'Keterangan', 'ket', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4176, 3, 'supplier', 1, 'Kode Supplier', 'contact_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4177, 3, 'supplier', 2, 'Nama Supplier', 'contact_name', 'varchar', 100, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4178, 3, 'supplier', 3, 'Alamat', 'alamat', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4179, 3, 'supplier', 4, 'Kota', 'kota', 'varchar', 50, 'combobox', 'rsKota', '1', NULL, NULL, NULL, NULL, NULL),
(4180, 2, 'supplier', 5, 'Kodepos', 'kode_pos', 'varchar', 10, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4181, 3, 'supplier', 6, 'Negara', 'negara', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4182, 3, 'supplier', 7, 'Telp', 'telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4183, 3, 'supplier', 8, 'Fax', 'fax', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4184, 3, 'supplier', 9, 'Email', 'email', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4185, 3, 'supplier', 10, 'Website', 'website', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4186, 3, 'supplier', 11, 'Hubungi', 'hubungi_nama', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4187, 3, 'supplier', 12, 'Telp Hubungi', 'hubungi_telp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4188, 3, 'supplier', 13, 'No Rekening', 'no_rek', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4189, 3, 'supplier', 14, 'NPWP', 'npwp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4190, 3, 'supplier', 15, 'Keterangan', 'ket', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4191, 4, 'karyawan', 1, 'NIK', 'contact_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4192, 4, 'karyawan', 2, 'Nama Karyawan', 'contact_name', 'varchar', 255, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4193, 4, 'karyawan', 3, 'Jenis Kelamin', 'jenis_kelamin', 'varchar', 1, 'combobox', 'rsJenisKelamin', NULL, NULL, NULL, NULL, NULL, NULL),
(4194, 4, 'karyawan', 4, 'Tgl Lahir', 'tgl_lahir', 'date', 20, 'datepicker', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4195, 4, 'karyawan', 5, 'Alamat', 'alamat', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4196, 4, 'karyawan', 6, 'Tgl Masuk', 'tgl_masuk', 'date', 20, 'datepicker', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4197, 4, 'karyawan', 7, 'Status Kerja', 'status_kerja', 'varchar', 20, 'combobox', 'rsStatusKerja', NULL, NULL, NULL, NULL, NULL, NULL),
(4198, 4, 'karyawan', 8, 'Jabatan', 'jabatan', 'varchar', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4199, 4, 'karyawan', 9, 'No Rekening', 'no_rek', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4200, 4, 'karyawan', 10, 'NPWP', 'npwp', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4201, 4, 'karyawan', 11, 'Keterangan', 'ket', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4202, 5, 'trx_terima', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4203, 5, 'trx_terima', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4204, 5, 'trx_terima', 3, 'Gudang', 'gudang_kode', 'varchar', 50, 'combobox', 'rsGudang', NULL, NULL, NULL, 1, 2, NULL),
(4205, 5, 'trx_terima', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4206, 5, 'trx_terima', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4212, 7, 'trx_keluar', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4213, 7, 'trx_keluar', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4214, 7, 'trx_keluar', 3, 'Gudang', 'gudang_kode', 'varchar', 50, 'combobox', 'rsGudang', NULL, NULL, NULL, 1, 2, NULL),
(4215, 7, 'trx_keluar', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4216, 7, 'trx_keluar', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4346, 17, 'barang_upload', 1, 'Judul', 'judul', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4347, 17, 'barang_upload', 2, 'Nama File', 'nama_file', 'varchar', 50, 'filebox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4358, 20, 'trx_pakai_bahan_baku', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4359, 20, 'trx_pakai_bahan_baku', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4360, 20, 'trx_pakai_bahan_baku', 3, 'Gudang', 'gudang_kode', 'varchar', 50, 'combobox', 'rsGudang', NULL, NULL, NULL, 1, 2, NULL),
(4361, 20, 'trx_pakai_bahan_baku', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4362, 20, 'trx_pakai_bahan_baku', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4363, 21, 'trx_pakai_bahan_baku_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4364, 21, 'trx_pakai_bahan_baku_det', 2, 'Nama Barang', 'product_name', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4365, 21, 'trx_pakai_bahan_baku_det', 3, 'Warna', 'kode_warna', 'varchar', 20, 'combobox', 'rsWarna', '1', NULL, NULL, NULL, NULL, NULL),
(4366, 21, 'trx_pakai_bahan_baku_det', 4, 'Qty', 'qty', 'integer', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4367, 21, 'trx_pakai_bahan_baku_det', 5, 'Ket', 'ket_detail', 'varchar', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4516, 1, 'barang', 1, 'Kelompok Barang', 'kode_kelompok', 'varchar', 30, 'combobox', 'rsKelBarang', '1', NULL, NULL, NULL, NULL, NULL),
(4517, 1, 'barang', 2, 'Artikel', 'kode_artikel', 'varchar', 30, 'combobox', 'rsArtikel', '1', NULL, NULL, NULL, NULL, NULL),
(4518, 1, 'barang', 3, 'Jenis Barang', 'kode_jenis', 'varchar', 30, 'combobox', 'rsJenisBarang', '1', NULL, NULL, NULL, NULL, NULL),
(4519, 1, 'barang', 4, 'Counter', 'counter', 'varchar', 10, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4520, 1, 'barang', 5, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4521, 1, 'barang', 6, 'Nama Barang', 'product_name', 'varchar', 100, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4522, 1, 'barang', 7, 'Mesin Produksi', 'kode_mesin', 'varchar', 30, 'combobox', 'rsMesin', NULL, NULL, NULL, NULL, NULL, NULL),
(4523, 1, 'barang', 8, 'Merek Barang', 'kode_merek', 'varchar', 30, 'combobox', 'rsMerekBarang', NULL, NULL, NULL, NULL, NULL, NULL),
(4524, 1, 'barang', 9, 'Harga Jual', 'harga_jual', 'money', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4525, 1, 'barang', 10, 'Harga Pokok', 'harga_beli', 'money', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4526, 1, 'barang', 11, 'Supplier', 'kode_supplier', 'varchar', 50, 'combobox', 'rsSupplier', NULL, NULL, NULL, NULL, NULL, NULL),
(4527, 1, 'barang', 12, 'Negara', 'kode_negara', 'varchar', 30, 'combobox', 'rsNegara', NULL, NULL, NULL, NULL, NULL, NULL),
(4528, 1, 'barang', 13, 'Kelompok Size', 'kode_size', 'varchar', 30, 'combobox', 'rsKelSize', NULL, NULL, NULL, NULL, NULL, NULL),
(4529, 1, 'barang', 14, 'Saldo Awal', 'saldo_awal', 'integer', 20, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4530, 1, 'barang', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4606, 16, 'trx_retur_jual_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4607, 16, 'trx_retur_jual_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4608, 16, 'trx_retur_jual_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4609, 16, 'trx_retur_jual_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4610, 16, 'trx_retur_jual_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4611, 16, 'trx_retur_jual_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4612, 16, 'trx_retur_jual_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4613, 16, 'trx_retur_jual_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4614, 16, 'trx_retur_jual_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4628, 18, 'trx_terima_hasil_produksi', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4629, 18, 'trx_terima_hasil_produksi', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4630, 18, 'trx_terima_hasil_produksi', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 2, NULL),
(4631, 18, 'trx_terima_hasil_produksi', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4632, 18, 'trx_terima_hasil_produksi', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4642, 19, 'trx_terima_hasil_produksi_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4643, 19, 'trx_terima_hasil_produksi_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4644, 19, 'trx_terima_hasil_produksi_det', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4645, 19, 'trx_terima_hasil_produksi_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4646, 19, 'trx_terima_hasil_produksi_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4647, 19, 'trx_terima_hasil_produksi_det', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4648, 19, 'trx_terima_hasil_produksi_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4649, 19, 'trx_terima_hasil_produksi_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4650, 19, 'trx_terima_hasil_produksi_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4651, 19, 'trx_terima_hasil_produksi_det', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4670, 6, 'trx_terima_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4671, 6, 'trx_terima_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4672, 6, 'trx_terima_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4673, 6, 'trx_terima_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4674, 6, 'trx_terima_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4675, 7, 'trx_terima_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4676, 8, 'trx_terima_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4677, 9, 'trx_terima_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4678, 10, 'trx_terima_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4679, 8, 'trx_keluar_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4680, 8, 'trx_keluar_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4681, 8, 'trx_keluar_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4682, 8, 'trx_keluar_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4683, 8, 'trx_keluar_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4684, 8, 'trx_keluar_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4685, 8, 'trx_keluar_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4686, 8, 'trx_keluar_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4687, 8, 'trx_keluar_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4709, 10, 'trx_beli_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4710, 10, 'trx_beli_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4711, 10, 'trx_beli_detail', 4, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4712, 10, 'trx_beli_detail', 5, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4713, 10, 'trx_beli_detail', 6, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4714, 10, 'trx_beli_detail', 7, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4715, 10, 'trx_beli_detail', 8, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4716, 10, 'trx_beli_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4717, 10, 'trx_beli_detail', 10, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4749, 12, 'trx_retur_beli_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4750, 12, 'trx_retur_beli_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4751, 12, 'trx_retur_beli_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4752, 12, 'trx_retur_beli_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4753, 12, 'trx_retur_beli_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4754, 12, 'trx_retur_beli_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4755, 12, 'trx_retur_beli_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4756, 12, 'trx_retur_beli_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4757, 12, 'trx_retur_beli_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4758, 9, 'trx_beli', 1, 'No. Nota Beli', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4759, 9, 'trx_beli', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4760, 9, 'trx_beli', 3, 'Kelompok Pembelian', 'kel_beli', 'varchar', 50, 'combobox', 'rsKelBeli', '1', NULL, NULL, 1, 1, NULL),
(4761, 9, 'trx_beli', 4, 'Supplier', 'contact_code', 'varchar', 50, 'combobox', 'rsSupplier', '1', NULL, NULL, 1, 2, NULL),
(4762, 9, 'trx_beli', 5, 'No. Nota Supplier', 'no_invoice', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(4763, 9, 'trx_beli', 6, 'Tgl Nota Supplier', 'tgl_invoice', 'varchar', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(4764, 9, 'trx_beli', 7, 'Petugas', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4765, 9, 'trx_beli', 8, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4766, 9, 'trx_beli', 9, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4767, 9, 'trx_beli', 10, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4768, 9, 'trx_beli', 11, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4769, 9, 'trx_beli', 12, 'Netto', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4770, 9, 'trx_beli', 13, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4771, 9, 'trx_beli', 14, 'Sisa', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4772, 9, 'trx_beli', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4773, 11, 'trx_retur_beli', 1, 'No Retur Pembelian', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4774, 11, 'trx_retur_beli', 2, 'Tgl Retur Pembelian', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4775, 11, 'trx_retur_beli', 3, 'Supplier', 'contact_code', 'varchar', 50, 'combobox', 'rsSupplier', '1', NULL, NULL, 1, 1, NULL),
(4776, 11, 'trx_retur_beli', 4, 'Petugas', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 1, NULL),
(4777, 11, 'trx_retur_beli', 5, 'Kode Pembelian', 'no_reff', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, 1, 2, NULL),
(4778, 11, 'trx_retur_beli', 6, 'Tgl Pembelian', 'tgl_reff', 'date', 50, 'datepicker', NULL, '1', NULL, NULL, 1, 2, NULL),
(4779, 11, 'trx_retur_beli', 7, 'No Invoice', 'no_invoice', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(4780, 11, 'trx_retur_beli', 8, 'Tgl Invoice', 'tgl_invoice', 'date', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(4781, 11, 'trx_retur_beli', 9, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4782, 11, 'trx_retur_beli', 10, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4783, 11, 'trx_retur_beli', 11, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4784, 11, 'trx_retur_beli', 12, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4785, 11, 'trx_retur_beli', 13, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4786, 11, 'trx_retur_beli', 14, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4787, 11, 'trx_retur_beli', 15, 'Piutang', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4788, 11, 'trx_retur_beli', 16, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4804, 14, 'trx_order_jual_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4805, 14, 'trx_order_jual_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4806, 14, 'trx_order_jual_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4807, 14, 'trx_order_jual_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4808, 14, 'trx_order_jual_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4809, 14, 'trx_order_jual_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4810, 14, 'trx_order_jual_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4811, 14, 'trx_order_jual_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4812, 14, 'trx_order_jual_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4826, 17, 'trx_order_jual', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4827, 17, 'trx_order_jual', 2, 'Tgl Order', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4828, 17, 'trx_order_jual', 3, 'Kelompok Penjualan', 'kel_beli', 'varchar', 50, 'combobox', 'rsKelJual', '1', NULL, NULL, 1, 1, NULL),
(4829, 17, 'trx_order_jual', 4, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 2, NULL),
(4830, 17, 'trx_order_jual', 5, 'Rencana Tgl Kirim', 'tgl_reff', 'date', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(4831, 17, 'trx_order_jual', 6, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4832, 17, 'trx_order_jual', 7, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4833, 17, 'trx_order_jual', 8, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4834, 17, 'trx_order_jual', 9, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4835, 17, 'trx_order_jual', 10, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4836, 17, 'trx_order_jual', 11, 'Biaya Kirim', 'biaya_kirim', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4837, 17, 'trx_order_jual', 12, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4838, 17, 'trx_order_jual', 13, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4839, 17, 'trx_order_jual', 14, 'Sisa', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4840, 17, 'trx_order_jual', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4851, 15, 'trx_retur_jual', 1, 'No Retur Penjualan', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4852, 15, 'trx_retur_jual', 2, 'Tgl Retur Penjualan', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4853, 15, 'trx_retur_jual', 3, 'No Faktur', 'no_reff', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, 1, 1, NULL),
(4854, 15, 'trx_retur_jual', 4, 'Tgl Faktur', 'tgl_reff', 'varchar', 50, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4855, 15, 'trx_retur_jual', 5, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 2, NULL),
(4856, 15, 'trx_retur_jual', 6, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4857, 15, 'trx_retur_jual', 9, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4858, 15, 'trx_retur_jual', 10, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4859, 15, 'trx_retur_jual', 11, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4860, 15, 'trx_retur_jual', 12, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4861, 15, 'trx_retur_jual', 13, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4862, 15, 'trx_retur_jual', 14, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4863, 15, 'trx_retur_jual', 15, 'Hutang', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4864, 15, 'trx_retur_jual', 16, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4865, 13, 'trx_jual', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4866, 13, 'trx_jual', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4867, 13, 'trx_jual', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 1, NULL),
(4868, 13, 'trx_jual', 4, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4869, 13, 'trx_jual', 5, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4870, 13, 'trx_jual', 6, 'Discount', 'disc_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4871, 13, 'trx_jual', 7, 'PPN %', 'ppn_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4872, 13, 'trx_jual', 8, 'PPN', 'ppn_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4873, 13, 'trx_jual', 9, 'Biaya Kirim', 'biaya_kirim', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4874, 13, 'trx_jual', 10, 'Total', 'total', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4875, 13, 'trx_jual', 11, 'Pembayaran', 'bayar', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4876, 13, 'trx_jual', 12, 'Sisa', 'sisa', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4877, 13, 'trx_jual', 13, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4878, 14, 'trx_jual_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4879, 14, 'trx_jual_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4880, 14, 'trx_jual_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4881, 14, 'trx_jual_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4882, 14, 'trx_jual_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4883, 14, 'trx_jual_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4884, 14, 'trx_jual_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4885, 14, 'trx_jual_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4886, 14, 'trx_jual_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4887, 14, 'trx_jual_detail', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4910, 13, 'trx_jual_by_order', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4911, 13, 'trx_jual_by_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4912, 13, 'trx_jual_by_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 1, NULL),
(4913, 13, 'trx_jual_by_order', 4, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4914, 13, 'trx_jual_by_order', 5, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4915, 13, 'trx_jual_by_order', 6, 'Discount', 'disc_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4916, 13, 'trx_jual_by_order', 7, 'PPN %', 'ppn_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4917, 13, 'trx_jual_by_order', 8, 'PPN', 'ppn_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4918, 13, 'trx_jual_by_order', 9, 'Biaya Kirim', 'biaya_kirim', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4919, 13, 'trx_jual_by_order', 10, 'Total', 'total', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4920, 13, 'trx_jual_by_order', 11, 'Pembayaran', 'bayar', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4921, 13, 'trx_jual_by_order', 12, 'Sisa', 'sisa', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4922, 13, 'trx_jual_by_order', 13, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4923, 14, 'trx_jual_by_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4924, 14, 'trx_jual_by_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4925, 14, 'trx_jual_by_order_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4926, 14, 'trx_jual_by_order_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4927, 14, 'trx_jual_by_order_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4928, 14, 'trx_jual_by_order_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4929, 14, 'trx_jual_by_order_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4930, 14, 'trx_jual_by_order_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4931, 14, 'trx_jual_by_order_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4932, 14, 'trx_jual_by_order_detail', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4933, 13, 'trx_jual_non_order', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4934, 13, 'trx_jual_non_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4935, 13, 'trx_jual_non_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 1, NULL),
(4936, 13, 'trx_jual_non_order', 4, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4937, 13, 'trx_jual_non_order', 5, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4938, 13, 'trx_jual_non_order', 6, 'Discount', 'disc_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4939, 13, 'trx_jual_non_order', 7, 'PPN %', 'ppn_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4940, 13, 'trx_jual_non_order', 8, 'PPN', 'ppn_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4941, 13, 'trx_jual_non_order', 9, 'Biaya Kirim', 'biaya_kirim', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4942, 13, 'trx_jual_non_order', 10, 'Total', 'total', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4943, 13, 'trx_jual_non_order', 11, 'Pembayaran', 'bayar', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4944, 13, 'trx_jual_non_order', 12, 'Sisa', 'sisa', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4945, 13, 'trx_jual_non_order', 13, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4946, 16, 'trx_jual_non_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4947, 16, 'trx_jual_non_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4948, 16, 'trx_jual_non_order_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4949, 16, 'trx_jual_non_order_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4950, 16, 'trx_jual_non_order_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4951, 16, 'trx_jual_non_order_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4952, 16, 'trx_jual_non_order_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4953, 16, 'trx_jual_non_order_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4954, 16, 'trx_jual_non_order_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4955, 9, 'trx_beli_non_order', 1, 'No. Nota Beli', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(4956, 9, 'trx_beli_non_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(4957, 9, 'trx_beli_non_order', 3, 'Kelompok Pembelian', 'kel_beli', 'varchar', 50, 'combobox', 'rsKelBeli', '1', NULL, NULL, 1, 1, NULL),
(4958, 9, 'trx_beli_non_order', 4, 'Supplier', 'contact_code', 'varchar', 50, 'combobox', 'rsSupplier', '1', NULL, NULL, 1, 2, NULL),
(4959, 9, 'trx_beli_non_order', 5, 'No. Nota Supplier', 'no_invoice', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(4960, 9, 'trx_beli_non_order', 6, 'Tgl Nota Supplier', 'tgl_invoice', 'varchar', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(4961, 9, 'trx_beli_non_order', 7, 'Petugas', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(4962, 9, 'trx_beli_non_order', 8, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4963, 9, 'trx_beli_non_order', 9, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4964, 9, 'trx_beli_non_order', 10, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(4965, 9, 'trx_beli_non_order', 11, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4966, 9, 'trx_beli_non_order', 12, 'Netto', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(4967, 9, 'trx_beli_non_order', 13, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4968, 9, 'trx_beli_non_order', 14, 'Sisa', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(4969, 9, 'trx_beli_non_order', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(4970, 10, 'trx_beli_non_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4971, 10, 'trx_beli_non_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4972, 10, 'trx_beli_non_order_detail', 4, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4973, 10, 'trx_beli_non_order_detail', 5, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4974, 10, 'trx_beli_non_order_detail', 6, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4975, 10, 'trx_beli_non_order_detail', 7, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4976, 10, 'trx_beli_non_order_detail', 8, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4977, 10, 'trx_beli_non_order_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(4978, 10, 'trx_beli_non_order_detail', 10, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4984, 6, 'trx_gudang_bahan_in_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4985, 6, 'trx_gudang_bahan_in_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4986, 6, 'trx_gudang_bahan_in_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(4987, 6, 'trx_gudang_bahan_in_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(4988, 6, 'trx_gudang_bahan_in_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4989, 7, 'trx_gudang_bahan_in_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4990, 8, 'trx_gudang_bahan_in_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4991, 9, 'trx_gudang_bahan_in_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(4992, 10, 'trx_gudang_bahan_in_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4998, 6, 'trx_gudang_bahan_out_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(4999, 6, 'trx_gudang_bahan_out_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(5000, 6, 'trx_gudang_bahan_out_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(5001, 6, 'trx_gudang_bahan_out_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(5002, 6, 'trx_gudang_bahan_out_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(5003, 7, 'trx_gudang_bahan_out_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(5004, 8, 'trx_gudang_bahan_out_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(5005, 9, 'trx_gudang_bahan_out_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(5006, 10, 'trx_gudang_bahan_out_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5007, 5, 'trx_gudang_bahan_in', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(5008, 5, 'trx_gudang_bahan_in', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(5009, 5, 'trx_gudang_bahan_in', 3, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(5010, 5, 'trx_gudang_bahan_in', 4, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(5011, 5, 'trx_gudang_bahan_out', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(5012, 5, 'trx_gudang_bahan_out', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(5013, 5, 'trx_gudang_bahan_out', 3, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(5014, 5, 'trx_gudang_bahan_out', 4, 'Penerima', 'petugas_kode2', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(5015, 5, 'trx_gudang_bahan_out', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(5016, 18, 'trx_gd_pro_in_by_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(5017, 18, 'trx_gd_pro_in_by_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(5018, 18, 'trx_gd_pro_in_by_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 2, NULL),
(5019, 18, 'trx_gd_pro_in_by_order', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(5020, 18, 'trx_gd_pro_in_by_order', 5, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5021, 19, 'trx_gd_pro_in_by_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(5022, 19, 'trx_gd_pro_in_by_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(5023, 19, 'trx_gd_pro_in_by_order_det', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(5024, 19, 'trx_gd_pro_in_by_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(5025, 19, 'trx_gd_pro_in_by_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5026, 19, 'trx_gd_pro_in_by_order_det', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5027, 19, 'trx_gd_pro_in_by_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5028, 19, 'trx_gd_pro_in_by_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5029, 19, 'trx_gd_pro_in_by_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5030, 19, 'trx_gd_pro_in_by_order_det', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5031, 18, 'trx_gd_pro_out_by_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(5032, 18, 'trx_gd_pro_out_by_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(5033, 18, 'trx_gd_pro_out_by_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 2, NULL),
(5034, 18, 'trx_gd_pro_out_by_order', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(5035, 18, 'trx_gd_pro_out_by_order', 5, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5036, 19, 'trx_gd_pro_out_by_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(5037, 19, 'trx_gd_pro_out_by_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(5038, 19, 'trx_gd_pro_out_by_order_det', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(5039, 19, 'trx_gd_pro_out_by_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(5040, 19, 'trx_gd_pro_out_by_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5041, 19, 'trx_gd_pro_out_by_order_det', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5042, 19, 'trx_gd_pro_out_by_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5043, 19, 'trx_gd_pro_out_by_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5044, 19, 'trx_gd_pro_out_by_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5045, 19, 'trx_gd_pro_out_by_order_det', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_cabang`
--

CREATE TABLE IF NOT EXISTS `mst_cabang` (
  `kode_cabang` varchar(20) NOT NULL,
  `nama_cabang` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(50) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_cabang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_cabang`
--

INSERT INTO `mst_cabang` (`kode_cabang`, `nama_cabang`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
('000', 'Kantor Pusat', '2015-04-21 14:21:57', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_config`
--

CREATE TABLE IF NOT EXISTS `mst_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) DEFAULT NULL,
  `ket` varchar(30) DEFAULT NULL,
  `int_value` int(11) DEFAULT NULL,
  `des_value` double DEFAULT NULL,
  `string_value` varchar(20) DEFAULT NULL,
  `date1_value` date DEFAULT NULL,
  `date2_value` date DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `bln` int(11) DEFAULT NULL,
  `thn` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `mst_config`
--

INSERT INTO `mst_config` (`id`, `kode`, `ket`, `int_value`, `des_value`, `string_value`, `date1_value`, `date2_value`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `bln`, `thn`) VALUES
(1, '001', 'Test', 0, 0, '', '2013-12-18', '2013-12-31', '2013-12-21 10:18:31', 'admin', '2013-12-21 10:19:07', 'admin', 2, 16),
(2, '', 'kode jurnal kas', 4, 0, 'JKX', '0000-00-00', '0000-00-00', '2013-12-21 17:58:30', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(3, '', 'kode jurnal bank', 2, 0, 'JBX', '0000-00-00', '0000-00-00', '2013-12-21 17:58:51', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(4, '', 'kode jurnal transaksi', 0, 0, 'JTX', '0000-00-00', '0000-00-00', '2013-12-21 17:59:43', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(5, '', 'kode jurnal memorial', 2, 0, 'JMX', '0000-00-00', '0000-00-00', '2013-12-21 17:59:57', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(6, '', 'kode company', 0, 0, '001', '0000-00-00', '0000-00-00', '2013-12-23 13:20:18', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(17, '', 'jml record paging', 250, 0, '', '0000-00-00', '0000-00-00', '2014-01-07 11:03:44', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(18, '', 'session timeout', 15, 0, '', '0000-00-00', '0000-00-00', '2014-01-12 16:50:13', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(24, NULL, 'kode customer', 34, NULL, 'C', NULL, NULL, '2015-10-17 08:10:04', 'admin', '2015-10-17 08:12:04', 'admin', 2, 16),
(25, NULL, 'kode supplier', 10, NULL, 'S', NULL, NULL, '2015-10-17 08:11:05', 'admin', '2015-10-17 08:12:29', 'admin', 2, 16),
(26, NULL, 'kode master', 0, NULL, NULL, NULL, NULL, '2015-10-17 08:11:22', 'admin', NULL, NULL, 2, 16),
(27, '', 'kode barang', 59, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(28, '1', 'Order Pembelian', 0, 0, 'POX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(29, '2', 'Pembelian by order', 0, 0, 'PBX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(30, '3', 'Pembelian non order', 5, 0, 'PNX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(31, '4', 'Retur Pembelian', 0, 0, 'PRX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(32, '5', 'Order Penjualan', 60, 0, 'SOX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(33, '6', 'Penjualan by order', 53, 0, 'SBX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(34, '7', 'Penjualan non order', 0, 0, 'SNX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(35, '8', 'Retur Penjualan', 0, 0, 'SRX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(36, '9', 'Penerimaan Hasil Produksi by O', 33, 0, 'IPO', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(37, '10', 'Penerimaan Hasil Produksi non ', 0, 0, 'IPN', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(38, '11', 'Pengiriman / Pengaluaran Baran', 29, 0, 'OPO', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(39, '12', 'Pengiriman / Pengaluaran Baran', 1, 0, 'OPN', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(40, '13', 'Penerimaan Bahan Produksi', 0, 0, 'IBP', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(41, '14', 'Pengeluaran / Pemakaian Bahan ', 0, 0, 'OBP', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(42, '15', 'Kontrabon Hutang', 0, 0, 'KHX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(43, '16', 'Kontrabon Piutang', 3, 0, 'KPX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(44, '17', 'Pembayaran Hutang', 15, 0, 'BHX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(45, '18', 'Pembayaran Piutang', 32, 0, 'BPX', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(46, NULL, 'kode karyawan', 4, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, '19', 'Delivery Order', 17, NULL, 'DOX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_contact`
--

CREATE TABLE IF NOT EXISTS `mst_contact` (
  `contact_code` varchar(20) NOT NULL,
  `contact_tipe` int(11) DEFAULT NULL,
  `contact_init` varchar(10) DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `saldo` double DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `alamat2` varchar(255) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `negara` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `npwp` varchar(50) DEFAULT NULL,
  `jenis_kelamin` varchar(1) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tgl_masuk` date DEFAULT NULL,
  `status_kerja` varchar(20) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `hubungi_nama` varchar(50) DEFAULT NULL,
  `hubungi_telp` varchar(50) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `no_rek` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`contact_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_contact`
--

INSERT INTO `mst_contact` (`contact_code`, `contact_tipe`, `contact_init`, `contact_name`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `saldo`, `alamat`, `alamat2`, `kota`, `kodepos`, `negara`, `telp`, `fax`, `email`, `website`, `npwp`, `jenis_kelamin`, `tgl_lahir`, `tgl_masuk`, `status_kerja`, `jabatan`, `hubungi_nama`, `hubungi_telp`, `kode_pos`, `no_rek`, `ket`) VALUES
('000001', 4, NULL, 'Admin', '2016-10-01 15:44:15', 'admin', '2016-10-01 18:30:19', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'Tetap', NULL, NULL, NULL, NULL, NULL, NULL),
('000002', 4, NULL, 'Fitriayadi', '2016-10-01 15:44:30', 'admin', '2016-11-02 13:48:58', 'admin', NULL, 'CIBOLERANG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'Tetap', NULL, NULL, NULL, NULL, NULL, NULL),
('000003', 4, NULL, 'TEDI', '2016-10-06 18:35:28', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'Tetap', NULL, NULL, NULL, NULL, NULL, NULL),
('000004', 4, NULL, 'Kuswandi', '2016-11-02 13:48:09', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'Tetap', NULL, NULL, NULL, NULL, NULL, NULL),
('001', 1, ' MAB', 'MITRA ALAM BANDUNG', '2013-12-22 16:38:16', 'admin', '0000-00-00 00:00:00', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000015', 3, NULL, 'AR.PUTRA TK.', '2016-09-30 10:58:07', 'admin', NULL, NULL, NULL, 'SOREANG', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000016', 3, NULL, 'LELA', '2016-09-30 15:14:33', 'admin', NULL, NULL, NULL, 'CIPATIK', NULL, 'CMH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000017', 3, NULL, 'AGUNG JAYA', '2016-10-01 18:01:11', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000018', 3, NULL, 'PD.HEBAT JAYA', '2016-10-31 14:19:08', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000019', 3, NULL, 'ACIL', '2016-10-31 14:20:53', 'admin', NULL, NULL, NULL, 'PASAR BARU', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000020', 3, NULL, 'IWAN CIKAJANB', '2016-10-31 14:21:27', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000021', 3, NULL, 'INTAN ', '2016-10-31 14:22:11', 'admin', NULL, NULL, NULL, 'CILILIN', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000022', 3, NULL, 'PT. TERMINAL ', '2016-10-31 14:24:35', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000023', 3, NULL, 'TK.MAKMUR ABADI', '2016-10-31 14:25:21', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000024', 3, NULL, 'TK.ATIU', '2016-10-31 14:26:59', 'admin', NULL, NULL, NULL, 'CIANJUR', NULL, 'CJR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000025', 3, NULL, 'HURIP ALIT GARUT', '2016-10-31 14:38:21', 'admin', NULL, NULL, NULL, 'GARUT', NULL, 'GRT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000026', 3, NULL, 'NASRUDIN', '2016-11-02 14:00:38', '02', NULL, NULL, NULL, 'PS.INDUK SURADE', NULL, 'SMI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000027', 3, NULL, 'SABAR BERKAH', '2016-11-02 14:04:18', '02', '2016-11-02 15:25:07', 'admin', NULL, 'PS.SURADE', NULL, 'SMI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000029', 3, NULL, 'IMAS', '2016-11-02 14:05:46', '02', NULL, NULL, NULL, 'PS.SURADE', NULL, 'SMI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000030', 3, NULL, 'TK.JASA IBU ', '2016-11-02 14:06:48', '04', NULL, NULL, NULL, 'PANGALENGAN RAYA KM26', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000031', 3, NULL, 'H.AYI ', '2016-11-02 14:08:11', '04', NULL, NULL, NULL, 'JLN.WARNASARI SITUCILEUNCA', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000032', 3, NULL, 'NUR GROSIR ', '2016-11-02 14:08:48', '04', NULL, NULL, NULL, 'PANGALENGAN WATES SITUCILEUNCA', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000033', 3, NULL, 'TK.ANEU JAYA ', '2016-11-02 14:11:05', '04', NULL, NULL, NULL, 'JLN.RAYA SITU CILEUNCA ', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('C000034', 3, NULL, 'GSM SUKAMANAH ', '2016-11-02 14:11:33', '04', NULL, NULL, NULL, 'PS.PINTU PANGALENGAN ', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('S000007', 2, NULL, 'ADI GAS', '2016-10-01 18:29:46', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('S000008', 2, NULL, 'NAMASINDO', '2016-10-21 15:18:21', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('S000009', 2, NULL, 'SAKU MAS', '2016-10-24 08:41:17', 'admin', NULL, NULL, NULL, 'JL.CARINGIN NO.439', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('S000010', 2, NULL, 'Admin', '2016-10-29 15:18:50', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_contact_person`
--

CREATE TABLE IF NOT EXISTS `mst_contact_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_code` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mst_group_user`
--

CREATE TABLE IF NOT EXISTS `mst_group_user` (
  `group_user_id` int(11) NOT NULL DEFAULT '0',
  `group_user` varchar(20) NOT NULL,
  PRIMARY KEY (`group_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_group_user`
--

INSERT INTO `mst_group_user` (`group_user_id`, `group_user`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `mst_jurnal_setting`
--

CREATE TABLE IF NOT EXISTS `mst_jurnal_setting` (
  `kode_transaksi` varchar(10) NOT NULL,
  `nama_transaksi` varchar(255) DEFAULT NULL,
  `debet` varchar(20) DEFAULT NULL,
  `kredit` varchar(20) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_jurnal_setting`
--

INSERT INTO `mst_jurnal_setting` (`kode_transaksi`, `nama_transaksi`, `debet`, `kredit`, `ket`) VALUES
('01', 'Penjualan Tunai', '001', '002', NULL),
('02', 'Penjualan Kredit', NULL, NULL, NULL),
('03', 'Pembayaran Giro Mundur', NULL, NULL, NULL),
('04', 'Pembayaran Piutang dgn Cek', NULL, NULL, NULL),
('05', 'Pembayaran Piutang dgn Tunai', NULL, NULL, NULL),
('06', 'Pencairan Piutang Giro', NULL, NULL, NULL),
('07', 'Pembelian Tunai', NULL, NULL, NULL),
('08', 'Pembelian Kredit', NULL, NULL, NULL),
('09', 'Pembayaran Hutang Giro', NULL, NULL, NULL),
('10', 'Hutang Giro Jatem', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_menu`
--

CREATE TABLE IF NOT EXISTS `mst_menu` (
  `MenuKode` varchar(20) NOT NULL,
  `MenuParent` varchar(20) DEFAULT NULL,
  `MenuName` varchar(100) DEFAULT NULL,
  `MenuLink` varchar(100) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `sortNo` int(11) DEFAULT NULL,
  `isHidden` int(11) DEFAULT NULL,
  PRIMARY KEY (`MenuKode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_menu`
--

INSERT INTO `mst_menu` (`MenuKode`, `MenuParent`, `MenuName`, `MenuLink`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `sortNo`, `isHidden`) VALUES
('0100000000', '', 'Master', '', '2013-12-09 12:59:41', 'admin', '0000-00-00 00:00:00', '', 1, 0),
('0101000000', '0100000000', 'Data Barang', 'product_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0102000000', '0100000000', 'Data Customer', 'customer_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0103000000', '0100000000', 'Data Supplier', 'supplier_list.php', '2013-12-09 13:05:01', 'admin', '2013-12-10 19:11:07', 'admin', NULL, NULL),
('0104000000', '0100000000', 'Data Karyawan', 'karyawan_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0105000000', '0100000000', 'Data Perkiraan', 'perkiraan_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0106000000', '0100000000', 'Kode Merek Barang', 'merek_barang_list.php', '2015-05-01 09:44:06', 'admin', NULL, NULL, NULL, NULL),
('0107000000', '0100000000', 'Kode Jenis Barang', 'jenis_barang_list.php', '2015-05-01 09:44:30', 'admin', NULL, NULL, NULL, NULL),
('0108000000', '0100000000', 'Kode Kelompok Barang', 'kel_barang_list.php', '2015-05-02 11:38:23', 'admin', NULL, NULL, NULL, NULL),
('0112000000', '0100000000', 'Unit Barang', 'unit_list.php', '2016-10-05 19:49:53', 'admin', NULL, NULL, NULL, NULL),
('0113000000', '0100000000', 'Divisi', 'artikel_list.php', '2015-12-30 21:20:34', 'admin', NULL, NULL, NULL, NULL),
('0114000000', '0100000000', 'Satuan Barang', 'satuan_list.php', NULL, NULL, NULL, NULL, NULL, NULL),
('0115000000', '0100000000', 'Kota', 'kota_list.php', '2016-09-28 12:16:17', 'admin', NULL, NULL, NULL, NULL),
('0200000000', '', 'Pembelian', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, NULL),
('0203000000', '0200000000', 'Pembelian non Order', 'purchase_non_order_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0204000000', '0200000000', 'Retur Pembelian', 'purchase_return_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0300000000', '', 'Penjualan', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 3, NULL),
('0301000000', '0300000000', 'Order Penjualan', 'sales_order_list.php', '2015-05-12 09:34:01', 'admin', NULL, NULL, NULL, NULL),
('0302000000', '0300000000', 'Pengiriman Barang by Order', 'delivery_order_list.php', '2016-10-01 15:26:44', 'admin', NULL, NULL, NULL, NULL),
('0303000000', '0300000000', 'Faktur Penjualan', 'sales_by_order_list.php', '0000-00-00 00:00:00', '', '2016-10-01 15:26:09', 'admin', NULL, NULL),
('0304000000', '0300000000', 'Penjualan Lainnya', 'sales_non_order_list.php', '0000-00-00 00:00:00', '', '2016-10-01 15:25:53', 'admin', 0, 0),
('0305000000', '0300000000', 'Retur Penjualan', 'sales_return_list.php', '0000-00-00 00:00:00', '', '2016-10-01 15:25:36', 'admin', NULL, NULL),
('0306000000', '0300000000', 'Cetak Surat Jalan', 'surat_jalan_list.php', NULL, NULL, NULL, NULL, NULL, NULL),
('0400000000', '', 'Gudang Produksi', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 0),
('0401000000', '0400000000', 'Penerimaan by Order', 'gudang_produksi_in_by_order_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0402000000', '0400000000', 'Penerimaan non Order', 'gudang_produksi_in_non_order_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 0),
('0403000000', '0400000000', 'Pengeluaran / Pengiriman by Order', 'gudang_produksi_out_by_order_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0404000000', '0400000000', 'Pengeluaran / Pengiriman non Order', 'gudang_produksi_out_non_order_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 0),
('0500000000', '', 'Gudang Bahan Baku', '', '2013-12-25 10:08:18', 'admin', '0000-00-00 00:00:00', '', 5, NULL),
('0503000000', '0500000000', 'Penerimaan Bahan Baku', 'gudang_bahan_in_list.php', '2013-12-25 10:09:50', 'admin', '2013-12-28 16:19:26', 'admin', NULL, NULL),
('0504000000', '0500000000', 'Pengeluaran / Pemakaian Bahan Baku', 'gudang_bahan_out_list.php', '2013-12-25 10:10:17', 'admin', '2013-12-28 16:19:53', 'admin', NULL, NULL),
('7100000000', '', 'Keuangan', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 6, NULL),
('7101000000', '7100000000', 'Kontrabon Piutang', 'kontrabon_piutang_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('7102000000', '7100000000', 'Pembayaran Piutang', 'pembayaran_piutang_list.php', NULL, NULL, NULL, NULL, NULL, NULL),
('7103000000', '7100000000', 'Pembayaran Hutang', 'pembayaran_hutang_list.php', NULL, NULL, NULL, NULL, NULL, NULL),
('7104000000', '7100000000', 'Kontrabon Hutang', 'kontrabon_hutang_list.php', NULL, NULL, NULL, NULL, NULL, NULL),
('7300000000', '', 'Akuntansi', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 7, NULL),
('7301000000', '7300000000', 'Jurnal Kas', 'jurnal_kas_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('7302000000', '7300000000', 'Jurnal Bank', 'jurnal_bank_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('7303000000', '7300000000', 'Jurnal Memorial', 'jurnal_memorial_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('7304000000', '7300000000', 'Laporan Jurnal Transaksi', 'jurnal_transaksi_report.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('7305000000', '7300000000', 'Laporan Neraca Saldo', 'neraca_saldo_report.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('7306000000', '7300000000', 'Laporan Laba Rugi', 'laba_rugi_report.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('7307000000', '7300000000', 'Laporan Neraca Akhir', 'neraca_akhir_report.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('8100000000', '', 'Report', '', NULL, NULL, NULL, NULL, NULL, NULL),
('8101000000', '8100000000', 'Barang', '', NULL, NULL, NULL, NULL, NULL, NULL),
('8101010000', '8101000000', 'Stok Barang', 'stok_produk_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8101020000', '8101000000', 'Mutasi Barang', 'mutasi_product_summary_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8101040000', '8101000000', 'Terima Barang', 'gudang_in_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8101050000', '8101000000', 'Keluar Barang', 'gudang_out_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8102000000', '8100000000', 'Penjualan', '', NULL, NULL, NULL, NULL, NULL, NULL),
('8102010000', '8102000000', 'Order Penjualan', 'sales_order_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8102020000', '8102000000', 'Sisa Order Penjualan', 'sisa_sales_order_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8102030000', '8102000000', 'Penjualan Barang', 'sales_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8102040000', '8102000000', 'Faktur Penjualan', 'faktur_sales_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8102050000', '8102000000', 'Retur Penjualan', 'sales_return_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8102060000', '8102000000', 'Pengiriman Barang', 'delivery_order_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8103000000', '8100000000', 'Pembelian', '', NULL, NULL, NULL, NULL, NULL, NULL),
('8103010000', '8103000000', 'Pembelian Barang', 'purchase_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8103020000', '8103000000', 'Retur Pembelian', 'purchase_return_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104000000', '8100000000', 'Keuangan', '', NULL, NULL, NULL, NULL, NULL, NULL),
('8104010000', '8104000000', 'Piutang', 'piutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104020000', '8104000000', 'Pembayaran Piutang', 'bayar_piutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104030000', '8104000000', 'Saldo Piutang', 'saldo_piutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104040000', '8104000000', 'Mutasi Piutang', 'mutasi_piutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104050000', '8104000000', 'Hutang', 'hutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104060000', '8104000000', 'Pembayaran Hutang', 'bayar_hutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104070000', '8104000000', 'Saldo Hutang', 'saldo_hutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104080000', '8104000000', 'Mutasi Hutang', 'mutasi_hutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104090000', '8104000000', 'Cara Pembayaran Piutang', 'cara_bayar_piutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('8104110000', '8104000000', 'Cara Pembayaran Hutang', 'cara_bayar_hutang_report.php', NULL, NULL, NULL, NULL, NULL, NULL),
('9700000000', '', 'Tool', '', '2013-12-09 13:02:26', 'admin', '0000-00-00 00:00:00', '', 9, NULL),
('9701000000', '9700000000', 'System Maintenence', '', '2013-12-10 14:50:02', 'admin', '0000-00-00 00:00:00', '', NULL, NULL),
('9701010000', '9701000000', 'Menu', 'menu_list.php', '2013-12-10 14:50:36', 'admin', '0000-00-00 00:00:00', '', NULL, NULL),
('9701020000', '9701000000', 'User', 'user_frame.html', '2013-12-11 15:17:10', 'admin', '0000-00-00 00:00:00', '', NULL, NULL),
('9701030000', '9701000000', 'Menu Akses', 'menu_akses.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('9701040000', '9701000000', 'Cabang', 'cabang_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('9701050000', '9701000000', 'Mst Config', 'config_list.php', '2016-09-06 21:06:42', 'admin', NULL, NULL, NULL, NULL),
('9702000000', '9700000000', 'Reff Data', '', '2013-12-11 16:06:33', 'admin', '0000-00-00 00:00:00', '', NULL, NULL),
('9702010000', '9702000000', 'Tipe Reff', 'tipe_reff_list.php', '2013-12-21 09:10:07', 'admin', '0000-00-00 00:00:00', '', NULL, NULL),
('9702020000', '9702000000', 'Reff Data', 'reff_list.php', '2013-12-21 09:11:07', 'admin', '2013-12-21 09:24:14', 'admin', NULL, NULL),
('9703000000', '0800000000', 'Config Properties', 'config_list.php', '2013-12-21 09:42:02', 'admin', '0000-00-00 00:00:00', '', NULL, NULL),
('9704000000', '9700000000', 'Backup Database', 'backupDB.php', '2014-01-08 16:30:02', 'admin', '2014-01-08 16:49:42', 'admin', NULL, NULL),
('9705000000', '9700000000', 'MySQL', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('9705010000', '9705000000', 'Exec Reader', 'mysql_reader.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('9705020000', '9705000000', 'Exec Command', 'mysql_command.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('9706000000', '9700000000', 'Import Form Generator', 'import_form_generator.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('9707000000', '9700000000', 'Download Font Barcode', 'download_font_barcode.php', '2015-05-03 11:54:00', 'admin', '2015-05-03 11:54:29', 'admin', NULL, NULL),
('9709000000', '9700000000', 'Setting Jurnal Otomatis', 'setting_jurnal_otomatis.php', '2015-05-06 15:39:45', 'admin', NULL, NULL, NULL, NULL),
('9711000000', '9700000000', 'Setting Company', 'setting_company.php', '2015-05-12 09:48:15', 'admin', NULL, NULL, NULL, NULL),
('9800000000', '', 'Change Password', 'ubah_password.php', '2013-12-10 14:51:17', 'admin', '0000-00-00 00:00:00', '', 10, NULL),
('9900000000', '', 'Logout', 'logout.php', '2013-12-10 14:51:45', 'admin', '0000-00-00 00:00:00', '', 11, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_menu_akses`
--

CREATE TABLE IF NOT EXISTS `mst_menu_akses` (
  `MenuAkses_ID` int(11) NOT NULL AUTO_INCREMENT,
  `MenuKode` varchar(20) DEFAULT NULL,
  `UserGroup_ID` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`MenuAkses_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `mst_menu_akses`
--

INSERT INTO `mst_menu_akses` (`MenuAkses_ID`, `MenuKode`, `UserGroup_ID`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(16, '0100000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(17, '0104000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(18, '0600000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(19, '0601000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(20, '0602000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(21, '0603000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(22, '0604000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(23, '0700000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(24, '0705000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(25, '0705010000 ', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(26, '0705020000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(27, '0705030000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(28, '0705040000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(29, '0705050000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(30, '0900000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(31, '1100000000', 8, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(32, '0100000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(33, '0101000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(34, '0103000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(35, '0104000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(36, '0800000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(37, '0801000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(38, '0801010000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(39, '0801020000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(40, '0801030000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(41, '0802000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(42, '0802010000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(43, '0802020000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(44, '0803000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(45, '0804000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(46, '0900000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(47, '1100000000', 3, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(48, '0400000000', 6, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(49, '0401000000', 6, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(50, '0402000000', 6, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(51, '0900000000', 6, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(52, '1100000000', 6, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(87, '0101000000', 5, NULL, NULL, NULL, NULL),
(88, '0102000000', 5, NULL, NULL, NULL, NULL),
(89, '0300000000', 5, NULL, NULL, NULL, NULL),
(90, '0400000000', 5, NULL, NULL, NULL, NULL),
(91, '0401000000', 5, NULL, NULL, NULL, NULL),
(92, '0403000000', 5, NULL, NULL, NULL, NULL),
(93, '8102000000', 5, NULL, NULL, NULL, NULL),
(94, '8102010000', 5, NULL, NULL, NULL, NULL),
(95, '8102020000', 5, NULL, NULL, NULL, NULL),
(96, '8102030000', 5, NULL, NULL, NULL, NULL),
(97, '8102040000', 5, NULL, NULL, NULL, NULL),
(98, '8102050000', 5, NULL, NULL, NULL, NULL),
(99, '0104000000', 5, NULL, NULL, NULL, NULL),
(100, '0107000000', 5, NULL, NULL, NULL, NULL),
(101, '0108000000', 5, NULL, NULL, NULL, NULL),
(102, '0114000000', 5, NULL, NULL, NULL, NULL),
(103, '0115000000', 5, NULL, NULL, NULL, NULL),
(104, '8101000000', 5, NULL, NULL, NULL, NULL),
(105, '8101010000', 5, NULL, NULL, NULL, NULL),
(106, '8101020000', 5, NULL, NULL, NULL, NULL),
(107, '8104040000', 5, NULL, NULL, NULL, NULL),
(108, '9900000000', 5, NULL, NULL, NULL, NULL),
(109, '0100000000', 5, NULL, NULL, NULL, NULL),
(110, '0301000000', 5, NULL, NULL, NULL, NULL),
(111, '0302000000', 5, NULL, NULL, NULL, NULL),
(112, '0303000000', 5, NULL, NULL, NULL, NULL),
(113, '0305000000', 5, NULL, NULL, NULL, NULL),
(114, '9800000000', 5, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_perkiraan`
--

CREATE TABLE IF NOT EXISTS `mst_perkiraan` (
  `perkiraan_code` varchar(20) NOT NULL,
  `perkiraan_name` varchar(100) DEFAULT NULL,
  `id_kel_perkiraan` int(11) DEFAULT NULL,
  `stDK` int(11) DEFAULT NULL,
  `stAC` int(11) DEFAULT NULL,
  `stKas` int(11) DEFAULT NULL,
  `stBank` int(11) DEFAULT NULL,
  `TglAwal` date DEFAULT NULL,
  `SaldoAwal` double DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `parent` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`perkiraan_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_perkiraan`
--

INSERT INTO `mst_perkiraan` (`perkiraan_code`, `perkiraan_name`, `id_kel_perkiraan`, `stDK`, `stAC`, `stKas`, `stBank`, `TglAwal`, `SaldoAwal`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `parent`) VALUES
('111.000', 'KAS', NULL, 1, 1, 1, 1, NULL, NULL, '2016-10-07 09:56:41', 'admin', '2016-10-20 15:05:13', 'admin', NULL),
('112.000', 'BANK', NULL, 1, 1, 1, 1, NULL, NULL, '2016-10-20 15:04:01', 'admin', NULL, NULL, NULL),
('113.000', 'Piutang Dagang', NULL, 1, 1, 1, 1, NULL, NULL, '2016-10-20 15:09:23', 'admin', NULL, NULL, NULL),
('114.000', 'Piutang Giro', NULL, 1, 1, 1, 1, NULL, NULL, '2016-10-20 15:11:18', 'admin', NULL, NULL, NULL),
('115.000', 'PIUTANG KARYAWAN', NULL, 1, 0, 1, 1, NULL, NULL, '2016-10-28 17:01:38', 'admin', '2016-11-09 16:12:17', 'admin', NULL),
('119000', 'PIUTANG LAIN-LAIN', NULL, 1, 1, 0, 1, NULL, NULL, '2016-11-10 14:49:34', 'admin', NULL, NULL, NULL),
('120000', 'PERSEDIAAN BARANG JADI MAB', NULL, 1, 1, 0, 0, NULL, NULL, '2016-11-10 15:01:20', 'admin', '2016-11-10 15:01:58', 'admin', NULL),
('121000', 'PERSEDIAAN BARANG JADI MAF', NULL, 1, 1, NULL, NULL, NULL, NULL, '2016-11-10 15:03:55', 'admin', NULL, NULL, NULL),
('122000', 'PERSEDIAAN BAHAN BAKU MAB', NULL, 1, 1, NULL, NULL, NULL, NULL, '2016-11-10 15:04:57', 'admin', NULL, NULL, NULL),
('123000', 'PERSEDIAAN BAHAN BAKU MAF', NULL, 1, 1, NULL, NULL, NULL, NULL, '2016-11-10 15:05:39', 'admin', NULL, NULL, NULL),
('130000', 'TANAH DAN GEDUNG', NULL, 1, 1, NULL, NULL, NULL, NULL, '2016-11-10 15:11:27', 'admin', NULL, NULL, NULL),
('131001', 'PERALATAN KANTOR', NULL, 1, 1, NULL, NULL, NULL, NULL, '2016-11-10 15:13:44', 'admin', NULL, NULL, NULL),
('132000', 'PERALATAN KANTOR', NULL, 1, 1, NULL, NULL, NULL, NULL, '2016-11-10 15:15:12', 'admin', NULL, NULL, NULL),
('211.000', 'HUTANG DAGANG', NULL, 2, 0, 1, 1, NULL, NULL, '2016-10-28 17:03:02', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_photo_sole`
--

CREATE TABLE IF NOT EXISTS `mst_photo_sole` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(50) DEFAULT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `nama_file` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mst_product`
--

CREATE TABLE IF NOT EXISTS `mst_product` (
  `product_code` varchar(50) NOT NULL DEFAULT '',
  `product_name` varchar(100) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `stok_jualbeli` int(11) DEFAULT NULL,
  `stok_keluarterima` int(11) DEFAULT NULL,
  `saldo_awal` int(11) DEFAULT NULL,
  `size1` varchar(10) DEFAULT NULL,
  `size2` varchar(10) DEFAULT NULL,
  `size3` varchar(10) DEFAULT NULL,
  `size4` varchar(10) DEFAULT NULL,
  `size5` varchar(10) DEFAULT NULL,
  `size6` varchar(10) DEFAULT NULL,
  `size7` varchar(10) DEFAULT NULL,
  `size8` varchar(10) DEFAULT NULL,
  `size9` varchar(10) DEFAULT NULL,
  `size10` varchar(10) DEFAULT NULL,
  `kode_jenis` varchar(50) DEFAULT NULL,
  `kode_merek` varchar(50) DEFAULT NULL,
  `kode_kelompok` varchar(50) DEFAULT NULL,
  `kode_negara` varchar(50) DEFAULT NULL,
  `kode_supplier` varchar(50) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `kode_size` varchar(50) DEFAULT NULL,
  `kode_mesin` varchar(50) DEFAULT NULL,
  `test` varchar(50) DEFAULT NULL,
  `kode_artikel` varchar(20) DEFAULT NULL,
  `counter` varchar(20) DEFAULT NULL,
  `kode_sat` varchar(10) DEFAULT NULL,
  `kode_warna` varchar(20) DEFAULT NULL,
  `kode_unit` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_product`
--

INSERT INTO `mst_product` (`product_code`, `product_name`, `harga_beli`, `harga_jual`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `stok_jualbeli`, `stok_keluarterima`, `saldo_awal`, `size1`, `size2`, `size3`, `size4`, `size5`, `size6`, `size7`, `size8`, `size9`, `size10`, `kode_jenis`, `kode_merek`, `kode_kelompok`, `kode_negara`, `kode_supplier`, `keterangan`, `kode_size`, `kode_mesin`, `test`, `kode_artikel`, `counter`, `kode_sat`, `kode_warna`, `kode_unit`) VALUES
('F.B.KC.104', 'KECAP RODA BAKSO 200 ML', 0, 0, '2016-10-31 18:05:52', 'admin', '2016-11-10 11:49:11', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KC', 'OBD', 'B', NULL, NULL, NULL, NULL, NULL, NULL, 'F', '104', 'BAL', NULL, 'PCS'),
('F.B.KC.105', 'KECAP RODA BAKSO 450 ML', 0, 0, '2016-10-31 18:05:02', 'admin', '2016-11-10 11:57:34', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KC', 'OBD', 'B', NULL, NULL, NULL, NULL, NULL, NULL, 'F', '105', 'DUS', NULL, 'PCS'),
('F.B.KC.106', 'KECAP POUCH 80 ML', 0, 0, '2016-11-10 11:39:09', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'KC', 'OBD', 'B', NULL, NULL, NULL, NULL, NULL, NULL, 'F', '106', 'DUS', NULL, 'PCS'),
('F.B.SA.101', 'SAOS CABE OBLADA', 0, 0, '2016-10-31 16:55:25', 'admin', '2016-11-10 11:56:50', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SA', 'OBD', 'B', NULL, NULL, NULL, NULL, NULL, NULL, 'F', '101', 'BAL', NULL, 'PCS'),
('F.B.SA.102', 'SAOS BAWANG OBLADA', 0, 0, '2016-10-31 16:54:27', 'admin', '2016-11-10 11:57:05', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SA', 'OBD', 'B', NULL, NULL, NULL, NULL, NULL, NULL, 'F', '102', 'BAL', NULL, 'PCS'),
('F.B.SA.103', 'SAOS RODA BAKSO', 0, 0, '2016-11-10 10:54:17', 'admin', '2016-11-10 11:48:51', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SA', 'OBD', 'B', NULL, NULL, NULL, NULL, NULL, NULL, 'F', '103', 'BAL', NULL, 'PCS'),
('M.A.LK.001', 'LAKERS BOTOL 600 ML', 0, 2000, '2016-10-06 18:32:54', 'admin', '2016-11-10 08:53:57', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LK', 'LKS', 'A', NULL, NULL, NULL, NULL, NULL, NULL, 'M', '001', 'DUS', NULL, 'PCS'),
('M.A.LK.002', 'LAKERS CUP 220 ML', 0, 12000, '2016-10-06 18:33:38', 'admin', '2016-11-10 08:55:05', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LK', 'LKS', 'A', NULL, NULL, NULL, NULL, NULL, NULL, 'M', '002', 'DUS', NULL, 'PCS'),
('M.A.TH.003', 'NEW OTEH 220 ML', 0, 0, '2016-10-31 16:51:33', 'admin', '2016-11-10 11:47:50', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TH', 'OTH', 'A', NULL, NULL, NULL, NULL, NULL, NULL, 'M', '003', 'DUS', NULL, 'PCS'),
('M.A.TH.004', 'TEH HULA HULA 160 ML', 0, 0, '2016-11-10 11:13:02', 'admin', '2016-11-10 11:57:52', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TH', NULL, 'A', NULL, NULL, NULL, NULL, NULL, NULL, 'M', '004', 'DUS', NULL, 'PCS');

-- --------------------------------------------------------

--
-- Table structure for table `mst_reff`
--

CREATE TABLE IF NOT EXISTS `mst_reff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipeReff` int(11) DEFAULT NULL,
  `KodeReff` varchar(10) DEFAULT NULL,
  `Reff` varchar(30) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=442 ;

--
-- Dumping data for table `mst_reff`
--

INSERT INTO `mst_reff` (`id`, `tipeReff`, `KodeReff`, `Reff`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 1, '1', 'Debet', '2013-12-21 09:29:47', 'admin', '0000-00-00 00:00:00', ''),
(2, 1, '2', 'Kredit', '2013-12-21 09:30:08', 'admin', '0000-00-00 00:00:00', ''),
(3, 2, '1', 'Company', '2013-12-21 10:22:30', 'admin', '0000-00-00 00:00:00', ''),
(4, 2, '2', 'Supplier', '2013-12-21 10:23:33', 'admin', '0000-00-00 00:00:00', ''),
(5, 2, '3', 'Customer', '2013-12-21 10:23:50', 'admin', '0000-00-00 00:00:00', ''),
(6, 2, '4', 'Karyawan', '2013-12-21 10:24:07', 'admin', '0000-00-00 00:00:00', ''),
(7, 4, '1', 'Kas Besar', '2013-12-21 13:25:57', 'admin', '0000-00-00 00:00:00', ''),
(8, 4, '2', 'Kas Direksi', '2013-12-21 13:26:17', 'admin', '0000-00-00 00:00:00', ''),
(9, 4, '3', 'Kas Merauke', '2013-12-21 13:26:35', 'admin', '0000-00-00 00:00:00', ''),
(10, 5, '4', 'Jurnal Bank', '2013-12-21 17:47:13', 'admin', '0000-00-00 00:00:00', ''),
(11, 6, '5', 'Jurnal Pembelian', '2013-12-21 17:49:14', 'admin', '0000-00-00 00:00:00', ''),
(12, 6, '6', 'Jurnal Penjualan', '2013-12-21 17:49:33', 'admin', '0000-00-00 00:00:00', ''),
(13, 6, '7', 'Jurnal lain-lain', '2013-12-21 17:49:52', 'admin', '0000-00-00 00:00:00', ''),
(14, 7, '8', 'Jurnal Memorial', '2013-12-21 17:50:12', 'admin', '0000-00-00 00:00:00', ''),
(15, 3, '1', 'Order Pembelian', '2013-12-25 09:53:36', 'admin', '0000-00-00 00:00:00', ''),
(16, 3, '2', 'Pembelian', '2013-12-25 09:55:10', 'admin', '0000-00-00 00:00:00', ''),
(17, 3, '3', 'Retur Pembelian', '2013-12-25 09:55:25', 'admin', '0000-00-00 00:00:00', ''),
(18, 3, '4', 'Order Penjualan', '2013-12-25 09:55:47', 'admin', '0000-00-00 00:00:00', ''),
(19, 3, '5', 'Penjualan', '2013-12-25 09:56:06', 'admin', '0000-00-00 00:00:00', ''),
(20, 3, '6', 'Retur Penjualan', '2013-12-25 09:56:20', 'admin', '0000-00-00 00:00:00', ''),
(21, 3, '7', 'Penerimaan Barang', '2013-12-25 09:57:00', 'admin', '0000-00-00 00:00:00', ''),
(22, 3, '8', 'Pengeluaran Barang', '2013-12-25 09:57:14', 'admin', '0000-00-00 00:00:00', ''),
(23, 2, '5', 'Gudang', '2013-12-28 15:07:21', 'admin', '0000-00-00 00:00:00', ''),
(24, 3, '9', 'Pembayaran Piutang', '2014-01-01 09:05:28', 'admin', '0000-00-00 00:00:00', ''),
(25, 3, '10', 'Pembayaran Hutang', '2014-01-01 09:05:47', 'admin', '0000-00-00 00:00:00', ''),
(26, 8, '1', 'Antrian', '2014-01-07 12:34:57', 'admin', '0000-00-00 00:00:00', ''),
(27, 8, '2', 'Sedang di Proses', '2014-01-07 12:35:24', 'admin', '0000-00-00 00:00:00', ''),
(28, 8, '3', 'Selesai', '2014-01-07 12:35:35', 'admin', '0000-00-00 00:00:00', ''),
(29, 9, '0', 'Tidak', '2014-01-08 19:43:47', 'admin', '2014-01-08 19:44:44', 'admin'),
(30, 9, '1', 'Ya', '2014-01-08 19:44:09', 'admin', '0000-00-00 00:00:00', ''),
(31, 10, '1', 'Administrator', '2014-01-10 10:46:33', 'admin', '0000-00-00 00:00:00', ''),
(32, 10, '2', 'Management', '2014-01-10 10:46:47', 'admin', '0000-00-00 00:00:00', ''),
(33, 10, '3', 'EDP', '2014-01-10 10:50:13', 'admin', '0000-00-00 00:00:00', ''),
(34, 10, '4', 'Pembelian', '2014-01-10 10:51:41', 'admin', '0000-00-00 00:00:00', ''),
(35, 10, '5', 'Penjualan', '2014-01-10 10:51:52', 'admin', '0000-00-00 00:00:00', ''),
(36, 10, '6', 'Gudang', '2014-01-10 10:52:05', 'admin', '0000-00-00 00:00:00', ''),
(37, 10, '7', 'Keuangan', '2014-01-10 10:52:15', 'admin', '0000-00-00 00:00:00', ''),
(38, 10, '8', 'Akunting', '2014-01-10 10:52:25', 'admin', '0000-00-00 00:00:00', ''),
(39, 10, '9', 'Marketing', '2014-01-10 10:53:04', 'admin', '0000-00-00 00:00:00', ''),
(40, 11, 'SMI', 'Sukabumi', '2014-01-12 08:37:05', 'admin', '0000-00-00 00:00:00', ''),
(41, 11, 'JKT', 'Jakarta', '2014-01-12 08:37:26', 'admin', '0000-00-00 00:00:00', ''),
(42, 11, 'BDG', 'Bandung', '2014-01-12 08:37:40', 'admin', '0000-00-00 00:00:00', ''),
(43, 11, 'SUB', 'Surabaya', '2014-01-12 08:37:51', 'admin', '2016-09-30 10:19:02', 'admin'),
(44, 12, 'INA', 'Indonesia', '2014-01-12 08:38:08', 'admin', '0000-00-00 00:00:00', ''),
(45, 12, 'SNG', 'Singapura', '2014-01-12 08:38:21', 'admin', '0000-00-00 00:00:00', ''),
(46, 12, 'MLY', 'Malaysia', '2014-01-12 08:38:32', 'admin', '0000-00-00 00:00:00', ''),
(47, 13, '1', 'Cash', '2014-01-12 09:27:40', 'admin', '0000-00-00 00:00:00', ''),
(48, 13, '2', 'Transfer', '2014-01-12 09:27:53', 'admin', '0000-00-00 00:00:00', ''),
(49, 13, '3', 'Giro', '2014-01-12 09:28:09', 'admin', '0000-00-00 00:00:00', ''),
(50, 13, '4', 'Cheque', '2014-01-12 09:28:23', 'admin', '0000-00-00 00:00:00', ''),
(52, 15, '39', '39', '2015-02-24 20:38:48', 'admin', '0000-00-00 00:00:00', ''),
(57, 19, 'P', 'Pria', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(58, 19, 'W', 'Wanita', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(59, 20, 'Tetap', 'Tetap', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(60, 20, 'Kontrak', 'Kontrak', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(61, 20, 'Outsource', 'Outsource', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(327, 21, 'MAB', 'MAB', '0000-00-00 00:00:00', '', '2016-09-30 14:21:25', 'admin'),
(328, 21, 'MAF', 'MAF', '0000-00-00 00:00:00', '', '2016-09-30 14:21:47', 'admin'),
(329, 21, 'MAT', 'MAT', '0000-00-00 00:00:00', '', '2016-09-30 14:22:58', 'admin'),
(330, 22, '1', 'Produksi Saos', '0000-00-00 00:00:00', '', '2016-09-30 10:24:58', 'admin'),
(331, 22, '0', 'Produksi Air', '0000-00-00 00:00:00', '', '2016-09-30 10:23:54', 'admin'),
(332, 18, 'OBD', 'OBLADA', '2015-10-17 11:35:12', 'admin', '2016-10-01 17:50:45', 'admin'),
(335, 23, 'M', 'MAB-MINUMAN', '2015-10-21 10:15:18', 'admin', '2016-10-06 10:08:17', 'admin'),
(342, 23, 'T', 'MAT-HASIL BUMI', '2015-12-30 05:50:51', 'admin', '2016-10-06 10:09:14', 'admin'),
(343, 23, 'F', 'MAF-MAKANAN', '2015-12-30 05:53:59', 'admin', '2016-10-06 10:08:43', 'admin'),
(347, 14, 'PTH', 'PUTIH', '2015-12-30 06:15:10', 'admin', '2015-12-30 17:38:03', 'admin'),
(348, 14, 'HTM', 'HITAM', '2015-12-30 17:38:18', 'admin', NULL, NULL),
(349, 14, 'CKT', 'COKLAT', '2015-12-30 17:38:39', 'admin', NULL, NULL),
(353, 18, 'LKS', 'LAKERS', '2016-03-10 11:20:50', 'admin', '2016-10-01 17:50:14', 'admin'),
(356, 18, 'OTH', 'OTEH', '2016-03-18 15:39:47', 'admin', '2016-10-01 18:31:55', 'admin'),
(363, 16, 'C', 'BAHAN BAKU MINUMAN', '2016-03-21 15:46:26', 'admin', '2016-11-09 16:35:43', 'admin'),
(376, 17, 'TH', 'TEH ', '2016-03-21 16:33:50', 'admin', '2016-11-10 11:46:33', 'admin'),
(381, 24, 'DUS', 'DUS', '2016-04-24 17:37:43', 'admin', '2016-09-30 10:17:27', 'admin'),
(389, 16, 'B', 'BARANG JADI MAKANAN', '2016-09-01 09:48:26', 'admin', '2016-11-09 16:35:20', 'admin'),
(394, 14, 'KUNING', 'KUNING', '2016-09-08 13:02:48', 'admin', NULL, NULL),
(395, 14, 'MERAH', 'MERAH', '2016-09-08 13:03:09', 'admin', NULL, NULL),
(397, 14, 'BIRU ', 'BIRU', '2016-09-08 13:09:22', 'admin', NULL, NULL),
(399, 11, 'CRB', 'Cirebon', '2016-09-28 12:21:15', 'admin', NULL, NULL),
(408, 24, 'BAL', 'BAL', '2016-09-30 10:17:39', 'admin', NULL, NULL),
(409, 24, 'PCS', 'PCS', '2016-09-30 10:17:49', 'admin', NULL, NULL),
(410, 11, 'GRT', 'Garut', '2016-09-30 10:19:29', 'admin', '2016-09-30 10:19:46', 'admin'),
(411, 11, 'CJR', 'Cianjur', '2016-09-30 10:20:21', 'admin', NULL, NULL),
(412, 11, 'TSK', 'Tasik', '2016-09-30 10:20:46', 'admin', NULL, NULL),
(413, 11, 'MAJ', 'Majalaya', '2016-09-30 10:21:28', 'admin', NULL, NULL),
(414, 11, 'PUR', 'Purwakarta', '2016-09-30 10:22:05', 'admin', NULL, NULL),
(415, 11, 'CMH', 'Cimahi', '2016-09-30 10:22:50', 'admin', NULL, NULL),
(416, 22, '3', 'Produksi Hasil Bumi', '2016-09-30 10:25:22', 'admin', NULL, NULL),
(418, 16, 'D', 'BAHAN BAKU MAKANAN', '2016-10-05 15:44:16', 'admin', '2016-11-09 16:35:55', 'admin'),
(419, 17, 'LK', 'LAKERS ', '2016-10-05 15:45:24', 'admin', '2016-10-14 17:36:00', 'admin'),
(421, 25, 'KRG', 'KARUNG', '2016-10-05 20:12:58', 'admin', '2016-10-06 16:28:44', 'admin'),
(422, 25, 'PCS', 'PCS', '2016-10-06 16:28:56', 'admin', NULL, NULL),
(423, 25, 'JRG', 'JARING', '2016-10-06 16:29:08', 'admin', NULL, NULL),
(426, 16, 'A', 'BARANG JADI MINUMAN', '2016-10-14 17:04:06', 'admin', '2016-11-09 16:34:54', 'admin'),
(428, 17, 'BT', 'BOTOL', '2016-10-21 15:07:51', 'admin', '2016-10-21 15:08:07', 'admin'),
(429, 25, 'BAL', 'BAL', '2016-10-21 15:10:25', 'admin', NULL, NULL),
(430, 25, 'DUS', 'DUS', '2016-10-21 15:11:04', 'admin', NULL, NULL),
(431, 26, '1', 'Admin', NULL, NULL, NULL, NULL),
(432, 26, '2', 'Supervisor', NULL, NULL, NULL, NULL),
(433, 26, '3', 'User', NULL, NULL, NULL, NULL),
(436, 16, 'N', 'LAIN-LAIN', '2016-11-09 16:41:06', 'admin', NULL, NULL),
(437, 24, 'KG', 'KG', '2016-11-10 09:05:15', 'admin', NULL, NULL),
(438, 17, 'IN', 'IONASIS', '2016-11-10 11:32:49', 'admin', NULL, NULL),
(439, 18, 'ION', 'IONASIS', '2016-11-10 11:34:23', 'admin', '2016-11-10 11:34:38', 'admin'),
(440, 17, 'KC', 'KECAP', '2016-11-10 11:36:53', 'admin', NULL, NULL),
(441, 17, 'SA', 'SAOS', '2016-11-10 11:37:48', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_size`
--

CREATE TABLE IF NOT EXISTS `mst_size` (
  `kode_size` varchar(50) NOT NULL,
  `size1` varchar(10) DEFAULT NULL,
  `size2` varchar(10) DEFAULT NULL,
  `size3` varchar(10) DEFAULT NULL,
  `size4` varchar(10) DEFAULT NULL,
  `size5` varchar(10) DEFAULT NULL,
  `size6` varchar(10) DEFAULT NULL,
  `size7` varchar(10) DEFAULT NULL,
  `size8` varchar(10) DEFAULT NULL,
  `size9` varchar(10) DEFAULT NULL,
  `size10` varchar(10) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(50) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kode_size`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_size`
--

INSERT INTO `mst_size` (`kode_size`, `size1`, `size2`, `size3`, `size4`, `size5`, `size6`, `size7`, `size8`, `size9`, `size10`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
('A', '1', '2', '3', '4', '5', '6', '7', '8', NULL, NULL, '2015-05-13 10:34:47', 'admin', '2016-09-30 10:16:11', 'admin'),
('All Size', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-02 07:02:48', 'admin', NULL, NULL),
('No Size', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-02 07:02:28', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_tipe_reff`
--

CREATE TABLE IF NOT EXISTS `mst_tipe_reff` (
  `tipe_reff` int(11) NOT NULL,
  `tipe_reff_desc` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`tipe_reff`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_tipe_reff`
--

INSERT INTO `mst_tipe_reff` (`tipe_reff`, `tipe_reff_desc`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 'Debet / Kredit', '2013-12-21 09:21:21', 'admin', '2013-12-21 09:21:42', 'admin'),
(2, 'Tipe Contact', '2013-12-21 10:19:42', 'admin', '0000-00-00 00:00:00', ''),
(3, 'Tipe Transaksi', '2013-12-21 10:19:59', 'admin', '0000-00-00 00:00:00', ''),
(4, 'Tipe Jurnal Kas', '2013-12-21 13:24:57', 'admin', '0000-00-00 00:00:00', ''),
(5, 'Tipe Jurnal Bank', '2013-12-21 13:25:26', 'admin', '0000-00-00 00:00:00', ''),
(6, 'Jurnal Transaksi', '2013-12-21 17:48:32', 'admin', '0000-00-00 00:00:00', ''),
(7, 'Jurnal Memorial', '2013-12-21 17:48:45', 'admin', '0000-00-00 00:00:00', ''),
(8, 'Status Order', '2014-01-07 12:34:30', 'admin', '0000-00-00 00:00:00', ''),
(9, 'Ya/Tidak', '2014-01-08 19:43:31', 'admin', '0000-00-00 00:00:00', ''),
(10, 'Group User', '2014-01-10 10:46:16', 'admin', '0000-00-00 00:00:00', ''),
(11, 'Kota', '2014-01-12 08:36:23', 'admin', '0000-00-00 00:00:00', ''),
(12, 'Negara', '2014-01-12 08:36:34', 'admin', '0000-00-00 00:00:00', ''),
(13, 'Cara Bayar', '2014-01-12 09:27:23', 'admin', '0000-00-00 00:00:00', ''),
(14, 'Warna', '2015-02-24 20:37:27', 'admin', '0000-00-00 00:00:00', ''),
(15, 'Size', '2015-02-24 20:37:42', 'admin', '0000-00-00 00:00:00', ''),
(16, 'Kelompok Barang', '2015-05-01 11:05:16', 'admin', NULL, NULL),
(17, 'Jenis Barang', '2015-05-01 11:05:31', 'admin', NULL, NULL),
(18, 'Merek Barang', '2015-05-01 11:05:56', 'admin', NULL, NULL),
(19, 'Jenis Kelamin', '2015-05-04 15:06:46', 'admin', NULL, NULL),
(20, 'Status Kerja', '2015-05-04 15:07:00', 'admin', NULL, NULL),
(21, 'Kelompok Beli', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(22, 'Mesin Produksi', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(23, 'Artikel', '2015-12-30 21:19:51', 'admin', NULL, NULL),
(24, 'Satuan Barang', NULL, NULL, NULL, NULL),
(25, 'Unit Barang', '2016-10-05 19:49:05', 'admin', NULL, NULL),
(26, 'Level User', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mst_user`
--

CREATE TABLE IF NOT EXISTS `mst_user` (
  `user_id` varchar(20) NOT NULL,
  `user_pass` varchar(100) DEFAULT NULL,
  `user_nama` varchar(255) DEFAULT NULL,
  `group_user_id` int(11) DEFAULT NULL,
  `status_aktif` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `kode_cabang` varchar(20) DEFAULT NULL,
  `level_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`user_id`, `user_pass`, `user_nama`, `group_user_id`, `status_aktif`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `kode_cabang`, `level_user_id`) VALUES
('02', '123456', 'TIA', 5, 1, '2016-10-06 15:48:44', 'admin', '2016-11-02 09:48:43', 'admin', NULL, 3),
('04', '123456', 'TRIE', 5, 1, '2016-10-21 09:54:29', 'admin', NULL, NULL, NULL, 1),
('09', '123456', 'Endin', 3, 1, '2016-11-02 11:23:37', 'admin', NULL, NULL, NULL, 2),
('admin', '78952', 'admin', 1, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '000', 1),
('akunting', '123456', 'akunting', 8, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '000', 1),
('edp', '123456', 'edp', 3, 1, '2014-01-11 10:01:13', 'admin', '0000-00-00 00:00:00', '', '000', 1),
('edp1', '123456', 'edp1', 3, 0, '2014-01-11 10:02:54', 'admin', '2014-01-11 10:11:13', 'edp1', '000', 1),
('gudang', '123456', 'gudang', 6, 1, '2014-01-11 10:10:54', 'edp1', '0000-00-00 00:00:00', '', '000', 1),
('management', '123456', 'management s', 2, 1, '0000-00-00 00:00:00', '', '2014-01-10 18:16:28', 'admin', '000', 1),
('MERRY', '123456', 'MERRY', 8, 1, '2016-10-08 15:24:59', 'admin', NULL, NULL, NULL, 1),
('NOVI', '123456', 'NOVI', 7, 1, '2016-10-08 15:25:46', 'admin', NULL, NULL, NULL, 1),
('test', '123456', 'Testing', 6, 1, '2015-02-12 10:34:24', 'admin', '0000-00-00 00:00:00', '', '000', 1),
('TIA', '123456', 'TIA', 5, 1, '2016-10-06 17:03:34', 'admin', NULL, NULL, NULL, 1),
('TRIE', '123456', 'TRIE', 5, 1, '2016-11-02 09:46:13', 'admin', NULL, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `trx_bayar`
--

CREATE TABLE IF NOT EXISTS `trx_bayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_kode` varchar(20) DEFAULT NULL,
  `no_invoice` varchar(50) DEFAULT NULL,
  `tgl_invoice` date DEFAULT NULL,
  `jml_invoice` double DEFAULT NULL,
  `telah_bayar` double DEFAULT NULL,
  `jml_hutang` double DEFAULT NULL,
  `jml_bayar` double DEFAULT NULL,
  `ket_bayar` varchar(100) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `trx_bayar`
--

INSERT INTO `trx_bayar` (`id`, `transaksi_kode`, `no_invoice`, `tgl_invoice`, `jml_invoice`, `telah_bayar`, `jml_hutang`, `jml_bayar`, `ket_bayar`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(10, 'PBP16100030', 'STO16090044', '2016-09-30', 2000000, 0, 2000000, 1000000, NULL, NULL, NULL, NULL, NULL),
(12, 'PBH16100015', 'PTN16100005', '2016-10-21', 1095000, 0, 1095000, 1095000, NULL, NULL, NULL, NULL, NULL),
(13, 'BPX16100031', 'STO16100047', '2016-10-20', 420000, 0, 420000, 420000, NULL, NULL, NULL, NULL, NULL),
(15, 'BPX16100032', 'SBM16100048', '2016-10-19', 2600000, 0, 2600000, 2600000, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_besar`
--

CREATE TABLE IF NOT EXISTS `trx_besar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `kodeac` varchar(50) DEFAULT NULL,
  `kodedc` varchar(50) DEFAULT NULL,
  `stdk` int(11) DEFAULT NULL,
  `debet` double DEFAULT NULL,
  `kredit` double DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `no_reff` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `trx_besar`
--

INSERT INTO `trx_besar` (`id`, `jenis_transaksi`, `no_transaksi`, `tgl_transaksi`, `kodeac`, `kodedc`, `stdk`, `debet`, `kredit`, `ket`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `no_reff`) VALUES
(1, 1, 'JKX16100004', '2016-10-27', '111.000', '112.000', 1, 10000000, 0, 'Isi Kas', NULL, NULL, NULL, NULL, NULL),
(2, 1, 'JKX16100004', '2016-10-27', '112.000', '111.000', 1, 0, 10000000, 'Isi Kas', NULL, NULL, NULL, NULL, NULL),
(3, 4, 'JBX16100002', '2016-10-29', '111.000', '211.000', 2, 0, 20000000, 'byr htg', NULL, NULL, NULL, NULL, NULL),
(4, 4, 'JBX16100002', '2016-10-29', '211.000', '111.000', 2, 20000000, 0, 'byr htg', NULL, NULL, NULL, NULL, NULL),
(5, 8, 'JMX16100002', '2016-10-29', '115.00', NULL, NULL, 1000000, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 8, 'JMX16100002', '2016-10-29', '111.000', NULL, NULL, 0, 1000000, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_cara_bayar`
--

CREATE TABLE IF NOT EXISTS `trx_cara_bayar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_kode` varchar(50) DEFAULT NULL,
  `cara_bayar` varchar(50) DEFAULT NULL,
  `perkiraan_code` varchar(50) DEFAULT NULL,
  `perkiraan_name` varchar(50) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `no_reff` varchar(50) DEFAULT NULL,
  `tgl_reff` varchar(50) DEFAULT NULL,
  `ket_reff` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `trx_cara_bayar`
--

INSERT INTO `trx_cara_bayar` (`id`, `transaksi_kode`, `cara_bayar`, `perkiraan_code`, `perkiraan_name`, `jumlah`, `no_reff`, `tgl_reff`, `ket_reff`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(8, 'PBH16100015', '1', '114.000', 'Piutang Giro', 1095000, '334324', '2016-10-29', 'BCA', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_catatan`
--

CREATE TABLE IF NOT EXISTS `trx_catatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) DEFAULT NULL,
  `catatan` varchar(50) DEFAULT NULL,
  `input_by` varchar(50) DEFAULT NULL,
  `input_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail`
--

CREATE TABLE IF NOT EXISTS `trx_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_kode` varchar(20) DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga_beli` double DEFAULT NULL,
  `harga_jual` double DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `disc_persen` double DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `ket_detail` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `kode_warna` varchar(50) DEFAULT NULL,
  `kode_size1` varchar(10) DEFAULT NULL,
  `kode_size2` varchar(10) DEFAULT NULL,
  `kode_size3` varchar(10) DEFAULT NULL,
  `kode_size4` varchar(10) DEFAULT NULL,
  `kode_size5` varchar(10) DEFAULT NULL,
  `kode_size6` varchar(10) DEFAULT NULL,
  `kode_size7` varchar(10) DEFAULT NULL,
  `kode_size8` varchar(10) DEFAULT NULL,
  `kode_size9` varchar(10) DEFAULT NULL,
  `kode_size10` varchar(10) DEFAULT NULL,
  `qty_size1` int(11) DEFAULT NULL,
  `qty_size2` int(11) DEFAULT NULL,
  `qty_size3` int(11) DEFAULT NULL,
  `qty_size4` int(11) DEFAULT NULL,
  `qty_size5` int(11) DEFAULT NULL,
  `qty_size6` int(11) DEFAULT NULL,
  `qty_size7` int(11) DEFAULT NULL,
  `qty_size8` int(11) DEFAULT NULL,
  `qty_size9` int(11) DEFAULT NULL,
  `qty_size10` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `no_order` varchar(50) DEFAULT NULL,
  `kode_cust` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=657 ;

--
-- Dumping data for table `trx_detail`
--

INSERT INTO `trx_detail` (`id`, `transaksi_kode`, `product_code`, `product_name`, `satuan`, `qty`, `harga_beli`, `harga_jual`, `sub_total`, `disc_persen`, `disc_amount`, `total`, `ket_detail`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `kode_warna`, `kode_size1`, `kode_size2`, `kode_size3`, `kode_size4`, `kode_size5`, `kode_size6`, `kode_size7`, `kode_size8`, `kode_size9`, `kode_size10`, `qty_size1`, `qty_size2`, `qty_size3`, `qty_size4`, `qty_size5`, `qty_size6`, `qty_size7`, `qty_size8`, `qty_size9`, `qty_size10`, `harga`, `no_order`, `kode_cust`) VALUES
(551, 'SOR16090039', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(552, 'STO16090044', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 20000, 'SOR16090039', NULL),
(553, 'SOR16100040', 'A.SC.SA.03', 'SAOS CABE OBLADA', NULL, 150, NULL, NULL, 45000000, 0, 0, 45000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 300000, NULL, NULL),
(554, '16100001', 'A.SC.SA.03', 'SAOS CABE OBLADA', NULL, 50, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'SOR16100040', NULL),
(556, 'SDO16100002', 'A.SC.SA.03', 'SAOS CABE OBLADA', NULL, 35, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'SOR16100040', NULL),
(557, 'SOR16100041', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(558, 'SOR16100041', 'A.LC.LK.01', 'LAKERS CUP 240 ML', NULL, 50, NULL, NULL, 600000, 0, 0, 600000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(559, 'SDO16100003', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 100, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'SOR16100041', NULL),
(560, 'SDO16100003', 'A.LC.LK.01', 'LAKERS CUP 240 ML', NULL, 50, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'SOR16100041', NULL),
(561, 'SOR16100042', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 200, NULL, NULL, 4000000, 0, 0, 4000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(562, 'SOR16100042', 'A.LC.LK.01', 'LAKERS CUP 240 ML', NULL, 100, NULL, NULL, 1200000, 0, 0, 1200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(563, 'SOR16100043', 'A.LC.LK.01', 'LAKERS CUP 240 ML', 'DUS', 15, NULL, NULL, 180000, 0, 0, 180000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(564, 'SDO16100004', 'A.LC.LK.01', 'LAKERS CUP 240 ML', 'DUS', 15, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 'SOR16100043', NULL),
(566, 'SDO16100005', 'A.SC.SA.03', 'SAOS CABE OBLADA', NULL, 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16100040', 'C000016'),
(567, 'SDO16100005', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16100041', 'C000017'),
(568, 'SDO16100005', 'A.LC.LK.01', 'LAKERS CUP 240 ML', NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16100041', 'C000017'),
(569, 'SDO16100005', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16100042', 'C000017'),
(570, 'SDO16100006', 'A.LB.LK.02', 'LAKERS BOTOL 600 ML', NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16090039', 'C000015'),
(571, 'SDO16100006', 'A.LC.LK.01', 'LAKERS CUP 240 ML', NULL, 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16100042', 'C000017'),
(572, 'SDO16100006', 'A.LC.LK.01', 'LAKERS CUP 240 ML', 'DUS', 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16100043', 'C000017'),
(573, 'SOR16100044', 'A.LA.LB.001', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(577, 'SOM16100045', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 210, NULL, NULL, 420000, 0, 0, 420000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL),
(578, 'SDO16100007', 'A.LA.LB.001', 'LAKERS BOTOL 600 ML', 'DUS', 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOR16100044', 'C000017'),
(579, 'SDO16100008', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 210, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100045', 'C000015'),
(580, 'SOF16100046', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 100, NULL, NULL, 1200000, 0, 0, 1200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(581, 'SOF16100046', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 125, NULL, NULL, 250000, 0, 0, 250000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL),
(586, 'SDO16100009', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16100046', 'C000015'),
(587, 'SDO16100009', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16100046', 'C000015'),
(588, 'SOM16100047', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(589, 'SOM16100047', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, 2400000, 0, 0, 2400000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(590, 'SDO16100010', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100047', 'C000016'),
(591, 'SDO16100010', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100047', 'C000016'),
(594, 'STO16100046', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, 'SOM16100047', NULL),
(595, 'STO16100046', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, 2400000, 0, 0, 2400000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, 'SOM16100047', NULL),
(596, 'SOM16100048', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 200000, 0, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL),
(597, 'SOM16100048', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, 2400000, 0, 0, 2400000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(598, 'SDO16100011', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100048', 'C000017'),
(599, 'SDO16100011', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100048', 'C000017'),
(600, 'STO16100047', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 210, NULL, NULL, 420000, 0, 0, 420000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, 'SOM16100045', NULL),
(601, 'SOM16100049', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 1, NULL, NULL, 2000, 0, 0, 2000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL),
(602, 'SOM16100050', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 200000, 0, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL),
(603, 'SOM16100050', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, 2400000, 0, 0, 2400000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(604, 'SOF16100051', 'F.SA.SC.50', 'SAOS CABE OBLADA', 'BAL', 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(605, 'SDO16100012', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100049', 'C000016'),
(606, 'SDO16100012', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100050', 'C000017'),
(607, 'SDO16100012', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100050', 'C000017'),
(608, 'SDO16100013', 'F.SA.SC.50', 'SAOS CABE OBLADA', 'BAL', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16100051', 'C000015'),
(609, 'PTN16100005', 'M.GF.BT.001', 'BOTOL PET 2925 NATURAL', 'BAL', 300, NULL, NULL, 1095000, 0, 0, 1095000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 36500, NULL, NULL),
(610, 'SOM16100052', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 2000000, 0, 0, 2000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(611, 'SOM16100052', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, 2400000, 0, 0, 2400000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(612, 'SOM16100053', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 300, NULL, NULL, 600000, 0, 0, 600000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, NULL, NULL),
(613, 'SOM16100053', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 500, NULL, NULL, 6000000, 0, 0, 6000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(614, 'DOM16100014', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100052', 'C000017'),
(615, 'DOM16100014', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100052', 'C000017'),
(616, 'SBM16100048', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 200000, 0, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, 'SOM16100048', NULL),
(617, 'SBM16100048', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, 2400000, 0, 0, 2400000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, 'SOM16100048', NULL),
(618, 'DOM16100015', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100053', 'C000016'),
(619, 'DOM16100015', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100053', 'C000016'),
(620, 'SOF16110054', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 50, NULL, NULL, 1150000, 0, 0, 1150000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23000, NULL, NULL),
(621, 'SOF16110054', 'F.SA.SB.100', 'SAOS BAWANG OBLADA', 'BAL', 30, NULL, NULL, 720000, 0, 0, 720000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24000, NULL, NULL),
(622, 'SOF16110054', 'F.KEC.KC.102', 'KECAP RODA BAKSO 450 ML', 'DUS', 15, NULL, NULL, 1200000, 0, 0, 1200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 80000, NULL, NULL),
(623, 'SOF16110055', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 100, NULL, NULL, 2200000, 0, 0, 2200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22000, NULL, NULL),
(624, 'SOF16110056', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 200, NULL, NULL, 3900000, 0, 0, 3900000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19500, NULL, NULL),
(625, 'DOF16110016', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110054', 'C000026'),
(626, 'DOF16110016', 'F.SA.SB.100', 'SAOS BAWANG OBLADA', 'BAL', 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110054', 'C000026'),
(627, 'DOF16110016', 'F.KEC.KC.102', 'KECAP RODA BAKSO 450 ML', 'DUS', 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110054', 'C000026'),
(628, 'DOF16110016', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110055', 'C000027'),
(629, 'DOF16110016', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110056', 'C000029'),
(630, 'SBF16110049', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 50, NULL, NULL, 1150000, 0, 0, 1150000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23000, 'SOF16110054', NULL),
(631, 'SBF16110049', 'F.SA.SB.100', 'SAOS BAWANG OBLADA', 'BAL', 30, NULL, NULL, 720000, 0, 0, 720000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24000, 'SOF16110054', NULL),
(632, 'SBF16110049', 'F.KEC.KC.102', 'KECAP RODA BAKSO 450 ML', 'DUS', 15, NULL, NULL, 1200000, 0, 0, 1200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 80000, 'SOF16110054', NULL),
(633, 'SBF16110050', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 100, NULL, NULL, 2200000, 0, 0, 2200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22000, 'SOF16110055', NULL),
(634, 'SOM16110057', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 100, NULL, NULL, 1200000, 0, 0, 1200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(635, 'SOM16110057', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 2, NULL, NULL, 24000, 0, 0, 24000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(636, 'SBF16110051', 'F.SA.SC.101', 'SAOS CABE OBLADA', 'BAL', 200, NULL, NULL, 3900000, 0, 0, 3900000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19500, 'SOF16110056', NULL),
(637, 'SOM16110058', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 100, NULL, NULL, 1200000, 0, 0, 1200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(638, 'SOM16110058', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 2, NULL, NULL, 24000, 0, 0, 24000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(639, 'SOM16110059', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 50, NULL, NULL, 600000, 0, 0, 600000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(640, 'SOM16110059', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 1, NULL, NULL, 12000, 0, 0, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(641, 'SOM16110059', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 50, NULL, NULL, 1000000, 0, 0, 1000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20000, NULL, NULL),
(642, 'SOM16110060', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 50, NULL, NULL, 600000, 0, 0, 600000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(643, 'SOM16110060', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 1, NULL, NULL, 12000, 0, 0, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL, NULL),
(644, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110057', 'C000030'),
(645, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110057', 'C000030'),
(646, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110058', 'C000031'),
(647, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110058', 'C000031'),
(648, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110059', 'C000032'),
(649, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110059', 'C000032'),
(650, 'DOM16110017', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110059', 'C000032'),
(651, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110060', 'C000033'),
(652, 'DOM16110017', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110060', 'C000033'),
(653, 'SBM16110052', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 100, NULL, NULL, 1200000, 0, 0, 1200000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, 'SOM16110057', NULL),
(654, 'SBM16110052', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 2, NULL, NULL, 24000, 0, 0, 24000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, 'SOM16110057', NULL),
(655, 'SBM16110053', 'M.LA.LB.01', 'LAKERS BOTOL 600 ML', 'DUS', 100, NULL, NULL, 200000, 10, 20000, 180000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2000, 'SOM16100050', NULL),
(656, 'SBM16110053', 'M.LA.LC.02', 'LAKERS CUP 220 ML', 'DUS', 200, NULL, NULL, 2400000, 10, 240000, 2160000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, 'SOM16100050', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_gudang`
--

CREATE TABLE IF NOT EXISTS `trx_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `qty_in` int(11) DEFAULT NULL,
  `qty_out` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `gudang_kode` varchar(20) DEFAULT NULL,
  `ketheader` varchar(255) DEFAULT NULL,
  `ketdetail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trx_invoice`
--

CREATE TABLE IF NOT EXISTS `trx_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `no_invoice` varchar(20) DEFAULT NULL,
  `jml_in` double DEFAULT NULL,
  `jml_out` double DEFAULT NULL,
  `contact_code` varchar(20) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `no_reff` varchar(50) DEFAULT NULL,
  `tgl_invoice` date DEFAULT NULL,
  `jml_invoice` double DEFAULT NULL,
  `sub_transaksi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=219 ;

--
-- Dumping data for table `trx_invoice`
--

INSERT INTO `trx_invoice` (`id`, `jenis_transaksi`, `no_transaksi`, `tgl_transaksi`, `no_invoice`, `jml_in`, `jml_out`, `contact_code`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `no_reff`, `tgl_invoice`, `jml_invoice`, `sub_transaksi`) VALUES
(207, 6, 'STO16090044', '2016-09-30', 'STO16090044', 2000000, 0, 'C000015', '2016-09-30 15:08:33', 'admin', NULL, NULL, NULL, '2016-09-30', 2000000, 3),
(210, 6, 'STO16100046', '2016-10-15', 'STO16100046', 4400000, 0, 'C000016', '2016-10-15 14:16:21', 'admin', NULL, NULL, 'SOM16100047', '2016-10-15', 4400000, 3),
(211, 6, 'STO16100047', '2016-10-20', 'STO16100047', 420000, 0, 'C000015', '2016-10-20 14:46:27', 'admin', NULL, NULL, 'SOM16100045', '2016-10-20', 420000, 3),
(212, 3, 'PTN16100005', '2016-10-21', 'PTN16100005', 1095000, 0, 'S000008', '2016-10-21 15:53:08', 'admin', NULL, NULL, NULL, '2016-10-21', 1095000, 3),
(213, 6, 'SBM16100048', '2016-10-19', 'SBM16100048', 2600000, 0, 'C000017', '2016-10-26 13:38:11', 'admin', NULL, NULL, 'SOM16100048', '2016-10-19', 2600000, 3),
(214, 6, 'SBF16110049', '2016-11-02', 'SBF16110049', 3070000, 0, 'C000026', '2016-11-02 14:13:39', '02', NULL, NULL, 'SOF16110054', '2016-11-02', 3070000, 3),
(215, 6, 'SBF16110050', '2016-11-02', 'SBF16110050', 2200000, 0, 'C000027', '2016-11-02 14:15:57', '02', NULL, NULL, 'SOF16110055', '2016-11-02', 2200000, 3),
(216, 6, 'SBF16110051', '2016-11-02', 'SBF16110051', 3900000, 0, 'C000029', '2016-11-02 14:16:59', '02', NULL, NULL, 'SOF16110056', '2016-11-02', 3900000, 3),
(217, 6, 'SBM16110052', '2016-11-02', 'SBM16110052', 1224000, 0, 'C000030', '2016-11-02 14:41:34', '04', NULL, NULL, 'SOM16110057', '2016-11-02', 1224000, 3),
(218, 6, 'SBM16110053', '2016-11-10', 'SBM16110053', 2340000, 0, 'C000017', '2016-11-10 10:49:13', 'admin', NULL, NULL, 'SOM16100050', '2016-11-10', 2340000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `trx_jurnal`
--

CREATE TABLE IF NOT EXISTS `trx_jurnal` (
  `jurnal_code` varchar(20) NOT NULL,
  `jurnal_date` date DEFAULT NULL,
  `tipe_jurnal` int(11) DEFAULT NULL,
  `perkiraan_header_code` varchar(20) DEFAULT NULL,
  `status_debet_kredit` int(11) DEFAULT NULL,
  `dari_bagian` varchar(20) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `jumlah_debet` double DEFAULT NULL,
  `jumlah_kredit` double DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `kode_divisi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`jurnal_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_jurnal`
--

INSERT INTO `trx_jurnal` (`jurnal_code`, `jurnal_date`, `tipe_jurnal`, `perkiraan_header_code`, `status_debet_kredit`, `dari_bagian`, `jumlah`, `jumlah_debet`, `jumlah_kredit`, `keterangan`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `kode_divisi`) VALUES
('JBX16100002', '2016-10-29', 4, '111.000', 2, 'S000008', 20000000, NULL, NULL, NULL, '2016-10-29 12:14:39', 'admin', NULL, NULL, NULL),
('JKX16100004', '2016-10-27', 1, '111.000', 1, NULL, 10000000, NULL, NULL, NULL, '2016-10-27 11:04:05', 'admin', NULL, NULL, 'M'),
('JMX16100002', '2016-10-29', 8, NULL, NULL, NULL, NULL, 1000000, 1000000, NULL, '2016-10-29 15:21:37', 'admin', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_jurnal_detail`
--

CREATE TABLE IF NOT EXISTS `trx_jurnal_detail` (
  `jurnal_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `jurnal_code` varchar(20) DEFAULT NULL,
  `perkiraan_code` varchar(50) DEFAULT NULL,
  `perkiraan_name` varchar(255) DEFAULT NULL,
  `flag_perkiraan_Header` int(11) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `jumlah_debet` double DEFAULT NULL,
  `jumlah_kredit` double DEFAULT NULL,
  `no_dok` varchar(20) DEFAULT NULL,
  `tgl_dok` date DEFAULT NULL,
  `ket_dok` varchar(50) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`jurnal_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `trx_jurnal_detail`
--

INSERT INTO `trx_jurnal_detail` (`jurnal_detail_id`, `jurnal_code`, `perkiraan_code`, `perkiraan_name`, `flag_perkiraan_Header`, `jumlah`, `jumlah_debet`, `jumlah_kredit`, `no_dok`, `tgl_dok`, `ket_dok`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 'JKX16100004', '112.000', 'BANK', NULL, 10000000, NULL, NULL, '12345', '2016-10-21', 'Isi Kas', NULL, NULL, NULL, NULL),
(2, 'JBX16100002', '211.000', 'HUTANG DAGANG', NULL, 20000000, NULL, NULL, '145353', '2016-10-31', 'byr htg', NULL, NULL, NULL, NULL),
(3, 'JMX16100002', '115.00', 'PIUTANG KARYAWAN', NULL, NULL, 1000000, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'JMX16100002', '111.000', 'KAS', NULL, NULL, 0, 1000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_kontrabon`
--

CREATE TABLE IF NOT EXISTS `trx_kontrabon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_kode` varchar(20) DEFAULT NULL,
  `no_invoice` varchar(50) DEFAULT NULL,
  `tgl_invoice` date DEFAULT NULL,
  `jml_invoice` double DEFAULT NULL,
  `telah_bayar` double DEFAULT NULL,
  `jml_hutang` double DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `trx_kontrabon`
--

INSERT INTO `trx_kontrabon` (`id`, `transaksi_kode`, `no_invoice`, `tgl_invoice`, `jml_invoice`, `telah_bayar`, `jml_hutang`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 'PBP16020001', 'STN16020001', '2016-02-07', 11636352, 0, 11636352, NULL, NULL, NULL, NULL),
(2, 'KOP16030001', 'STO16020001', '2016-02-07', 4646460, 0, 4646460, NULL, NULL, NULL, NULL),
(3, 'KOP16030002', 'STO16030003', '2016-03-14', 2094261, 0, 2094261, NULL, NULL, NULL, NULL),
(4, 'KOP16030002', 'STO16030004', '2016-03-15', 1062646, 0, 1062646, NULL, NULL, NULL, NULL),
(5, 'KOP16030002', 'STO16030005', '2016-03-16', 1237000, 0, 1237000, NULL, NULL, NULL, NULL),
(6, 'KOP16030003', 'STO16030007', '2016-03-19', 1040000, 0, 1040000, NULL, NULL, NULL, NULL),
(7, 'KOP16040004', 'STO16040010', '2016-04-05', 1750000, 0, 1750000, NULL, NULL, NULL, NULL),
(8, 'KOP16040005', 'STO16040011', '2016-04-25', 253000, 0, 253000, NULL, NULL, NULL, NULL),
(9, 'KOP16040006', 'STO16040012', '2016-04-25', 115000, 0, 115000, NULL, NULL, NULL, NULL),
(10, 'KOP16040007', 'STO16040014', '2016-04-26', 200000, 0, 200000, NULL, NULL, NULL, NULL),
(11, 'KOP16040008', 'STO16040017', '2016-04-27', 750000, 0, 750000, NULL, NULL, NULL, NULL),
(12, 'KOP16050009', 'STO16050020', '2016-05-17', 3534375, 0, 3534375, NULL, NULL, NULL, NULL),
(13, 'KOP16050010', 'STO16040014', '2016-04-26', 200000, 0, 200000, NULL, NULL, NULL, NULL),
(14, 'KOP16050010', 'STO16040015', '2016-04-27', 450000, 0, 450000, NULL, NULL, NULL, NULL),
(15, 'KOP16050010', 'STO16050021', '2016-05-19', 2315625, 0, 2315625, NULL, NULL, NULL, NULL),
(16, 'KOP16050011', 'STO16040014', '2016-04-26', 200000, 0, 200000, NULL, NULL, NULL, NULL),
(17, 'KOP16050011', 'STO16040015', '2016-04-27', 450000, 0, 450000, NULL, NULL, NULL, NULL),
(18, 'KOP16050012', 'STO16040015', '2016-04-27', 450000, 0, 450000, NULL, NULL, NULL, NULL),
(19, 'KOP16050012', 'STO16050020', '2016-05-17', 3534375, 0, 3534375, NULL, NULL, NULL, NULL),
(20, 'KOP16050012', 'STO16050021', '2016-05-19', 2315625, 0, 2315625, NULL, NULL, NULL, NULL),
(21, 'KOP16050013', 'STO16040015', '2016-04-27', 450000, 0, 450000, NULL, NULL, NULL, NULL),
(22, 'KOP16050013', 'STO16050020', '2016-05-17', 3534375, 0, 3534375, NULL, NULL, NULL, NULL),
(23, 'KOP16050013', 'STO16050021', '2016-05-19', 2315625, 0, 2315625, NULL, NULL, NULL, NULL),
(24, 'KOP16050013', 'STO16050022', '2016-05-20', 7848750, 0, 7848750, NULL, NULL, NULL, NULL),
(25, 'KOP16050014', 'STO16030009', '2016-03-21', 1040000, 0, 1040000, NULL, NULL, NULL, NULL),
(26, 'KOP16050014', 'STO16040017', '2016-04-27', 125000, 750000, -625000, NULL, NULL, NULL, NULL),
(27, 'KOP16050014', 'STO16040018', '2016-04-27', 750000, 0, 750000, NULL, NULL, NULL, NULL),
(28, 'KOP16050014', 'STO16050019', '2016-05-04', 609375, 0, 609375, NULL, NULL, NULL, NULL),
(29, 'KOP16050014', 'SRT16050002', '2016-05-21', -10000, 0, -10000, NULL, NULL, NULL, NULL),
(30, 'KOP16050015', 'STO16040014', '2016-04-26', 200000, 0, 200000, NULL, NULL, NULL, NULL),
(31, 'KOP16050015', 'STO16040015', '2016-04-27', 450000, 0, 450000, NULL, NULL, NULL, NULL),
(32, 'KOP16050015', 'STO16050020', '2016-05-17', 3534375, 0, 3534375, NULL, NULL, NULL, NULL),
(33, 'KOP16050015', 'STO16050021', '2016-05-19', 2315625, 0, 2315625, NULL, NULL, NULL, NULL),
(34, 'KOP16050015', 'SRT16050001', '2016-05-20', -200000, 0, -200000, NULL, NULL, NULL, NULL),
(35, 'KOP16050015', 'STO16050022', '2016-05-20', 7848750, 0, 7848750, NULL, NULL, NULL, NULL),
(36, 'KOP16050015', 'SRT16050003', '2016-05-23', -100000, 0, -100000, NULL, NULL, NULL, NULL),
(37, 'KOP16050015', 'STO16050023', '2016-05-23', 1706250, 0, 1706250, NULL, NULL, NULL, NULL),
(38, 'KOP16050016', 'SRT16050004', '2016-05-26', -50000, 0, -50000, NULL, NULL, NULL, NULL),
(39, 'KOP16050016', 'STO16050024', '2016-05-26', 2691250, 0, 2691250, NULL, NULL, NULL, NULL),
(40, 'KOP16050017', 'SRT16050005', '2016-05-28', -100000, 0, -100000, NULL, NULL, NULL, NULL),
(41, 'KOP16050017', 'STO16050025', '2016-05-28', 1462500, 0, 1462500, NULL, NULL, NULL, NULL),
(42, 'KOP16060018', 'SRT16050004', '2016-05-26', -50000, 0, -50000, NULL, NULL, NULL, NULL),
(43, 'KOP16060018', 'STO16050024', '2016-05-26', 2691250, 0, 2691250, NULL, NULL, NULL, NULL),
(44, 'KOP16060018', 'STO16060026', '2016-06-01', 1500000, 0, 1500000, NULL, NULL, NULL, NULL),
(45, 'KOP16060018', 'STO16060027', '2016-06-04', 1881250, 0, 1881250, NULL, NULL, NULL, NULL),
(46, 'KOP16060018', 'STO16060029', '2016-06-04', 260000, 0, 260000, NULL, NULL, NULL, NULL),
(47, 'KOP16060018', 'SRT16060006', '2016-06-09', -100000, 0, -100000, NULL, NULL, NULL, NULL),
(48, 'KOP16060018', 'STO16060030', '2016-06-09', 1072500, 0, 1072500, NULL, NULL, NULL, NULL),
(49, 'KOP16080019', 'STO16040016', '2016-04-27', 237500, 0, 237500, NULL, NULL, NULL, NULL),
(50, 'KOP16080019', 'STO16080034', '2016-08-04', 4800000, 0, 4800000, NULL, NULL, NULL, NULL),
(51, 'KOP16090020', 'STO16090010', '2016-08-22', 5000000, 0, 5000000, NULL, NULL, NULL, NULL),
(52, 'KOP16090020', 'STO16090011', '2016-08-24', 5000000, 0, 5000000, NULL, NULL, NULL, NULL),
(57, 'KOP16090002', 'STO16080005', '2016-08-02', 2044500, 0, 2044500, NULL, NULL, NULL, NULL),
(58, 'KOP16090002', 'STO16080006', '2016-08-10', 3219000, 0, 3219000, NULL, NULL, NULL, NULL),
(59, 'KOP16090002', 'STO16080007', '2016-08-11', 1493500, 0, 1493500, NULL, NULL, NULL, NULL),
(60, 'KOP16090002', 'STO16080008', '2016-08-16', 1508000, 0, 1508000, NULL, NULL, NULL, NULL),
(61, 'KOP16090002', 'STO16080009', '2016-08-29', 216000, 0, 216000, NULL, NULL, NULL, NULL),
(62, 'KOP16090003', 'STO16080001', '2016-07-18', 2760000, 0, 2760000, NULL, NULL, NULL, NULL),
(63, 'KOP16090003', 'STO16080002', '2016-07-23', 5520000, 0, 5520000, NULL, NULL, NULL, NULL),
(64, 'KOP16090003', 'STO16080003', '2016-08-01', 5520000, 0, 5520000, NULL, NULL, NULL, NULL),
(65, 'KOP16090003', 'STO16080004', '2016-08-09', 7164500, 0, 7164500, NULL, NULL, NULL, NULL),
(66, 'KOP16090001', 'STO16090014', '2016-08-23', 84000, 0, 84000, NULL, NULL, NULL, NULL),
(67, 'KOP16090001', 'STO16090012', '2016-08-24', 2786000, 0, 2786000, NULL, NULL, NULL, NULL),
(68, 'KOP16090001', 'STO16090013', '2016-08-26', 714000, 0, 714000, NULL, NULL, NULL, NULL),
(69, 'KOP16090001', 'STO16090015', '2016-08-30', 812000, 0, 812000, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_master`
--

CREATE TABLE IF NOT EXISTS `trx_master` (
  `transaksi_kode` varchar(20) NOT NULL,
  `transaksi_tipe` int(11) DEFAULT NULL,
  `transaksi_tgl` date DEFAULT NULL,
  `no_invoice` varchar(50) DEFAULT NULL,
  `tgl_invoice` date DEFAULT NULL,
  `contact_code` varchar(20) DEFAULT NULL,
  `sales_code` varchar(20) DEFAULT NULL,
  `sub_total` double DEFAULT NULL,
  `sub_qty` int(11) DEFAULT NULL,
  `disc_persen` double DEFAULT NULL,
  `disc_amount` double DEFAULT NULL,
  `ppn_persen` double DEFAULT NULL,
  `ppn_amount` double DEFAULT NULL,
  `total` double DEFAULT NULL,
  `bayar` double DEFAULT NULL,
  `sisa` double DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `stOrder` int(11) DEFAULT NULL,
  `stOrder_input_date` date DEFAULT NULL,
  `stOrder_input_by` varchar(20) DEFAULT NULL,
  `stOrder_ket` varchar(255) DEFAULT NULL,
  `no_reff` varchar(50) DEFAULT NULL,
  `tgl_reff` date DEFAULT NULL,
  `JmlCaraBayar` double DEFAULT NULL,
  `gudang_kode` varchar(50) DEFAULT NULL,
  `petugas_kode` varchar(50) DEFAULT NULL,
  `disc_persen2` int(11) DEFAULT NULL,
  `disc_amount2` double DEFAULT NULL,
  `disc_persen3` int(11) DEFAULT NULL,
  `disc_amount3` double DEFAULT NULL,
  `kel_beli` varchar(10) DEFAULT NULL,
  `biaya_kirim` float DEFAULT NULL,
  `piutang` double DEFAULT NULL,
  `petugas_kode2` varchar(50) DEFAULT NULL,
  `contact_code2` varchar(50) DEFAULT NULL,
  `biaya_lain` double DEFAULT NULL,
  `potongan_lain` double DEFAULT NULL,
  `supir_code` varchar(50) DEFAULT NULL,
  `no_mobil` varchar(10) DEFAULT NULL,
  `kode_divisi` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`transaksi_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_master`
--

INSERT INTO `trx_master` (`transaksi_kode`, `transaksi_tipe`, `transaksi_tgl`, `no_invoice`, `tgl_invoice`, `contact_code`, `sales_code`, `sub_total`, `sub_qty`, `disc_persen`, `disc_amount`, `ppn_persen`, `ppn_amount`, `total`, `bayar`, `sisa`, `keterangan`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `stOrder`, `stOrder_input_date`, `stOrder_input_by`, `stOrder_ket`, `no_reff`, `tgl_reff`, `JmlCaraBayar`, `gudang_kode`, `petugas_kode`, `disc_persen2`, `disc_amount2`, `disc_persen3`, `disc_amount3`, `kel_beli`, `biaya_kirim`, `piutang`, `petugas_kode2`, `contact_code2`, `biaya_lain`, `potongan_lain`, `supir_code`, `no_mobil`, `kode_divisi`) VALUES
('16100001', 19, '2016-10-01', NULL, NULL, 'C000016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tester', '2016-10-01 15:39:42', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'B 4536 ABC', NULL),
('BPX16100031', 18, '2016-10-26', NULL, NULL, 'C000015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 420000, 420000, NULL, NULL, '2016-10-26 10:45:46', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 'M'),
('BPX16100032', 18, '2016-10-26', NULL, NULL, 'C000017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2600000, 2600000, NULL, NULL, '2016-10-26 14:55:04', NULL, '2016-10-26 15:56:13', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 'M'),
('DOF16110016', 19, '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-02 14:08:06', '02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000004', NULL, 'F'),
('DOM16100014', 19, '2016-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-24 15:57:09', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000001', NULL, 'M'),
('DOM16100015', 19, '2016-10-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-31 19:00:56', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000001', 'D 1234 R', 'M'),
('DOM16110017', 19, '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-02 14:28:44', '04', NULL, NULL, NULL, NULL, NULL, NULL, 'SJM16110017', '2016-11-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('PBH16100015', 17, '2016-10-21', NULL, NULL, 'S000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1095000, 1095000, NULL, NULL, '2016-10-21 15:54:24', 'admin', '2016-10-21 16:34:13', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, 'M'),
('PBP16100030', 18, '2016-10-12', NULL, NULL, 'C000015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000000, 1000000, NULL, NULL, '2016-10-12 16:32:45', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL),
('PTN16100004', 3, '2016-10-21', NULL, NULL, 'S000008', '000001', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, NULL, '2016-10-21 15:49:37', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('PTN16100005', 3, '2016-10-21', '121314', '2016-10-20', 'S000008', '000001', NULL, NULL, NULL, 0, NULL, 0, 1095000, 0, 1095000, NULL, '2016-10-21 15:53:08', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SBF16110049', 6, '2016-11-02', NULL, NULL, 'C000026', '000004', NULL, NULL, NULL, 0, NULL, 0, 3070000, 0, 3070000, NULL, '2016-11-02 14:13:39', '02', NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110054', '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SBF16110050', 6, '2016-11-02', NULL, NULL, 'C000027', NULL, NULL, NULL, NULL, 0, NULL, 0, 2200000, 0, 2200000, NULL, '2016-11-02 14:15:57', '02', NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110055', '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SBF16110051', 6, '2016-11-02', NULL, NULL, 'C000029', NULL, NULL, NULL, NULL, 0, NULL, 0, 3900000, 0, 3900000, NULL, '2016-11-02 14:16:59', '02', NULL, NULL, NULL, NULL, NULL, NULL, 'SOF16110056', '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SBM16100048', 6, '2016-10-19', NULL, NULL, 'C000017', NULL, NULL, NULL, NULL, 0, NULL, 0, 2600000, 0, 2600000, NULL, '2016-10-26 13:38:11', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100048', '2016-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SBM16110052', 6, '2016-11-02', NULL, NULL, 'C000030', NULL, NULL, NULL, NULL, 0, NULL, 0, 1224000, 0, 1224000, NULL, '2016-11-02 14:41:34', '04', NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16110057', '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SBM16110053', 6, '2016-11-10', NULL, NULL, 'C000017', NULL, NULL, NULL, NULL, 0, NULL, 0, 2340000, 0, 2340000, NULL, '2016-11-10 10:49:13', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100050', '2016-10-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SDO16100002', 19, '2016-10-01', NULL, NULL, 'C000016', '000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-01 15:52:43', 'admin', '2016-10-01 15:56:50', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000002', NULL, NULL),
('SDO16100003', 19, '2016-10-01', NULL, NULL, 'C000017', '000002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-01 18:03:03', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('SDO16100004', 19, '2016-10-04', NULL, NULL, 'C000017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-04 14:05:38', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('SDO16100005', 19, '2016-10-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-04 23:27:38', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000002', NULL, NULL),
('SDO16100006', 19, '2016-10-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-05 08:29:17', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('SDO16100007', 19, '2016-10-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-10 15:38:48', 'TIA', '2016-10-10 16:01:29', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000001', NULL, NULL),
('SDO16100008', 19, '2016-10-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-10 17:20:33', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('SDO16100009', 19, '2016-10-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-12 10:08:26', 'admin', '2016-10-12 15:56:27', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000002', 'D 1234 R', NULL),
('SDO16100010', 19, '2016-10-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-15 13:50:45', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '000002', 'D 1234 R', NULL),
('SDO16100011', 19, '2016-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-19 10:17:14', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SDO16100012', 19, '2016-10-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-21 10:54:08', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'd 101 e', 'M'),
('SDO16100013', 19, '2016-10-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-21 10:54:55', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'SJO16100013', '2016-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SOF16100046', 5, '2016-10-11', NULL, NULL, 'C000015', '000002', 1450000, 225, 10, 145000, 5, 72500, 1377500, 0, 1377500, NULL, '2016-10-11 18:59:13', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SOF16100051', 5, '2016-10-17', NULL, NULL, 'C000015', '000001', 2000000, 100, NULL, 0, NULL, 0, 2000000, 0, 2000000, NULL, '2016-10-21 10:53:25', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SOF16110054', 5, '2016-11-02', NULL, NULL, 'C000026', '000004', 3070000, 95, NULL, 0, NULL, 0, 3070000, 0, 3070000, NULL, '2016-11-02 14:03:25', '02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SOF16110055', 5, '2016-11-02', NULL, NULL, 'C000027', '000004', 2200000, 100, NULL, 0, NULL, 0, 2200000, 0, 2200000, NULL, '2016-11-02 14:05:01', '02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SOF16110056', 5, '2016-11-02', NULL, NULL, 'C000029', '000004', 3900000, 200, NULL, 0, NULL, 0, 3900000, 0, 3900000, NULL, '2016-11-02 14:06:33', '02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F'),
('SOM16100045', 5, '2016-10-10', NULL, NULL, 'C000015', NULL, 420000, 210, NULL, 0, NULL, 0, 420000, 0, 420000, NULL, '2016-10-10 15:48:32', 'admin', '2016-10-10 15:49:28', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16100047', 5, '2016-10-15', NULL, NULL, 'C000016', NULL, 4400000, 300, NULL, 0, NULL, 0, 4400000, 0, 4400000, NULL, '2016-10-15 13:49:59', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16100048', 5, '2016-10-19', NULL, NULL, 'C000017', '000002', 2600000, 300, NULL, 0, NULL, 0, 2600000, 0, 2600000, NULL, '2016-10-19 10:11:50', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16100049', 5, '2016-10-21', NULL, NULL, 'C000016', '000002', 2000, 1, NULL, 0, NULL, 0, 2000, 0, 2000, NULL, '2016-10-21 10:45:59', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16100050', 5, '2016-10-21', NULL, NULL, 'C000017', '000003', 2600000, 300, NULL, 0, NULL, 0, 2600000, 0, 2600000, NULL, '2016-10-21 10:47:09', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16100052', 5, '2016-10-21', NULL, NULL, 'C000017', NULL, 4400000, 300, NULL, 0, NULL, 0, 4400000, 0, 4400000, NULL, '2016-10-24 15:36:53', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16100053', 5, '2016-10-21', NULL, NULL, 'C000016', '000001', 6600000, 800, NULL, 0, NULL, 0, 6600000, 0, 6600000, NULL, '2016-10-24 15:40:26', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16110057', 5, '2016-11-02', NULL, NULL, 'C000030', '000002', 1224000, 102, NULL, 0, NULL, 0, 1224000, 0, 1224000, NULL, '2016-11-02 14:16:42', '04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16110058', 5, '2016-11-02', NULL, NULL, 'C000031', '000002', 1224000, 102, NULL, 0, NULL, 0, 1224000, 0, 1224000, NULL, '2016-11-02 14:21:53', '04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16110059', 5, '2016-11-02', NULL, NULL, 'C000032', '000002', 1612000, 101, NULL, 0, NULL, 0, 1612000, 0, 1612000, NULL, '2016-11-02 14:26:32', '04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOM16110060', 5, '2016-11-02', NULL, NULL, 'C000033', '000002', 612000, 51, NULL, 0, NULL, 0, 612000, 0, 612000, NULL, '2016-11-02 14:27:24', '04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M'),
('SOR16090039', 5, '2016-09-30', NULL, NULL, 'C000015', NULL, NULL, NULL, NULL, 0, NULL, 0, 2000000, 0, 2000000, NULL, '2016-09-30 14:42:22', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB'),
('SOR16100040', 5, '2016-10-01', NULL, NULL, 'C000016', NULL, 45000000, 150, NULL, 0, NULL, 0, 45000000, 5000000, 40000000, NULL, '2016-10-01 15:39:12', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB'),
('SOR16100041', 5, '2016-10-01', NULL, NULL, 'C000017', '000002', 2600000, 150, NULL, 0, NULL, 0, 2600000, 0, 2600000, NULL, '2016-10-01 18:02:01', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB'),
('SOR16100042', 5, '2016-10-04', NULL, NULL, 'C000017', '000001', 5200000, 300, NULL, 0, NULL, 0, 5200000, 0, 5200000, NULL, '2016-10-04 09:01:30', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB'),
('SOR16100043', 5, '2016-10-04', NULL, NULL, 'C000017', NULL, 180000, 15, NULL, 0, NULL, 0, 180000, 0, 180000, NULL, '2016-10-04 14:05:00', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB'),
('SOR16100044', 5, '2016-10-05', NULL, NULL, 'C000017', '000001', 2000000, 100, NULL, 0, NULL, 0, 2000000, 0, 2000000, NULL, '2016-10-05 16:28:38', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MAB'),
('STO16090044', 6, '2016-09-30', NULL, NULL, 'C000015', NULL, NULL, NULL, NULL, 0, NULL, 0, 2000000, 0, 2000000, NULL, '2016-09-30 15:08:33', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('STO16100045', 6, '2016-10-04', NULL, NULL, 'C000016', NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, NULL, '2016-10-04 22:48:24', 'admin', '2016-10-10 17:13:09', 'admin', NULL, NULL, NULL, NULL, 'SOR16100040', '2016-10-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('STO16100046', 6, '2016-10-15', NULL, NULL, 'C000016', '000002', NULL, NULL, NULL, 0, NULL, 0, 4400000, 0, 4400000, NULL, '2016-10-15 14:15:04', 'admin', '2016-10-15 14:16:21', 'admin', NULL, NULL, NULL, NULL, 'SOM16100047', '2016-10-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('STO16100047', 6, '2016-10-20', NULL, NULL, 'C000015', NULL, NULL, NULL, NULL, 0, NULL, 0, 420000, 0, 420000, NULL, '2016-10-20 14:46:27', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'SOM16100045', '2016-10-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'M');

-- --------------------------------------------------------

--
-- Table structure for table `trx_persediaan`
--

CREATE TABLE IF NOT EXISTS `trx_persediaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `product_code` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `qty_in` int(11) DEFAULT NULL,
  `qty_out` int(11) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `CreateBy` varchar(20) DEFAULT NULL,
  `UpdateDate` datetime DEFAULT NULL,
  `UpdateBy` varchar(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `qtysize1` int(11) DEFAULT NULL,
  `qtysize2` int(11) DEFAULT NULL,
  `qtysize3` int(11) DEFAULT NULL,
  `qtysize4` int(11) DEFAULT NULL,
  `qtysize5` int(11) DEFAULT NULL,
  `qtysize6` int(11) DEFAULT NULL,
  `qtysize7` int(11) DEFAULT NULL,
  `qtysize8` int(11) DEFAULT NULL,
  `qtysize9` int(11) DEFAULT NULL,
  `qtysize10` int(11) DEFAULT NULL,
  `qtysize1_out` int(11) DEFAULT NULL,
  `qtysize2_in` int(11) DEFAULT NULL,
  `qtysize2_out` int(11) DEFAULT NULL,
  `qtysize3_in` int(11) DEFAULT NULL,
  `qtysize3_out` int(11) DEFAULT NULL,
  `qtysize4_in` int(11) DEFAULT NULL,
  `qtysize4_out` int(11) DEFAULT NULL,
  `qtysize5_in` int(11) DEFAULT NULL,
  `qtysize5_out` int(11) DEFAULT NULL,
  `qtysize6_in` int(11) DEFAULT NULL,
  `qtysize6_out` int(11) DEFAULT NULL,
  `qtysize7_in` int(11) DEFAULT NULL,
  `qtysize7_out` int(11) DEFAULT NULL,
  `qtysize8_in` int(11) DEFAULT NULL,
  `qtysize8_out` int(11) DEFAULT NULL,
  `qtysize9_in` int(11) DEFAULT NULL,
  `qtysize9_out` int(11) DEFAULT NULL,
  `qtysize10_in` int(11) DEFAULT NULL,
  `qtysize10_out` int(11) DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `kode_gudang` varchar(50) DEFAULT NULL,
  `ketdetail` varchar(50) DEFAULT NULL,
  `qtysize1_in` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
