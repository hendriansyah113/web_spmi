-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Des 2024 pada 06.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_spmi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `audit_dokumen`
--

CREATE TABLE `audit_dokumen` (
  `id` int(11) NOT NULL,
  `standar_id` int(11) DEFAULT NULL,
  `soal_nomor` varchar(255) NOT NULL,
  `uraian` text DEFAULT NULL,
  `kelengkapan_dokumen_farmasi` varchar(255) DEFAULT NULL,
  `kelengkapan_dokumen_ak` varchar(255) DEFAULT NULL,
  `catatan_farmasi` text DEFAULT NULL,
  `catatan_ak` text DEFAULT NULL,
  `upload_dokumen_farmasi` varchar(255) DEFAULT NULL,
  `upload_dokumen_ak` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `audit_dokumen`
--

INSERT INTO `audit_dokumen` (`id`, `standar_id`, `soal_nomor`, `uraian`, `kelengkapan_dokumen_farmasi`, `kelengkapan_dokumen_ak`, `catatan_farmasi`, `catatan_ak`, `upload_dokumen_farmasi`, `upload_dokumen_ak`) VALUES
(1, 1, '1.1', 'Tersedianya dokumen VMTS UPPS/PS yang sangat jelas, sangat realistis dan memiliki pengesahan yang dilengkapi dengan:', '✓', 'Lengkap', 'Dokumen lengkap dan sesuai', NULL, '67598d46710fa_1733922118.png', 'ak'),
(2, 1, '1.2', 'Tersedianya dokumen Pedoman penyusunan RIP, RENSTRA dan RENOP UPPS/PS', '✓', NULL, 'Dokumen lengkap dan sesuai', NULL, '', NULL),
(3, 2, '2.1', 'Tersedianya prosedur audit untuk proses pelaksanaan', '✓', NULL, 'Prosedur sesuai standar', NULL, '', NULL),
(4, 3, '3.1', 'Dokumen bukti penilaian untuk semua dokumen yang diaudit', '✓', 'Tidak Lengkap', 'Bukti penilaian lengkap', 'aduh', '', NULL),
(5, 4, '4.1', 'Dokumen hasil analisis SWOT untuk semua standar audit', '✓', NULL, 'Analisis SWOT sudah ada dan valid', NULL, NULL, NULL),
(7, 1, '1.4', 'mantap2', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `audit_soal`
--

CREATE TABLE `audit_soal` (
  `id` int(11) NOT NULL,
  `audit_id` int(11) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `kelengkapan_dokumen_farmasi` varchar(255) DEFAULT NULL,
  `kelengkapan_dokumen_ak` varchar(255) DEFAULT NULL,
  `catatan_farmasi` text DEFAULT NULL,
  `catatan_ak` text DEFAULT NULL,
  `upload_dokumen_farmasi` varchar(255) DEFAULT NULL,
  `upload_dokumen_ak` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `audit_soal`
--

INSERT INTO `audit_soal` (`id`, `audit_id`, `uraian`, `kelengkapan_dokumen_farmasi`, `kelengkapan_dokumen_ak`, `catatan_farmasi`, `catatan_ak`, `upload_dokumen_farmasi`, `upload_dokumen_ak`) VALUES
(1, 1, 'Dokumen panduan penyusunan VMTS', 'Lengkap', 'Tidak Lengkap', 'Dokumen lengkap dan valid', 'apa ini', ';l', '67598e1857e6c_1733922328.png'),
(2, 1, 'Dokumen Tim Perumus VMTS', 'Lengkap', NULL, 'mantap coy', NULL, NULL, NULL),
(3, 2, 'Dokumen prosedur audit pelaksanaan yang jelas', '✓', NULL, 'Prosedur audit sudah ditetapkan', NULL, NULL, NULL),
(4, 3, 'Dokumen bukti penilaian yang terperinci', '✓', NULL, 'Dokumen penilaian lengkap dan sesuai', NULL, NULL, NULL),
(5, 4, 'Dokumen analisis SWOT yang relevan', '✓', 'Lengkap', 'Analisis SWOT sesuai dengan kondisi audit', 'mantap', NULL, '6759936684628_1733923686.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gkm_ami`
--

CREATE TABLE `gkm_ami` (
  `nidn` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `gkm_ami`
--

INSERT INTO `gkm_ami` (`nidn`, `nama`, `jabatan`, `email`, `foto`) VALUES
(2222, 'c', 'c', 'cindykfykfy@gmail.com', 0x696e7374616772616d2d6c6f676f2d453030363741313430332d7365656b6c6f676f2e636f6d2e706e67),
(11111, 'cindy', 'lpm', 'cindykfykfy@gmail.com', 0x696d61676573202831292e6a7067),
(23456, 'nita', 'lpm', 'lookism41@vikas2.com', 0x62756b746920627961722e6a7067),
(200003, 'nita', 'lpm', 'saf@wgf', 0x65),
(32009853, 'cindy', 'lpm', 'adefitriaputri06122002@gmail.com', 0x53637265656e73686f745f5f32395f2d72656d6f766562672d707265766965772e706e67);

-- --------------------------------------------------------

--
-- Struktur dari tabel `indikator`
--

CREATE TABLE `indikator` (
  `id` int(11) NOT NULL,
  `sub_standar_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `skor_farmasi` int(1) DEFAULT NULL,
  `skor_analisis_kesehatan` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `indikator`
--

INSERT INTO `indikator` (`id`, `sub_standar_id`, `nama`, `skor_farmasi`, `skor_analisis_kesehatan`) VALUES
(1, 1, 'Visi Program Studi (1)', 4, 3),
(2, 1, 'Visi dan Misi Program Studi (2)', 2, 1),
(3, 3, 'Kejelasan dan keselarasan tujuan dengan visi dan misi (5)', NULL, NULL),
(4, 3, 'Sasaran program studi (6)', NULL, NULL),
(5, 2, 'Kualitas input mahasiswa tercermin dari rasio antara calon mahasiswa yang mendaftar dan yang diterima serta memenuhi daya tampung (9)', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_ami`
--

CREATE TABLE `jadwal_ami` (
  `id_jadwal` int(11) NOT NULL,
  `nama_auditor` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `nama`) VALUES
(1, 'auditee', 'ac7b19332cdf22ce60b441e35d31984e', 'auditee'),
(2, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(3, 'auditor', '5cb59fe845b83231b0e5aa95d96267e9', 'auditor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_indikator`
--

CREATE TABLE `nilai_indikator` (
  `id` int(11) NOT NULL,
  `id_indikator` int(11) DEFAULT NULL,
  `poin` int(11) DEFAULT NULL,
  `nama_nilai_indikator` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai_indikator`
--

INSERT INTO `nilai_indikator` (`id`, `id_indikator`, `poin`, `nama_nilai_indikator`) VALUES
(1, 1, 4, 'Program studi memiliki visi yang sangat jelas dan realistis, berorientasi ke masa depan untuk dicapai dalam batas periode waktu tertentu.'),
(2, 1, 3, 'Program studi memiliki visi yang sangat jelas dan realistis, berorientasi ke masa depan tetapi tidak ada batas periode waktu tertentu.'),
(3, 2, 2, 'program studi memiliki visi yang sangat jelas dan realistis tetapi tidak berorientasi ke masa depan untuk dicapai dalam batas periode waktu tertentu.'),
(4, 2, 1, 'Program studi memiliki visi yang sangat jelas tetapi tidak realistis untuk dicapai dalam batas periode waktu tertentu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelaksanaan`
--

CREATE TABLE `pelaksanaan` (
  `id_pelaksanaan` int(11) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `auditor` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Proses','Belum Selesai','Perbaikan') DEFAULT 'Proses',
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelaksanaan`
--

INSERT INTO `pelaksanaan` (`id_pelaksanaan`, `fakultas`, `prodi`, `auditor`, `keterangan`, `status`, `tahun`) VALUES
(1, 'fbi aja', 'Ilmu Komputer aja', 'x', 'x', 'Proses', 2024),
(2, 'wdw', 'dwdw', 'wdwd', 'dwdw', 'Proses', 2023),
(3, 'kesehatan', 'Analisis Kesehatan', 'ade', 'sqsq', 'Proses', 2024),
(4, 'kesehatan', 'Farmasi', 'ade', 'wdw', 'Proses', 2024);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `kaprodi` varchar(255) NOT NULL,
  `akreditasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `standar`
--

CREATE TABLE `standar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `standar`
--

INSERT INTO `standar` (`id`, `nama`, `tahun`) VALUES
(1, 'Standar 1: Identitas', 2024),
(2, 'Standar 2: Kemahasiswaan', 2024),
(3, 'standar 3: kampus', 2024),
(4, 'standar 4: jurusanm', 2023);

-- --------------------------------------------------------

--
-- Struktur dari tabel `standar_audit`
--

CREATE TABLE `standar_audit` (
  `id` int(11) NOT NULL,
  `nama_standar` varchar(255) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `standar_audit`
--

INSERT INTO `standar_audit` (`id`, `nama_standar`, `tahun`) VALUES
(1, 'Standar 1 Identitas', 2024),
(2, 'Standar 2 Proses Audit', 2024),
(3, 'Standar 3 Penilaian Dokumen', 2024),
(4, 'Standar 4 Analisis SWOT', 2023),
(5, 'Standar 5 Pemangku Kepentingan', 2024),
(10, 'sss', 2021);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_standar`
--

CREATE TABLE `sub_standar` (
  `id` int(11) NOT NULL,
  `standar_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sub_standar`
--

INSERT INTO `sub_standar` (`id`, `standar_id`, `nama`) VALUES
(1, 1, '1. Visi dan Misi'),
(2, 2, '1. Kualitas Inpit'),
(3, 1, '2. Tujuan, Sasaran, dan Strategi'),
(4, 2, '2 Animo Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `audit_dokumen`
--
ALTER TABLE `audit_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `audit_soal`
--
ALTER TABLE `audit_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `gkm_ami`
--
ALTER TABLE `gkm_ami`
  ADD PRIMARY KEY (`nidn`);

--
-- Indeks untuk tabel `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_standar_id` (`sub_standar_id`);

--
-- Indeks untuk tabel `jadwal_ami`
--
ALTER TABLE `jadwal_ami`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_indikator`
--
ALTER TABLE `nilai_indikator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_indikator` (`id_indikator`);

--
-- Indeks untuk tabel `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD PRIMARY KEY (`id_pelaksanaan`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indeks untuk tabel `standar`
--
ALTER TABLE `standar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `standar_audit`
--
ALTER TABLE `standar_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sub_standar`
--
ALTER TABLE `sub_standar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `standar_id` (`standar_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `audit_dokumen`
--
ALTER TABLE `audit_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `audit_soal`
--
ALTER TABLE `audit_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `jadwal_ami`
--
ALTER TABLE `jadwal_ami`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `nilai_indikator`
--
ALTER TABLE `nilai_indikator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  MODIFY `id_pelaksanaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `standar`
--
ALTER TABLE `standar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `standar_audit`
--
ALTER TABLE `standar_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sub_standar`
--
ALTER TABLE `sub_standar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `indikator`
--
ALTER TABLE `indikator`
  ADD CONSTRAINT `indikator_ibfk_1` FOREIGN KEY (`sub_standar_id`) REFERENCES `sub_standar` (`id`);

--
-- Ketidakleluasaan untuk tabel `nilai_indikator`
--
ALTER TABLE `nilai_indikator`
  ADD CONSTRAINT `nilai_indikator_ibfk_1` FOREIGN KEY (`id_indikator`) REFERENCES `indikator` (`id`);

--
-- Ketidakleluasaan untuk tabel `sub_standar`
--
ALTER TABLE `sub_standar`
  ADD CONSTRAINT `sub_standar_ibfk_1` FOREIGN KEY (`standar_id`) REFERENCES `standar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
