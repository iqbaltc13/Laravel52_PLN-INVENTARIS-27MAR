-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2018 pada 16.05
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pln_inventaris`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `chgpassword` (`var_password` VARCHAR(60), `var_id` INT(10))  BEGIN
update users set password=var_password, updated_at= NOW() where id=var_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `confirmed` (`var_id` INT(10))  BEGIN
   update users set status_reg=1, role=1,created_at=NOW() where id=var_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `confirmed_2` (`var_id` INT(10))  BEGIN
   update users set status_reg=1, role=2,created_at=NOW() where id=var_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editakun` (`var_nama` VARCHAR(255), `var_hp` VARCHAR(30), `var_alamat` VARCHAR(50), `var_email` VARCHAR(255), `var_id` INT(10))  BEGIN
 update users set name=var_nama, telepon=var_hp, alamat=var_alamat, updated_at=NOW(),email=var_email where id=var_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editfoto` (`var_foto` VARCHAR(40), `var_id` INT(10))  BEGIN
    update users set foto=var_foto, updated_at=NOW() where id=var_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (`var_id` INT(10))  BEGIN
update users set last_login=NOW(), status_login=1 where id=var_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `logout` (`var_id` INT(10))  BEGIN
update users set  status_login=0 where id=var_id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_admin` (`var_name` VARCHAR(255), `var_email` VARCHAR(255), `var_password` VARCHAR(60), `var_remember_token` VARCHAR(100), `var_id_pegawai` VARCHAR(30), `var_telepon` VARCHAR(30), `var_jk` VARCHAR(1), `var_foto` VARCHAR(40), `var_username` VARCHAR(20), `var_alamat` VARCHAR(50))  BEGIN
        insert into users (name,email,password,remember_token,created_at,updated_at,role,status_login,status_reg,last_login,id_pegawai,telepon,jenis_kelamin,foto, username,alamat)
          values(var_name,var_email,var_password,var_remember_token,NOW(),NULL,1,0,1,NULL,var_id_pegawai,var_telepon,var_jk,var_foto,var_username, var_alamat);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_native_user` (`var_name` VARCHAR(255), `var_email` VARCHAR(255), `var_password` VARCHAR(60), `var_remember_token` VARCHAR(100), `var_id_pegawai` VARCHAR(30), `var_telepon` VARCHAR(30), `var_jk` VARCHAR(1), `var_foto` VARCHAR(40), `var_username` VARCHAR(20), `var_alamat` VARCHAR(50))  BEGIN
        insert into users (name,email,password,remember_token,created_at,updated_at,role,status_login,status_reg,last_login,id_pegawai,telepon,jenis_kelamin,foto, username,alamat)
          values(var_name,var_email,var_password,var_remember_token,NOW(),NULL,2,0,0,NULL,var_id_pegawai,var_telepon,var_jk,var_foto,var_username, var_alamat);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sent_remember_token` (`var_token` VARCHAR(100), `var_email` VARCHAR(225))  BEGIN
        update users set remember_token=var_token,updated_at=NOW() where email=var_email;
    END$$

--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `cek_confirmed` (`var_id` INT(10)) RETURNS INT(11) BEGIN
    set @s=(select status_reg from users where id=var_id);
    if(@s=1) then
    return 1;
    else
    return 0;
    end if;
    END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `cek_username` (`username1` VARCHAR(20), `email1` VARCHAR(255)) RETURNS INT(11) BEGIN
    set @a= (select count(*) from users where username=username1);
    set @b= (select count(*) from users where email=email1);
    set @c = @a+@b;
    return @c;    
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `nama_area` varchar(30) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `foto` varchar(20) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `kode_area` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `area`
--

INSERT INTO `area` (`id_area`, `nama_area`, `alamat`, `telepon`, `foto`, `updated_at`, `created_at`, `kode_area`) VALUES
(1, 'Madiun Kota', 'M  Haryono', '0834920123', 'imgarea/68489.jpg', '2016-06-07 19:23:02', NULL, 'MDN'),
(3, 'Caruban', '', '', NULL, '2016-06-29 22:52:23', NULL, 'CRB'),
(5, 'Magetan', '', '', NULL, '2016-06-29 22:56:28', NULL, 'MGT'),
(6, 'Maospati', '', '', NULL, NULL, NULL, 'MPT'),
(7, 'Dolopo', '', '', NULL, NULL, NULL, 'DLP'),
(8, 'Ngawi', '', '', NULL, NULL, NULL, 'NGW'),
(9, 'Mantingan', '', '', NULL, NULL, NULL, 'MTG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(30) DEFAULT NULL,
  `merek` varchar(20) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `nomor_inventaris` varchar(30) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL,
  `fisik` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `fid_ruang` int(11) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `fid_area` int(11) DEFAULT NULL,
  `noperarea` int(11) DEFAULT NULL,
  `narea` varchar(20) DEFAULT NULL,
  `nruang` varchar(20) DEFAULT NULL,
  `fid_sub` int(11) DEFAULT NULL,
  `nama_sub` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `merek`, `tahun`, `nomor_inventaris`, `jumlah`, `satuan`, `fisik`, `keterangan`, `fid_ruang`, `gambar`, `updated_at`, `created_at`, `fid_area`, `noperarea`, `narea`, `nruang`, `fid_sub`, `nama_sub`) VALUES
(1, 'MEJA KERJA 1/2 BIRO U/PIMP', NULL, 2003, '001/MGR/DLP/03', 1, 'Buah', NULL, NULL, 51, NULL, NULL, NULL, 7, 1, NULL, NULL, -1, ''),
(2, 'CREDENSA PANJANG 3 PINTU', '-', 2003, '004/MGR/DLP/03', 1, 'Set', NULL, NULL, 51, NULL, NULL, NULL, 7, 4, NULL, NULL, -1, ''),
(3, 'KURSI KERJA P. LENGAN', 'TIGER', 2005, '126/MGR/DLP/05', 1, 'Buah', NULL, NULL, 51, NULL, NULL, NULL, 7, 126, NULL, NULL, -1, ''),
(4, 'KURSI KOMPUTER', 'TIGER', 2005, '127/MGR/DLP/05', 1, 'Buah', NULL, NULL, 51, NULL, NULL, NULL, 7, 127, NULL, NULL, -1, ''),
(5, 'KURSI KOMPUTER', 'TIGER', 2005, '128/MGR/DLP/05', 1, 'Buah', NULL, NULL, 51, NULL, NULL, NULL, 7, 128, NULL, NULL, -1, ''),
(6, 'ALMARI BESI', 'DATASCRIPT', 2003, '136/MGR/DLP/05', 1, 'Buah', NULL, NULL, 51, NULL, NULL, NULL, 7, 136, NULL, NULL, -1, ''),
(7, 'CAMERA DIGITAL', 'SONY', 2004, '138/MGR/DLP/05', 1, 'Buah', NULL, NULL, 51, NULL, NULL, NULL, 7, 138, NULL, NULL, -1, ''),
(8, 'KURSI SOFA', '-', 2003, '144/MGR/DLP/05', 1, 'Set', NULL, NULL, 51, NULL, NULL, NULL, 7, 144, NULL, NULL, -1, ''),
(9, 'PRINTER', 'EPSON', 2003, '145/MGR/DLP/05', 1, 'Buah', NULL, NULL, 51, NULL, NULL, NULL, 7, 145, NULL, NULL, -1, ''),
(10, 'MEJA KERJA 1 BIRO KAYU JATI', '-', 2003, '039/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 39, NULL, NULL, -1, ''),
(11, 'MEJA KERJA 1/2 BIRO ', 'LIGNA', 2003, '041/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 41, NULL, NULL, -1, ''),
(12, 'MEJA KERJA 1/2 BIRO ', 'LIGNA', 2003, '042/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 42, NULL, NULL, -1, ''),
(13, 'MEJA KERJA 1/2 BIRO ', 'LIGNA', 2003, '043/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 43, NULL, NULL, -1, ''),
(14, 'KARDEK BESI', 'TOP', 2003, '046/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 46, NULL, NULL, -1, ''),
(15, 'ALMARI BESI', 'ROYAL', 2003, '047/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 47, NULL, NULL, -1, ''),
(16, 'ALMARI BESI', 'ROYAL', 2003, '048/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 48, NULL, NULL, -1, ''),
(17, 'APAR POWDER 4,5 Kg', 'WORMALD', 2003, '049/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 49, NULL, NULL, -1, ''),
(18, 'MEJA 1 BIRO KAYU JATI', '-', 2003, '050/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 50, NULL, NULL, -1, ''),
(19, 'RAK BARANG / BESI', '-', 2003, '055/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 55, NULL, NULL, -1, ''),
(20, 'APAR BCF 2,7 Kg', 'GRAVINER', 2003, '060/UAD/DLP/03', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 60, NULL, NULL, -1, ''),
(21, 'VISUAL MAN - KINERJA', NULL, 2011, '166/UAD/DLP/11', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 166, NULL, NULL, -1, ''),
(22, 'VISUAL MAN- KOMITMEN', NULL, 2011, '167/UAD/DLP/11', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 167, NULL, NULL, -1, ''),
(23, 'VISUAL MAN- TMP', NULL, 2011, '168/UAD/DLP/11', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 168, NULL, NULL, -1, ''),
(24, 'VISUAL MAN - QUICK WINS', NULL, 2011, '169/UAD/DLP/11', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 169, NULL, NULL, -1, ''),
(25, 'VISUAL MAN - PAKTA INTEGRITAS', NULL, 2011, '170/UAD/DLP/11', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 170, NULL, NULL, -1, ''),
(26, 'KURSI RAPAT', NULL, 2013, '171/UAD/DLP/13', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 171, NULL, NULL, -1, ''),
(27, 'KURSI RAPAT', NULL, 2013, '172/UAD/DLP/13', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 172, NULL, NULL, -1, ''),
(28, 'KURSI RAPAT', NULL, 2013, '173/UAD/DLP/13', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 173, NULL, NULL, -1, ''),
(29, 'KURSI RAPAT', NULL, 2013, '174/UAD/DLP/13', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 174, NULL, NULL, -1, ''),
(30, 'MEJA OVAL ', NULL, 2013, '175/UAD/DLP/13', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 175, NULL, NULL, -1, ''),
(31, 'PRINTER EPSON', NULL, 2013, '176/UAD/DLP/13', 1, 'Buah', NULL, NULL, 29, NULL, NULL, NULL, 7, 176, NULL, NULL, -1, ''),
(32, 'MEJA KERJA 1 BIRO', 'MODULA', 2003, '078/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 78, NULL, NULL, -1, ''),
(33, 'MEJA KERJA 1/2 BIRO KAYU JATI', '-', 2003, '079/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 79, NULL, NULL, -1, ''),
(34, 'MEJA KERJA 1/2 BIRO *', 'LIGNA', 2003, '080/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 80, NULL, NULL, -1, ''),
(35, 'KURSI HADAP', '-', 2003, '081/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 81, NULL, NULL, -1, ''),
(36, 'KARDEK BESI', 'CELICA', 2003, '090/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 90, NULL, NULL, -1, ''),
(37, 'ALMARI KAYU JATI U/TANG ZEGE', '-', 2003, '092/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 92, NULL, NULL, -1, ''),
(38, 'PAPAN DATA', 'FORMIKA', 2003, '093/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 93, NULL, NULL, -1, ''),
(39, 'PAPAN DATA', 'FORMIKA', 2003, '094/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 94, NULL, NULL, -1, ''),
(40, 'MEJA KOMPUTER', 'ISEBEL', 2003, '095/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 95, NULL, NULL, -1, ''),
(41, 'MEJA KOMPUTER', 'ISEBEL', 2003, '096/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 96, NULL, NULL, -1, ''),
(42, 'TELEPON', 'TENS', 2003, '100/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 100, NULL, NULL, -1, ''),
(43, 'KURSI KOMPUTER', 'TIGER', 2005, '131/UDS/DLP/05', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 131, NULL, NULL, -1, ''),
(44, 'KURSI KOMPUTER', 'TIGER', 2005, '132/UDS/DLP/05', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 132, NULL, NULL, -1, ''),
(45, 'KURSI KOMPUTER', 'TIGER', 2005, '133/UDS/DLP/05', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 133, NULL, NULL, -1, ''),
(46, 'KOTAK P3K', '-', 2003, '153/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 153, NULL, NULL, -1, ''),
(47, 'APAR BCF 5 Kg', 'WORMALD', 2003, '108/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 108, NULL, NULL, -1, ''),
(48, 'AC PANASONIC', 'PANASONIC', 2013, '109/UDS/DLP/13', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 109, NULL, NULL, -1, ''),
(49, 'MEJA 1/2 BIRO', 'LIGNA', 2003, '062/UBM/DLP/03', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 62, NULL, NULL, -1, ''),
(50, 'MEJA 1/2 BIRO', 'LIGNA', 2003, '063/UBM/DLP/03', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 63, NULL, NULL, -1, ''),
(51, 'KURSI HADAP', '-', 2003, '064/UBM/DLP/03', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 64, NULL, NULL, -1, ''),
(52, 'KURSI KERJA PUTAR ', 'ANATOMIC', 2003, '065/UBM/DLP/03', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 65, NULL, NULL, -1, ''),
(53, 'ALMARI BESI', 'DATA SCRIP ', 2003, '071/UBM/DLP/03', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 71, NULL, NULL, -1, ''),
(54, 'MEJA KOMPUTER', 'ISEBEL', 2003, '073/UBM/DLP/03', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 73, NULL, NULL, -1, ''),
(55, 'MEJA SERVER', '-', 2004, '119/UBM/DLP/04', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 119, NULL, NULL, -1, ''),
(56, 'MEJA SERVER', '-', 2004, '120/UBM/DLP/04', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 120, NULL, NULL, -1, ''),
(57, 'RAK CD.', 'MANHATAN', 2004, '121/UBM/DLP/04', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 121, NULL, NULL, -1, ''),
(58, 'KURSI KOMPUTER ', 'TIGER', 2005, '134/UBM/DLP/05', 1, 'Buah', NULL, NULL, 32, NULL, NULL, NULL, 7, 134, NULL, NULL, -1, ''),
(59, 'MEJA KERJA 1/2 BIRO', 'MODULA', 2003, '005/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 5, NULL, NULL, -1, ''),
(60, 'MEJA KERJA 1/2 BIRO', 'LIGNA', 2003, '009/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 9, NULL, NULL, -1, ''),
(61, 'KURSI KERJA PUTAR T. LENGAN', '-', 2003, '016/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 16, NULL, NULL, -1, ''),
(62, 'KURSI KERJA PUTAR T. LENGAN', '-', 2003, '017/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 17, NULL, NULL, -1, ''),
(63, 'KARDEK BESI', 'CELICA', 2003, '025/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 25, NULL, NULL, -1, ''),
(64, 'KARDEK BESI', 'CELICA', 2003, '026/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 26, NULL, NULL, -1, ''),
(65, 'KURSI FIBER GLAS', '-', 2003, '028/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 28, NULL, NULL, -1, ''),
(66, 'KURSI FIBER GLAS', '-', 2003, '031/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 31, NULL, NULL, -1, ''),
(67, 'JAM DINDING', 'SEIKO', 2003, '032/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 32, NULL, NULL, -1, ''),
(68, 'MEJA KOMPUTER', 'ISEBEL', 2003, '033/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 33, NULL, NULL, -1, ''),
(69, 'MEJA KOMPUTER', 'ISEBEL', 2003, '034/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 34, NULL, NULL, -1, ''),
(70, 'APAR BCF 8 Kg', 'HARTINDO', 2003, '035/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 35, NULL, NULL, -1, ''),
(71, 'MESIN HITUNG CASIO DR-8420', 'CASIO', 2003, '038/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 38, NULL, NULL, -1, ''),
(72, 'KURSI KOMPUTER ', 'TIGER', 2005, '130/UPP/DLP/05', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 130, NULL, NULL, -1, ''),
(73, 'SKETSEL ALUMINIUM', '-', 2003, '135/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 135, NULL, NULL, -1, ''),
(74, 'KURSI PELANGGAN', 'TIGER', 2003, '141/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 141, NULL, NULL, -1, ''),
(75, 'KURSI PELANGGAN', 'TIGER', 2003, '142/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 142, NULL, NULL, -1, ''),
(76, 'KURSI PELANGGAN', 'TIGER', 2003, '143/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 143, NULL, NULL, -1, ''),
(77, 'KURSI STAINLES', 'FUTURA', 2003, '145/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 145, NULL, NULL, -1, ''),
(78, 'KURSI STAINLES', 'FUTURA', 2003, '146/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 146, NULL, NULL, -1, ''),
(79, 'KURSI STAINLES', 'FUTURA', 2003, '147/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 147, NULL, NULL, -1, ''),
(80, 'KURSI STAINLES', 'FUTURA', 2003, '148/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 148, NULL, NULL, -1, ''),
(81, 'KURSI STAINLES', 'FUTURA', 2003, '149/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 149, NULL, NULL, -1, ''),
(82, 'KURSI STAINLES', 'FUTURA', 2003, '150/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 150, NULL, NULL, -1, ''),
(83, 'KURSI STAINLES', 'FUTURA', 2003, '151/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 151, NULL, NULL, -1, ''),
(84, 'KOTAK P3K', '-', 2003, '152/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 152, NULL, NULL, -1, ''),
(85, 'MESIN HITUNG   ', 'CASIO', 2003, '154/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 154, NULL, NULL, -1, ''),
(86, 'PAPAN SINGLE LYNE', NULL, 2008, '155/UPP/DLP/08', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 155, NULL, NULL, -1, ''),
(87, 'LEMARI LIGNA', NULL, 2008, '156/UPP/DLP/08', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 156, NULL, NULL, -1, ''),
(88, 'KURSI STAINLES', 'FUTURA', 2003, '157/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 157, NULL, NULL, -1, ''),
(89, 'KURSI STAINLES', 'FUTURA', 2003, '158/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 158, NULL, NULL, -1, ''),
(90, 'KURSI STAINLES', 'FUTURA', 2003, '159/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 159, NULL, NULL, -1, ''),
(91, 'KURSI STAINLES', 'FUTURA', 2003, '160/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 160, NULL, NULL, -1, ''),
(92, 'KURSI STAINLES', 'FUTURA', 2003, '161/UPP/DLP/03', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 161, NULL, NULL, -1, ''),
(93, 'PAPAN DATA WCS', NULL, 2010, '162/UPP/DLP/10', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 162, NULL, NULL, -1, ''),
(94, 'RAK DIL', NULL, 2011, '163/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 163, NULL, NULL, -1, ''),
(95, 'KURSI STAINLES', 'FUTURA', 2011, '164/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 164, NULL, NULL, -1, ''),
(96, 'KURSI STAINLES', 'FUTURA', 2011, '165/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 165, NULL, NULL, -1, ''),
(97, 'MEJA KAYU JATI', NULL, 2011, '171/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 171, NULL, NULL, -1, ''),
(98, 'ETALASI ALUMUNIUM', NULL, 2012, '172/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 172, NULL, NULL, -1, ''),
(99, 'GENSET DISEL', NULL, 2012, '173/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 173, NULL, NULL, -1, ''),
(100, 'LAPTOP', 'BAYOND', 2012, '174/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 174, NULL, NULL, -1, ''),
(101, 'PRINTER', 'CANON', 2013, '175/UPP/DLP/12', 1, 'Buah', NULL, NULL, 31, NULL, NULL, NULL, 7, 175, NULL, NULL, -1, ''),
(102, 'MEJA KURSI SOFA', '-', 2003, '014/UDS/DLP/03', 1, 'Set', NULL, NULL, 30, NULL, NULL, NULL, 7, 14, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(103, 'MEJA TULIS 1/2 BIRO', 'MODULA', 2003, '101/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 101, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(104, 'MEJA TULIS 1/2 BIRO', 'LIGNA', 2003, '102/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 102, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(105, 'KURSI KERJA', 'LIGNA', 2003, '103/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 103, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(106, 'KURSI LIPAT', 'ELEPHANT', 2003, '104/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 104, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(107, 'ALMARI KAYU', '-', 2003, '106/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 106, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(108, 'PESAWAT TELEPON', 'INTI', 2003, '107/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 107, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(109, 'PAPAN SINGGLE DIAGRAM', '-', 2003, '109/UDS/DLP/03', 1, 'Set', NULL, NULL, 30, NULL, NULL, NULL, 7, 109, NULL, NULL, 8, 'KANTOR SUB PAGOTAN'),
(110, 'PAPAN PENGUMUMAN', '-', 2003, '110/UDS/DLP/03', 1, 'Buah', NULL, NULL, 30, NULL, NULL, NULL, 7, 110, NULL, NULL, 8, 'KANTOR SUB PAGOTAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang`
--

CREATE TABLE `ruang` (
  `id_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(30) DEFAULT NULL,
  `fid_area` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(20) DEFAULT NULL,
  `kode_ruang` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruang`
--

INSERT INTO `ruang` (`id_ruang`, `nama_ruang`, `fid_area`, `updated_at`, `created_at`, `foto`, `kode_ruang`) VALUES
(7, 'Manajer', 1, NULL, NULL, NULL, 'MGR'),
(9, 'Manajer', 3, NULL, NULL, NULL, 'MGR'),
(10, 'Manajer', 5, NULL, NULL, NULL, 'MGR'),
(11, 'ADM & KEU', 1, NULL, NULL, NULL, 'UAD'),
(12, 'ADM & KEU', 3, NULL, NULL, NULL, 'UAD'),
(13, 'ADM & KEU', 5, NULL, NULL, NULL, 'UAD'),
(15, 'Distribusi', 1, NULL, NULL, NULL, 'UDS'),
(16, 'PP', 1, NULL, NULL, NULL, 'UPP'),
(17, 'UBM', 1, NULL, NULL, NULL, 'UBM'),
(18, 'SAR', 1, NULL, NULL, NULL, 'SAR'),
(19, 'SEK', 1, NULL, NULL, NULL, 'SEK'),
(20, 'Distribusi', 5, NULL, NULL, NULL, 'UDS'),
(21, 'PP', 5, NULL, NULL, NULL, 'UPP'),
(22, 'UBM', 5, NULL, NULL, NULL, 'UBM'),
(23, 'Manajer', 6, NULL, NULL, NULL, 'MGR'),
(24, 'ADM & Keu', 6, NULL, NULL, NULL, 'UAD'),
(25, 'Distribusi', 6, NULL, NULL, NULL, 'UDS'),
(26, 'PP', 6, NULL, NULL, NULL, 'UPP'),
(27, 'UBM', 6, NULL, NULL, NULL, 'UBM'),
(29, 'ADM & KEU', 7, NULL, NULL, NULL, 'UAD'),
(30, 'Distribusi', 7, NULL, NULL, NULL, 'UDS'),
(31, 'PP', 7, NULL, NULL, NULL, 'UPP'),
(32, 'UBM', 7, NULL, NULL, NULL, 'UBM'),
(33, 'Distribusi', 3, NULL, NULL, NULL, 'UDS'),
(34, 'PP', 3, NULL, NULL, NULL, 'UPP'),
(35, 'UBM', 3, NULL, NULL, NULL, 'UBM'),
(37, 'ADM & KEU', 8, NULL, NULL, NULL, 'UAD'),
(38, 'Distribusi', 8, NULL, NULL, NULL, 'UDS'),
(39, 'PP', 8, NULL, NULL, NULL, 'UPP'),
(40, 'UBM', 8, NULL, NULL, NULL, 'UBM'),
(44, 'Manajer', 9, NULL, NULL, NULL, 'MGR'),
(45, 'ADM & KEU', 9, NULL, NULL, NULL, 'UAD'),
(46, 'Distribusi', 9, NULL, NULL, NULL, 'UDS'),
(47, 'PP', 9, NULL, NULL, NULL, 'UPP'),
(48, 'UBM', 9, NULL, NULL, NULL, 'UBM'),
(49, 'Manajer', 8, NULL, NULL, NULL, 'MGR'),
(51, 'Manajer', 7, NULL, NULL, NULL, 'MGR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sublokasi`
--

CREATE TABLE `sublokasi` (
  `id_sub` int(11) NOT NULL,
  `nama_sub` varchar(50) DEFAULT NULL,
  `fid_area` int(11) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sublokasi`
--

INSERT INTO `sublokasi` (`id_sub`, `nama_sub`, `fid_area`, `gambar`, `updated_at`, `created_at`) VALUES
(-1, '', NULL, NULL, NULL, NULL),
(1, 'KANTOR JAGA GEMARANG', 3, NULL, NULL, NULL),
(2, 'KANTOR SUB UNIT PLAOSAN', 5, NULL, NULL, NULL),
(3, 'MES SARANGAN', 5, NULL, NULL, NULL),
(4, 'KANTOR SUB UNIT SARANGAN', 5, NULL, NULL, NULL),
(5, 'KANTOR SUB UNIT GORANG GARENG', 5, NULL, NULL, NULL),
(8, 'KANTOR SUB PAGOTAN', 7, NULL, NULL, NULL),
(9, 'KANTOR SUB DUNGUS', 7, NULL, NULL, NULL),
(10, 'KANTOR JAGA JOGO ROGO', 8, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `role` int(11) DEFAULT NULL COMMENT '1 utk admin, 2 untuk native',
  `status_login` int(10) DEFAULT NULL COMMENT '0 jika belum , 1 jika login',
  `status_reg` int(10) DEFAULT NULL COMMENT '0 jika belum , 1 jika terdaftar',
  `last_login` timestamp NULL DEFAULT NULL COMMENT 'waktu terakhir login',
  `id_pegawai` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telepon` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Laki2 atau perempuan di if',
  `foto` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'path ke lokasi photo',
  `username` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alamat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `status_login`, `status_reg`, `last_login`, `id_pegawai`, `telepon`, `jenis_kelamin`, `foto`, `username`, `alamat`) VALUES
(1, 'iqbal rifqi', 'rifqimaula@gmail.com', '$2y$10$/R/RCpMQugbBVDOjH73xQOU5dtb4IzsMidSRbERHPbIpAjGvUScWm', 'X0QAceoEB8ZNxnusQ8wn600V07GsoOwnMJ4v0buFxlrlq0nApGckAz3lkxa2', '2016-06-09 05:42:28', '2018-03-26 01:55:24', 1, 1, 1, '2016-07-01 03:52:28', '1213', '9999', 'L', 'imguser/53287.png', 'iqbal', 'kkk'),
(3, 'rifqi maula', 'admin@admin.com', '$2y$10$O/wVxInDSOiomHmhTTnYPusAm0tSDBkp960d0DyIwFpFKy9Uegu/G', NULL, '2016-06-14 03:42:08', '2016-06-10 06:40:18', 2, 0, 1, NULL, '994', '000', 'P', 'imguser/48152.jpg', 'reza', NULL),
(4, 'ronaldo', 'dodo@gmail.com', '$2y$10$M7b5LNvtBk1wjZYIgdrw3.3Pls6rMA77eccZnUIichNRjNKh7TX8y', 'rfly7DxNWfUpWckl1TH0VA5McE6m5zXQh2OoQP661gzjrJQ0NYe9TS29KA3O', '2016-06-10 06:45:45', '2016-06-11 01:17:31', 2, 0, 1, NULL, '779', '997', 'L', 'imgbarang/83517.jpg', 'penaldo', 'wayut'),
(8, 'bana', 'abc@gmail.com', '$2y$10$B8V5t6w6uKFXb0YXVkM/9uJxnn7.6BCW5.4DLWh.wkNhaCxCmUoMa', 'saOy3s31uMO2ytNTlLeKlSnQRlr4eVJmzfHzwvGpUCg7wCpSAd5Yp6HAnjg8', '2016-06-14 16:16:07', '2016-06-23 19:50:26', 1, 0, 1, '2016-06-24 02:49:10', '34342341', '0843413123', 'L', 'imguser/78285.png', 'bana', 'Jln Thamrin'),
(9, 'Yarmolenko', 'goalindonesiaaja@gmail.com', '$2y$10$0sKiIYU7zt6vUnfUnQDzHuRBmAYmDTqs5qAoukPH.fUgtjpv0lGV.', NULL, '2016-06-22 03:56:07', '2016-06-22 03:56:07', 1, 1, 1, '2016-06-22 03:57:03', '433', '03514444444', 'L', '', 'Ukraina', 'Ukraina'),
(10, 'admin', 'admin@gmail.com', '$2y$10$4dAinxTHaXS4ZUa6eRmYBu3QCggm0fXvRdtutRQKnm.Vldim3tPci', '0TIOumnDR2ceq9qaiezHSQaZyOlr1rGIp4kt779qjpLpnyrfVuukZKqoWzc9', '2016-06-24 02:50:01', '2016-06-30 20:20:30', 1, 1, 1, '2016-07-01 03:55:49', '123456', '09876543', 'L', '', 'admin', 'Jln. PLN'),
(11, 'andik', 'andiknur@pln.co.id', '$2y$10$S/CMEJ9yCyySJSNPNHnRJOgzXmZNfA0xVN.YtmDK5jzgcMG/yf7qS', 'rmxfpj2Wz7LaZ7Md0AJ9K1cUsevGemc8y2L7qzv1HomOd5924gLyE7qOr0aw', '2016-06-24 03:03:26', '2016-06-29 06:56:13', 1, 1, 1, '2016-07-01 02:21:04', '3333333333', '081335673450', 'L', 'imguser/40589.jpg', 'andik', 'Magetan'),
(12, 'hasan', 'hasan.wahyudi@pln.co.id', '$2y$10$5tH8MZ5bT8/X7aYm34YrvuqNblkpvHnQP1voZFTYw6GLfmVX34dVO', '$2y$10$u59xZe2qExXs2mxAqTLskOArDT1u2NOGCK8.7yPAg22SLkU.hF7HG', '2016-06-29 06:12:12', '2016-06-29 06:18:45', 1, 1, 1, '2016-06-29 06:41:26', '002', '081', 'L', '', 'jenggot', 'dagangan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `FK_barang` (`fid_area`),
  ADD KEY `FK_barang_ruang` (`fid_ruang`),
  ADD KEY `FK_barang_sub` (`fid_sub`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indeks untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD PRIMARY KEY (`id_ruang`),
  ADD KEY `fid_area` (`fid_area`);

--
-- Indeks untuk tabel `sublokasi`
--
ALTER TABLE `sublokasi`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `FK_sublokasi` (`fid_area`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT untuk tabel `ruang`
--
ALTER TABLE `ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `sublokasi`
--
ALTER TABLE `sublokasi`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_barang` FOREIGN KEY (`fid_area`) REFERENCES `area` (`id_area`),
  ADD CONSTRAINT `FK_barang_ruang` FOREIGN KEY (`fid_ruang`) REFERENCES `ruang` (`id_ruang`),
  ADD CONSTRAINT `FK_barang_sub` FOREIGN KEY (`fid_sub`) REFERENCES `sublokasi` (`id_sub`);

--
-- Ketidakleluasaan untuk tabel `ruang`
--
ALTER TABLE `ruang`
  ADD CONSTRAINT `fid_area` FOREIGN KEY (`fid_area`) REFERENCES `area` (`id_area`);

--
-- Ketidakleluasaan untuk tabel `sublokasi`
--
ALTER TABLE `sublokasi`
  ADD CONSTRAINT `FK_sublokasi` FOREIGN KEY (`fid_area`) REFERENCES `area` (`id_area`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
