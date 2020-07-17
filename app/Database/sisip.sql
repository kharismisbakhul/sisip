-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jul 2020 pada 20.00
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `batas_penanggalan`
--

CREATE TABLE `batas_penanggalan` (
  `id_batas_penanggalan` int(11) NOT NULL,
  `jumlah_tanggal` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bulan`
--

CREATE TABLE `bulan` (
  `id_bulan` int(11) NOT NULL,
  `nama_bulan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `bulan`
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
-- Struktur dari tabel `direktur`
--

CREATE TABLE `direktur` (
  `id_direktur` int(11) NOT NULL,
  `nama_direktur` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `direktur`
--

INSERT INTO `direktur` (`id_direktur`, `nama_direktur`) VALUES
(1, 'Guest House');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `no_induk` varchar(30) NOT NULL,
  `kategori_feedback` int(11) NOT NULL,
  `file_pendukung` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `feedback`, `no_induk`, `kategori_feedback`, `file_pendukung`) VALUES
(1, '0', '700', 1, ''),
(2, '0', '700', 3, ''),
(3, 'Haga', '700', 2, ''),
(4, 'test', '700', 1, ''),
(5, 'cek', '700', 1, ''),
(9, 'asdasd', '700', 2, '/assets/filependukung/O.png'),
(10, 'cekee', '700', 1, ''),
(11, 'asdasddsa', '700', 1, ''),
(12, 'dda', '700', 3, '/assets/filependukung/oleh.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `general_manager`
--

CREATE TABLE `general_manager` (
  `id_general_manager` int(11) NOT NULL,
  `nama_general_manager` varchar(50) NOT NULL,
  `id_direktur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `general_manager`
--

INSERT INTO `general_manager` (`id_general_manager`, `nama_general_manager`, `id_direktur`) VALUES
(1, 'Guest House', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hari`
--

CREATE TABLE `hari` (
  `id_hari` int(11) NOT NULL,
  `nama_hari` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hari`
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
-- Struktur dari tabel `indeks_kepuasan`
--

CREATE TABLE `indeks_kepuasan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `indeks_kepuasan`
--

INSERT INTO `indeks_kepuasan` (`id`, `tanggal`, `status`) VALUES
(2, '2020-07-11', 1),
(4, '2020-07-06', 0),
(5, '2020-07-15', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `indeks_nilai`
--

CREATE TABLE `indeks_nilai` (
  `id_nilai` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `no_induk` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `indeks_nilai`
--

INSERT INTO `indeks_nilai` (`id_nilai`, `id_pertanyaan`, `nilai`, `no_induk`) VALUES
(2, 7, 4, '700'),
(3, 8, 3, '700'),
(4, 9, 2, '700'),
(5, 7, 3, '600'),
(6, 8, 3, '600'),
(7, 9, 3, '600');

-- --------------------------------------------------------

--
-- Struktur dari tabel `indeks_pertanyaan`
--

CREATE TABLE `indeks_pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `pertanyaan` varchar(500) NOT NULL,
  `id_indeks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `indeks_pertanyaan`
--

INSERT INTO `indeks_pertanyaan` (`id_pertanyaan`, `pertanyaan`, `id_indeks`) VALUES
(7, '', 2),
(8, '', 2),
(9, '', 2),
(78, 'asdasd', 4),
(82, 'deletedasd hghghghgh ghghghghghg', 4),
(83, 'vhh', 4),
(86, 'dsfsdfd', 4),
(87, 'dasda', 4),
(88, 'asdasdas adsads', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `kode_jabatan` int(11) NOT NULL,
  `detail_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
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
(13, 7, 8),
(14, 7, 9),
(15, 7, 10),
(16, 7, 11),
(17, 7, 12),
(18, 7, 13),
(19, 7, 14),
(20, 7, 15),
(21, 7, 7),
(22, 5, 2),
(23, 5, 3),
(24, 6, 2),
(25, 6, 3),
(26, 6, 4),
(27, 6, 5),
(28, 6, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_kerja`
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
-- Dumping data untuk tabel `jam_kerja`
--

INSERT INTO `jam_kerja` (`id_jam_kerja`, `jam_kerja_masuk`, `jam_kerja_keluar`, `id_jabatan`, `status_aktif`, `status_jam_kerja`) VALUES
(1, '08:00:00', '15:00:00', 7, 1, 0),
(2, '08:00:00', '15:00:00', 6, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_feedback`
--

CREATE TABLE `kategori_feedback` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_feedback`
--

INSERT INTO `kategori_feedback` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Saran'),
(2, 'Masukan'),
(3, 'Gagasan'),
(4, 'Inovasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_menu`
--

CREATE TABLE `kategori_menu` (
  `id_kategori_menu` int(11) NOT NULL,
  `nama_kategori_menu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_menu`
--

INSERT INTO `kategori_menu` (`id_kategori_menu`, `nama_kategori_menu`) VALUES
(1, 'Home'),
(2, 'Layanan'),
(3, 'Laporan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manager`
--

CREATE TABLE `manager` (
  `id_manager` int(11) NOT NULL,
  `nama_manager` varchar(50) NOT NULL,
  `id_gm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `manager`
--

INSERT INTO `manager` (`id_manager`, `nama_manager`, `id_gm`) VALUES
(1, 'Keuangan dan Kepegawaian', 1),
(2, 'Administrasi, Marketing dan Umum', 1),
(3, 'Restoran dan Masakan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
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
-- Dumping data untuk tabel `menu`
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
(35, 'Indeks Kepuasan Pegawai', '/admin/indeksKepuasan', 'icon-Pie-Chart2', 1, 2),
(36, 'Penilaian Kinerja', '/admin/penilaianKinerja', 'icon-Pie-Chart2', 1, 2),
(37, 'Daftar Pengumuman', '/admin/daftarPengumuman', 'icon-Pie-Chart', 1, 2),
(38, 'Daftar Rancangan Tugas', 'admin/daftarRancanganTugas', 'icon-Pie-Chart3', 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_pk`
--

CREATE TABLE `nilai_pk` (
  `id_nilai` int(11) NOT NULL,
  `id_pertanyaan_pk` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `no_induk` varchar(30) NOT NULL,
  `id_pemberi_nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_pk`
--

INSERT INTO `nilai_pk` (`id_nilai`, `id_pertanyaan_pk`, `nilai`, `no_induk`, `id_pemberi_nilai`) VALUES
(1, 3, 100, '700', 600),
(2, 4, 50, '700', 600),
(3, 5, 55, '700', 600),
(4, 6, 66, '700', 600),
(5, 3, 100, '999', 600),
(6, 4, 100, '999', 600),
(7, 5, 80, '999', 600),
(8, 6, 90, '999', 600);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penanggalan`
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
-- Struktur dari tabel `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `pengumuman` varchar(255) NOT NULL,
  `tanggal_pengumuman` date NOT NULL,
  `waktu_pengumuman` time NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `status_pengumuman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `pengumuman`, `tanggal_pengumuman`, `waktu_pengumuman`, `publisher`, `status_pengumuman`) VALUES
(1, 'Masuk New Normal dimulai Minggu Depan', '2020-06-16', '07:00:00', '100', 0),
(2, 'Pelaksanaan kerja kembali untuk seluruh staff ub guest house mulai tanggal 27 juli 2020', '2020-07-14', '09:16:44', '100', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian_kinerja`
--

CREATE TABLE `penilaian_kinerja` (
  `id_pk` int(11) NOT NULL,
  `nama_pk` varchar(255) NOT NULL,
  `tanggal_pk` date NOT NULL,
  `status_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian_kinerja`
--

INSERT INTO `penilaian_kinerja` (`id_pk`, `nama_pk`, `tanggal_pk`, `status_pk`) VALUES
(1, 'test', '2020-07-13', 1),
(2, 'contoh 1', '2020-07-14', 0),
(5, 'coba coba', '2020-07-16', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan_pk`
--

CREATE TABLE `pertanyaan_pk` (
  `id_pertanyaan_pk` int(11) NOT NULL,
  `pertanyaan_pk` varchar(255) NOT NULL,
  `id_pk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pertanyaan_pk`
--

INSERT INTO `pertanyaan_pk` (`id_pertanyaan_pk`, `pertanyaan_pk`, `id_pk`) VALUES
(3, '', 1),
(4, '', 1),
(5, '', 1),
(6, '', 1),
(9, '', 5),
(11, '', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id_pesan` int(11) NOT NULL,
  `pesan` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `tanggal` date NOT NULL,
  `user` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `id_presensi` int(11) NOT NULL,
  `waktu_presensi_masuk` time NOT NULL,
  `waktu_presensi_keluar` time DEFAULT NULL,
  `status_presensi` int(1) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status_tempat_kerja` int(1) NOT NULL,
  `id_riwayat_jabatan` int(11) NOT NULL,
  `tanggal_presensi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`id_presensi`, `waktu_presensi_masuk`, `waktu_presensi_keluar`, `status_presensi`, `lokasi`, `status_tempat_kerja`, `id_riwayat_jabatan`, `tanggal_presensi`) VALUES
(1, '07:00:00', '16:00:00', 0, 'Jl. Bunga No. 21', 1, 2, '2020-06-29'),
(5, '07:20:22', '07:41:55', 0, 'Jl. Bunga No. 22', 1, 1, '2020-06-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rancangan_tugas`
--

CREATE TABLE `rancangan_tugas` (
  `id_rancangan_tugas` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `periode` int(1) NOT NULL,
  `jumlah_tugas` int(11) NOT NULL,
  `nomor_pekerjaan` int(11) NOT NULL,
  `status_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rancangan_tugas`
--

INSERT INTO `rancangan_tugas` (`id_rancangan_tugas`, `id_jabatan`, `nama_tugas`, `periode`, `jumlah_tugas`, `nomor_pekerjaan`, `status_tugas`) VALUES
(1, 7, 'Membantu membuat laporan harian bendahara seperti buku kas, setoran ke bank dan lain lain', 1, 10, 1, 1),
(2, 7, 'Menyiapkan kelengkapan permintaan uang persediaan', 1, 20, 2, 1),
(6, 7, 'Melakukan pemeriksaan Keuangan', 1, 5, 3, 1),
(7, 7, 'lupa lupa', 1, 5, 4, 1),
(8, 7, 'sadsd adsds ad', 1, 3, 5, 1),
(9, 7, 'Cek Sistem addad', 2, 12, 6, 1),
(14, 11, 'cek', 1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_jabatan`
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
-- Dumping data untuk tabel `riwayat_jabatan`
--

INSERT INTO `riwayat_jabatan` (`id_riwayat_jabatan`, `no_induk`, `id_jabatan`, `status_aktif`, `periode_mulai_jabatan`, `periode_akhir_jabatan`) VALUES
(1, '700', 7, 0, '2020-06-01', '2020-07-16'),
(2, '600', 6, 0, '2020-06-01', NULL),
(3, '999', 7, 0, '2020-07-09', NULL),
(8, '700', 11, 1, '2020-07-24', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_supervisor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `staff`
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
-- Struktur dari tabel `status_user`
--

CREATE TABLE `status_user` (
  `id_status_user` int(11) NOT NULL,
  `nama_status_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status_user`
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
-- Struktur dari tabel `supervisor`
--

CREATE TABLE `supervisor` (
  `id_supervisor` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_manager` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `supervisor`
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
-- Struktur dari tabel `tugas`
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
  `id_rancangan_tugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`no_induk`, `password`, `nama`, `no_telepon`, `alamat`, `email`, `tahun_masuk`, `foto_profil`, `isPenilaian`, `isPresensi`, `id_status_user`) VALUES
('100', '123', 'Admin', '', '', '', 0000, '/assets/images/users/img3.jpg', NULL, NULL, 1),
('200', '123', 'Operator', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
('300', '123', 'Donny Alair', '086666666', 'Jl. Kembang No. 44', 'donny@gmail.com', 2013, '/assets/images/users/profile.jpg', 0, 0, 3),
('333', '321', 'Aditya Yusril', '0831290977126', 'Jl. Sunan bonang No 3, Malang', 'adit9b02@gmail.com', 2022, '/assets/images/users/profil.jpg', NULL, NULL, 1),
('400', '123', 'Rita Wahyuningsih, S.S', '085555555555', 'Jl. Bunga Bunga No. 22', 'ritawahyu@gmail.com', 2013, NULL, 0, 0, 4),
('500', '123', 'Adika Setia Hadi', '0899999999', 'Jl. Kucing No. 22', 'adika@gmail.com', 2014, NULL, 0, 0, 5),
('600', '123', 'Cuikitalia, SE', '081111111', 'Jl. Mawar No. 33', 'cuikitalia@gmail.com', 2014, '/assets/images/users/1.jpg', 0, 0, 6),
('700', '123', 'luniar Sofyan Syah', '082222222233', 'Jl. Melati No. 333', 'juniar@gmail.com', 2013, '/assets/images/users/1.jpg', 0, 0, 7),
('8080', '123', 'Sutrisno', '083123123123', 'Jln. H. Samsuri', 'sutris@gmail.com', 2019, '/assets/images/users/workingspace.jpg', NULL, NULL, 7),
('999', '123', 'Boaz Salosa', '0831290977126', 'Jl. Sunan bonang No 3, Malang', 'adit9b02@gmail.com', 2020, '/assets/images/users/bukti_telah_skripsi.png', NULL, NULL, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `validasi`
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
-- Indeks untuk tabel `batas_penanggalan`
--
ALTER TABLE `batas_penanggalan`
  ADD PRIMARY KEY (`id_batas_penanggalan`),
  ADD KEY `bulan` (`bulan`);

--
-- Indeks untuk tabel `bulan`
--
ALTER TABLE `bulan`
  ADD PRIMARY KEY (`id_bulan`);

--
-- Indeks untuk tabel `direktur`
--
ALTER TABLE `direktur`
  ADD PRIMARY KEY (`id_direktur`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`),
  ADD KEY `kategori_feedback` (`kategori_feedback`);

--
-- Indeks untuk tabel `general_manager`
--
ALTER TABLE `general_manager`
  ADD PRIMARY KEY (`id_general_manager`),
  ADD KEY `id_direktur` (`id_direktur`);

--
-- Indeks untuk tabel `hari`
--
ALTER TABLE `hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indeks untuk tabel `indeks_kepuasan`
--
ALTER TABLE `indeks_kepuasan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `indeks_nilai`
--
ALTER TABLE `indeks_nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `no_induk` (`no_induk`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indeks untuk tabel `indeks_pertanyaan`
--
ALTER TABLE `indeks_pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_indeks` (`id_indeks`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `kode_jabatan` (`kode_jabatan`);

--
-- Indeks untuk tabel `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD PRIMARY KEY (`id_jam_kerja`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `kategori_feedback`
--
ALTER TABLE `kategori_feedback`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `kategori_menu`
--
ALTER TABLE `kategori_menu`
  ADD PRIMARY KEY (`id_kategori_menu`);

--
-- Indeks untuk tabel `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id_manager`),
  ADD KEY `id_gm` (`id_gm`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `status_user` (`status_user`),
  ADD KEY `id_kategori_menu` (`id_kategori_menu`);

--
-- Indeks untuk tabel `nilai_pk`
--
ALTER TABLE `nilai_pk`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_pertanyaan_pk` (`id_pertanyaan_pk`),
  ADD KEY `no_induk` (`no_induk`);

--
-- Indeks untuk tabel `penanggalan`
--
ALTER TABLE `penanggalan`
  ADD PRIMARY KEY (`id_penanggalan`),
  ADD KEY `bulan` (`bulan`),
  ADD KEY `hari` (`hari`);

--
-- Indeks untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`),
  ADD KEY `publisher` (`publisher`);

--
-- Indeks untuk tabel `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indeks untuk tabel `pertanyaan_pk`
--
ALTER TABLE `pertanyaan_pk`
  ADD PRIMARY KEY (`id_pertanyaan_pk`),
  ADD KEY `id_pk` (`id_pk`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `user` (`user`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id_presensi`),
  ADD KEY `id_riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Indeks untuk tabel `rancangan_tugas`
--
ALTER TABLE `rancangan_tugas`
  ADD PRIMARY KEY (`id_rancangan_tugas`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD PRIMARY KEY (`id_riwayat_jabatan`),
  ADD KEY `no_induk` (`no_induk`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `id_supervisor` (`id_supervisor`);

--
-- Indeks untuk tabel `status_user`
--
ALTER TABLE `status_user`
  ADD PRIMARY KEY (`id_status_user`);

--
-- Indeks untuk tabel `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`id_supervisor`),
  ADD KEY `id_manager` (`id_manager`);

--
-- Indeks untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`id_tugas`),
  ADD KEY `id_rancangan_tugas` (`id_rancangan_tugas`),
  ADD KEY `id_riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no_induk`),
  ADD KEY `id_status_user` (`id_status_user`);

--
-- Indeks untuk tabel `validasi`
--
ALTER TABLE `validasi`
  ADD PRIMARY KEY (`id_validasi`),
  ADD KEY `id_tugas` (`id_tugas`),
  ADD KEY `validator` (`validator`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `batas_penanggalan`
--
ALTER TABLE `batas_penanggalan`
  MODIFY `id_batas_penanggalan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `bulan`
--
ALTER TABLE `bulan`
  MODIFY `id_bulan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `direktur`
--
ALTER TABLE `direktur`
  MODIFY `id_direktur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `general_manager`
--
ALTER TABLE `general_manager`
  MODIFY `id_general_manager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hari`
--
ALTER TABLE `hari`
  MODIFY `id_hari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `indeks_kepuasan`
--
ALTER TABLE `indeks_kepuasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `indeks_nilai`
--
ALTER TABLE `indeks_nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `indeks_pertanyaan`
--
ALTER TABLE `indeks_pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id_jam_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategori_feedback`
--
ALTER TABLE `kategori_feedback`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id_kategori_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `manager`
--
ALTER TABLE `manager`
  MODIFY `id_manager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `nilai_pk`
--
ALTER TABLE `nilai_pk`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `penanggalan`
--
ALTER TABLE `penanggalan`
  MODIFY `id_penanggalan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penilaian_kinerja`
--
ALTER TABLE `penilaian_kinerja`
  MODIFY `id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan_pk`
--
ALTER TABLE `pertanyaan_pk`
  MODIFY `id_pertanyaan_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rancangan_tugas`
--
ALTER TABLE `rancangan_tugas`
  MODIFY `id_rancangan_tugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  MODIFY `id_riwayat_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `status_user`
--
ALTER TABLE `status_user`
  MODIFY `id_status_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `supervisor`
--
ALTER TABLE `supervisor`
  MODIFY `id_supervisor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tugas`
--
ALTER TABLE `tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `validasi`
--
ALTER TABLE `validasi`
  MODIFY `id_validasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `batas_penanggalan`
--
ALTER TABLE `batas_penanggalan`
  ADD CONSTRAINT `batas_penanggalan_ibfk_1` FOREIGN KEY (`bulan`) REFERENCES `bulan` (`id_bulan`);

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`kategori_feedback`) REFERENCES `kategori_feedback` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `general_manager`
--
ALTER TABLE `general_manager`
  ADD CONSTRAINT `general_manager_ibfk_1` FOREIGN KEY (`id_direktur`) REFERENCES `direktur` (`id_direktur`);

--
-- Ketidakleluasaan untuk tabel `indeks_nilai`
--
ALTER TABLE `indeks_nilai`
  ADD CONSTRAINT `indeks_nilai_ibfk_1` FOREIGN KEY (`no_induk`) REFERENCES `user` (`no_induk`),
  ADD CONSTRAINT `indeks_nilai_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `indeks_pertanyaan` (`id_pertanyaan`);

--
-- Ketidakleluasaan untuk tabel `indeks_pertanyaan`
--
ALTER TABLE `indeks_pertanyaan`
  ADD CONSTRAINT `indeks_pertanyaan_ibfk_1` FOREIGN KEY (`id_indeks`) REFERENCES `indeks_kepuasan` (`id`);

--
-- Ketidakleluasaan untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_ibfk_1` FOREIGN KEY (`kode_jabatan`) REFERENCES `status_user` (`id_status_user`);

--
-- Ketidakleluasaan untuk tabel `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD CONSTRAINT `jam_kerja_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Ketidakleluasaan untuk tabel `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`id_gm`) REFERENCES `general_manager` (`id_general_manager`);

--
-- Ketidakleluasaan untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`status_user`) REFERENCES `status_user` (`id_status_user`),
  ADD CONSTRAINT `menu_ibfk_2` FOREIGN KEY (`id_kategori_menu`) REFERENCES `kategori_menu` (`id_kategori_menu`);

--
-- Ketidakleluasaan untuk tabel `nilai_pk`
--
ALTER TABLE `nilai_pk`
  ADD CONSTRAINT `nilai_pk_ibfk_1` FOREIGN KEY (`id_pertanyaan_pk`) REFERENCES `pertanyaan_pk` (`id_pertanyaan_pk`),
  ADD CONSTRAINT `nilai_pk_ibfk_2` FOREIGN KEY (`no_induk`) REFERENCES `user` (`no_induk`);

--
-- Ketidakleluasaan untuk tabel `penanggalan`
--
ALTER TABLE `penanggalan`
  ADD CONSTRAINT `penanggalan_ibfk_1` FOREIGN KEY (`bulan`) REFERENCES `bulan` (`id_bulan`),
  ADD CONSTRAINT `penanggalan_ibfk_2` FOREIGN KEY (`hari`) REFERENCES `hari` (`id_hari`);

--
-- Ketidakleluasaan untuk tabel `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_ibfk_1` FOREIGN KEY (`publisher`) REFERENCES `user` (`no_induk`);

--
-- Ketidakleluasaan untuk tabel `pertanyaan_pk`
--
ALTER TABLE `pertanyaan_pk`
  ADD CONSTRAINT `pertanyaan_pk_ibfk_1` FOREIGN KEY (`id_pk`) REFERENCES `penilaian_kinerja` (`id_pk`);

--
-- Ketidakleluasaan untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`no_induk`);

--
-- Ketidakleluasaan untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_ibfk_1` FOREIGN KEY (`id_riwayat_jabatan`) REFERENCES `riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Ketidakleluasaan untuk tabel `rancangan_tugas`
--
ALTER TABLE `rancangan_tugas`
  ADD CONSTRAINT `rancangan_tugas_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Ketidakleluasaan untuk tabel `riwayat_jabatan`
--
ALTER TABLE `riwayat_jabatan`
  ADD CONSTRAINT `riwayat_jabatan_ibfk_1` FOREIGN KEY (`no_induk`) REFERENCES `user` (`no_induk`),
  ADD CONSTRAINT `riwayat_jabatan_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Ketidakleluasaan untuk tabel `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_supervisor`) REFERENCES `supervisor` (`id_supervisor`);

--
-- Ketidakleluasaan untuk tabel `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`id_manager`) REFERENCES `manager` (`id_manager`);

--
-- Ketidakleluasaan untuk tabel `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`id_rancangan_tugas`) REFERENCES `rancangan_tugas` (`id_rancangan_tugas`),
  ADD CONSTRAINT `tugas_ibfk_2` FOREIGN KEY (`id_riwayat_jabatan`) REFERENCES `riwayat_jabatan` (`id_riwayat_jabatan`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_status_user`) REFERENCES `status_user` (`id_status_user`);

--
-- Ketidakleluasaan untuk tabel `validasi`
--
ALTER TABLE `validasi`
  ADD CONSTRAINT `validasi_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`),
  ADD CONSTRAINT `validasi_ibfk_2` FOREIGN KEY (`validator`) REFERENCES `user` (`no_induk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
