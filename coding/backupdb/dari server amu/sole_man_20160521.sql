-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 21, 2016 at 11:09 AM
-- Server version: 5.5.47-MariaDB-1ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sole_man`
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
('rsSatBarang', 'SELECT contact_code, CONCAT(contact_code,'' - '', contact_name) FROM mst_contact where contact_tipe = 24'),
('rsStatusKerja', 'select kodereff, reff from mst_reff where tipereff=20 order by reff'),
('rsSupplier', 'SELECT contact_code, CONCAT(contact_code,'' - '', contact_name) FROM mst_contact where contact_tipe = 2'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=314 ;

--
-- Dumping data for table `form_generator`
--

INSERT INTO `form_generator` (`id`, `formNo`, `tableName`, `sortNo`, `TitleName`, `FieldName`, `FieldType`, `FieldLen`, `FieldInput`, `ComboData`, `isMandatory`, `disableEdit`, `other`, `section`, `kolom`, `haveSum`) VALUES
(1, 1, 'barang', 1, 'Kelompok Barang', 'kode_kelompok', 'varchar', 30, 'combobox', 'rsKelBarang', '1', NULL, NULL, NULL, NULL, NULL),
(2, 1, 'barang', 2, 'Artikel', 'kode_artikel', 'varchar', 30, 'combobox', 'rsArtikel', '1', NULL, NULL, NULL, NULL, NULL),
(3, 1, 'barang', 3, 'Jenis Barang', 'kode_jenis', 'varchar', 30, 'combobox', 'rsJenisBarang', '1', NULL, NULL, NULL, NULL, NULL),
(4, 1, 'barang', 4, 'Counter', 'counter', 'varchar', 10, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(5, 1, 'barang', 5, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(6, 1, 'barang', 6, 'Nama Barang', 'product_name', 'varchar', 100, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(7, 1, 'barang', 7, 'Mesin Produksi', 'kode_mesin', 'varchar', 30, 'combobox', 'rsMesin', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, 'barang', 8, 'Merek Barang', 'kode_merek', 'varchar', 30, 'combobox', 'rsMerekBarang', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 'barang', 9, 'Harga Jual', 'harga_jual', 'money', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, 'barang', 10, 'Harga Pokok', 'harga_beli', 'money', 30, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, 'barang', 12, 'Supplier', 'kode_supplier', 'varchar', 50, 'combobox', 'rsSupplier', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, 'barang', 13, 'Negara', 'kode_negara', 'varchar', 30, 'combobox', 'rsNegara', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, 'barang', 14, 'Kelompok Size', 'kode_size', 'varchar', 30, 'combobox', 'rsKelSize', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, 'barang', 15, 'Saldo Awal', 'saldo_awal', 'integer', 20, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, 'barang', 16, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
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
(64, 6, 'trx_terima_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(65, 6, 'trx_terima_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(66, 6, 'trx_terima_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(67, 6, 'trx_terima_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(68, 6, 'trx_terima_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(69, 6, 'trx_terima_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(70, 6, 'trx_terima_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 7, 'trx_gudang_bahan_in', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(72, 7, 'trx_gudang_bahan_in', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(73, 7, 'trx_gudang_bahan_in', 3, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(74, 7, 'trx_gudang_bahan_in', 4, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(75, 8, 'trx_gudang_bahan_in_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(76, 8, 'trx_gudang_bahan_in_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(77, 8, 'trx_gudang_bahan_in_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(78, 8, 'trx_gudang_bahan_in_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(79, 8, 'trx_gudang_bahan_in_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(80, 8, 'trx_gudang_bahan_in_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
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
(91, 10, 'trx_gudang_bahan_out_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(92, 10, 'trx_gudang_bahan_out_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(93, 10, 'trx_gudang_bahan_out_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(94, 10, 'trx_gudang_bahan_out_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
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
(105, 12, 'trx_keluar_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(106, 12, 'trx_keluar_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(107, 12, 'trx_keluar_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(108, 12, 'trx_keluar_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(109, 12, 'trx_keluar_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(110, 12, 'trx_keluar_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(111, 12, 'trx_keluar_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 13, 'trx_beli_non_order', 1, 'No. Nota Beli', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(113, 13, 'trx_beli_non_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(114, 13, 'trx_beli_non_order', 3, 'Kelompok Pembelian', 'kel_beli', 'varchar', 50, 'combobox', 'rsKelBeli', '1', NULL, NULL, 1, 1, NULL),
(115, 13, 'trx_beli_non_order', 4, 'Supplier', 'contact_code', 'varchar', 50, 'combobox', 'rsSupplier', '1', NULL, NULL, 1, 2, NULL),
(116, 13, 'trx_beli_non_order', 5, 'No. Nota Supplier', 'no_invoice', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(117, 13, 'trx_beli_non_order', 6, 'Tgl Nota Supplier', 'tgl_invoice', 'varchar', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(118, 13, 'trx_beli_non_order', 7, 'Petugas', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(119, 13, 'trx_beli_non_order', 8, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(120, 13, 'trx_beli_non_order', 9, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(121, 13, 'trx_beli_non_order', 10, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(122, 13, 'trx_beli_non_order', 11, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(123, 13, 'trx_beli_non_order', 12, 'Netto', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(124, 13, 'trx_beli_non_order', 13, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(125, 13, 'trx_beli_non_order', 14, 'Sisa', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(126, 13, 'trx_beli_non_order', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(127, 14, 'trx_beli_non_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(128, 14, 'trx_beli_non_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(129, 14, 'trx_beli_non_order_detail', 4, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(130, 14, 'trx_beli_non_order_detail', 5, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(131, 14, 'trx_beli_non_order_detail', 6, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(132, 14, 'trx_beli_non_order_detail', 7, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 14, 'trx_beli_non_order_detail', 8, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(134, 14, 'trx_beli_non_order_detail', 9, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(135, 14, 'trx_beli_non_order_detail', 10, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(136, 15, 'trx_retur_beli', 1, 'No Retur Pembelian', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(137, 15, 'trx_retur_beli', 2, 'Tgl Retur Pembelian', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(138, 15, 'trx_retur_beli', 3, 'Supplier', 'contact_code', 'varchar', 50, 'combobox', 'rsSupplier', '1', NULL, NULL, 1, 1, NULL),
(139, 15, 'trx_retur_beli', 4, 'Petugas', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 1, NULL),
(140, 15, 'trx_retur_beli', 5, 'Kode Pembelian', 'no_reff', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, 1, 2, NULL),
(141, 15, 'trx_retur_beli', 6, 'Tgl Pembelian', 'tgl_reff', 'date', 50, 'datepicker', NULL, '1', NULL, NULL, 1, 2, NULL),
(142, 15, 'trx_retur_beli', 7, 'No Invoice', 'no_invoice', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 1, 2, NULL),
(143, 15, 'trx_retur_beli', 8, 'Tgl Invoice', 'tgl_invoice', 'date', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(144, 15, 'trx_retur_beli', 9, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(145, 15, 'trx_retur_beli', 10, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(146, 15, 'trx_retur_beli', 11, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(147, 15, 'trx_retur_beli', 12, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(148, 15, 'trx_retur_beli', 13, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(149, 15, 'trx_retur_beli', 14, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(150, 15, 'trx_retur_beli', 15, 'Piutang', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(151, 15, 'trx_retur_beli', 16, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(152, 16, 'trx_retur_beli_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(153, 16, 'trx_retur_beli_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(154, 16, 'trx_retur_beli_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(155, 16, 'trx_retur_beli_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(156, 16, 'trx_retur_beli_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(157, 16, 'trx_retur_beli_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(158, 16, 'trx_retur_beli_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(159, 16, 'trx_retur_beli_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(160, 16, 'trx_retur_beli_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(161, 17, 'trx_order_jual', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(162, 17, 'trx_order_jual', 2, 'Tgl Order', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(163, 17, 'trx_order_jual', 3, 'Kelompok Penjualan', 'kel_beli', 'varchar', 50, 'combobox', 'rsKelJual', '1', NULL, NULL, 1, 1, NULL),
(164, 17, 'trx_order_jual', 4, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 2, NULL),
(165, 17, 'trx_order_jual', 5, 'Rencana Tgl Kirim', 'tgl_reff', 'date', 50, 'datepicker', NULL, NULL, NULL, NULL, 1, 2, NULL),
(166, 17, 'trx_order_jual', 6, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(167, 17, 'trx_order_jual', 7, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(168, 17, 'trx_order_jual', 8, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(169, 17, 'trx_order_jual', 9, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(170, 17, 'trx_order_jual', 10, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(171, 17, 'trx_order_jual', 11, 'Biaya Kirim', 'biaya_kirim', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(172, 17, 'trx_order_jual', 12, 'Uang Muka', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(173, 17, 'trx_order_jual', 13, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(174, 17, 'trx_order_jual', 14, 'Sisa', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(175, 17, 'trx_order_jual', 15, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(176, 18, 'trx_order_jual_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(177, 18, 'trx_order_jual_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(178, 18, 'trx_order_jual_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(179, 18, 'trx_order_jual_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(180, 18, 'trx_order_jual_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(181, 18, 'trx_order_jual_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 18, 'trx_order_jual_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(183, 18, 'trx_order_jual_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(184, 18, 'trx_order_jual_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 19, 'trx_jual_by_order', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(186, 19, 'trx_jual_by_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(187, 19, 'trx_jual_by_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 1, NULL),
(188, 19, 'trx_jual_by_order', 4, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(189, 19, 'trx_jual_by_order', 5, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(190, 19, 'trx_jual_by_order', 6, 'Discount', 'disc_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(191, 19, 'trx_jual_by_order', 7, 'PPN %', 'ppn_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(192, 19, 'trx_jual_by_order', 8, 'PPN', 'ppn_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(193, 19, 'trx_jual_by_order', 9, 'Biaya Kirim', 'biaya_kirim', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(194, 19, 'trx_jual_by_order', 10, 'Total', 'total', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(195, 19, 'trx_jual_by_order', 11, 'Pembayaran', 'bayar', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(196, 19, 'trx_jual_by_order', 12, 'Sisa', 'sisa', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(197, 19, 'trx_jual_by_order', 13, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(198, 20, 'trx_jual_by_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(199, 20, 'trx_jual_by_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(200, 20, 'trx_jual_by_order_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(201, 20, 'trx_jual_by_order_detail', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(202, 20, 'trx_jual_by_order_detail', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(203, 20, 'trx_jual_by_order_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 20, 'trx_jual_by_order_detail', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(205, 20, 'trx_jual_by_order_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(206, 20, 'trx_jual_by_order_detail', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 20, 'trx_jual_by_order_detail', 10, 'No Order', 'no_order', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 21, 'trx_jual_non_order', 1, 'No Faktur', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(209, 21, 'trx_jual_non_order', 2, 'Tanggal', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(210, 21, 'trx_jual_non_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 1, NULL),
(211, 21, 'trx_jual_non_order', 4, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(212, 21, 'trx_jual_non_order', 5, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(213, 21, 'trx_jual_non_order', 6, 'Discount', 'disc_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(214, 21, 'trx_jual_non_order', 7, 'PPN %', 'ppn_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(215, 21, 'trx_jual_non_order', 8, 'PPN', 'ppn_amount', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(216, 21, 'trx_jual_non_order', 9, 'Biaya Kirim', 'biaya_kirim', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(217, 21, 'trx_jual_non_order', 10, 'Total', 'total', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(218, 21, 'trx_jual_non_order', 11, 'Pembayaran', 'bayar', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(219, 21, 'trx_jual_non_order', 12, 'Sisa', 'sisa', 'money', 20, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(220, 21, 'trx_jual_non_order', 13, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(221, 22, 'trx_jual_non_order_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(222, 22, 'trx_jual_non_order_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(223, 22, 'trx_jual_non_order_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(224, 22, 'trx_jual_non_order_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(225, 22, 'trx_jual_non_order_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(226, 22, 'trx_jual_non_order_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(227, 22, 'trx_jual_non_order_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(228, 22, 'trx_jual_non_order_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(229, 22, 'trx_jual_non_order_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(230, 23, 'trx_retur_jual', 1, 'No Retur Penjualan', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(231, 23, 'trx_retur_jual', 2, 'Tgl Retur Penjualan', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(232, 23, 'trx_retur_jual', 3, 'No Faktur', 'no_reff', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, 1, 1, NULL),
(233, 23, 'trx_retur_jual', 4, 'Tgl Faktur', 'tgl_reff', 'varchar', 50, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(234, 23, 'trx_retur_jual', 5, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', NULL, NULL, 1, 2, NULL),
(235, 23, 'trx_retur_jual', 6, 'Sales', 'sales_code', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(236, 23, 'trx_retur_jual', 9, 'Disc %', 'disc_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(237, 23, 'trx_retur_jual', 10, 'Discount', 'disc_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(238, 23, 'trx_retur_jual', 11, 'PPN %', 'ppn_persen', 'integer', 5, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(239, 23, 'trx_retur_jual', 12, 'PPN', 'ppn_amount', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 1, NULL),
(240, 23, 'trx_retur_jual', 13, 'Total', 'total', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(241, 23, 'trx_retur_jual', 14, 'Pembayaran', 'bayar', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(242, 23, 'trx_retur_jual', 15, 'Hutang', 'sisa', 'money', 30, 'textbox', NULL, '1', NULL, NULL, 2, 2, NULL),
(243, 23, 'trx_retur_jual', 16, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 2, NULL),
(244, 24, 'trx_retur_jual_detail', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(245, 24, 'trx_retur_jual_detail', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(246, 24, 'trx_retur_jual_detail', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(247, 24, 'trx_retur_jual_detail', 4, 'Harga', 'harga', 'money', 15, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(248, 24, 'trx_retur_jual_detail', 5, 'Sub Total', 'sub_total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(249, 24, 'trx_retur_jual_detail', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 24, 'trx_retur_jual_detail', 7, 'Disc', 'disc_amount', 'money', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, 1),
(251, 24, 'trx_retur_jual_detail', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, 1),
(252, 24, 'trx_retur_jual_detail', 9, 'Ket', 'ket_detail', 'varchar', 15, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 25, 'barang_upload', 1, 'Judul', 'judul', 'varchar', 50, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(254, 25, 'barang_upload', 2, 'Nama File', 'nama_file', 'varchar', 50, 'filebox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(255, 26, 'trx_gd_pro_in_by_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(256, 26, 'trx_gd_pro_in_by_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'date', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(257, 26, 'trx_gd_pro_in_by_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', '1', '1', NULL, 1, 2, NULL),
(258, 26, 'trx_gd_pro_in_by_order', 4, 'Petugas', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(259, 26, 'trx_gd_pro_in_by_order', 5, 'Keterangan', 'keterangan', 'varchar', 50, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(260, 27, 'trx_gd_pro_in_by_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(261, 27, 'trx_gd_pro_in_by_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(262, 27, 'trx_gd_pro_in_by_order_det', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(263, 27, 'trx_gd_pro_in_by_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(264, 27, 'trx_gd_pro_in_by_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 27, 'trx_gd_pro_in_by_order_det', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
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
(277, 29, 'trx_gd_pro_out_by_order_det', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(278, 29, 'trx_gd_pro_out_by_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(279, 29, 'trx_gd_pro_out_by_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(280, 29, 'trx_gd_pro_out_by_order_det', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
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
(291, 31, 'trx_gd_pro_in_non_order_det', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(292, 31, 'trx_gd_pro_in_non_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(293, 31, 'trx_gd_pro_in_non_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(294, 31, 'trx_gd_pro_in_non_order_det', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(295, 31, 'trx_gd_pro_in_non_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(296, 31, 'trx_gd_pro_in_non_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(297, 31, 'trx_gd_pro_in_non_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(298, 32, 'trx_gd_pro_out_non_order', 1, 'Kode Transaksi', 'transaksi_kode', 'varchar', 20, 'textbox', NULL, '1', '1', NULL, 1, 1, NULL),
(299, 32, 'trx_gd_pro_out_non_order', 2, 'Tgl Transaksi', 'transaksi_tgl', 'varchar', 20, 'datepicker', NULL, '1', NULL, NULL, 1, 1, NULL),
(300, 32, 'trx_gd_pro_out_non_order', 4, 'Petugas Gudang', 'petugas_kode', 'varchar', 50, 'combobox', 'rsKaryawan', NULL, NULL, NULL, 1, 2, NULL),
(301, 32, 'trx_gd_pro_out_non_order', 5, 'Keterangan', 'keterangan', 'varchar', 255, 'textbox', NULL, NULL, NULL, NULL, 2, 1, NULL),
(302, 33, 'trx_gd_pro_out_non_order_det', 1, 'Kode Barang', 'product_code', 'varchar', 20, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, NULL),
(303, 33, 'trx_gd_pro_out_non_order_det', 2, 'Nama Barang', 'product_name', 'varchar', 30, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(304, 33, 'trx_gd_pro_out_non_order_det', 3, 'Qty', 'qty', 'integer', 3, 'textbox', NULL, '1', NULL, NULL, NULL, NULL, 1),
(305, 33, 'trx_gd_pro_out_non_order_det', 4, 'Harga', 'harga', 'money', 12, 'textbox', NULL, '1', '1', NULL, NULL, NULL, NULL),
(306, 33, 'trx_gd_pro_out_non_order_det', 5, 'Sub Total', 'sub_total', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(307, 33, 'trx_gd_pro_out_non_order_det', 6, 'Disc %', 'disc_persen', 'integer', 3, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(308, 33, 'trx_gd_pro_out_non_order_det', 7, 'Disc', 'disc_amount', 'money', 12, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(309, 33, 'trx_gd_pro_out_non_order_det', 8, 'Total', 'total', 'money', 15, 'textbox', NULL, NULL, '1', NULL, NULL, NULL, NULL),
(310, 33, 'trx_gd_pro_out_non_order_det', 9, 'Ket', 'ket_detail', 'varchar', 12, 'textbox', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(311, 1, 'barang', 11, 'Satuan Barang', 'kode_sat', 'varchar', 10, 'combobox', 'rsSatBarang', NULL, NULL, NULL, NULL, NULL, NULL),
(312, 30, 'trx_gd_pro_in_non_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', NULL, NULL, NULL, 1, 2, NULL),
(313, 30, 'trx_gd_pro_out_non_order', 3, 'Customer', 'contact_code', 'varchar', 50, 'combobox', 'rsCustomer', NULL, NULL, NULL, 1, 2, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `mst_config`
--

INSERT INTO `mst_config` (`id`, `kode`, `ket`, `int_value`, `des_value`, `string_value`, `date1_value`, `date2_value`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `bln`, `thn`) VALUES
(1, '001', 'Test', 1, 0, '', '2013-12-18', '2013-12-31', '2013-12-21 10:18:31', 'admin', '2013-12-21 10:19:07', 'admin', 2, 16),
(2, '', 'kode jurnal kas', 1, 0, 'JK', '0000-00-00', '0000-00-00', '2013-12-21 17:58:30', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(3, '', 'kode jurnal bank', 0, 0, 'JB', '0000-00-00', '0000-00-00', '2013-12-21 17:58:51', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(4, '', 'kode jurnal transaksi', 0, 0, 'JT', '0000-00-00', '0000-00-00', '2013-12-21 17:59:43', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(5, '', 'kode jurnal memorial', 0, 0, 'JM', '0000-00-00', '0000-00-00', '2013-12-21 17:59:57', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(6, '', 'kode company', 0, 0, '001', '0000-00-00', '0000-00-00', '2013-12-23 13:20:18', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(17, '', 'jml record paging', 250, 0, '', '0000-00-00', '0000-00-00', '2014-01-07 11:03:44', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(18, '', 'session timeout', 15, 0, '', '0000-00-00', '0000-00-00', '2014-01-12 16:50:13', 'admin', '0000-00-00 00:00:00', '', 2, 16),
(24, NULL, 'kode customer', 9, NULL, 'C', NULL, NULL, '2015-10-17 08:10:04', 'admin', '2015-10-17 08:12:04', 'admin', 2, 16),
(25, NULL, 'kode supplier', 0, NULL, 'S', NULL, NULL, '2015-10-17 08:11:05', 'admin', '2015-10-17 08:12:29', 'admin', 2, 16),
(26, NULL, 'kode master', 0, NULL, NULL, NULL, NULL, '2015-10-17 08:11:22', 'admin', NULL, NULL, 2, 16),
(27, '', 'kode barang', 29, 0, '', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(28, '1', 'Order Pembelian', 0, 0, 'POR', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(29, '2', 'Pembelian by order', 0, 0, 'PTO', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(30, '3', 'Pembelian non order', 11, 0, 'PTN', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(31, '4', 'Retur Pembelian', 1, 0, 'PRT', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(32, '5', 'Order Penjualan', 22, 0, 'SOR', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(33, '6', 'Penjualan by order', 22, 0, 'STO', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(34, '7', 'Penjualan non order', 1, 0, 'STN', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(35, '8', 'Retur Penjualan', 1, 0, 'SRT', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(36, '9', 'Penerimaan Hasil Produksi by O', 2, 0, 'IPO', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(37, '10', 'Penerimaan Hasil Produksi non ', 3, 0, 'IPN', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(38, '11', 'Pengiriman / Pengaluaran Baran', 2, 0, 'OPO', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(39, '12', 'Pengiriman / Pengaluaran Baran', 2, 0, 'OPN', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(40, '13', 'Penerimaan Bahan Produksi', 2, 0, 'IBP', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(41, '14', 'Pengeluaran / Pemakaian Bahan ', 3, 0, 'OBP', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(42, '15', 'Kontrabon Hutang', 0, 0, 'KOH', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(43, '16', 'Kontrabon Piutang', 13, 0, 'KOP', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(44, '17', 'Pembayaran Hutang', 10, 0, 'PBH', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(45, '18', 'Pembayaran Piutang', 21, 0, 'PBP', '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, 16),
(46, NULL, 'kode karyawan', 0, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
('001', 1, ' ', 'ISB', '2013-12-22 16:38:16', 'admin', '0000-00-00 00:00:00', '', 0, '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2000003', 3, NULL, 'LABITA', '2015-10-17 11:34:46', 'admin', '2016-03-14 09:23:56', 'admin', NULL, 'JL.SATRIA RAYA', NULL, 'BDG', NULL, 'Indonesia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41212', NULL, NULL),
('2000004', 3, NULL, 'ABADI', '2015-12-28 20:37:30', 'admin', '2016-03-14 09:23:05', 'admin', NULL, '1', NULL, 'BDG', NULL, '1', '1', '1', '1', '1', '1', NULL, NULL, NULL, NULL, NULL, '1', '1', '1', '1', '1'),
('2000005', 3, NULL, 'BRUTINI', '2016-03-10 11:24:29', 'admin', NULL, NULL, NULL, 'LEUWI SARI', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2000006', 3, NULL, 'DELAVIN ', '2016-03-18 15:39:19', 'admin', NULL, NULL, NULL, 'BANDUNG', NULL, 'BDG', NULL, NULL, '022 567890', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2000007', 3, NULL, 'ALKA SIMAS', '2016-03-21 16:02:16', 'admin', NULL, NULL, NULL, 'CIBADUYUT', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '022 5555555', NULL, NULL, NULL),
('2000008', 3, NULL, 'KO AHIN', '2016-04-25 13:37:50', 'admin', NULL, NULL, NULL, 'THI ', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('2000009', 3, NULL, 'LINTANG SAKTI', '2016-04-25 13:49:02', 'admin', NULL, NULL, NULL, 'JL.TAMAN KOPO INDAH BLOK C-45', NULL, 'BDG', NULL, NULL, '5401384/ 0816605984', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('A1000001', 4, NULL, 'ADMIN', '2016-03-16 15:30:23', 'admin', NULL, NULL, NULL, 'CARINGIN 439', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('B00001', 4, NULL, 'BUDIMAN', '2015-12-29 19:30:45', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', '2005-12-01', NULL, 'Tetap', NULL, NULL, NULL, NULL, NULL, NULL),
('B102345', 4, NULL, 'BENNY', '2016-03-14 09:25:51', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'P', NULL, NULL, 'Tetap', NULL, NULL, NULL, NULL, NULL, NULL),
('C100002', 2, NULL, 'CITRA ', '2016-03-18 15:21:42', 'admin', NULL, NULL, NULL, NULL, NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('D100001', 2, NULL, 'DUTA LASTINDO', '2016-03-21 16:03:28', 'admin', NULL, NULL, NULL, 'JL.CIBADUYUT', NULL, 'BDG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '022 657890', NULL, NULL, NULL),
('GD001', 5, NULL, 'Gudang Produksi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('GD002', 5, NULL, 'Gudang Bahan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('S001', 4, NULL, 'SITI', '2016-04-05 15:40:13', 'admin', NULL, NULL, NULL, 'KOPO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'W', '2016-10-16', '2016-04-05', 'Kontrak', 'PENJUALAN', NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mst_contact_person`
--

INSERT INTO `mst_contact_person` (`id`, `contact_code`, `nama`, `jabatan`, `telp`, `email`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 's001', 'Abdul', 'Sales', '0888121212', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(2, 'S002', 'Tono', 'Sales', '', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(4, 'S004', '2', '2', '2', '2', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(5, 'S006', 'a', 'b', 'c', 'd', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '');

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
('0109000000', '0100000000', 'Kode Warna', 'warna_list.php', '2015-05-02 11:38:52', 'admin', NULL, NULL, NULL, NULL),
('0111000000', '0100000000', 'Kelompok Size', 'size_list.php', '2015-05-02 11:39:20', 'admin', '2016-01-03 14:07:24', 'admin', NULL, NULL),
('0112000000', '0100000000', 'Mesin Produksi', 'mesin_list.php', '0000-00-00 00:00:00', '', '2015-10-17 07:19:22', 'admin', NULL, NULL),
('0113000000', '0100000000', 'Artikel', 'artikel_list.php', '2015-12-30 21:20:34', 'admin', NULL, NULL, NULL, NULL),
('0114000000', '0100000000', 'Satuan Barang', 'satuan_list.php', NULL, NULL, NULL, NULL, NULL, NULL),
('0200000000', '', 'Pembelian', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 2, NULL),
('0203000000', '0200000000', 'Pembelian non Order', 'purchase_non_order_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0204000000', '0200000000', 'Retur Pembelian', 'purchase_return_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL),
('0300000000', '', 'Penjualan', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 3, NULL),
('0301000000', '0300000000', 'Order Penjualan', 'sales_order_list.php', '2015-05-12 09:34:01', 'admin', NULL, NULL, NULL, NULL),
('0302000000', '0300000000', 'Penjualan by Order', 'sales_by_order_list.php', '0000-00-00 00:00:00', '', '2015-05-12 09:33:35', 'admin', NULL, NULL),
('0303000000', '0300000000', 'Penjualan non Order', 'sales_non_order_list.php', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, 0),
('0304000000', '0300000000', 'Retur Penjualan', 'sales_return_list.php', '0000-00-00 00:00:00', '', '2015-05-12 09:33:17', 'admin', NULL, NULL),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

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
(52, '1100000000', 6, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '');

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
('100000', 'Kas', NULL, 1, 1, 1, 0, '2016-01-01', 1000000, '2015-12-30 17:36:46', 'admin', NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `mst_photo_sole`
--

INSERT INTO `mst_photo_sole` (`id`, `kode_barang`, `judul`, `nama_file`, `CreateDate`, `CreateBy`) VALUES
(1, 'ITJ1M1', 'depnn', 'Chrysanthemum.jpg', '2015-11-11 06:40:45', 'admin'),
(2, 'A.1111.TPR.16010002', 'depan', 'Koala.jpg', '2016-01-03 14:34:51', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mst_product`
--

CREATE TABLE IF NOT EXISTS `mst_product` (
  `product_code` varchar(20) NOT NULL,
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
  PRIMARY KEY (`product_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_product`
--

INSERT INTO `mst_product` (`product_code`, `product_name`, `harga_beli`, `harga_jual`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `stok_jualbeli`, `stok_keluarterima`, `saldo_awal`, `size1`, `size2`, `size3`, `size4`, `size5`, `size6`, `size7`, `size8`, `size9`, `size10`, `kode_jenis`, `kode_merek`, `kode_kelompok`, `kode_negara`, `kode_supplier`, `keterangan`, `kode_size`, `kode_mesin`, `test`, `kode_artikel`, `counter`, `kode_sat`) VALUES
('0.1111.1301.1611', '1301 HITAM POLOS', 1212112, 12112122, '2016-01-01 20:32:23', 'admin', '2016-03-22 16:32:16', 'admin', NULL, NULL, 1, '37', '38', '39', '40', '41', '42', '43', '44', NULL, NULL, '1301', 'BR01', '0', NULL, NULL, '1', 'Dewasa Laki-laki', '0', NULL, '1111', '1611', NULL),
('0.AZURA.TPR.109', 'AZURA TPR PUTIH', 0, 25000, '2016-04-05 14:57:06', 'admin', NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 'TPR', NULL, '0', NULL, NULL, NULL, 'Dewasa Perempuan', '0', NULL, 'AZURA', '109', NULL),
('1.12345678.TPR.1612', 'TPR HITAM 12345678', 0, 20000, '2016-03-18 16:53:34', 'admin', '2016-03-22 16:32:50', 'admin', NULL, NULL, NULL, '37', '38', '39', '40', '41', '42', '43', '44', NULL, NULL, 'TPR', 'SEM001', '1', NULL, NULL, NULL, 'Dewasa Laki-laki', '1', NULL, '12345678', '1612', NULL),
('1.1383M.TPR.16020004', '1381 TPR HITAM', 0, 13000, '2016-03-15 10:44:02', 'admin', NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'ANAK', '1', NULL, '1383M', '16020004', NULL),
('1.1391.TPR.16020003', '1391 TPR HITAM', 10000, 13000, '2016-03-10 11:22:49', 'admin', NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 'TPR', 'BON', '1', 'INA', 'S002', NULL, 'ANAK', '1', NULL, '1391', '16020003', NULL),
('1.BELINA.TPR.1701', 'BELINA TPR HITAM', 15000, 15000, '2016-03-21 15:49:15', 'admin', '2016-03-22 16:28:31', 'admin', NULL, NULL, 10, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 'TPR', 'BON', '1', NULL, NULL, NULL, 'Dewasa Perempuan', '1', NULL, 'BELINA', '1701', NULL),
('1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 10000, 10000, '2016-03-21 15:51:43', 'admin', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'ANAK TG', '1', NULL, 'BROWN', '16020008', NULL),
('1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', 0, 13000, '2016-04-25 14:00:09', 'admin', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'ANAK TG', '1', NULL, 'BROWN', '16020029', NULL),
('1.GYM KIDS.TPR.1702', 'GYM KIDS TPR CAPUCINO', 0, 15000, '2016-03-21 15:53:11', 'admin', '2016-03-22 16:30:27', 'admin', NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'ANAK', '1', NULL, 'GYM KIDS', '1702', NULL),
('1.IVY.TPR.16020010', 'IVY TPR HITAM', 18000, 18000, '2016-03-21 15:54:05', 'admin', '2016-03-21 16:10:49', 'admin', NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'Dewasa Perempuan', '1', NULL, 'IVY', '16020010', NULL),
('1.KIKY.TPR.16020011', 'KIKY TPR PUTIH', 7000, 7000, '2016-03-21 15:55:25', 'admin', NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'ANAK', '1', NULL, 'KIKY', '16020011', NULL),
('1.NINI.TPR.16020012', 'NINI TPR KUNING', 17500, 17500, '2016-03-21 15:56:19', 'admin', NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'Dewasa Perempuan', '1', NULL, 'NINI', '16020012', NULL),
('1.PRINCE.TPR.1602001', 'PRINCE TPR HITAM', 12000, 12000, '2016-03-21 15:57:20', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'ANAK TG', '1', NULL, 'PRINCE', '16020013', NULL),
('1.SERENA.TPR.1602001', 'SERENA TPR PINK', 17000, 17000, '2016-03-21 15:59:06', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'Dewasa Perempuan', '1', NULL, 'SERENA', '16020014', NULL),
('1.SYLVIA.TPR.1602001', 'SYLVIA TPR HITAM', 19000, 19000, '2016-03-21 16:00:02', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'Dewasa Perempuan', '1', NULL, 'SYLVIA', '16020015', NULL),
('1.VIOLET.TPR.1602001', 'VIOLET TPR HITAM', 18000, 18000, '2016-03-21 16:01:26', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '1', NULL, NULL, NULL, 'Dewasa Perempuan', '1', NULL, 'VIOLET', '16020016', NULL),
('13 B.HQ 1100.TPR.123', 'HQ 1100 TPR HITAM - 55%', 0, 0, '2016-04-05 15:18:38', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '13 B', NULL, 'C100002', NULL, NULL, NULL, NULL, 'HQ 1100', '123', NULL),
('13 B.HQ 1100.TPR.160', 'HQ 1100 WHITE - 55%', 50000, 0, '2016-03-21 16:26:44', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '13 B', NULL, 'C100002', NULL, NULL, NULL, NULL, 'HQ 1100', '16020018', NULL),
('13 B.VENUS 679.TPR.1', 'VENUS 679 - 55%', 50000, 0, '2016-03-21 16:24:27', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '13 B', NULL, 'D100001', NULL, NULL, NULL, NULL, 'VENUS 679', '16020017', NULL),
('13 B.VENUS 686.TPR.1', 'VENUS 686 HQ - 55%', 60000, 0, '2016-03-21 16:48:26', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '13 B', NULL, 'C100002', NULL, NULL, NULL, NULL, 'VENUS 686', '16020025', NULL),
('13 B.VS 9000.TPR.160', 'VS 9000 HITAM - 55%', 60000, 0, '2016-03-21 16:28:08', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '13 B', NULL, 'D100001', NULL, NULL, NULL, NULL, 'VS 9000', '16020019', NULL),
('13 B.VS BROWN.TPR.16', 'VS BROWN - 55%', 75000, 0, '2016-03-21 16:29:40', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, '13 B', NULL, 'D100001', NULL, NULL, NULL, NULL, 'VS BROWN', '16020020', NULL),
('A.1111.TPR.16010002', 'TPR No Size', 2323, 23233, '2016-01-03 14:33:06', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, 'A', 'INA', 'S002', NULL, 'No Size', NULL, NULL, '1111', '16010002', NULL),
('C.ACQUA.MATRES.16020', 'MATRES ACQUA', 8000000, 0, '2016-03-21 16:38:37', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, 'C', NULL, 'D100001', NULL, 'Dewasa Laki-laki', NULL, NULL, 'ACQUA', '16020022', NULL),
('C.AZURA.MATRES.123', 'MATRES AZURA ', 8500000, 0, '2016-04-05 15:44:35', 'admin', '2016-04-05 15:46:38', 'admin', NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 'MATRES', NULL, 'C', NULL, 'D100001', NULL, 'Dewasa Perempuan', '0', NULL, 'AZURA', '123', NULL),
('C.FIRLO.MATRES.16020', 'MATRES FIRLO', 8000000, 0, '2016-03-21 16:35:39', 'admin', '2016-03-21 16:36:34', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, 'C', NULL, 'C100002', NULL, 'Dewasa Laki-laki', NULL, NULL, 'FIRLO', '16020021', NULL),
('C.OCKLAY.MATRES.1602', 'MATRES OCKLAY', 8000000, 0, '2016-03-21 16:42:40', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, 'C', NULL, NULL, NULL, 'ANAK', NULL, NULL, 'OCKLAY', '16020024', NULL),
('C.VIOLET.MATRES.1602', 'MATRES VIOLET', 8000000, 0, '2016-03-21 16:40:11', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, 'C', NULL, NULL, NULL, 'Dewasa Perempuan', NULL, NULL, 'VIOLET', '16020023', NULL),
('C1383MTPR1212', 'TPR 1383', 0, 0, '2015-12-30 22:17:21', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TPR', NULL, 'C', NULL, NULL, NULL, NULL, NULL, NULL, '1383M', '1212', NULL),
('F.1111.1301.15120001', '1301 HITAM ', 121212, 121212, '2016-01-01 20:49:36', 'admin', '2016-03-19 11:15:06', 'admin', NULL, NULL, 232, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, '1301', 'BR01', 'F', 'INA', NULL, '232', 'ANAK TG', '0', NULL, '1111', '15120001', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=382 ;

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
(43, 11, 'SBY', 'Surabaya', '2014-01-12 08:37:51', 'admin', '0000-00-00 00:00:00', ''),
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
(327, 21, 'BAHAN', 'BAHAN', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(328, 21, 'MATRES', 'MATRES', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(329, 21, 'SOLE', 'SOLE', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', ''),
(330, 22, '1', 'Mesin Rotari Taiwan', '0000-00-00 00:00:00', '', '2015-12-30 05:22:56', 'admin'),
(331, 22, '0', 'Mesin Italy', '0000-00-00 00:00:00', '', '2015-12-30 05:21:15', 'admin'),
(332, 18, 'BR01', 'BRUTINI', '2015-10-17 11:35:12', 'admin', '2015-12-30 19:23:42', 'admin'),
(333, 17, '1301', '1301', '2015-10-17 11:35:24', 'admin', '2015-12-28 19:45:41', 'admin'),
(334, 16, '1', 'SOLE TAIWAN', '2015-10-17 11:36:00', 'admin', '2015-12-30 05:45:43', 'admin'),
(335, 16, 'A', 'TPR', '2015-10-21 10:15:18', 'admin', '2015-12-30 05:54:16', 'admin'),
(336, 16, '0', 'SOLE ITALY', '2015-10-21 10:15:26', 'admin', '2015-12-30 05:44:25', 'admin'),
(337, 17, 'TPR', 'TPR', '0000-00-00 00:00:00', '', '2015-12-28 19:46:38', 'admin'),
(338, 16, '2', 'SOLE ITALY 2 WARNA', '2015-12-30 05:48:01', 'admin', NULL, NULL),
(339, 16, '3', 'INSOLE', '2015-12-30 05:48:23', 'admin', NULL, NULL),
(340, 16, '4', 'SHOELAST', '2015-12-30 05:48:41', 'admin', NULL, NULL),
(341, 16, '5', 'SOLE TAIWAN 2 WARNA', '2015-12-30 05:50:15', 'admin', NULL, NULL),
(342, 16, 'B', 'PVC', '2015-12-30 05:50:51', 'admin', '2015-12-30 05:55:01', 'admin'),
(343, 16, 'C', 'MATRES', '2015-12-30 05:53:59', 'admin', NULL, NULL),
(344, 16, 'D', 'SOLAR', '2015-12-30 05:55:34', 'admin', NULL, NULL),
(345, 16, 'E', 'INVENTARIS', '2015-12-30 05:57:07', 'admin', NULL, NULL),
(346, 16, 'F', 'FINISHING', '2015-12-30 05:57:20', 'admin', NULL, NULL),
(347, 14, 'PTH', 'PUTIH', '2015-12-30 06:15:10', 'admin', '2015-12-30 17:38:03', 'admin'),
(348, 14, 'HTM', 'HITAM', '2015-12-30 17:38:18', 'admin', NULL, NULL),
(349, 14, 'CKT', 'COKLAT', '2015-12-30 17:38:39', 'admin', NULL, NULL),
(350, 23, '1111', '123121', '2015-12-30 21:26:39', 'admin', '2016-03-15 11:07:30', 'admin'),
(351, 23, '1383M', '1383', '2015-12-30 22:10:47', 'admin', '2015-12-30 22:12:47', 'admin'),
(352, 23, '1391', '1391', '2016-03-10 11:18:43', 'admin', NULL, NULL),
(353, 18, 'BON', 'BONIA', '2016-03-10 11:20:50', 'admin', NULL, NULL),
(354, 23, '2345', '2345', '2016-03-15 11:07:49', 'admin', NULL, NULL),
(355, 23, '12345678', '12345678', '2016-03-18 15:36:18', 'admin', NULL, NULL),
(356, 18, 'SEM001', 'SEMBONIA', '2016-03-18 15:39:47', 'admin', NULL, NULL),
(357, 14, 'CAP01', 'CAPUCINO', '2016-03-18 15:41:16', 'admin', NULL, NULL),
(358, 23, 'VIOLET', 'VIOLET', '2016-03-21 15:44:35', 'admin', NULL, NULL),
(359, 23, 'BROWN', 'BROWN', '2016-03-21 15:44:54', 'admin', NULL, NULL),
(360, 23, 'IVY', 'IVY', '2016-03-21 15:45:10', 'admin', NULL, NULL),
(361, 23, 'NINI', 'NINI', '2016-03-21 15:45:28', 'admin', NULL, NULL),
(362, 23, 'GYM KIDS', 'GYM KIDS', '2016-03-21 15:45:59', 'admin', NULL, NULL),
(363, 23, 'PRINCE', 'PRINCE', '2016-03-21 15:46:26', 'admin', NULL, NULL),
(364, 23, 'KIKY', 'KIKY', '2016-03-21 15:46:52', 'admin', NULL, NULL),
(365, 23, 'SERENA', 'SERENA', '2016-03-21 15:47:10', 'admin', NULL, NULL),
(366, 23, 'BELINA', 'BELINA', '2016-03-21 15:47:27', 'admin', NULL, NULL),
(367, 23, 'SYLVIA', 'SYLVIA', '2016-03-21 15:47:50', 'admin', NULL, NULL),
(368, 14, 'PTH', 'PUTIH', '2016-03-21 16:04:29', 'admin', NULL, NULL),
(369, 14, 'PNK', 'PINK', '2016-03-21 16:04:43', 'admin', NULL, NULL),
(370, 16, '13 B', 'BAHAN', '2016-03-21 16:21:03', 'admin', NULL, NULL),
(371, 23, 'VENUS 679', 'VENUS 679', '2016-03-21 16:22:47', 'admin', NULL, NULL),
(372, 23, 'HQ 1100', 'HQ 1100', '2016-03-21 16:25:14', 'admin', NULL, NULL),
(373, 23, 'VS 9000', 'VS 9000', '2016-03-21 16:27:11', 'admin', NULL, NULL),
(374, 23, 'VS BROWN', 'VS BROWN', '2016-03-21 16:28:38', 'admin', NULL, NULL),
(375, 23, 'FIRLO', 'FIRLO', '2016-03-21 16:30:41', 'admin', NULL, NULL),
(376, 17, 'MATRES', 'MATRES', '2016-03-21 16:33:50', 'admin', NULL, NULL),
(377, 23, 'ACQUA', 'ACQUA', '2016-03-21 16:37:29', 'admin', NULL, NULL),
(378, 23, 'OCKLAY', 'OCKLAY', '2016-03-21 16:41:10', 'admin', NULL, NULL),
(379, 23, 'VENUS 686', 'VENUS 686', '2016-03-21 16:46:18', 'admin', NULL, NULL),
(380, 23, 'AZURA', 'AZURA', '2016-04-05 14:55:08', 'admin', NULL, NULL),
(381, 24, 'PSG', 'PASANG', '2016-04-24 17:37:43', 'admin', NULL, NULL);

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
('All Size', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-02 07:02:48', 'admin', NULL, NULL),
('ANAK', '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, '2015-05-13 10:34:47', 'admin', NULL, NULL),
('ANAK TG', '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, '2015-05-13 10:33:28', 'admin', NULL, NULL),
('BABY', '20', '21', '22', '23', '24', '25', '26', '27', NULL, NULL, '2015-05-13 10:32:20', 'admin', '2015-05-13 10:34:17', 'admin'),
('Dewasa Laki-laki', '37', '38', '39', '40', '41', '42', '43', '44', NULL, NULL, '2015-05-01 10:27:29', 'admin', '2016-03-21 16:09:53', 'admin'),
('Dewasa Perempuan', '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, '2015-05-01 10:30:32', 'admin', '2016-03-21 16:09:40', 'admin'),
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
(24, 'Satuan Barang', NULL, NULL, NULL, NULL);

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
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_user`
--

INSERT INTO `mst_user` (`user_id`, `user_pass`, `user_nama`, `group_user_id`, `status_aktif`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `kode_cabang`) VALUES
('admin', '123456', 'admin', 1, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '000'),
('akunting', '123456', 'akunting', 8, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', '000'),
('edp', '123456', 'edp', 3, 1, '2014-01-11 10:01:13', 'admin', '0000-00-00 00:00:00', '', '000'),
('edp1', '123456', 'edp1', 3, 0, '2014-01-11 10:02:54', 'admin', '2014-01-11 10:11:13', 'edp1', '000'),
('gudang', '123456', 'gudang', 6, 1, '2014-01-11 10:10:54', 'edp1', '0000-00-00 00:00:00', '', '000'),
('management', '123456', 'management s', 2, 1, '0000-00-00 00:00:00', '', '2014-01-10 18:16:28', 'admin', '000'),
('test', '123456', 'Testing', 6, 1, '2015-02-12 10:34:24', 'admin', '0000-00-00 00:00:00', '', '000');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `trx_bayar`
--

INSERT INTO `trx_bayar` (`id`, `transaksi_kode`, `no_invoice`, `tgl_invoice`, `jml_invoice`, `telah_bayar`, `jml_hutang`, `jml_bayar`, `ket_bayar`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(2, 'PBP16020002', 'STN16020001', '2016-02-07', 11636352, 0, 11636352, 1636352, 'test', NULL, NULL, NULL, NULL),
(8, 'PBP16030003', 'STN16020001', '2016-02-07', 11636352, 1636352, 10000000, 10000000, NULL, NULL, NULL, NULL, NULL),
(9, 'PBP16030004', 'STO16030003', '2016-03-14', 2094261, 0, 2094261, 2094261, NULL, NULL, NULL, NULL, NULL),
(10, 'PBP16030004', 'STO16030004', '2016-03-15', 1062646, 0, 1062646, 1062646, NULL, NULL, NULL, NULL, NULL),
(11, 'PBP16030004', 'STO16030005', '2016-03-16', 1237000, 0, 1237000, 1237000, NULL, NULL, NULL, NULL, NULL),
(12, 'PBP16030005', 'STO16030007', '2016-03-19', 1040000, 0, 1040000, 1040000, NULL, NULL, NULL, NULL, NULL),
(13, 'PBP16040006', 'STO16030006', '2016-03-18', 520000, 0, 520000, 520000, NULL, NULL, NULL, NULL, NULL),
(14, 'PBP16040006', 'STO16040010', '2016-04-05', 1750000, 0, 1750000, 1000000, NULL, NULL, NULL, NULL, NULL),
(15, 'PBH16040001', 'PTN16040004', '2016-04-05', 250000, 0, 250000, 100000, NULL, NULL, NULL, NULL, NULL),
(16, 'PBH16040002', 'PTN16040005', '2016-04-05', 8500000, 0, 8500000, 5000000, NULL, NULL, NULL, NULL, NULL),
(18, 'PBP16040007', 'STO16040011', '2016-04-25', 253000, 0, 253000, 200000, NULL, NULL, NULL, NULL, NULL),
(19, 'PBH16040003', 'PTN16040004', '2016-04-05', 250000, 100000, 150000, 150000, NULL, NULL, NULL, NULL, NULL),
(20, 'PBP16040008', 'STO16040012', '2016-04-25', 115000, 0, 115000, 115000, NULL, NULL, NULL, NULL, NULL),
(23, 'PBP16040009', 'STO16040011', '2016-04-25', 253000, 200000, 53000, 53000, NULL, NULL, NULL, NULL, NULL),
(24, 'PBP16040009', 'STO16040013', '2016-04-26', 446750, 0, 446750, 446750, NULL, NULL, NULL, NULL, NULL),
(25, 'PBP16040011', 'STO16040010', '2016-04-05', 1750000, 1000000, 750000, 750000, NULL, NULL, NULL, NULL, NULL),
(26, 'PBP16040012', 'STO16030002', '2016-03-11', 2546544, 0, 2546544, 2546544, NULL, NULL, NULL, NULL, NULL),
(27, 'PBP16040012', 'STO16030008', '2016-03-21', 3640000, 0, 3640000, 3640000, NULL, NULL, NULL, NULL, NULL),
(28, 'PBH16040004', 'PTN16040005', '2016-04-05', 8500000, 5000000, 3500000, 3500000, NULL, NULL, NULL, NULL, NULL),
(29, 'PBH16040005', 'PTN16030003', '2016-03-19', 12000000, 0, 12000000, 12000000, NULL, NULL, NULL, NULL, NULL),
(30, 'PBP16040013', 'STO16040017', '2016-04-27', 750000, 0, 750000, 500000, NULL, NULL, NULL, NULL, NULL),
(31, 'PBP16040014', 'STO16040017', '2016-04-27', 750000, 500000, 250000, 250000, NULL, NULL, NULL, NULL, NULL),
(32, 'PBH16040006', 'PTN16040008', '2016-04-26', 8000000, 0, 8000000, 5000000, NULL, NULL, NULL, NULL, NULL),
(33, 'PBP16050021', 'STO16020001', '2016-02-07', 4646460, 0, 4646460, 1646460, NULL, NULL, NULL, NULL, NULL),
(34, 'PBH16050010', 'PTN16030001', '2016-03-18', 2323, 0, 2323, 2323, NULL, NULL, NULL, NULL, NULL),
(35, 'PBH16050010', 'PTN16030002', '2016-03-18', 12000, 0, 12000, 12000, NULL, NULL, NULL, NULL, NULL),
(36, 'PBH16050010', 'PTN16040007', '2016-04-25', 250000, 0, 250000, 210000, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `trx_besar`
--

INSERT INTO `trx_besar` (`id`, `jenis_transaksi`, `no_transaksi`, `tgl_transaksi`, `kodeac`, `kodedc`, `stdk`, `debet`, `kredit`, `ket`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `no_reff`) VALUES
(1, 1, 'JK16040001', '2016-04-26', '100000', '100000', 1, 200000, 0, 'PEMBAYARAN SUPLIER', NULL, NULL, NULL, NULL, NULL),
(2, 1, 'JK16040001', '2016-04-26', '100000', '100000', 1, 0, 200000, 'PEMBAYARAN SUPLIER', NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `trx_cara_bayar`
--

INSERT INTO `trx_cara_bayar` (`id`, `transaksi_kode`, `cara_bayar`, `perkiraan_code`, `perkiraan_name`, `jumlah`, `no_reff`, `tgl_reff`, `ket_reff`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(2, 'PBP16020002', '1', '100000', 'Kas', 1636352, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'PBP16030003', '2', '100000', 'Kas', 10000000, 'G12345', '2016-03-25', NULL, NULL, NULL, NULL, NULL),
(5, 'PBP16030004', '2', '100000', 'Kas', 4393907, NULL, '2016-03-19', NULL, NULL, NULL, NULL, NULL),
(6, 'PBP16030005', '1', '100000', 'Kas', 1040000, NULL, '2016-03-19', NULL, NULL, NULL, NULL, NULL),
(7, 'PBP16040006', '1', '100000', 'Kas', 1520000, NULL, NULL, 'TRANSFER TGL 5/4/16', NULL, NULL, NULL, NULL),
(8, 'PBH16040001', '2', '100000', 'Kas', 100000, NULL, NULL, 'TRANSFER 5/4/16', NULL, NULL, NULL, NULL),
(9, 'PBH16040002', '3', '100000', 'Kas', 5000000, 'BG12345678', '2016-04-06', NULL, NULL, NULL, NULL, NULL),
(10, 'PBP16040007', '1', '100000', 'Kas', 200000, NULL, '2016-04-25', NULL, NULL, NULL, NULL, NULL),
(11, 'PBH16040003', '2', '100000', 'Kas', 150000, NULL, '2016-04-25', NULL, NULL, NULL, NULL, NULL),
(12, 'PBP16040009', '2', '100000', 'Kas', 499750, NULL, '2016-04-27', NULL, NULL, NULL, NULL, NULL),
(13, 'PBP16040011', '1', '100000', 'Kas', 750000, NULL, '2016-04-26', NULL, NULL, NULL, NULL, NULL),
(15, 'PBP16040012', '2', '100000', 'Kas', 6186544, NULL, '2016-04-26', NULL, NULL, NULL, NULL, NULL),
(16, 'PBH16040004', '2', '100000', 'Kas', 3500000, NULL, '2016-04-26', NULL, NULL, NULL, NULL, NULL),
(17, 'PBH16040005', '2', '100000', 'Kas', 12000000, NULL, '2016-04-26', NULL, NULL, NULL, NULL, NULL),
(18, 'PBP16040013', '1', '100000', 'Kas', 500000, NULL, '2016-04-27', NULL, NULL, NULL, NULL, NULL),
(19, 'PBP16040014', '2', '100000', 'Kas', 250000, NULL, '2016-04-27', NULL, NULL, NULL, NULL, NULL),
(20, 'PBH16040006', '1', '100000', 'Kas', 5000000, NULL, '2016-04-27', NULL, NULL, NULL, NULL, NULL),
(21, 'PBP16050021', '1', '100000', 'Kas', 1646460, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'PBH16050010', '1', '100000', 'Kas', 224323, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `trx_catatan`
--

INSERT INTO `trx_catatan` (`id`, `judul`, `catatan`, `input_by`, `input_date`) VALUES
(1, 'judul', 'catatan', 'admin', '2015-10-22 10:06:23'),
(2, 'judul 2', 'catatan 2', 'admin', '2015-10-22 10:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `trx_detail`
--

CREATE TABLE IF NOT EXISTS `trx_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_kode` varchar(20) DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=158 ;

--
-- Dumping data for table `trx_detail`
--

INSERT INTO `trx_detail` (`id`, `transaksi_kode`, `product_code`, `product_name`, `satuan`, `qty`, `harga_beli`, `harga_jual`, `sub_total`, `disc_persen`, `disc_amount`, `total`, `ket_detail`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `kode_warna`, `kode_size1`, `kode_size2`, `kode_size3`, `kode_size4`, `kode_size5`, `kode_size6`, `kode_size7`, `kode_size8`, `kode_size9`, `kode_size10`, `qty_size1`, `qty_size2`, `qty_size3`, `qty_size4`, `qty_size5`, `qty_size6`, `qty_size7`, `qty_size8`, `qty_size9`, `qty_size10`, `harga`, `no_order`) VALUES
(33, 'PRT16020001', '01301M1', 'test', NULL, 48, NULL, NULL, 11151504, 0, 0, 11151504, NULL, NULL, NULL, NULL, NULL, NULL, '20', '21', '22', '23', '24', '25', '26', '27', NULL, NULL, 12, 12, 12, 12, NULL, NULL, NULL, NULL, NULL, NULL, 232323, NULL),
(36, 'SOR16020001', '01301M1', 'test', NULL, 9, NULL, NULL, 2090907, 0, 0, 2090907, NULL, NULL, NULL, NULL, NULL, NULL, '20', '21', '22', '23', '24', '25', '26', '27', NULL, NULL, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 232323, NULL),
(37, 'STO16020001', '01301M1', 'test', NULL, 20, NULL, NULL, 4646460, 0, 0, 4646460, NULL, NULL, NULL, NULL, NULL, NULL, '20', '21', '22', '23', '24', '25', '26', '27', NULL, NULL, 5, 5, 5, 5, 0, 0, 0, 0, NULL, NULL, 232323, 'PRT16020001'),
(38, 'STN16020001', 'ITJ1M1', 'Barang 11', NULL, 96, NULL, NULL, 11636352, 0, 0, 11636352, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 19, 11, 11, 11, 11, 11, 11, 11, NULL, NULL, 121212, NULL),
(39, 'SOR16030002', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 30, NULL, NULL, 390000, 0, 0, 390000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 5, 5, 5, 5, 5, 5, NULL, NULL, NULL, NULL, 13000, NULL),
(40, 'SOR16030002', 'F.1111.1301.15120001', 'bnansa asdad', NULL, 12, NULL, NULL, 1454544, 0, 0, 1454544, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 121212, NULL),
(41, 'SOR16030003', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 54, NULL, NULL, 702000, 0, 0, 702000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 12, 13, 14, 15, NULL, NULL, NULL, NULL, NULL, NULL, 13000, NULL),
(42, 'STO16030002', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 30, NULL, NULL, 390000, 0, 0, 390000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 5, 5, 5, 5, 5, 5, 0, 0, NULL, NULL, 13000, 'SOR16030002'),
(43, 'STO16030002', 'F.1111.1301.15120001', 'bnansa asdad', NULL, 12, NULL, NULL, 1454544, 0, 0, 1454544, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 6, 6, 0, 0, 0, 0, 0, 0, NULL, NULL, 121212, 'SOR16030002'),
(44, 'STO16030002', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 54, NULL, NULL, 702000, 0, 0, 702000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 12, 13, 14, 15, 0, 0, 0, 0, NULL, NULL, 13000, 'SOR16030003'),
(45, 'SOR16030004', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 36, NULL, NULL, 468000, 0, 0, 468000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 6, 6, 6, 6, 6, 6, NULL, NULL, NULL, NULL, 13000, NULL),
(48, 'SOR16030005', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 40, NULL, NULL, 520000, 0, 0, 520000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 8, 8, 8, 8, 8, NULL, NULL, NULL, NULL, NULL, 13000, NULL),
(51, 'SOR16030006', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 15, NULL, NULL, 195000, 0, 0, 195000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 5, 5, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13000, NULL),
(52, 'STO16030003', '01301M1', 'test', NULL, 7, NULL, NULL, 1626261, 0, 0, 1626261, NULL, NULL, NULL, NULL, NULL, NULL, '20', '21', '22', '23', '24', '25', '26', '27', NULL, NULL, 2, 1, 4, 0, 0, 0, 0, 0, NULL, NULL, 232323, 'SOR16020001'),
(53, 'STO16030003', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 36, NULL, NULL, 468000, 0, 0, 468000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 6, 6, 6, 6, 6, 6, 0, 0, NULL, NULL, 13000, 'SOR16030004'),
(54, 'STO16030004', '01301M1', 'test', NULL, 2, NULL, NULL, 464646, 0, 0, 464646, NULL, NULL, NULL, NULL, NULL, NULL, '20', '21', '22', '23', '24', '25', '26', '27', NULL, NULL, 1, 2, -1, 0, 0, 0, 0, 0, NULL, NULL, 232323, 'SOR16020001'),
(55, 'STO16030004', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 40, NULL, NULL, 520000, 0, 0, 520000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 8, 8, 8, 8, 8, 0, 0, 0, NULL, NULL, 13000, 'SOR16030005'),
(56, 'STO16030004', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 6, NULL, NULL, 78000, 0, 0, 78000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 2, 2, 2, 0, 0, 0, 0, 0, NULL, NULL, 13000, 'SOR16030006'),
(57, 'SOR16030007', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 80, NULL, NULL, 1040000, 0, 0, 1040000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 10, 10, 10, 10, 10, 10, 10, 10, NULL, NULL, 13000, NULL),
(58, 'SOR16030007', '1.1383M.TPR.16020004', '1381 TPR HITAM', NULL, 40, NULL, NULL, 600000, 0, 0, 600000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 5, 5, 5, 5, 5, 5, 5, 5, NULL, NULL, 15000, NULL),
(59, 'STO16030005', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 9, NULL, NULL, 117000, 0, 0, 117000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 3, 3, 3, 0, 0, 0, 0, 0, NULL, NULL, 13000, 'SOR16030006'),
(60, 'STO16030005', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 40, NULL, NULL, 520000, 0, 0, 520000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 5, 5, 5, 5, 5, 5, 5, 5, NULL, NULL, 13000, 'SOR16030007'),
(61, 'STO16030005', '1.1383M.TPR.16020004', '1381 TPR HITAM', NULL, 40, NULL, NULL, 600000, 0, 0, 600000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 5, 5, 5, 5, 5, 5, 5, 5, NULL, NULL, 15000, 'SOR16030007'),
(63, 'PTN16030002', 'C1383MTPR1212', 'TPR 1383', NULL, 1, NULL, NULL, 12000, 0, 0, 12000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000, NULL),
(64, 'PTN16030001', 'A.1111.TPR.16010002', 'TPR No Size', NULL, 1, NULL, NULL, 2323, 0, 0, 2323, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2323, NULL),
(65, 'STO16030006', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 40, NULL, NULL, 520000, 0, 0, 520000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 5, 5, 5, 5, 5, 5, 5, 5, NULL, NULL, 13000, 'SOR16030007'),
(67, 'STO16030007', '1.1383M.TPR.16020004', '1381 TPR HITAM', NULL, 80, NULL, NULL, 1040000, 0, 0, 1040000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 10, 10, 10, 10, 10, 10, 10, 10, NULL, NULL, 13000, 'SOR16030008'),
(68, 'SOR16030008', '1.1383M.TPR.16020004', '1381 TPR HITAM', NULL, 80, NULL, NULL, 1040000, 0, 0, 1040000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 10, 10, 10, 10, 10, 10, 10, 10, NULL, NULL, 13000, NULL),
(69, 'SOR16030008', 'F.1111.1301.15120001', '1301 HITAM ', NULL, 60, NULL, NULL, 7272720, 0, 0, 7272720, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, 10, 10, 10, 10, 10, 10, NULL, NULL, NULL, 121212, NULL),
(70, 'PTN16030003', 'C1383MTPR1212', 'TPR 1383', NULL, 10, NULL, NULL, 12000000, 0, 0, 12000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1200000, NULL),
(71, 'SOR16030009', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 240, NULL, NULL, 3120000, 0, 0, 3120000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 30, 30, 30, 30, 30, 30, 30, 30, NULL, NULL, 13000, NULL),
(72, 'SOR16030009', '1.1383M.TPR.16020004', '1381 TPR HITAM', NULL, 120, NULL, NULL, 1560000, 0, 0, 1560000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 15, 15, 15, 15, 15, 15, 15, 15, NULL, NULL, 13000, NULL),
(73, 'STO16030008', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 160, NULL, NULL, 2080000, 0, 0, 2080000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 20, 20, 20, 20, 20, 20, 20, 20, NULL, NULL, 13000, 'SOR16030009'),
(74, 'STO16030008', '1.1383M.TPR.16020004', '1381 TPR HITAM', NULL, 120, NULL, NULL, 1560000, 0, 0, 1560000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 15, 15, 15, 15, 15, 15, 15, 15, NULL, NULL, 13000, 'SOR16030009'),
(75, 'STO16030009', '1.1391.TPR.16020003', '1391 TPR HITAM', NULL, 80, NULL, NULL, 1040000, 0, 0, 1040000, NULL, NULL, NULL, NULL, NULL, NULL, '26', '27', '28', '29', '30', '31', '32', '33', NULL, NULL, 10, 10, 10, 10, 10, 10, 10, 10, NULL, NULL, 13000, 'SOR16030009'),
(77, 'STO16040010', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 70, NULL, NULL, 1750000, 0, 0, 1750000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 10, 10, 10, 10, 10, 10, 10, 0, NULL, NULL, 25000, 'SOR16040010'),
(78, 'IPN16040001', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 15, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(79, 'IPN16040002', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 10, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(80, 'PTN16040004', '13 B.HQ 1100.TPR.160', 'HQ 1100 WHITE - 55%', NULL, 5, NULL, NULL, 250000, 0, 0, 250000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL),
(81, 'IPN16040003', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 10, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(82, 'OBP16040001', '13 B.HQ 1100.TPR.160', 'HQ 1100 WHITE - 55%', NULL, 2, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(83, 'PTN16040005', 'C.AZURA.MATRES.123', 'MATRES AZURA ', NULL, 1, NULL, NULL, 8500000, 0, 0, 8500000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8500000, NULL),
(84, 'SOR16040010', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 70, NULL, NULL, 1750000, 0, 0, 1750000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 10, 10, 10, 10, 10, 10, 10, NULL, NULL, NULL, 25000, NULL),
(85, 'OPN16040001', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 15, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(86, 'OPN16040002', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 1, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(87, 'OPN16040002', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 2, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(89, 'SOR16040012', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 5, NULL, NULL, 50000, 0, 0, 50000, 'BRASS ( 1100 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(90, 'SOR16040012', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 5, NULL, NULL, 65000, 0, 0, 65000, 'BRASS ( 686 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 13000, NULL),
(91, 'SOR16040011', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 15, NULL, NULL, 150000, 0, 0, 150000, 'BRASS (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(92, 'SOR16040011', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 15, NULL, NULL, 195000, 0, 0, 195000, 'BRASS ( 686 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, 13000, NULL),
(102, 'PTN16040007', '13 B.HQ 1100.TPR.160', 'HQ 1100 WHITE - 55%', NULL, 5, NULL, NULL, 250000, 0, 0, 250000, 'BAHAN RUSAK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50000, NULL),
(103, 'PTN16040006', '13 B.HQ 1100.TPR.123', 'HQ 1100 TPR HITAM - 55%', NULL, 8, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(104, 'STO16040012', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 5, NULL, NULL, 50000, 0, 0, 50000, 'BRASS ( 1100 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 5, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16040012'),
(105, 'STO16040012', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 5, NULL, NULL, 65000, 0, 0, 65000, 'BRASS ( 686 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 5, 0, 0, 0, 0, NULL, NULL, 13000, 'SOR16040012'),
(106, 'STO16040011', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 10, NULL, NULL, 100000, 0, 0, 100000, 'BRASS (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 10, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16040011'),
(107, 'STO16040011', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 10, NULL, NULL, 130000, 0, 0, 130000, 'BRASS ( 686 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 10, 0, 0, 0, 0, NULL, NULL, 13000, 'SOR16040011'),
(108, 'IPO16040001', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 15, NULL, NULL, 0, 0, 0, 0, 'BRASS ( 686 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 15, 0, 0, 0, 0, NULL, NULL, 0, 'SOR16040011'),
(109, 'OPO16040001', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 15, NULL, NULL, 0, 0, 0, 0, 'BRASS ( 686 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 15, 0, 0, 0, 0, NULL, NULL, 0, 'SOR16040011'),
(110, 'OBP16040002', '13 B.HQ 1100.TPR.160', 'HQ 1100 WHITE - 55%', NULL, 6, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(111, 'IBP16040001', '13 B.VENUS 679.TPR.1', 'VENUS 679 - 55%', NULL, 8, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(113, 'IPO16040002', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 15, NULL, NULL, 0, 0, 0, 0, 'BRASS (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 15, 0, 0, 0, 0, NULL, NULL, 0, 'SOR16040011'),
(114, 'IPO16040002', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 45, NULL, NULL, 0, 0, 0, 0, 'BRASS (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 10, 20, 15, 0, 0, 0, NULL, NULL, 0, 'SOR16040013'),
(115, 'STO16040013', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 5, NULL, NULL, 50000, 0, 0, 50000, 'BRASS (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 5, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16040011'),
(116, 'STO16040013', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 5, NULL, NULL, 65000, 0, 0, 65000, 'BRASS ( 686 )', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 5, 0, 0, 0, 0, NULL, NULL, 13000, 'SOR16040011'),
(117, 'STO16040013', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 45, NULL, NULL, 450000, 0, 0, 450000, 'BRASS (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 10, 20, 15, 0, 0, 0, NULL, NULL, 10000, 'SOR16040013'),
(118, 'SOR16040014', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 15, NULL, NULL, 195000, 0, 0, 195000, 'BRASS 686', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, 5, 5, 5, NULL, NULL, NULL, NULL, NULL, 13000, NULL),
(119, 'PTN16040008', 'C.FIRLO.MATRES.16020', 'MATRES FIRLO', NULL, 1, NULL, NULL, 8000000, 0, 0, 8000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8000000, NULL),
(120, 'SOR16040013', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 45, NULL, NULL, 450000, 0, 0, 450000, 'BRASS (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, 10, 20, 15, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(121, 'SOR16040015', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 20, NULL, NULL, 200000, 0, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(122, 'OPO16040002', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 20, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 20, 0, 0, 0, 0, NULL, NULL, 0, 'SOR16040015'),
(123, 'STO16040014', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 20, NULL, NULL, 200000, 0, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 20, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16040015'),
(126, 'STO16040015', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 20, NULL, NULL, 500000, 0, 0, 500000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 0, 5, 10, 5, 0, 0, 0, 0, NULL, NULL, 25000, 'SOR16040016'),
(127, 'SOR16040017', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 50, NULL, NULL, 500000, 0, 0, 500000, 'brass (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(128, 'STO16040016', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 25, NULL, NULL, 250000, 0, 0, 250000, 'brass (1100)', NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 25, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16040017'),
(129, 'SOR16040018', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 30, NULL, NULL, 750000, 0, 0, 750000, 'BRASS ( 1100)', NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, NULL, 30, NULL, NULL, NULL, NULL, NULL, NULL, 25000, NULL),
(131, 'STO16040017', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 5, NULL, NULL, 125000, 0, 0, 125000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 25000, NULL),
(132, 'IBP16040002', '13 B.HQ 1100.TPR.123', 'HQ 1100 TPR HITAM - 55%', NULL, 5, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(133, 'OBP16040003', '13 B.HQ 1100.TPR.123', 'HQ 1100 TPR HITAM - 55%', NULL, 3, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(134, 'PTN16040009', 'C.ACQUA.MATRES.16020', 'MATRES ACQUA', NULL, 1, NULL, NULL, 8000000, 0, 0, 8000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8000000, NULL),
(135, 'PTN16040010', 'C.ACQUA.MATRES.16020', 'MATRES ACQUA', NULL, 1, NULL, NULL, 8000000, 0, 0, 8000000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8000000, NULL),
(136, 'SOR16040016', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 20, NULL, NULL, 1125000, 0, 0, 1125000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, 5, 10, 5, NULL, NULL, NULL, NULL, NULL, NULL, 25000, NULL),
(137, 'STO16040018', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 30, NULL, NULL, 750000, 0, 0, 750000, 'BRASS ( 1100)', NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 0, 0, 0, 30, 0, 0, 0, 0, NULL, NULL, 25000, 'SOR16040018'),
(138, 'SOR16050019', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 50, NULL, NULL, 1250000, 0, 0, 1250000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, 50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25000, NULL),
(139, 'STO16050019', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 25, NULL, NULL, 625000, 0, 0, 625000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 0, 0, 25, 0, 0, 0, 0, 0, NULL, NULL, 25000, 'SOR16050019'),
(140, 'SOR16050020', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 200, NULL, NULL, 5000000, 0, 0, 5000000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, 50, 50, 50, 50, NULL, NULL, NULL, NULL, NULL, 25000, NULL),
(141, 'SOR16050020', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 100, NULL, NULL, 1000000, 0, 0, 1000000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(142, 'STO16050020', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 125, NULL, NULL, 3125000, 0, 0, 3125000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 0, 50, 25, 25, 25, 0, 0, 0, NULL, NULL, 25000, 'SOR16050020'),
(143, 'STO16050020', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 50, NULL, NULL, 500000, 0, 0, 500000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 25, 25, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16050020'),
(144, 'PTN16050011', 'C.AZURA.MATRES.123', 'MATRES AZURA ', NULL, 1, NULL, NULL, 8500000, 0, 0, 8500000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, 8500000, NULL),
(145, 'SOR16050021', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 150, NULL, NULL, 3750000, 0, 0, 3750000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, NULL, NULL, 50, 50, 50, NULL, NULL, NULL, NULL, NULL, 25000, NULL),
(146, 'SOR16050021', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 150, NULL, NULL, 1500000, 0, 0, 1500000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, 50, 50, 50, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(147, 'SOR16050021', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 100, NULL, NULL, 1300000, 0, 0, 1300000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 50, 50, NULL, NULL, NULL, NULL, NULL, 13000, NULL),
(148, 'STO16050021', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 75, NULL, NULL, 1875000, 0, 0, 1875000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 0, 0, 25, 25, 25, 0, 0, 0, NULL, NULL, 25000, 'SOR16050020'),
(149, 'STO16050021', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 50, NULL, NULL, 500000, 0, 0, 500000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 25, 25, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16050020'),
(150, 'SOR16050022', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 100, NULL, NULL, 1000000, 0, 0, 1000000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(151, 'SOR16050022', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 100, NULL, NULL, 1000000, 0, 0, 1000000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, 50, 50, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL),
(152, 'STO16050022', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', NULL, 150, NULL, NULL, 3750000, 0, 0, 3750000, NULL, NULL, NULL, NULL, NULL, NULL, '35', '36', '37', '38', '39', '40', '41', '42', NULL, NULL, 0, 0, 50, 50, 50, 0, 0, 0, NULL, NULL, 25000, 'SOR16050021'),
(153, 'STO16050022', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 150, NULL, NULL, 1500000, 0, 0, 1500000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 50, 50, 50, 0, 0, 0, NULL, NULL, 10000, 'SOR16050021'),
(154, 'STO16050022', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', NULL, 100, NULL, NULL, 1300000, 0, 0, 1300000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 0, 50, 50, 0, 0, 0, NULL, NULL, 13000, 'SOR16050021'),
(155, 'STO16050022', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 75, NULL, NULL, 750000, 0, 0, 750000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 25, 50, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16050022'),
(156, 'STO16050022', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 75, NULL, NULL, 750000, 0, 0, 750000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, 0, 0, 25, 50, 0, 0, 0, 0, NULL, NULL, 10000, 'SOR16050022'),
(157, 'SRT16050001', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', NULL, 20, NULL, NULL, 200000, 0, 0, 200000, NULL, NULL, NULL, NULL, NULL, NULL, '30', '31', '32', '33', '34', '35', '36', '37', NULL, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL, 10000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_gudang`
--

CREATE TABLE IF NOT EXISTS `trx_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

--
-- Dumping data for table `trx_invoice`
--

INSERT INTO `trx_invoice` (`id`, `jenis_transaksi`, `no_transaksi`, `tgl_transaksi`, `no_invoice`, `jml_in`, `jml_out`, `contact_code`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `no_reff`, `tgl_invoice`, `jml_invoice`, `sub_transaksi`) VALUES
(49, 6, 'STO16020001', '2016-02-07', 'STO16020001', 4646460, 0, '2000004', '2016-02-07 19:27:43', 'admin', NULL, NULL, NULL, '2016-02-07', 4646460, 3),
(50, 7, 'STN16020001', '2016-02-07', 'STN16020001', 11636352, 0, '2000003', '2016-02-07 20:21:03', 'admin', NULL, NULL, NULL, '2016-02-07', 11636352, 3),
(51, 18, 'PBP16020002', '2016-02-08', 'STN16020001', 0, 1636352, '2000003', '2016-02-08 16:28:10', 'admin', NULL, NULL, NULL, '2016-02-07', 11636352, 3),
(52, 6, 'STO16030002', '2016-03-11', 'STO16030002', 2546544, 0, '2000005', '2016-03-11 14:17:17', 'admin', NULL, NULL, NULL, '2016-03-11', 2546544, 3),
(55, 6, 'STO16030003', '2016-03-14', 'STO16030003', 2094261, 0, '2000003', '2016-03-14 11:51:48', 'admin', NULL, NULL, NULL, '2016-03-14', 2094261, 3),
(56, 6, 'STO16030004', '2016-03-15', 'STO16030004', 1062646, 0, '2000003', '2016-03-15 09:01:20', 'admin', NULL, NULL, NULL, '2016-03-15', 1062646, 3),
(57, 6, 'STO16030005', '2016-03-16', 'STO16030005', 1237000, 0, '2000003', '2016-03-15 10:53:20', 'admin', NULL, NULL, NULL, '2016-03-16', 1237000, 3),
(60, 18, 'PBP16030003', '2016-03-16', 'STN16020001', 0, 10000000, '2000003', '2016-03-16 21:14:15', 'admin', NULL, NULL, NULL, '2016-02-07', 11636352, 3),
(62, 3, 'PTN16030002', '2016-03-18', 'PTN16030002', 12000, 0, 'C100002', '2016-03-18 15:44:23', 'admin', NULL, NULL, NULL, '2016-03-18', 12000, 3),
(63, 3, 'PTN16030001', '2016-03-18', 'PTN16030001', 2323, 0, 'C100002', '2016-03-18 15:45:12', 'admin', NULL, NULL, NULL, '2016-03-18', 2323, 3),
(64, 6, 'STO16030006', '2016-03-18', 'STO16030006', 520000, 0, '2000003', '2016-03-18 15:46:22', 'admin', NULL, NULL, NULL, '2016-03-18', 520000, 3),
(65, 18, 'PBP16030004', '2016-03-19', 'STO16030003', 0, 2094261, '2000003', '2016-03-18 16:07:32', 'admin', NULL, NULL, NULL, '2016-03-14', 2094261, 3),
(66, 18, 'PBP16030004', '2016-03-19', 'STO16030004', 0, 1062646, '2000003', '2016-03-18 16:07:32', 'admin', NULL, NULL, NULL, '2016-03-15', 1062646, 3),
(67, 18, 'PBP16030004', '2016-03-19', 'STO16030005', 0, 1237000, '2000003', '2016-03-18 16:07:32', 'admin', NULL, NULL, NULL, '2016-03-16', 1237000, 3),
(68, 6, 'STO16030007', '2016-03-19', 'STO16030007', 1040000, 0, '2000006', '2016-03-19 10:38:47', 'admin', NULL, NULL, NULL, '2016-03-19', 1040000, 3),
(69, 18, 'PBP16030005', '2016-03-19', 'STO16030007', 0, 1040000, '2000006', '2016-03-19 10:41:28', 'admin', NULL, NULL, NULL, '2016-03-19', 1040000, 3),
(70, 3, 'PTN16030003', '2016-03-19', 'PTN16030003', 12000000, 0, 'C100002', '2016-03-19 11:24:51', 'admin', NULL, NULL, NULL, '2016-03-19', 12000000, 3),
(71, 6, 'STO16030008', '2016-03-21', 'STO16030008', 3640000, 0, '2000005', '2016-03-21 15:31:19', 'admin', NULL, NULL, NULL, '2016-03-21', 3640000, 3),
(72, 6, 'STO16030009', '2016-03-21', 'STO16030009', 1040000, 0, '2000005', '2016-03-21 15:34:04', 'admin', NULL, NULL, NULL, '2016-03-21', 1040000, 3),
(73, 6, 'STO16040010', '2016-04-05', 'STO16040010', 1750000, 0, '2000003', '2016-04-05 15:05:51', 'admin', NULL, NULL, NULL, '2016-04-05', 1750000, 3),
(74, 18, 'PBP16040006', '2016-04-05', 'STO16030006', 0, 520000, '2000003', '2016-04-05 15:08:39', 'admin', NULL, NULL, NULL, '2016-03-18', 520000, 3),
(75, 18, 'PBP16040006', '2016-04-05', 'STO16040010', 0, 1000000, '2000003', '2016-04-05 15:08:39', 'admin', NULL, NULL, NULL, '2016-04-05', 1750000, 3),
(77, 3, 'PTN16040004', '2016-04-05', 'PTN16040004', 250000, 0, 'C100002', '2016-04-05 15:22:35', 'admin', NULL, NULL, NULL, '2016-04-05', 250000, 3),
(78, 17, 'PBH16040001', '2016-04-05', 'PTN16040004', 0, 100000, 'C100002', '2016-04-05 15:23:36', 'admin', NULL, NULL, NULL, '2016-04-05', 250000, 3),
(79, 3, 'PTN16040005', '2016-04-05', 'PTN16040005', 8500000, 0, 'D100001', '2016-04-05 15:47:56', 'admin', NULL, NULL, NULL, '2016-04-05', 8500000, 3),
(80, 17, 'PBH16040002', '2016-04-05', 'PTN16040005', 0, 5000000, 'D100001', '2016-04-05 15:50:11', 'admin', NULL, NULL, NULL, '2016-04-05', 8500000, 3),
(86, 6, 'STO16040012', '2016-04-25', 'STO16040012', 115000, 0, '2000009', '2016-04-25 15:03:51', 'admin', NULL, NULL, NULL, '2016-04-25', 115000, 3),
(87, 6, 'STO16040011', '2016-04-25', 'STO16040011', 253000, 0, '2000008', '2016-04-25 15:07:37', 'admin', NULL, NULL, NULL, '2016-04-25', 253000, 3),
(89, 18, 'PBP16040007', '2016-04-25', 'STO16040011', 0, 200000, '2000008', '2016-04-25 16:04:03', 'admin', NULL, NULL, NULL, '2016-04-25', 253000, 3),
(90, 17, 'PBH16040003', '2016-04-25', 'PTN16040004', 0, 150000, 'C100002', '2016-04-25 16:12:16', 'admin', NULL, NULL, NULL, '2016-04-05', 250000, 3),
(91, 18, 'PBP16040008', '2016-04-25', 'STO16040012', 0, 115000, '2000009', '2016-04-25 16:38:36', 'admin', NULL, NULL, NULL, '2016-04-25', 115000, 3),
(92, 6, 'STO16040013', '2016-04-26', 'STO16040013', 446750, 0, '2000008', '2016-04-26 13:24:41', 'admin', NULL, NULL, NULL, '2016-04-26', 446750, 3),
(96, 18, 'PBP16040009', '2016-04-26', 'STO16040011', 0, 53000, '2000008', '2016-04-26 14:27:40', 'admin', NULL, NULL, NULL, '2016-04-25', 253000, 3),
(97, 18, 'PBP16040009', '2016-04-26', 'STO16040013', 0, 446750, '2000008', '2016-04-26 14:27:40', 'admin', NULL, NULL, NULL, '2016-04-26', 446750, 3),
(99, 18, 'PBP16040011', '2016-04-26', 'STO16040010', 0, 750000, '2000003', '2016-04-26 14:35:18', 'admin', NULL, NULL, NULL, '2016-04-05', 1750000, 3),
(100, 18, 'PBP16040012', '2016-04-26', 'STO16030002', 0, 2546544, '2000005', '2016-04-26 14:43:01', 'admin', NULL, NULL, NULL, '2016-03-11', 2546544, 3),
(101, 18, 'PBP16040012', '2016-04-26', 'STO16030008', 0, 3640000, '2000005', '2016-04-26 14:43:01', 'admin', NULL, NULL, NULL, '2016-03-21', 3640000, 3),
(103, 3, 'PTN16040008', '2016-04-26', 'PTN16040008', 8000000, 0, 'D100001', '2016-04-26 14:50:14', 'admin', NULL, NULL, NULL, '2016-04-26', 8000000, 3),
(104, 17, 'PBH16040004', '2016-04-26', 'PTN16040005', 0, 3500000, 'D100001', '2016-04-26 14:53:17', 'admin', NULL, NULL, NULL, '2016-04-05', 8500000, 3),
(105, 17, 'PBH16040005', '2016-04-26', 'PTN16030003', 0, 12000000, 'C100002', '2016-04-26 14:58:01', 'admin', NULL, NULL, NULL, '2016-03-19', 12000000, 3),
(106, 6, 'STO16040014', '2016-04-26', 'STO16040014', 200000, 0, '2000003', '2016-04-26 15:59:33', 'admin', NULL, NULL, NULL, '2016-04-26', 200000, 3),
(107, 6, 'STO16040015', '2016-04-27', 'STO16040015', 450000, 0, '2000003', '2016-04-27 10:15:27', 'admin', NULL, NULL, NULL, '2016-04-27', 450000, 3),
(108, 6, 'STO16040016', '2016-04-27', 'STO16040016', 237500, 0, '2000008', '2016-04-27 10:19:35', 'admin', NULL, NULL, NULL, '2016-04-27', 237500, 3),
(109, 6, 'STO16040017', '2016-04-27', 'STO16040017', 750000, 0, '2000005', '2016-04-27 10:39:31', 'admin', NULL, NULL, NULL, '2016-04-27', 750000, 3),
(110, 18, 'PBP16040013', '2016-04-27', 'STO16040017', 0, 500000, '2000005', '2016-04-27 10:46:53', 'admin', NULL, NULL, NULL, '2016-04-27', 750000, 3),
(111, 18, 'PBP16040014', '2016-04-27', 'STO16040017', 0, 250000, '2000005', '2016-04-27 11:09:05', 'admin', NULL, NULL, NULL, '2016-04-27', 750000, 3),
(112, 17, 'PBH16040006', '2016-04-27', 'PTN16040008', 0, 5000000, 'D100001', '2016-04-27 11:16:19', 'admin', NULL, NULL, NULL, '2016-04-26', 8000000, 3),
(113, 3, 'PTN16040009', '2016-04-27', 'PTN16040009', 8000000, 0, 'D100001', '2016-04-27 11:21:54', 'admin', NULL, NULL, NULL, '2016-04-27', 8000000, 3),
(114, 6, 'STO16040018', '2016-04-27', 'STO16040018', 750000, 0, '2000005', '2016-04-27 15:22:08', 'admin', NULL, NULL, NULL, '2016-04-27', 750000, 3),
(115, 6, 'STO16050019', '2016-05-04', 'STO16050019', 609375, 0, '2000005', '2016-05-04 13:55:47', 'admin', NULL, NULL, NULL, '2016-05-04', 609375, 3),
(116, 6, 'STO16050020', '2016-05-17', 'STO16050020', 3534375, 0, '2000003', '2016-05-17 14:22:31', 'admin', NULL, NULL, NULL, '2016-05-17', 3534375, 3),
(117, 3, 'PTN16050011', '2016-05-17', 'PTN16050011', 8500000, 0, 'D100001', '2016-05-17 14:56:05', 'admin', NULL, NULL, NULL, '2016-05-17', 8500000, 3),
(118, 6, 'STO16050021', '2016-05-19', 'STO16050021', 2315625, 0, '2000003', '2016-05-19 08:43:28', 'admin', NULL, NULL, NULL, '2016-05-19', 2315625, 3),
(119, 6, 'STO16050022', '2016-05-20', 'STO16050022', 7848750, 0, '2000003', '2016-05-20 09:16:39', 'admin', NULL, NULL, NULL, '2016-05-20', 7848750, 3);

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
  PRIMARY KEY (`jurnal_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_jurnal`
--

INSERT INTO `trx_jurnal` (`jurnal_code`, `jurnal_date`, `tipe_jurnal`, `perkiraan_header_code`, `status_debet_kredit`, `dari_bagian`, `jumlah`, `jumlah_debet`, `jumlah_kredit`, `keterangan`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
('JK16040001', '2016-04-26', 1, '100000', 1, 'C100002', 200000, NULL, NULL, NULL, '2016-04-26 14:11:00', 'admin', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trx_jurnal_detail`
--

INSERT INTO `trx_jurnal_detail` (`jurnal_detail_id`, `jurnal_code`, `perkiraan_code`, `perkiraan_name`, `flag_perkiraan_Header`, `jumlah`, `jumlah_debet`, `jumlah_kredit`, `no_dok`, `tgl_dok`, `ket_dok`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`) VALUES
(1, 'JK16040001', '100000', 'Kas', NULL, 200000, NULL, NULL, '123456', '2016-04-27', 'PEMBAYARAN SUPLIER', NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

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
(24, 'KOP16050013', 'STO16050022', '2016-05-20', 7848750, 0, 7848750, NULL, NULL, NULL, NULL);

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
  PRIMARY KEY (`transaksi_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trx_master`
--

INSERT INTO `trx_master` (`transaksi_kode`, `transaksi_tipe`, `transaksi_tgl`, `no_invoice`, `tgl_invoice`, `contact_code`, `sales_code`, `sub_total`, `sub_qty`, `disc_persen`, `disc_amount`, `ppn_persen`, `ppn_amount`, `total`, `bayar`, `sisa`, `keterangan`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `stOrder`, `stOrder_input_date`, `stOrder_input_by`, `stOrder_ket`, `no_reff`, `tgl_reff`, `JmlCaraBayar`, `gudang_kode`, `petugas_kode`, `disc_persen2`, `disc_amount2`, `disc_persen3`, `disc_amount3`, `kel_beli`, `biaya_kirim`, `piutang`, `petugas_kode2`, `contact_code2`, `biaya_lain`, `potongan_lain`) VALUES
('IBP16040001', 13, '2016-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-25 15:51:52', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD002', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IBP16040002', 13, '2016-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-27 10:58:16', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD002', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IPN16040001', 10, '2016-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-05 15:13:23', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IPN16040002', 10, '2016-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-05 15:16:00', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IPN16040003', 10, '2016-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'UNTUK RUANG SAMPLE', '2016-04-05 15:30:30', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IPO16040001', 9, '2016-04-25', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-25 15:44:12', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('IPO16040002', 9, '2016-04-26', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-26 13:21:41', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16030001', 16, '2016-03-16', NULL, NULL, '2000004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4646460, NULL, NULL, 'test', '2016-03-16 21:12:57', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16030002', 16, '2016-03-18', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4913907, NULL, NULL, NULL, '2016-03-18 16:04:38', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16030003', 16, '2016-03-19', NULL, NULL, '2000006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1040000, NULL, NULL, NULL, '2016-03-19 10:40:24', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16040004', 16, '2016-04-05', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2270000, NULL, NULL, NULL, '2016-04-05 15:07:03', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16040005', 16, '2016-04-25', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 253000, NULL, NULL, NULL, '2016-04-25 15:56:03', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16040006', 16, '2016-04-25', NULL, NULL, '2000009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 115000, NULL, NULL, NULL, '2016-04-25 15:57:37', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16040007', 16, '2016-04-26', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200000, NULL, NULL, NULL, '2016-04-26 16:00:10', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16040008', 16, '2016-04-27', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1790000, NULL, NULL, NULL, '2016-04-27 10:45:55', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16050009', 16, '2016-05-17', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4184375, NULL, NULL, NULL, '2016-05-17 14:31:03', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16050010', 16, '2016-05-19', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6500000, NULL, NULL, NULL, '2016-05-19 08:52:45', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16050011', 16, '2016-05-19', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6500000, NULL, NULL, NULL, '2016-05-19 14:13:53', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16050012', 16, '2016-05-20', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6500000, NULL, NULL, NULL, '2016-05-20 09:05:09', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('KOP16050013', 16, '2016-05-20', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14348750, NULL, NULL, NULL, '2016-05-20 09:25:29', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('OBP16040001', 14, '2016-04-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-05 15:36:47', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD002', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A1000001', NULL, NULL, NULL),
('OBP16040002', 14, '2016-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-25 15:50:54', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD002', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A1000001', NULL, NULL, NULL),
('OBP16040003', 14, '2016-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-27 11:00:01', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('OPN16040001', 12, '2016-03-19', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-25 13:41:55', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('OPN16040002', 12, '2016-04-25', NULL, NULL, '2000009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-25 14:04:33', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', 'A1000001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('OPO16040001', 11, '2016-04-25', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-25 15:46:21', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('OPO16040002', 11, '2016-04-26', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-26 15:57:11', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'GD001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBH16040001', 17, '2016-04-05', NULL, NULL, 'C100002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100000, NULL, NULL, '2016-04-05 15:23:36', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBH16040002', 17, '2016-04-05', NULL, NULL, 'D100001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000000, NULL, NULL, '2016-04-05 15:50:11', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBH16040003', 17, '2016-04-25', NULL, NULL, 'C100002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 150000, NULL, NULL, '2016-04-25 16:12:16', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBH16040004', 17, '2016-04-26', NULL, NULL, 'D100001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3500000, NULL, NULL, '2016-04-26 14:53:17', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBH16040005', 17, '2016-04-26', NULL, NULL, 'C100002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12000000, NULL, NULL, '2016-04-26 14:58:01', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBH16040006', 17, '2016-04-27', NULL, NULL, 'D100001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5000000, NULL, NULL, '2016-04-27 11:16:19', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBH16050010', 17, '2016-05-21', NULL, NULL, 'C100002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 224323, 224323, NULL, NULL, '2016-05-21 11:01:59', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
('PBP16020001', 18, '2016-02-07', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11636352, NULL, NULL, NULL, '2016-02-07 20:28:49', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16020002', 18, '2016-02-08', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1636352, NULL, 'test', '2016-02-08 16:23:29', 'admin', '2016-02-08 16:28:09', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16030003', 18, '2016-03-16', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10000000, NULL, NULL, '2016-03-16 16:39:13', 'admin', '2016-03-16 21:14:15', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16030004', 18, '2016-03-19', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4393907, NULL, NULL, '2016-03-18 16:07:32', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16030005', 18, '2016-03-19', NULL, NULL, '2000006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1040000, NULL, NULL, '2016-03-19 10:41:28', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040006', 18, '2016-04-05', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1520000, NULL, NULL, '2016-04-05 15:08:38', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040007', 18, '2016-04-25', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 200000, NULL, NULL, '2016-04-25 16:00:23', 'admin', '2016-04-25 16:04:03', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040008', 18, '2016-04-25', NULL, NULL, '2000009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 115000, NULL, NULL, '2016-04-25 16:38:36', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040009', 18, '2016-04-26', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 499750, NULL, NULL, '2016-04-26 14:26:27', 'admin', '2016-04-26 14:27:40', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040010', 18, '2016-04-26', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2016-04-26 14:27:07', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040011', 18, '2016-04-26', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 750000, NULL, NULL, '2016-04-26 14:35:18', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040012', 18, '2016-04-26', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6186544, NULL, NULL, '2016-04-26 14:43:00', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040013', 18, '2016-04-27', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 500000, NULL, NULL, '2016-04-27 10:46:53', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16040014', 18, '2016-04-27', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 250000, NULL, NULL, '2016-04-27 11:09:05', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PBP16050021', 18, '2016-05-21', NULL, NULL, '2000004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1646460, 1646460, NULL, 'test', '2016-05-21 10:53:44', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
('PRT16020001', 4, '2016-02-07', NULL, NULL, '2000004', NULL, NULL, NULL, NULL, 0, NULL, 0, 11151504, 0, 11151504, NULL, '2016-02-07 16:56:15', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('PTN16030001', 3, '2016-03-18', 'N12345', '2016-03-18', 'C100002', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 2323, 0, 2323, NULL, '2016-03-18 15:23:52', 'admin', '2016-03-18 15:45:12', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAHAN', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16030002', 3, '2016-03-18', 'N12345', NULL, 'C100002', NULL, NULL, NULL, NULL, 0, NULL, 0, 12000, 0, 12000, NULL, '2016-03-18 15:44:23', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAHAN', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16030003', 3, '2016-03-19', 'N12345', '2016-03-18', 'C100002', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 12000000, 0, 12000000, NULL, '2016-03-19 11:24:51', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAHAN', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16040004', 3, '2016-04-05', NULL, '2016-04-06', 'C100002', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 250000, 0, 250000, NULL, '2016-04-05 15:22:35', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAHAN', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16040005', 3, '2016-04-05', NULL, '2016-04-06', 'D100001', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 8500000, 0, 8500000, NULL, '2016-04-05 15:47:56', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16040006', 3, '2016-04-25', NULL, '2016-04-27', 'C100002', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 0, 0, 0, NULL, '2016-04-25 14:42:12', 'admin', '2016-04-25 14:51:29', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'BAHAN', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16040007', 3, '2016-04-25', NULL, NULL, 'C100002', NULL, NULL, NULL, NULL, 0, NULL, 0, 250000, 0, 250000, NULL, '2016-04-25 14:44:46', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, '000001', '2016-04-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16040008', 3, '2016-04-26', NULL, NULL, 'D100001', NULL, NULL, NULL, NULL, 0, NULL, 0, 8000000, 0, 8000000, NULL, '2016-04-26 14:50:13', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16040009', 3, '2016-04-27', NULL, '2016-04-27', 'D100001', NULL, NULL, NULL, NULL, 0, NULL, 0, 8000000, 0, 8000000, NULL, '2016-04-27 11:21:54', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16040010', 3, '2016-04-27', NULL, NULL, 'D100001', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 8000000, 0, 8000000, NULL, '2016-04-27 11:26:19', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'PTN16040009', '2016-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('PTN16050011', 3, '2016-05-17', NULL, '2016-05-17', 'D100001', 'S001', NULL, NULL, NULL, 0, NULL, 0, 8500000, 0, 8500000, NULL, '2016-05-17 14:56:05', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'MATRES', NULL, NULL, NULL, NULL, NULL, NULL),
('SOR16020001', 5, '2016-02-07', NULL, NULL, '2000003', 'B00001', NULL, NULL, NULL, 0, NULL, 0, 2090907, 0, 2090907, NULL, '2016-02-07 17:11:30', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030002', 5, '2016-03-10', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, 0, NULL, 0, 1844544, 0, 1844544, NULL, '2016-03-10 11:33:59', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030003', 5, '2016-03-11', NULL, NULL, '2000005', 'B00001', NULL, NULL, NULL, 0, NULL, 0, 702000, 0, 702000, NULL, '2016-03-11 14:14:54', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030004', 5, '2016-03-01', NULL, NULL, '2000003', 'B102345', NULL, NULL, NULL, 0, NULL, 0, 468000, 0, 468000, NULL, '2016-03-14 09:29:55', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030005', 5, '2016-03-14', NULL, NULL, '2000003', 'B102345', NULL, NULL, NULL, 0, NULL, 0, 520000, 0, 520000, NULL, '2016-03-14 09:45:51', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030006', 5, '2016-03-14', NULL, NULL, '2000003', 'B102345', NULL, NULL, NULL, 0, NULL, 0, 195000, 0, 195000, NULL, '2016-03-14 11:35:48', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030007', 5, '2016-03-15', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, 0, NULL, 0, 1640000, 0, 1640000, NULL, '2016-03-15 10:47:23', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030008', 5, '2016-03-19', NULL, NULL, '2000006', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 8312720, 0, 8312720, NULL, '2016-03-19 10:29:30', 'admin', '2016-03-19 11:16:44', 'admin', NULL, NULL, NULL, NULL, NULL, '2016-03-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16030009', 5, '2016-03-21', NULL, NULL, '2000005', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 4680000, 0, 4680000, NULL, '2016-03-21 15:18:47', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-03-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040010', 5, '2016-04-05', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 1750000, 0, 1750000, NULL, '2016-04-05 15:03:54', 'admin', '2016-04-24 17:02:34', 'admin', NULL, NULL, NULL, NULL, NULL, '2016-04-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040011', 5, '2016-04-25', NULL, NULL, '2000008', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 345000, 0, 345000, NULL, '2016-04-25 14:11:03', 'admin', '2016-04-25 14:24:30', 'admin', NULL, NULL, NULL, NULL, NULL, '2016-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040012', 5, '2016-04-25', NULL, NULL, '2000009', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 115000, 0, 115000, NULL, '2016-04-25 14:19:28', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040013', 5, '2016-04-26', NULL, NULL, '2000008', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 450000, 0, 450000, NULL, '2016-04-26 13:12:28', 'admin', '2016-04-26 15:01:44', 'admin', NULL, NULL, NULL, NULL, NULL, '2016-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040014', 5, '2016-04-26', NULL, NULL, '2000007', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 195000, 0, 195000, NULL, '2016-04-26 14:02:05', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040015', 5, '2016-04-26', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 200000, 0, 200000, NULL, '2016-04-26 15:55:34', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040016', 5, '2016-04-27', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 1125000, 0, 1125000, NULL, '2016-04-27 10:08:48', 'admin', '2016-04-27 11:41:44', 'admin', NULL, NULL, NULL, NULL, NULL, '2016-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040017', 5, '2016-04-27', NULL, NULL, '2000008', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 500000, 0, 500000, NULL, '2016-04-27 10:18:12', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16040018', 5, '2016-04-27', NULL, NULL, '2000005', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 750000, 0, 750000, 'DP 500 000', '2016-04-27 10:36:01', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16050019', 5, '2016-05-04', NULL, NULL, '2000005', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 1250000, 0, 1250000, NULL, '2016-05-04 13:53:33', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16050020', 5, '2016-05-17', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 6000000, 0, 6000000, NULL, '2016-05-17 14:19:48', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16050021', 5, '2016-05-19', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 6550000, 0, 6550000, NULL, '2016-05-19 08:37:16', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SOR16050022', 5, '2016-05-20', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 2000000, 0, 2000000, NULL, '2016-05-20 09:11:30', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-05-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SOLE', 0, NULL, NULL, NULL, NULL, NULL),
('SRT16050001', 8, '2016-05-20', NULL, NULL, '2000003', 'S001', NULL, NULL, NULL, 0, NULL, 0, 200000, 0, 200000, NULL, '2016-05-20 13:57:31', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 'STO160400022', '2016-05-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('STN16020001', 7, '2016-02-07', NULL, NULL, '2000003', 'B00001', NULL, NULL, NULL, 0, NULL, 0, 11636352, 0, 11636352, NULL, '2016-02-07 17:05:05', 'admin', '2016-02-07 20:21:03', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16020001', 6, '2016-02-07', NULL, NULL, '2000004', NULL, NULL, NULL, NULL, 0, NULL, 0, 4646460, 0, 4646460, NULL, '2016-02-07 16:58:23', 'admin', '2016-02-07 19:27:42', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030002', 6, '2016-03-11', NULL, NULL, '2000005', 'B00001', NULL, NULL, NULL, 0, NULL, 0, 2546544, 0, 2546544, NULL, '2016-03-11 14:17:17', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030003', 6, '2016-03-14', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, 0, NULL, 0, 2094261, 0, 2094261, NULL, '2016-03-14 09:40:09', 'admin', '2016-03-14 11:51:48', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030004', 6, '2016-03-15', NULL, NULL, '2000003', 'B102345', NULL, NULL, NULL, 0, NULL, 0, 1062646, 0, 1062646, NULL, '2016-03-15 09:01:20', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030005', 6, '2016-03-16', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, 0, NULL, 0, 1237000, 0, 1237000, NULL, '2016-03-15 10:53:20', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030006', 6, '2016-03-18', NULL, NULL, '2000003', NULL, NULL, NULL, NULL, 0, NULL, 0, 520000, 0, 520000, NULL, '2016-03-18 15:46:22', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030007', 6, '2016-03-19', NULL, NULL, '2000006', NULL, NULL, NULL, NULL, 0, NULL, 0, 1040000, 0, 1040000, NULL, '2016-03-19 10:38:47', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030008', 6, '2016-03-21', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, 0, NULL, 0, 3640000, 0, 3640000, NULL, '2016-03-21 15:31:19', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16030009', 6, '2016-03-21', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, 0, NULL, 0, 1040000, 0, 1040000, NULL, '2016-03-21 15:34:04', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040010', 6, '2016-04-05', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 1750000, 0, 1750000, NULL, '2016-04-05 15:05:51', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040011', 6, '2016-04-25', NULL, NULL, '2000008', NULL, NULL, NULL, NULL, 0, 10, 23000, 253000, 0, 253000, '1 PLASTIK', '2016-04-25 14:26:49', 'admin', '2016-04-25 15:07:37', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040012', 6, '2016-04-25', NULL, NULL, '2000009', NULL, NULL, NULL, NULL, 0, NULL, 0, 115000, 0, 115000, NULL, '2016-04-25 15:03:51', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040013', 6, '2016-04-26', NULL, NULL, '2000008', NULL, NULL, NULL, 25, 141250, NULL, 0, 446750, 0, 446750, NULL, '2016-04-26 13:24:41', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23000, NULL, NULL, NULL, NULL, NULL),
('STO16040014', 6, '2016-04-26', NULL, NULL, '2000003', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 200000, 0, 200000, NULL, '2016-04-26 15:59:33', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040015', 6, '2016-04-27', NULL, NULL, '2000003', NULL, NULL, NULL, 10, 50000, NULL, 0, 450000, 0, 450000, NULL, '2016-04-27 10:15:27', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040016', 6, '2016-04-27', NULL, NULL, '2000008', NULL, NULL, NULL, 5, 12500, NULL, 0, 237500, 0, 237500, NULL, '2016-04-27 10:19:35', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040017', 6, '2016-04-27', NULL, NULL, '2000005', NULL, NULL, NULL, NULL, 0, NULL, 0, 125000, 0, 125000, NULL, '2016-04-27 10:39:31', 'admin', '2016-04-27 10:43:12', 'admin', NULL, NULL, NULL, NULL, 'STO160400017', '2016-04-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16040018', 6, '2016-04-27', NULL, NULL, '2000005', 'A1000001', NULL, NULL, NULL, 0, NULL, 0, 750000, 0, 750000, NULL, '2016-04-27 15:22:08', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16050019', 6, '2016-05-04', NULL, NULL, '2000005', NULL, NULL, NULL, 2.5, 15625, NULL, 0, 609375, 0, 609375, NULL, '2016-05-04 13:55:46', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16050020', 6, '2016-05-17', NULL, NULL, '2000003', 'S001', NULL, NULL, 2.5, 90625, NULL, 0, 3534375, 0, 3534375, NULL, '2016-05-17 14:22:31', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16050021', 6, '2016-05-19', NULL, NULL, '2000003', NULL, NULL, NULL, 2.5, 59375, NULL, 0, 2315625, 0, 2315625, NULL, '2016-05-19 08:43:28', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL),
('STO16050022', 6, '2016-05-20', NULL, NULL, '2000003', NULL, NULL, NULL, 2.5, 201250, NULL, 0, 7848750, 0, 7848750, NULL, '2016-05-20 09:16:39', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trx_persediaan`
--

CREATE TABLE IF NOT EXISTS `trx_persediaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_transaksi` int(11) DEFAULT NULL,
  `no_transaksi` varchar(20) DEFAULT NULL,
  `tgl_transaksi` date DEFAULT NULL,
  `product_code` varchar(20) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `trx_persediaan`
--

INSERT INTO `trx_persediaan` (`id`, `jenis_transaksi`, `no_transaksi`, `tgl_transaksi`, `product_code`, `product_name`, `qty_in`, `qty_out`, `CreateDate`, `CreateBy`, `UpdateDate`, `UpdateBy`, `qty`, `qtysize1`, `qtysize2`, `qtysize3`, `qtysize4`, `qtysize5`, `qtysize6`, `qtysize7`, `qtysize8`, `qtysize9`, `qtysize10`, `qtysize1_out`, `qtysize2_in`, `qtysize2_out`, `qtysize3_in`, `qtysize3_out`, `qtysize4_in`, `qtysize4_out`, `qtysize5_in`, `qtysize5_out`, `qtysize6_in`, `qtysize6_out`, `qtysize7_in`, `qtysize7_out`, `qtysize8_in`, `qtysize8_out`, `qtysize9_in`, `qtysize9_out`, `qtysize10_in`, `qtysize10_out`, `harga`, `kode_gudang`, `ketdetail`, `qtysize1_in`) VALUES
(25, 4, 'PRT16020001', '2016-02-07', '01301M1', 'test', NULL, NULL, NULL, NULL, NULL, NULL, -48, -12, -12, -12, -12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 6, 'STO16020001', '2016-02-07', '01301M1', 'test', NULL, NULL, NULL, NULL, NULL, NULL, -20, -5, -5, -5, -5, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 7, 'STN16020001', '2016-02-07', 'ITJ1M1', 'Barang 11', NULL, NULL, NULL, NULL, NULL, NULL, -96, -19, -11, -11, -11, -11, -11, -11, -11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 5, 'SOR16020001', '2016-02-07', '01301M1', 'test', NULL, NULL, NULL, NULL, NULL, NULL, -9, -3, -3, -3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 5, 'SOR16030002', '2016-03-10', '1.1391.TPR.16020003', '1391 TPR HITAM', 0, 30, NULL, NULL, NULL, NULL, -30, -5, -5, -5, -5, -5, -5, NULL, NULL, NULL, NULL, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(30, 5, 'SOR16030002', '2016-03-10', 'F.1111.1301.15120001', 'bnansa asdad', 0, 12, NULL, NULL, NULL, NULL, -12, -6, -6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, 6, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 121212, '-1', NULL, 0),
(31, 5, 'SOR16030003', '2016-03-11', '1.1391.TPR.16020003', '1391 TPR HITAM', 0, 54, NULL, NULL, NULL, NULL, -54, -12, -13, -14, -15, NULL, NULL, NULL, NULL, NULL, NULL, 12, 0, 13, 0, 14, 0, 15, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(32, 5, 'SOR16030004', '2016-03-01', '1.1391.TPR.16020003', '1391 TPR HITAM', 0, 36, NULL, NULL, NULL, NULL, -36, -6, -6, -6, -6, -6, -6, NULL, NULL, NULL, NULL, 6, 0, 6, 0, 6, 0, 6, 0, 6, 0, 6, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(33, 5, 'SOR16030005', '2016-03-14', '1.1391.TPR.16020003', '1391 TPR HITAM', 0, 40, NULL, NULL, NULL, NULL, -40, -8, -8, -8, -8, -8, NULL, NULL, NULL, NULL, NULL, 8, 0, 8, 0, 8, 0, 8, 0, 8, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(34, 5, 'SOR16030006', '2016-03-14', '1.1391.TPR.16020003', '1391 TPR HITAM', 0, 15, NULL, NULL, NULL, NULL, -15, -5, -5, -5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 0, 5, 0, 5, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(35, 5, 'SOR16030007', '2016-03-15', '1.1391.TPR.16020003', '1391 TPR HITAM', 0, 80, NULL, NULL, NULL, NULL, -80, -10, -10, -10, -10, -10, -10, -10, -10, NULL, NULL, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(36, 5, 'SOR16030007', '2016-03-15', '1.1383M.TPR.16020004', '1381 TPR HITAM', 0, 40, NULL, NULL, NULL, NULL, -40, -5, -5, -5, -5, -5, -5, -5, -5, NULL, NULL, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, 5, 0, NULL, 0, NULL, 15000, '-1', NULL, 0),
(39, 5, 'SOR16030008', '2016-03-19', '1.1383M.TPR.16020004', '1381 TPR HITAM', 0, 80, NULL, NULL, NULL, NULL, -80, -10, -10, -10, -10, -10, -10, -10, -10, NULL, NULL, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(40, 5, 'SOR16030008', '2016-03-19', 'F.1111.1301.15120001', '1301 HITAM ', 0, 60, NULL, NULL, NULL, NULL, -60, NULL, -10, -10, -10, -10, -10, -10, NULL, NULL, NULL, NULL, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, NULL, 0, NULL, 0, NULL, 121212, '-1', NULL, 0),
(42, 5, 'SOR16030009', '2016-03-21', '1.1391.TPR.16020003', '1391 TPR HITAM', 0, 240, NULL, NULL, NULL, NULL, -240, -30, -30, -30, -30, -30, -30, -30, -30, NULL, NULL, 30, 0, 30, 0, 30, 0, 30, 0, 30, 0, 30, 0, 30, 0, 30, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(43, 5, 'SOR16030009', '2016-03-21', '1.1383M.TPR.16020004', '1381 TPR HITAM', 0, 120, NULL, NULL, NULL, NULL, -120, -15, -15, -15, -15, -15, -15, -15, -15, NULL, NULL, 15, 0, 15, 0, 15, 0, 15, 0, 15, 0, 15, 0, 15, 0, 15, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(45, 5, 'SOR16040010', '2016-04-05', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', 0, 70, NULL, NULL, NULL, NULL, -70, -10, -10, -10, -10, -10, -10, -10, NULL, NULL, NULL, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, 10, 0, NULL, 0, NULL, 0, NULL, 25000, '-1', NULL, 0),
(47, 5, 'SOR16040012', '2016-04-25', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 5, NULL, NULL, NULL, NULL, -5, NULL, NULL, NULL, -5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 5, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(48, 5, 'SOR16040012', '2016-04-25', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', 0, 5, NULL, NULL, NULL, NULL, -5, NULL, NULL, NULL, -5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 5, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(50, 5, 'SOR16040011', '2016-04-25', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 15, NULL, NULL, NULL, NULL, -15, NULL, NULL, NULL, -15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 15, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(51, 5, 'SOR16040011', '2016-04-25', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', 0, 15, NULL, NULL, NULL, NULL, -15, NULL, NULL, NULL, -15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 15, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(53, 3, 'PTN16040007', '2016-04-25', '13 B.HQ 1100.TPR.160', 'HQ 1100 WHITE - 55%', 0, 5, NULL, NULL, NULL, NULL, -5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 50000, '-1', NULL, 0),
(55, 5, 'SOR16040014', '2016-04-26', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', 0, 15, NULL, NULL, NULL, NULL, -15, NULL, NULL, -5, -5, -5, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 5, 0, 5, 0, 5, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(56, 5, 'SOR16040013', '2016-04-26', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 45, NULL, NULL, NULL, NULL, -45, NULL, NULL, -10, -20, -15, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 10, 0, 20, 0, 15, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(57, 5, 'SOR16040015', '2016-04-26', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 20, NULL, NULL, NULL, NULL, -20, NULL, NULL, NULL, -20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 20, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(60, 5, 'SOR16040017', '2016-04-27', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 50, NULL, NULL, NULL, NULL, -50, NULL, NULL, NULL, -50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(61, 5, 'SOR16040018', '2016-04-27', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', 0, 30, NULL, NULL, NULL, NULL, -30, NULL, NULL, NULL, -30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 30, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 25000, '-1', NULL, 0),
(62, 6, 'STO16040017', '2016-04-27', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', 5, 0, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 5, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, 25000, '-1', NULL, NULL),
(63, 3, 'PTN16040010', '2016-04-27', 'C.ACQUA.MATRES.16020', 'MATRES ACQUA', 0, 1, NULL, NULL, NULL, NULL, -1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 8000000, '-1', NULL, 0),
(64, 5, 'SOR16040016', '2016-04-27', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', 0, 20, NULL, NULL, NULL, NULL, -20, NULL, -5, -10, -5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 5, 0, 10, 0, 5, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 25000, '-1', NULL, 0),
(65, 5, 'SOR16050019', '2016-05-04', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', 0, 50, NULL, NULL, NULL, NULL, -50, NULL, NULL, -50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 25000, '-1', NULL, 0),
(66, 5, 'SOR16050020', '2016-05-17', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', 0, 200, NULL, NULL, NULL, NULL, -200, NULL, -50, -50, -50, -50, NULL, NULL, NULL, NULL, NULL, NULL, 0, 50, 0, 50, 0, 50, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 25000, '-1', NULL, 0),
(67, 5, 'SOR16050020', '2016-05-17', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 100, NULL, NULL, NULL, NULL, -100, NULL, NULL, -50, -50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 50, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(69, 5, 'SOR16050021', '2016-05-19', '0.AZURA.TPR.109', 'AZURA TPR PUTIH', 0, 150, NULL, NULL, NULL, NULL, -150, NULL, NULL, -50, -50, -50, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 50, 0, 50, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 25000, '-1', NULL, 0),
(70, 5, 'SOR16050021', '2016-05-19', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 150, NULL, NULL, NULL, NULL, -150, NULL, NULL, -50, -50, -50, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 50, 0, 50, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(71, 5, 'SOR16050021', '2016-05-19', '1.BROWN.TPR.16020029', 'BROWN TPR CAPUCINO', 0, 100, NULL, NULL, NULL, NULL, -100, NULL, NULL, NULL, -50, -50, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 50, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 13000, '-1', NULL, 0),
(72, 5, 'SOR16050022', '2016-05-20', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 100, NULL, NULL, NULL, NULL, -100, NULL, NULL, -50, -50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 50, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(73, 5, 'SOR16050022', '2016-05-20', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 0, 100, NULL, NULL, NULL, NULL, -100, NULL, NULL, -50, -50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 50, 0, 50, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 10000, '-1', NULL, 0),
(75, 8, 'SRT16050001', '2016-05-20', '1.BROWN.TPR.16020008', 'BROWN TPR PUTIH', 20, 0, NULL, NULL, NULL, NULL, 20, NULL, NULL, NULL, 20, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 20, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, NULL, 0, 10000, '-1', NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
