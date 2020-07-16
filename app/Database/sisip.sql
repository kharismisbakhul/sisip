-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 10:06 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisip`
--

-- --------------------------------------------------------

--
-- Table structure for table `batas_penanggalan`
--

CREATE TABLE `batas_penanggalan` (
  `id_batas_penanggalan` int(11) NOT NULL,
  `jumlah_tanggal` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL,
  `nama_bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id_bulan`, `nama_bulan`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'November'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `direktur`
--

CREATE TABLE `direktur` (
  `id_direktur` int(11) NOT NULL,
  `nama_direktur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `direktur`
--

INSERT INTO `direktur` (`id_direktur`, `nama_direktur`) VALUES
(1, 'Guest House');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `no_induk` varchar(30) NOT NULL,
  `kategori_feedback` int(11) NOT NULL,
  `file_pendukung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `feedback`, `tanggal`, `waktu`, `no_induk`, `kategori_feedback`, `file_pendukung`) VALUES
(5, 'AAA', '2020-07-16', '08:00:00', '700', 3, ''),
(6, 'AAAA', '2020-07-01', '11:00:00', '700', 4, '395871.jpg'),
(7, 'AVCC', '2020-07-16', '18:00:00', '700', 4, 'Abstrak Jurnal - Misbakhul Kharis 165150201111021.pdf'),
(8, 'Saran 1', '2020-07-14', '10:00:00', '700', 4, '23_Kartu_Peserta_Seminar_Hasil.pdf'),
(9, 'Feedback Baru dong', '2020-07-15', '08:00:00', '700', 1, '21.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `general_manager`
--

CREATE TABLE `general_manager` (
  `id_general_manager` int(11) NOT NULL,
  `nama_general_manager` varchar(50) NOT NULL,
  `id_direktur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_manager`
--

INSERT INTO `general_manager` (`id_general_manager`, `nama_general_manager`, `id_direktur`) VALUES
(1, 'Guest House', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
(1, 'Senin'),
(2, 'Selasa'),
(3, 'Rabu'),
(4, 'Kamis'),
(5, 'Jumat'),
(6, 'Sabtu'),
(7, 'Minggu');

-- --------------------------------------------------------

--
-- Table structure for table `indeks_kepuasan`
--

CREATE TABLE `indeks_kepuasan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indeks_kepuasan`
--

INSERT INTO `indeks_kepuasan` (`id`, `tanggal`, `status`) VALUES
(2, '2020-07-11', 0),
(4, '2020-07-06', 0),
(11, '2020-07-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `indeks_nilai`
--

CREATE TABLE `indeks_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `no_induk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indeks_nilai`
--

INSERT INTO `indeks_nilai` (`id_nilai`, `id_pertanyaan`, `nilai`, `no_induk`) VALUES
(9, 12, 3, '700'),
(10, 13, 3, '700'),
(11, 14, 3, '700');

-- --------------------------------------------------------

--
-- Table structure for table `indeks_pertanyaan`
--

CREATE TABLE `indeks_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `id_indeks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `indeks_pertanyaan`
--

INSERT INTO `indeks_pertanyaan` (`id_pertanyaan`, `pertanyaan`, `id_indeks`) VALUES
(7, 'Test ', 2),
(8, 'contoh soal 2 ?', 2),
(9, 'contoh soal 3 ?', 2),
(12, 'Pertanyaan 1', 11),
(13, 'Pertanyaan 2', 11),
(14, 'Pertanyaan 3', 11);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `kode_jabatan` int(11) NOT NULL,
  `detail_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `kode_jabatan`, `detail_jabatan`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 3),
(8, 7, 1),
(9, 7, 2),
(10, 7, 4),
(11, 7, 5),
(12, 7, 6),
(13, 7, 7),
(14, 7, 8),
(15, 7, 9),
(16, 7, 10),
(17, 7, 11),
(18, 7, 12),
(19, 7, 13),
(20, 7, 14),
(21, 7, 15);

-- --------------------------------------------------------

--
-- Table structure for table `jam_kerja`
--

CREATE TABLE `jam_kerja` (
  `id_jam_kerja` int(11) NOT NULL,
  `jam_kerja_masuk` time NOT NULL,
  `jam_kerja_keluar` time NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `status_aktif` int(1) NOT NULL,
  `status_jam_kerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jam_kerja`
--

INSERT INTO `jam_kerja` (`id_jam_kerja`, `jam_kerja_masuk`, `jam_kerja_keluar`, `id_jabatan`, `status_aktif`, `status_jam_kerja`) VALUES
(1, '08:00:00', '15:00:00', 7, 1, 0),
(2, '08:00:00', '15:00:00', 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_feedback`
--

CREATE TABLE `kategori_feedback` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_feedback`
--

INSERT INTO `kategori_feedback` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Saran'),
(2, 'Masukan'),
(3, 'Gagasan'),
(4, 'Inovasi');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_menu`
--

CREATE TABLE `kategori_menu` (
  `id_kategori_menu` int(11) NOT NULL,
  `nama_kategori_menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_menu`
--

INSERT INTO `kategori_menu` (`id_kategori_menu`, `nama_kategori_menu`) VALUES
(1, 'Home'),
(2, 'Layanan'),
(3, 'Laporan');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id_manager` int(11) NOT NULL,
  `nama_manager` varchar(50) NOT NULL,
  `id_gm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id_manager`, `nama_manager`, `id_gm`) VALUES
(1, 'Keuangan dan Kepegawaian', 1),
(2, 'Administrasi, Marketing dan Umum', 1),
(3, 'Restoran dan Masakan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status_user` int(11) NOT NULL,
  `id_kategori_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `link`, `icon`, `status_user`, `id_kategori_menu`) VALUES
(1, 'Dashboard', '/staff', 'icon-Car-Wheel', 7, 1),
(2, 'Profil', '/staff/profil', 'icon-User', 7, 1),
(3, 'Presensi', '/staff/presensi', 'icon-Bookmark', 7, 2),
(4, 'Logbook', '/staff/logbook', 'icon-Book', 7, 2),
(5, 'Capaian Kerja', '/staff/capaianKerja', 'icon-Starfish', 7, 2),
(6, 'Saran', '/staff/saran', 'icon-Mail-Send', 7, 2),
(7, 'Klarifikasi', '/staff/klarifikasi', 'icon-Settings-Window', 7, 2),
(11, 'Dashboard', '/supervisor', 'icon-Car-Wheel', 6, 1),
(12, 'Profil', '/supervisor/profil', 'icon-User', 6, 1),
(13, 'Presensi', '/supervisor/presensi', 'icon-Bookmark', 6, 2),
(14, 'Logbook', '/supervisor/logbook', 'icon-Book', 6, 2),
(15, 'Capaian Kerja', '/supervisor/capaianKerja', 'icon-Starfish', 6, 2),
(16, 'Saran', '/supervisor/saran', 'icon-Mail-Send', 6, 2),
(17, 'Klarifikasi', '/supervisor/klarifikasi', 'icon-Settings-Window', 6, 2),
(21, 'Indeks Kepuasan', '/staff/indeksKepuasan', 'icon-Pie-Chart2', 7, 3),
(22, 'Kinerja', '/staff/laporanKinerja', 'icon-Bar-Chart2', 7, 3),
(23, 'Evaluasi', '/staff/LaporanEvaluasi', 'icon-Bar-Chart5', 7, 3),
(24, 'Keaktifan', '/staff/laporanKeaktifan', 'icon-Line-Chart3', 7, 3),
(26, 'Validasi', '/supervisor/validasi', 'icon-Check-2', 6, 2),
(27, 'Kinerja', '/supervisor/laporanKinerja', 'icon-Bar-Chart2', 6, 3),
(28, 'Evaluasi', '/supervisor/LaporanEvaluasi', 'icon-Bar-Chart5', 6, 3),
(29, 'Keaktifan', '/supervisor/laporanKeaktifan', 'icon-Line-Chart3', 6, 3),
(30, 'Indeks Kepuasan', '/supervisor/indeksKepuasan', 'icon-Pie-Chart2', 6, 3),
(31, 'Dashboard', '/admin', 'icon-Car-Wheel', 1, 1),
(32, 'Profil', '/admin/profil', 'icon-User', 1, 1),
(33, 'Management Users', '/admin/managementUsers', 'icon-People-onCloud', 1, 2),
(34, 'Daftar Saran', '/admin/daftarSaran', 'icon-Mail-Send', 1, 2),
(35, 'Indeks Kepuasan Pegawai', '/admin/indeksKepuasan', 'icon-Pie-Chart2', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penanggalan`
--

CREATE TABLE `penanggalan` (
  `id_penanggalan` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `hari` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `pengumuman` varchar(255) NOT NULL,
  `tanggal_pengumuman` date NOT NULL,
  `waktu_pengumuman` time NOT NULL,
  `publisher` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `pengumuman`, `tanggal_pengumuman`, `waktu_pengumuman`, `publisher`) VALUES
(1, 'Masuk New Normal dimulai Minggu Depan', '2020-06-16', '07:00:00', '100');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_kinerja`
--

CREATE TABLE `penilaian_kinerja` (
  `id_penilaian_kinerja` int(11) NOT NULL,
  `nilai_kriteria_1` int(11) NOT NULL,
  `nilai_kriteria_2` int(11) NOT NULL,
  `id_riwayat_jabatan` int(11) NOT NULL,
  `waktu_penilaian` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `perizinan`
--

CREATE TABLE `perizinan` (
  `id_perizinan` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `alasan` varchar(500) NOT NULL,
  `bukti` varchar(500) NOT NULL,
  `kategori_izin` int(1) NOT NULL,
  `no_induk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perizinan`
--

INSERT INTO `perizinan` (`id_perizinan`, `tanggal_mulai`, `tanggal_selesai`, `alasan`, `bukti`, `kategori_izin`, `no_induk`) VALUES
(2, '2020-07-10', '2020-07-14', 'ADDD', '', 1, '700'),
(3, '2020-07-16', '2020-07-17', 'Cuti ya', '21.jpg', 0, '700');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `tanggal` date NOT NULL,
  `user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `pesan`, `waktu`, `tanggal`, `user`) VALUES
(6, 'Hai Gaes', '02:54:51', '2020-07-09', '100'),
(7, 'Saya Supervisor', '02:55:28', '2020-07-09', '600'),
(8, 'Aku Januar', '02:56:14', '2020-07-09', '700'),
(9, 'Wahahaha', '10:10:06', '2020-07-16', '700');

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `waktu_presensi_masuk` time NOT NULL,
  `waktu_presensi_keluar` time DEFAULT NULL,
  `status_presensi` int(1) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `lokasi_keluar` varchar(255) DEFAULT NULL,
  `status_tempat_kerja` int(1) NOT NULL,
  `id_riwayat_jabatan` int(11) NOT NULL,
  `tanggal_presensi` date NOT NULL,
  `isi_logbook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `waktu_presensi_masuk`, `waktu_presensi_keluar`, `status_presensi`, `lokasi`, `lokasi_keluar`, `status_tempat_kerja`, `id_riwayat_jabatan`, `tanggal_presensi`, `isi_logbook`) VALUES
(1, '07:00:00', '16:00:00', 0, 'Jl. Bunga No. 21', NULL, 1, 2, '2020-06-29', 0),
(5, '07:20:22', '07:41:55', 0, 'Jl. Bunga No. 22', NULL, 1, 1, '2020-06-28', 0),
(6, '07:54:08', '07:54:17', 0, 'Jl. Kucing No. 21', NULL, 1, 1, '2020-07-06', 0),
(7, '08:09:57', '08:10:04', 0, 'Perumahan Griya', NULL, 3, 1, '2020-07-07', 0),
(9, '10:15:21', '11:43:00', 0, 'Jl. Koala No. 33', NULL, 1, 1, '2020-07-08', 0),
(10, '01:53:11', '01:56:33', 0, 'Jl. Veteran No. 21', NULL, 2, 1, '2020-07-09', 0),
(12, '09:43:48', '09:46:50', 0, 'Jalan Sultan Agung, RW 10, Pasar Manggis, Setiabudi, South Jakarta, Jakarta Special Capital Region, 12850, Indonesia', 'Malang, East Java, 65113, Indonesia', 2, 1, '2020-07-16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rancangan_tugas`
--

CREATE TABLE `rancangan_tugas` (
  `id_rancangan_tugas` int(11) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `nama_tugas` varchar(255) DEFAULT NULL,
  `periode` int(1) DEFAULT NULL,
  `jumlah_total_tugas` int(11) DEFAULT NULL,
  `nomor_pekerjaan` int(11) DEFAULT NULL,
  `status_tugas` int(11) DEFAULT NULL,
  `kode_tugas` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rancangan_tugas`
--

INSERT INTO `rancangan_tugas` (`id_rancangan_tugas`, `id_jabatan`, `nama_tugas`, `periode`, `jumlah_total_tugas`, `nomor_pekerjaan`, `status_tugas`, `kode_tugas`) VALUES
(0, NULL, NULL, NULL, 0, NULL, NULL, ''),
(1, 7, 'Membantu membuat laporan harian bendahara seperti buku kas, setoran ke bank dan lain lain', 1, 10, 1, 1, 's512dd'),
(2, 7, 'Menyiapkan kelengkapan permintaan uang persediaan', 1, 20, 2, 1, 'we23rr'),
(3, 6, 'Monitoring', 1, 20, 12, 1, 'afdr11');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_jabatan`
--

CREATE TABLE `riwayat_jabatan` (
  `id_riwayat_jabatan` int(11) NOT NULL,
  `no_induk` varchar(30) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `status_aktif` int(1) NOT NULL,
  `periode_mulai_jabatan` date NOT NULL,
  `periode_akhir_jabatan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `riwayat_jabatan`
--

INSERT INTO `riwayat_jabatan` (`id_riwayat_jabatan`, `no_induk`, `id_jabatan`, `status_aktif`, `periode_mulai_jabatan`, `periode_akhir_jabatan`) VALUES
(1, '700', 7, 1, '2020-06-01', NULL),
(2, '600', 6, 1, '2020-06-01', NULL),
(4, '701', 7, 1, '2020-06-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_supervisor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `nama`, `id_supervisor`) VALUES
(1, 'Sekertaris dan Marketing', 1),
(2, 'Keuangan (Bendahara)', 1),
(3, 'Keuangan (Pengadaan)', 1),
(4, 'Keuangan (A&R)', 1),
(5, 'Kepegawaian', 2),
(6, 'Kebersihan Kamar (Room Boy)', 3),
(7, 'Kebersihan Area', 3),
(8, 'Resepsionis', 4),
(9, 'Teknisi', 4),
(10, 'Umum', 4),
(11, 'Sopir', 5),
(12, 'Kasir', 5),
(13, 'Pramusaji', 6),
(14, 'Juru Masak', 6),
(15, 'Kebersihan Dapur', 6);

-- --------------------------------------------------------

--
-- Table structure for table `status_user`
--

CREATE TABLE `status_user` (
  `id_status_user` int(11) NOT NULL,
  `nama_status_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status_user`
--

INSERT INTO `status_user` (`id_status_user`, `nama_status_user`) VALUES
(1, 'Admin'),
(2, 'Operator'),
(3, 'Direktur'),
(4, 'General Manager'),
(5, 'Manager'),
(6, 'Supervisor'),
(7, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE `supervisor` (
  `id_supervisor` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id_supervisor`, `nama`, `id_manager`) VALUES
(1, 'Keuangan', 1),
(2, 'Kepegawaian', 1),
(3, 'Kamar, Kebersihan dan Pertamanan', 2),
(4, 'Resepsionis, Teknisi dan Umum', 2),
(5, 'Restoran', 3),
(6, 'Masakan', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `id_tugas` int(11) NOT NULL,
  `id_riwayat_jabatan` int(11) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `tanggal_tugas` date NOT NULL,
  `periode` int(1) NOT NULL,
  `jumlah_tugas` int(11) NOT NULL,
  `nomor_pekerjaan` int(11) NOT NULL,
  `status_tugas` int(1) NOT NULL,
  `id_rancangan_tugas` int(11) NOT NULL,
  `kode_tugas` varchar(6) DEFAULT NULL,
  `catatan` varchar(500) DEFAULT NULL,
  `bukti` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `id_riwayat_jabatan`, `nama_tugas`, `tanggal_tugas`, `periode`, `jumlah_tugas`, `nomor_pekerjaan`, `status_tugas`, `id_rancangan_tugas`, `kode_tugas`, `catatan`, `bukti`) VALUES
(2, 1, 'Membantu membuat laporan harian bendahara seperti buku kas, setoran ke bank dan lain lain', '2020-07-07', 1, 1, 1, 1, 1, 's512dd', '', NULL),
(3, 1, 'Menyiapkan kelengkapan permintaan uang persediaan', '2020-07-07', 1, 3, 2, 1, 2, 'we23rr', '', NULL),
(4, 1, 'Siram Bunga', '2020-07-07', 1, 2, 0, 1, 0, 'ww2211', '', NULL),
(6, 1, 'Membantu membuat laporan harian bendahara seperti buku kas, setoran ke bank dan lain lain', '2020-07-08', 1, 1, 1, 2, 1, 's512dd', 'Harus Revisi', NULL),
(7, 1, 'Ganti Baju', '2020-07-07', 1, 1, 0, 1, 0, '33wwee', '', NULL),
(8, 1, 'Cuci Cuci', '2020-07-08', 1, 1, 0, 4, 0, 'rewq11', 'Saya sudah melakukan ini loh mas', 'ERD.png'),
(10, 1, 'Menyiapkan kelengkapan permintaan uang persediaan', '2020-07-08', 1, 4, 2, 1, 2, 'we23rr', NULL, NULL),
(12, 1, 'Bersih Bersih', '2020-07-09', 1, 2, 0, 1, 0, 'bds455', NULL, NULL),
(13, 1, 'Menyiapkan kelengkapan permintaan uang persediaan', '2020-07-09', 1, 4, 2, 4, 2, 'we23rr', 'Saya melakukan ini', 'Abstrak Jurnal - Misbakhul Kharis 165150201111021.pdf'),
(31, 1, 'Menyiapkan kelengkapan permintaan uang persediaan', '2020-07-16', 1, 6, 2, 3, 2, 'we23rr', NULL, NULL),
(32, 1, 'Membantu membuat laporan harian bendahara seperti buku kas, setoran ke bank dan lain lain', '2020-07-16', 1, 5, 1, 3, 1, 's512dd', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no_induk` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tahun_masuk` year(4) DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `isPenilaian` int(1) DEFAULT NULL,
  `isPresensi` int(1) DEFAULT NULL,
  `id_status_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no_induk`, `password`, `nama`, `no_telepon`, `alamat`, `email`, `tahun_masuk`, `foto_profil`, `isPenilaian`, `isPresensi`, `id_status_user`) VALUES
('100', '123', 'Admin', NULL, NULL, NULL, NULL, 'assets/images/users/Kharis.jpg', NULL, NULL, 1),
('200', '123', 'Operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
('300', '123', 'Donny Alair', '086666666', 'Jl. Kembang No. 44', 'donny@gmail.com', 2013, NULL, 0, 0, 3),
('400', '123', 'Rita Wahyuningsih, S.S', '085555555555', 'Jl. Bunga Bunga No. 22', 'ritawahyu@gmail.com', 2013, NULL, 0, 0, 4),
('500', '123', 'Adika Setia Hadi', '0899999999', 'Jl. Kucing No. 22', 'adika@gmail.com', 2014, NULL, 0, 0, 5),
('600', '123', 'Cuikitalia, SE', '081111111', 'Jl. Mawar No. 33', 'cuikitalia@gmail.com', 2014, 'assets/images/users/kharis_ub.png', 0, 0, 6),
('700', '321', 'Juniar Sofyan Syah', '082222222233', 'Jl. Melati No. 333', 'juniarS@gmail.com', 2013, 'assets/images/users/Kharis.jpg', 0, 0, 7),
('701', '321', 'Joni AB', '082222222233', 'Jl. Melati No. 333', 'juniarS@gmail.com', 2013, 'assets/images/users/Kharis.jpg', 0, 0, 7);

-- --------------------------------------------------------

--
-- Table structure for table `validasi`
--

CREATE TABLE `validasi` (
  `id_validasi` int(11) NOT NULL,
  `id_tugas` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `catatan` varchar(255) NOT NULL,
  `status_validasi` int(1) NOT NULL,
  `validator` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batas_penanggalan`
--
ALTER TABLE `batas_penanggalan`
  ADD PRIMARY KEY (`id_batas_penanggalan`),
  ADD KEY `bulan` (`bulan`);

--
-- Indexes for table `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indexes for table `direktur`
--
ALTER TABLE `direktur`
  ADD PRIMARY KEY (`id_direktur`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `kategori_feedback` (`kategori_feedback`);

--
-- Indexes for table `general_manager`
--
ALTER TABLE `general_manager`
  ADD PRIMARY KEY (`id_general_manager`),
  ADD KEY `id_direktur` (`id_direktur`);

--
-- Indexes for table `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indexes for table `indeks_kepuasan`
--
ALTER TABLE `indeks_kepuasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `indeks_nilai`
--
ALTER TABLE `indeks_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `no_induk` (`no_induk`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `indeks_pertanyaan`
--
ALTER TABLE `indeks_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_indeks` (`id_indeks`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `kode_jabatan` (`kode_jabatan`);

--
-- Indexes for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD PRIMARY KEY (`id_jam_kerja`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `kategori_feedback`
--
ALTER TABLE `kategori_feedback`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  ADD PRIMARY KEY (`id_kategori_menu`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_manager`),
  ADD KEY `id_gm` (`id_gm`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `status_user` (`status_user`),
  ADD KEY `id_kategori_menu` (`id_kategori_menu`);

--
-- Indexes for table `penanggalan`
--
ALTER TABLE `penanggalan`
  ADD PRIMARY KEY (`id_penanggalan`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `hari` (`hari`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `publisher` (`publisher`);

--
-- Indexes for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD PRIMARY KEY (`id_penilaian_kinerja`),
  ADD KEY `id_riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Indexes for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD PRIMARY KEY (`id_perizinan`),
  ADD KEY `no_induk` (`no_induk`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Indexes for table `rancangan_tugas`
--
ALTER TABLE `rancangan_tugas`
  ADD PRIMARY KEY (`id_rancangan_tugas`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD PRIMARY KEY (`id_riwayat_jabatan`),
  ADD KEY `no_induk` (`no_induk`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `id_supervisor` (`id_supervisor`);

--
-- Indexes for table `status_user`
--
ALTER TABLE `status_user`
  ADD PRIMARY KEY (`id_status_user`);

--
-- Indexes for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id_supervisor`),
  ADD KEY `id_manager` (`id_manager`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_rancangan_tugas` (`id_rancangan_tugas`),
  ADD KEY `id_riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_induk`),
  ADD KEY `id_status_user` (`id_status_user`);

--
-- Indexes for table `validasi`
--
ALTER TABLE `validasi`
  ADD PRIMARY KEY (`id_validasi`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `validator` (`validator`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batas_penanggalan`
--
ALTER TABLE `batas_penanggalan`
  MODIFY `id_batas_penanggalan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `direktur`
--
ALTER TABLE `direktur`
  MODIFY `id_direktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `general_manager`
--
ALTER TABLE `general_manager`
  MODIFY `id_general_manager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `indeks_kepuasan`
--
ALTER TABLE `indeks_kepuasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `indeks_nilai`
--
ALTER TABLE `indeks_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `indeks_pertanyaan`
--
ALTER TABLE `indeks_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id_jam_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_feedback`
--
ALTER TABLE `kategori_feedback`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id_kategori_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id_manager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `penanggalan`
--
ALTER TABLE `penanggalan`
  MODIFY `id_penanggalan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  MODIFY `id_penilaian_kinerja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `perizinan`
--
ALTER TABLE `perizinan`
  MODIFY `id_perizinan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rancangan_tugas`
--
ALTER TABLE `rancangan_tugas`
  MODIFY `id_rancangan_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  MODIFY `id_riwayat_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `status_user`
--
ALTER TABLE `status_user`
  MODIFY `id_status_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id_supervisor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `validasi`
--
ALTER TABLE `validasi`
  MODIFY `id_validasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batas_penanggalan`
--
ALTER TABLE `batas_penanggalan`
  ADD CONSTRAINT `batas_penanggalan_ibfk_1` FOREIGN KEY (`bulan`) REFERENCES `bulan` (`id_bulan`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`kategori_feedback`) REFERENCES `kategori_feedback` (`id_kategori`);

--
-- Constraints for table `general_manager`
--
ALTER TABLE `general_manager`
  ADD CONSTRAINT `general_manager_ibfk_1` FOREIGN KEY (`id_direktur`) REFERENCES `direktur` (`id_direktur`);

--
-- Constraints for table `indeks_nilai`
--
ALTER TABLE `indeks_nilai`
  ADD CONSTRAINT `indeks_nilai_ibfk_1` FOREIGN KEY (`no_induk`) REFERENCES `user` (`no_induk`),
  ADD CONSTRAINT `indeks_nilai_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `indeks_pertanyaan` (`id_pertanyaan`);

--
-- Constraints for table `indeks_pertanyaan`
--
ALTER TABLE `indeks_pertanyaan`
  ADD CONSTRAINT `indeks_pertanyaan_ibfk_1` FOREIGN KEY (`id_indeks`) REFERENCES `indeks_kepuasan` (`id`);

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `status_user` (`id_status_user`);

--
-- Constraints for table `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD CONSTRAINT `jam_kerja_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`id_gm`) REFERENCES `general_manager` (`id_general_manager`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`status_user`) REFERENCES `status_user` (`id_status_user`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`id_kategori_menu`) REFERENCES `kategori_menu` (`id_kategori_menu`);

--
-- Constraints for table `penanggalan`
--
ALTER TABLE `penanggalan`
  ADD CONSTRAINT `penanggalan_ibfk_1` FOREIGN KEY (`bulan`) REFERENCES `bulan` (`id_bulan`),
  ADD CONSTRAINT `penanggalan_ibfk_2` FOREIGN KEY (`hari`) REFERENCES `hari` (`id_hari`);

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`publisher`) REFERENCES `user` (`no_induk`);

--
-- Constraints for table `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD CONSTRAINT `penilaian_kinerja_ibfk_1` FOREIGN KEY (`id_riwayat_jabatan`) REFERENCES `riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Constraints for table `perizinan`
--
ALTER TABLE `perizinan`
  ADD CONSTRAINT `perizinan_ibfk_1` FOREIGN KEY (`no_induk`) REFERENCES `user` (`no_induk`);

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`no_induk`);

--
-- Constraints for table `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`id_riwayat_jabatan`) REFERENCES `riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Constraints for table `rancangan_tugas`
--
ALTER TABLE `rancangan_tugas`
  ADD CONSTRAINT `rancangan_tugas_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD CONSTRAINT `riwayat_jabatan_ibfk_1` FOREIGN KEY (`no_induk`) REFERENCES `user` (`no_induk`),
  ADD CONSTRAINT `riwayat_jabatan_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_supervisor`) REFERENCES `supervisor` (`id_supervisor`);

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`id_manager`) REFERENCES `manager` (`id_manager`);

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_rancangan_tugas`) REFERENCES `rancangan_tugas` (`id_rancangan_tugas`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`id_riwayat_jabatan`) REFERENCES `riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_status_user`) REFERENCES `status_user` (`id_status_user`);

--
-- Constraints for table `validasi`
--
ALTER TABLE `validasi`
  ADD CONSTRAINT `validasi_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`),
  ADD CONSTRAINT `validasi_ibfk_2` FOREIGN KEY (`validator`) REFERENCES `user` (`no_induk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
