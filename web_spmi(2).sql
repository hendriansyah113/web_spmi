-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 02:37 PM
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
-- Database: `web_spmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_dokumen`
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
-- Dumping data for table `audit_dokumen`
--

INSERT INTO `audit_dokumen` (`id`, `standar_id`, `soal_nomor`, `uraian`, `kelengkapan_dokumen_farmasi`, `kelengkapan_dokumen_ak`, `catatan_farmasi`, `catatan_ak`, `upload_dokumen_farmasi`, `upload_dokumen_ak`) VALUES
(1, 1, '1.1', 'Tersedianya dokumen VMTS UPPS/PS yang sangat jelas, sangat realistis dan memiliki pengesahan yang dilengkapi dengan:', '✓', 'Lengkap', 'Dokumen lengkap dan sesuai', NULL, '67598d46710fa_1733922118.png', '67679ed68a5a3_1734844118.png'),
(2, 1, '1.2', 'Tersedianya dokumen Pedoman penyusunan RIP, RENSTRA dan RENOP UPPS/PS', '✓', NULL, 'Dokumen lengkap dan sesuai', NULL, '', NULL),
(3, 2, '2.1', 'Tersedianya prosedur audit untuk proses pelaksanaan', '✓', NULL, 'Prosedur sesuai standar', NULL, '', '67679dd2edbd8_1734843858.jpeg'),
(4, 3, '3.1', 'Dokumen bukti penilaian untuk semua dokumen yang diaudit', 'Lengkap', 'Lengkap', 'sudah lengkap', 'mantap', '67679ef2bfee4_1734844146.jpeg', '67679eadeb2d5_1734844077.pdf'),
(5, 4, '4.1', 'Dokumen hasil analisis SWOT untuk semua standar audit', 'Tidak Lengkap', NULL, 'wwww', NULL, NULL, NULL),
(7, 1, '1.4', 'mantap2', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 13, '1', 'e. Dokumen VMTS UPPS/PS memiliki keselarasan dengan VMTS PT', 'Lengkap', NULL, '', NULL, '676a231aee28f_1735009050.pdf', NULL),
(9, 13, '2', 'b. Dokumen Tim Perumus VMTS', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 14, '1', 'Tersedianya dokumen VMTS UPPS/PS yang sangat jelas, sangat realistis dan memiliki pengesahan yang dilengkapi dengan:', 'Lengkap', NULL, 'o8ss', NULL, NULL, NULL),
(11, 14, '2', 'Tersedianya dokumen Pedoman penyusunan RIP, RENSTRA dan RENOP UPPS/PS', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 14, '3', 'Tersedianya dokumen RIP, RENSTRA dan RENOP UPPS/PS dan tonggak-tonggak capaian (milestone) yang dievaluasi secara berkala', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 14, '4', 'Tersedianya dokumen bukti pelaksanaan sosialisasi VMTS dalam bentik  notulen rapat, spanduk, banner, poster, leaflet, materi pada saat penerimaan mahasiswa baru, media tulis dan elektronik, dan lainnya', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 14, '5', 'Tersedianya dokumen bukti pelaksanaan monev pemahaman VMTS ditingkat UPPS/PS', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 15, '6', 'Data Calon Mahasiswa yang mendaftar ', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 15, '7', 'Surat Keputusan Penerimaan Mahasiswa', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 15, '8', 'Surat Keputusan tentang Daya Tampung ', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 15, '9', 'Daftar layanan layanan dan pembinaan kemahasiswaan  dalam bidang minat, bakat, penalaran dan keprofesian disertai dengan dokumentasi kegiatan pada setiap bidang layanan ', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 16, '10', 'Dekumen DTPS yang lengkap: Ijazah & Transkrip nilai (semua jenjang level pendidikan) SK Jafung terakhir Sertifikat pendidik Sertifikat Kompetensi Sertifikat kegiatan seminar/worksop (pada TS) Laporan Kinerja dosen (BKD) (pada TS)', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 16, '11', 'SK Mengajar DTPS (pada TS)', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 16, '12', 'SK Dosen Pembimbing Akademik (pada TS)', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 16, '13', 'SK Dosen Pembimbing KTI/Skripsi/Tesis (pada TS)', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 16, '14', 'SK Dosen Pembimbing Praktek/Magang/PKL (pada TS)', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 17, '15', 'Kebijakan Implementasi kurikulum pada PS', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 17, '16', 'Dokumentasi kegiatan lokakarya kurikulum ', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 17, '17', 'Dokumen Kurikulum yang lengkap yang berisi: identitas PS, penilaian terhadap pelaksanaan kurikulum sebelumnya, VMTS, profil lulusan, capaian pembelajaran lulusan (CPL), bidang kajian, daftar mata kuliah, dan perangkat pembelajaran (RPS, materi pembelajaran, rencana tugas, rencana penilaian, intrumen panilaian, dan rubrik penilaian), koheren, relevan, dan mutakhir', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 17, '18', 'RPS semua mata kuliah (yang terbaru sesuai dengan TS)', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 17, '19', 'Jurnal perkuliahan semua mata kuliah', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 17, '20', 'Dokumentasi kegiatan seminar, worksop, kuliah umum, lokakarkarya, atau diskusi ilmiah yang dilaksanakan oleh PT/UPPS/PS yang melibatkan dosen dan mahasiswa (pada TS)', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_soal`
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
-- Dumping data for table `audit_soal`
--

INSERT INTO `audit_soal` (`id`, `audit_id`, `uraian`, `kelengkapan_dokumen_farmasi`, `kelengkapan_dokumen_ak`, `catatan_farmasi`, `catatan_ak`, `upload_dokumen_farmasi`, `upload_dokumen_ak`) VALUES
(1, 1, 'Dokumen panduan penyusunan VMTS', 'Lengkap', 'Tidak Lengkap', 'Dokumen lengkap dan valid', 'apa ini', ';l', '67598e1857e6c_1733922328.png'),
(2, 1, 'Dokumen Tim Perumus VMTS', 'Lengkap', NULL, 'mantap coy', NULL, NULL, NULL),
(3, 2, 'Dokumen prosedur audit pelaksanaan yang jelas', '✓', NULL, 'Prosedur audit sudah ditetapkan', NULL, NULL, NULL),
(4, 3, 'Dokumen bukti penilaian yang terperinci', '✓', NULL, 'Dokumen penilaian lengkap dan sesuai', NULL, NULL, NULL),
(5, 4, 'Dokumen analisis SWOT yang relevan', 'Tidak Lengkap', 'Tidak Lengkap', 'kurang', 'aaaa', '67679c2766f71_1734843431.jpeg', '67679ec0dc4d4_1734844096.png'),
(12, 10, 'a. Dokumen panduan penyusunan VMTS', 'Lengkap', NULL, 'dokumen langkap dan mengacu pada pertanyaan', NULL, '6777b206c5a5a_1735897606.pdf', NULL),
(13, 10, 'b. Dokumen Tim Perumus VMTS', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 10, 'c. Dokumen bukti pelaksanaan analisis SWOT untuk penyusunan VMTS  UPPS/PS', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 10, 'd. Dokumen bukti penyusunan VMTS yang melibatkan pemangku kepentingan internal (pimpinan, dosen, tenaga kependidikan, dan mahasiswa) dan eksternal (pengguna lulusan, mitra, organisasi profesi,organisasi keilmuan, pemerintah, alumni dan pakar)', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 10, 'e. Dokumen VMTS UPPS/PS memiliki keselarasan dengan VMTS PT', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 10, 'f. Tersedianya visi keilmuan pada masing-masing prodi', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gkm_ami`
--

CREATE TABLE `gkm_ami` (
  `nidn` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gkm_ami`
--

INSERT INTO `gkm_ami` (`nidn`, `nama`, `jabatan`, `email`, `foto`) VALUES
(2222, 'c', 'c', 'cindykfykfy@gmail.com', 0x696e7374616772616d2d6c6f676f2d453030363741313430332d7365656b6c6f676f2e636f6d2e706e67),
(11111, 'cindy', 'lpm', 'cindykfykfy@gmail.com', 0x696d61676573202831292e6a7067),
(23456, 'nita', 'lpm', 'lookism41@vikas2.com', 0x62756b746920627961722e6a7067),
(200003, 'nita', 'lpm', 'saf@wgf', 0x65),
(32009853, 'cindy', 'lpm', 'adefitriaputri06122002@gmail.com', 0x53637265656e73686f745f5f32395f2d72656d6f766562672d707265766965772e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `indikator`
--

CREATE TABLE `indikator` (
  `id` int(11) NOT NULL,
  `sub_standar_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `skor_farmasi` int(1) DEFAULT NULL,
  `skor_analisis_kesehatan` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indikator`
--

INSERT INTO `indikator` (`id`, `sub_standar_id`, `nama`, `skor_farmasi`, `skor_analisis_kesehatan`) VALUES
(1, 1, 'Visi Program Studi (1)', 4, 4),
(2, 1, 'Visi dan Misi Program Studi (2)', 2, 2),
(3, 3, 'Kejelasan dan keselarasan tujuan dengan visi dan misi (5)', NULL, NULL),
(4, 3, 'Sasaran program studi (6)', NULL, NULL),
(5, 2, 'Kualitas input mahasiswa tercermin dari rasio antara calon mahasiswa yang mendaftar dan yang diterima serta memenuhi daya tampung (9)', NULL, 1),
(6, 6, 'Visi Program Studi (1)', 2, NULL),
(7, 7, 'Kejelasan dan Keselarasan Tujuan dengan Visi dan Misi (5)', NULL, NULL),
(8, 8, 'Kualitas input mahasiswa tercermin dari rasio antara calon mahasiswa yang mendaftar dan yang diterima serta memenuhi daya tampung (9', NULL, NULL),
(9, 9, 'Pada TS jumlah animo calon mahasiswa meningkat  (10)', NULL, NULL),
(11, 6, 'Visi dan Misi Program Studi (2)', NULL, NULL),
(12, 7, 'Strategi pencapaian program studi (6)', NULL, NULL),
(13, 7, 'Tujuan, sasaran dan strategi pencapaian disosialisasikan (7)', NULL, NULL),
(14, 6, 'Perumusan visi dan misi program studi (3)', NULL, NULL),
(15, 10, 'Ketersediaan Program layanan dan pembinaan kemahasiswaan  dalam bidang minat, bakat, penalaran dan keprofesian (11) ', NULL, NULL),
(16, 11, 'Kualifikasi Akademik Magister DTPS (12)', NULL, NULL),
(17, 11, 'PS memiliki DTPS dengan jabatan Minimal Lektor Kepala (13)', NULL, NULL),
(18, 11, 'PS memiliki DTPS dengan jabatan Minimal Lektor Kepala di Bidang Keahliannya sesuai dengan Program Studi  (14)', NULL, NULL),
(19, 11, 'PS Memiliki DTPS yang telah memiliki sertifikat pendidikan/sertifikasi dosen (15)', NULL, NULL),
(20, 11, 'DTPS yang memiliki Sertifikat Kompetensi/Surat Tanda Registrasi/Ijazah Apoteker (16)', NULL, NULL),
(21, 12, 'Jumlah DTPS (17)', NULL, NULL),
(22, 12, 'Jumlah Dosen Tidak tetap (DTT) (18)', NULL, NULL),
(23, 13, 'Beban Kerja DTPS (19', NULL, NULL),
(24, 13, 'Kehadiran DTPS mengajar di PS sesuai dengan yang direncanakan (20)', NULL, NULL),
(25, 13, 'DTPS menjadi pembimbing utama tugas akhir (gabungan skripsi, tesis, dan disertasi) yang memungkinkan pembimbingan berjalan dengan baik (21)', NULL, NULL),
(26, 13, 'DTPS memiliki prestasi (pembicara kunci, dosen tamu, nara sumber, konsultan, editor, dll) yang diakui oleh pihak lain (22)', NULL, NULL),
(27, 14, 'DTPS mengikuti kegiatan keprofesian berkelanjutan, seperti studi lanjut, postdoc, academic recharging program (ARP), kursus singkat, magang, pelatihan, sertifikasi, konferensi, seminar, dan lokakarya pada TS (23)', NULL, NULL),
(28, 15, 'PT/UPPS memiliki kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS (termasuk kebijakan Merdeka Belajar - Kampus Merdeka), dan pelaksanaannya secara konsisten (24)', NULL, NULL),
(29, 16, 'UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya dalam bentuk pemberian dana, pemberian pendampingan, dan penyediaan pakar yang relevan. (25)', NULL, NULL),
(30, 16, 'Keterlibatan pemangku kepentingan dalam proses evaluasi dan pemutakhiran kurikulum (26)', NULL, NULL),
(31, 17, 'PS memiliki  kurikulum lengkap (27)', NULL, NULL),
(33, 17, 'Kesesuaian capaian pembelajaran dengan profil lulusan dan jenjang KKNI/SKKNI (28)', NULL, NULL),
(34, 17, 'Ketepatan struktur kurikulum dalam pembentukan capaian pembelajaran (29)', NULL, NULL),
(35, 18, 'Pembelajaran dilaksanakan sesuai dengan RPS dan memiliki sifat interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa (30)', NULL, NULL),
(36, 18, 'Ketersediaan dan kelengkapan dokumen rencana pembelajaran semester (RPS) (31)', NULL, NULL),
(37, 18, 'Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan (32)', NULL, NULL),
(38, 19, 'Bentuk interaksi antara dosen, mahasiswa dan sumber belajar (33)', NULL, NULL),
(39, 19, 'Pemantauan kesesuaian proses terhadap rencana pembelajaran (34)', NULL, NULL),
(40, 19, 'Kedalaman dan keluasan RPS sesuai dengan capaian pembelajaran lulusan (35)', NULL, NULL),
(41, 20, 'Pembelajaran di PS mengintegrasikan hasil penelitian dan/atau PkM (36)', NULL, NULL),
(42, 20, 'Kesesuaian metode pembelajaran dengan capaian pembelajaran. Contoh: RBE (research based education), IBE (industry based education), teaching factory/teaching industry, dll. (37)', NULL, NULL),
(43, 21, 'PS melaksanakan penilaian pembelajaran minimal dua kali dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap: (a) kisi-kisi, (b) alat penilaian, (c) rubrik penilaian, dan (d)', NULL, NULL),
(44, 22, 'Monitoring dan evaluasi pelaksanaan proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa untuk memperoleh capaian pembelajaran lulusan (39)', NULL, NULL),
(45, 22, 'PS melaksanakan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen (40)', NULL, NULL),
(46, 23, 'Keterlaksanaan dan keberkalaan program dan kegiatan diluar kegiatan pembelajaran terstruktur untuk meningkatkan suasana akademik  Contoh: kegiatan himpunan mahasiswa, kuliah umum/stadium generale, seminar ilmiah, bedah buku (41)', NULL, NULL),
(47, 23, 'PS melaksanakan pembimbingan akademik oleh PA, baik yang menyangkut masalah akademik maupun non-akademik, paling tidak dilakukan sebanyak 3 kali dalam satu semester di awal, di tengah, dan di akhir semester. Kegiatan pembimbingan terdokumentasi dengan bai', NULL, NULL),
(48, 23, 'PS melaksanakan pembimbingan magang kependidikan di sekolah mitra , yang dilakukan setidaknya sebanyak 3 kali dalam satu kegiatan magang, baik secara luring maupun daring. Pembimbingan dapat dilakukan di kampus atau di sekolah mitra, dan terdokumentasi de', NULL, NULL),
(49, 23, 'PS melaksanakan pembimbingan tugas akhir/skripsi secara luring maupun daring setidaknya sebanyak 16 kali secara terjadwal, konsisten, serta terdokumentasi dengan baik (44)', NULL, NULL),
(50, 24, 'PS memiliki Research Group (RG) dan  Roadmap (RM) penelitian dan PkM yang jelas dan relevan dengan VMTS PS (45)', NULL, NULL),
(51, 24, 'DTPS melakukan kegiatan penelitian yang relevan dengan bidang keahlian PS minimal 1 kali dalam 1 tahun, baik dengan pembiayaan PT/mandiri, pembiayaan dalam negeri, maupun pembiayaan luar negeri (46)', NULL, NULL),
(52, 24, 'Dalam melaksanakan penelitiannya, DTPS melibatkan mahasiswa PS (47)', NULL, NULL),
(53, 24, 'DTPS melakukan kegiatan PkM yang relevan dengan bidang keahlian program studi minimal 1 kali dalam 1 tahun, baik dengan pembiayaan PT/mandiri, pembiayaan dalam negeri, maupun pembiayaan luar negeri (48)', NULL, NULL),
(54, 24, 'Dalam melaksanakan PkM, DTPS melibatkan mahasiswa PS (49)', NULL, NULL),
(55, 25, 'Mahasiswa PS memiliki rata-rata IPK yang baik (50)', NULL, NULL),
(56, 25, 'Mahasiswa PS memiliki prestasi akademik dan non-akademik mahasiswa di tingkat  international (NI), nasional (NN), dan/atau lokal/wilayah(NW) (51)', NULL, NULL),
(57, 25, 'Lulusan PS memiliki rata-rata masa studi yang pendek (52)', NULL, NULL),
(58, 25, 'Mahasiswa dapat menyelesaikan studinya tepat waktu (STW) (53)', NULL, NULL),
(59, 25, 'Mahasiswa berhasil menyelesaikan studinya (KSM) (54)', NULL, NULL),
(60, 25, 'Lulusan first taker Uji Kompetensi Mahasiswa Program Diploma Tiga Farmasi Computer Based Test (CBT) Nasional pada TS (55)', NULL, NULL),
(61, 25, 'DTPS dan/atau mahasiswa mempublikasikan hasil penelitian dan PkM (56)', NULL, NULL),
(62, 25, 'Karya Ilmiah (hasil penelitian, PkM, dan/atau pemikiran) DTPS dan mahasiswa disitasi oleh orang lain pada TS (57)', NULL, NULL),
(63, 25, 'Produk atau Jasa DTPS dan/atau mahaswa (hasil penelitian, PkM dan/atau pemikiran) diadopsi oleh Masyarakat pada TS (58)', NULL, NULL),
(64, 25, 'Produk atau Jasa (hasil penelitian dan/atau PkM) DTPS mendapatkan sertifikat HKI atau Paten pada TS (59)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ami`
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
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `nama`, `role`) VALUES
(1, 'auditee', '$2y$10$Ql4t9eV4YU1Y7AL950Tn6es0czYuhgqtIm4LQ9g6T4RhEMNUHbFeW', 'auditee', 'auditee'),
(2, 'admin', '$2y$10$Ot776Qzq.THMk9YzhNLJbu1fsYhA1zVzLik2tCPBO6VaE7xdq22MO', 'admin', 'admin'),
(3, 'auditor', '$2y$10$2MUfnJxdqlmGHTf3FaLLTe/ibLQ31/aTKcIOcycJ5zQvMCzlQtGhC', 'auditor', 'auditor'),
(4, 'misyanto', 'misyanto1', 'misyanto', 'auditor');

-- --------------------------------------------------------

--
-- Table structure for table `nilai_indikator`
--

CREATE TABLE `nilai_indikator` (
  `id` int(11) NOT NULL,
  `id_indikator` int(11) DEFAULT NULL,
  `poin` int(11) DEFAULT NULL,
  `nama_nilai_indikator` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai_indikator`
--

INSERT INTO `nilai_indikator` (`id`, `id_indikator`, `poin`, `nama_nilai_indikator`) VALUES
(1, 1, 4, 'Program studi memiliki visi yang sangat jelas dan realistis, berorientasi ke masa depan untuk dicapai dalam batas periode waktu tertentu.'),
(2, 1, 3, 'Program studi memiliki visi yang sangat jelas dan realistis, berorientasi ke masa depan tetapi tidak ada batas periode waktu tertentu.'),
(3, 2, 2, 'program studi memiliki visi yang sangat jelas dan realistis tetapi tidak berorientasi ke masa depan untuk dicapai dalam batas periode waktu tertentu.'),
(4, 2, 1, 'Program studi memiliki visi yang sangat jelas tetapi tidak realistis untuk dicapai dalam batas periode waktu tertentu'),
(5, 5, 1, 'mantap'),
(6, 6, 1, 'Program studi memiliki visi yang sangat jelas tetapi tidak realistis untuk dicapai dalam batas periode waktu tertentu'),
(7, 6, 2, 'program studi memiliki visi yang sangat jelas dan realistis tetapi tidak berorientasi ke masa depan untuk dicapai dalam batas periode waktu tertentu.'),
(8, 6, 3, 'Program studi memiliki visi yang sangat jelas dan realistis, berorientasi ke masa depan tetapi tidak ada batas periode waktu tertentu.'),
(9, 6, 4, 'Program studi memiliki visi yang sangat jelas dan realistis, berorientasi ke masa depan untuk dicapai dalam batas periode waktu tertentu.'),
(11, 7, 2, 'Tujuan tidak jelas dan tidak selaras dengan visi dan misi'),
(12, 7, 3, 'Tujuan telah jelas tetapi tidak selaras dengan visi dan misi'),
(13, 7, 4, 'Tujuan telah jelas dan selaras dengan visi dan misi.'),
(14, 8, 4, 'Jumlah mahasiswa yang diterima antara > 10% sampai dengan ≤ 50% dari jumlah pendaftar dan daya tampung terpenuhi'),
(15, 8, 3, 'Jumlah mahasiswa yang diterima antara > 51% sampai dengan ≤ 99% dari jumlah pendaftar dan daya tampung terpenuhi'),
(16, 8, 2, 'Jumlah mahasiswa yang diterima sama dengan jumlah mahasiswa yang mendaftar (100%) dan daya tampung terpenuhi'),
(17, 8, 1, 'Jumlah mahasiswa yang diterima sama dengan jumlah mahasiswa yang mendaftar (100%) dan daya tampung tidak terpenuhi'),
(18, 9, 1, 'Pada TS jumlah animo calon mahasiswa yang mendaftar di PS menunjukkan angka penurunan dibandingkan TS-1.'),
(19, 9, 2, 'Pada TS jumlah animo calon mahasiswa yang mendaftar di PS tidak mengalami peningkatan dibandingkan TS-1.'),
(20, 9, 3, 'Pada TS jumlah animo calon mahasiswa yang mendaftar di PS meningkat secara konsisten < 15 % dari daya tampung dibandingkan TS-1.'),
(21, 9, 4, 'Pada TS jumlah animo calon mahasiswa yang mendaftar di PS meningkat secara konsisten ≥ 15 % dari daya tampung dibandingkan TS-1'),
(22, 10, 1, 'Sama sekali tidak mengacu ke visi dan misi fakultas.'),
(23, 10, 2, 'Kurang jelas mengacu pada visi dan misi fakultas.'),
(24, 10, 3, 'Cukup jelas mengacu pada visi dan misi fakultas.'),
(25, 10, 4, 'Sangat jelas mengacu pada visi dan misi fakultas.'),
(26, 11, 4, 'Sangat jelas mengacu pada visi dan misi fakultas'),
(27, 11, 3, 'Cukup jelas mengacu pada visi dan misi fakultas'),
(28, 11, 2, 'Kurang jelas mengacu pada visi dan misi fakultas'),
(29, 11, 1, 'Sama sekali tidak mengacu ke visi dan misi fakultas'),
(30, 7, 1, 'program studi tidak memiliki tujuan dan keselarasan dengan visi dan mis'),
(31, 12, 4, 'Program studi strategi pencapaian secara jelas dan realistik, didokumentasikan dengan lengkap, serta dikomunikasikan secara formal kepada semua penyelenggara pendidikan.'),
(32, 12, 3, 'Memuat dua dari tiga aspek di atas'),
(33, 12, 2, 'Memuat satu dari tiga aspek di atas'),
(34, 12, 1, 'Tidak memuat satupun aspek di atas'),
(35, 13, 4, 'Dosen, tenaga kependidikan dan mahasiswa'),
(36, 14, 4, 'Tersedia dokumen bahwa perumusan visi dan misi melibatkan unsur pimpinan program studi, majelis dosen dan memperhatikan masukan dari stakeholders baik internal maupun eksternal dan terdokumentasi dengan baik'),
(37, 14, 3, 'Tersedia dokumen bahwa perumusan visi dan misi melibatkan unsur pimpinan program studi, majelis dosen dan memperhatikan masukan dari stakeholders internal dan melibatkan stakeholders eksternal tidak terdokumentasi '),
(38, 14, 2, 'Tersedia dokumen bahwa perumusan visi dan misi melibatkan unsur pimpinan program studi dan majelis dosen tanpa memperhatikan masukan dari stakeholders'),
(39, 14, 1, 'Tersedia dokumen bahwa visi dan misi hanya  dirumuskan oleh unsur pimpinan program studi Saja'),
(40, 15, 4, 'Adanya Program layanan dan pembinaan kemahasiswaan dalam bidang minat, bakat, penalaran, dan keprofesian serta terdokumentasi dengan baik'),
(41, 15, 3, 'Adanya program layanan dan pembinaan kemahasiswaan dalam bidang minat, bakat, dan penalaran dan keprofesian tetpai belum terdokumentasi'),
(42, 15, 2, 'Adanya program layanan dan pembinaan kemahasiswaan dalam bidang minat dan bakat'),
(43, 15, 1, 'Tidak memiliki program layanan dan pembinaan kemahasiswaan'),
(44, 16, 4, 'Jika KD2 ≥ 20%, maka Skor 4'),
(45, 16, 3, '2 + [(20 x KD4F) / 3]'),
(46, 16, 2, 'Tidak ada nilai di bawah 2'),
(47, 16, 1, 'Tidak ada nilai di bawah 2'),
(48, 17, 4, 'Jika KD1F ≥  30%, maka skor 4'),
(49, 17, 3, 'Jika 0 KDF1F , 30%, maka skor = (200xKDF1F)/15'),
(50, 17, 2, 'Tidak ada nilai di bawah 2'),
(51, 17, 1, 'Tidak ada nilai di bawah 2'),
(52, 18, 4, 'Jika KD3 ≥  20%, maka skor 4'),
(53, 18, 3, 'Jika 0% < KD3 < 20%, maka skor = 1 + (3xKD3)/0,2'),
(54, 18, 2, 'Tidak ada nilai di bawah 2'),
(55, 18, 1, 'Tidak ada nilai di bawah 2'),
(56, 19, 4, 'Jika KD5 ≥ 40%, maka skor 4'),
(57, 19, 3, 'Jika KD5 < 40%, maka skor = 10 x KD 5'),
(58, 19, 2, 'Tidak ada nilai di bawah 2'),
(59, 19, 1, 'Tidak ada nilai di bawah 2'),
(60, 20, 4, 'Jika KDTSKA ≥ 90%, maka skor = 4'),
(61, 20, 3, 'Jika 10% < KDTSKA < 90%, maka skor = [(10 x KDTSKA) – 1] / 2'),
(62, 20, 2, 'Jika 10% < KDTSKA < 90%, maka skor = [(10 x KDTSKA) – 1] / 2'),
(63, 20, 1, 'Jika KDTSKA≤ 10%, maka skor = 0'),
(64, 21, 4, 'PS memiliki rasio DTPS: mahasiswa = 1:10 – 1:30'),
(65, 21, 3, 'PS memiliki rasio DTPS: mahasiswa = 1:31 – 1:40'),
(66, 21, 2, 'PS memiliki: rasio DTPS: mahasiswa = 1: 41 – 1:50'),
(67, 21, 1, 'PS memiliki: a. rasio DTPS: mahasiswa = 1: > 50 atau 1: < 10'),
(68, 22, 4, 'Jika PDTT ≤ 10%, maka skor = 4.'),
(69, 22, 3, 'Jika 10% < PDTT ≤ 40%, maka skor = ((-20 x PDTT) + 14) / 3'),
(70, 22, 2, 'Jika 10% < PDTT ≤ 40%, maka skor = ((-20 x PDTT) + 14) / 3'),
(71, 22, 1, 'Jika 40% < PDTT ≤100%, maka skor = [(2 – (2 x PDTT)] / 0.6'),
(72, 23, 4, 'Rata-rata BK DTPS dalam rentang 13 – 14 sks'),
(73, 23, 3, 'Rata-rata BK DTPS dalam rentang 15 – 16 sks'),
(74, 23, 2, 'Rata-rata BK DTPS = 12 sks'),
(75, 23, 1, 'Rata-rata BK DTPS dalam rentang BKDT < 12 sks atau BKDT >16 sks'),
(76, 24, 4, 'Rata-rata Kehadiran DTPS mengajar di PS sebanyak 16 minggu, termasuk ujian'),
(77, 24, 3, 'Rata-rata Kehadiran DTPS mengajar di PS sebanyak 15 minggu, termasuk ujian'),
(78, 24, 2, 'Rata-rata Kehadiran DTPS mengajar di PS sebanyak 14 minggu, termasuk ujian'),
(79, 24, 1, 'Rata-rata Kehadiran DTPS mengajar di PS sebanyak < 14 minggu, termasuk ujian.'),
(80, 25, 4, 'DTPS memiliki mahasiswa bimbingan tugas akhir sebagai pembimbing utama (gabungan skripsi, tesis, dan disertasi) 1 - 5 orang per semester.'),
(81, 25, 3, 'DTPS memiliki mahasiswa bimbingan tugas akhir sebagai pembimbing utama (gabungan skripsi, tesis, dan disertasi) 6 - 8 orang per semester'),
(84, 25, 2, 'DTPS memiliki mahasiswa bimbingan tugas akhir sebagai pembimbing utama (gabungan skripsi, tesis, dan disertasi) 9 - 10 orang per semester.'),
(85, 25, 1, 'DTPS memiliki mahasiswa bimbingan tugas akhir (gabungan skripsi, tesis, dan disertasi) sebanyak > 10 orang.'),
(86, 26, 4, '≥ 30% DTPS memiliki prestasi yang diakui oleh pihak lain '),
(87, 26, 3, '20% ≤ DTPS < 30% memiliki prestasi yang diakui oleh pihak lain'),
(88, 26, 2, '10% ≤ DTPS < 20% memiliki prestasi yang diakui oleh pihak lain '),
(89, 26, 1, '< 10% DTPS memiliki prestasi yang diakui oleh pihak la'),
(90, 27, 4, '≥ 60% DTPS mengikuti kegiatan keprofesian berkelanjutan pada TS'),
(91, 27, 3, '35% ≤ DTPS < 60% mengikuti kegiatan keprofesian berkelanjutan pada TS'),
(92, 27, 2, '20% ≤ DTPS <35% mengikuti kegiatan keprofesian berkelanjutan pada TS'),
(93, 27, 1, '< 20% DTPS mengikuti kegiatan keprofesian berkelanjutan pada TS'),
(94, 28, 4, 'a. memiliki kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS b. menyosialisasikan kepada sivitas akademika dengan sangat baik c. melaksanakan secara sangat konsisten d. Mengevaluasi secara berkala e. menindaklanjuti hasil ev'),
(95, 28, 3, 'a. memiliki kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS b. menyosialisasikan kepada sivitas akademika dengan sangat baik c. melaksanakan secara sangat konsisten d. Mengevaluasi secara berkala'),
(96, 28, 2, 'a. memiliki kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS b. menyosialisasikan kepada sivitas akademika dengan sangat baik c. melaksanakan secara sangat konsisten'),
(97, 28, 1, 'a.memiliki kebijakan tentang penyusunan, pelaksanaan, evaluasi, dan perbaikan kurikulum PS b. tidak melaksanakan secara konsisten'),
(98, 29, 4, 'UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana, pemberian pendampingan, dan penyediaan pakar yang relevan.'),
(99, 29, 3, 'UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana dan pemberian pendampingan'),
(100, 29, 2, 'UPPS memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya, dalam bentuk pemberian dana.'),
(101, 29, 1, 'UPPS tidak memberikan dukungan kepada PS untuk menyusun, melaksanakan, mengevaluasi, dan memperbaiki kurikulumnya.'),
(102, 30, 1, 'Evaluasi dan pemutakhiran kurikulum tidak melibatkan seluruh pemangku  kepentingan internal'),
(103, 30, 2, 'Evaluasi dan pemutakhiran kurikulum melibatkan pemangku kepentingan'),
(104, 30, 3, 'Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal '),
(105, 30, 4, 'Evaluasi dan pemutakhiran kurikulum secara berkala tiap 4 s.d. 5 tahun yang melibatkan pemangku kepentingan internal dan eksternal'),
(106, 31, 4, 'PS memiliki dokumen kurikulum yang: a. sangat lengkap, b. sangat koheren, c. sangat relevan, d. sangat mutakhir'),
(107, 31, 3, '	PS memiliki dokumen kurikulum yang: a. sangat lengkap, b. sangat koheren, c. relevan, d. mutakhir'),
(108, 31, 2, 'PS memiliki dokumen kurikulum yang: a. lengkap, b. koheren, c. relevan, d. mutakhir'),
(109, 31, 1, '	PS memiliki dokumen kurikulum yang: a. tidak lengkap, b. tidak koheren, c. tidak relevan, d. tidak mutakhir'),
(110, 33, 4, 'Capaian pembelajaran diturunkan dari profil lulusan, mengacu pada hasil kesepakatan dengan asosiasi penyelenggara program studi sejenis dan organisasi profesi, dan memenuhi level KKNI, serta dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkemba'),
(111, 33, 3, 'Capaian pembelajaran diturunkan dari profil lulusan, memenuhi level KKNI, dan dimutakhirkan secara berkala tiap 4 s.d. 5 tahun sesuai perkembangan ipteks atau kebutuhan pengguna'),
(112, 33, 2, 'Capaian pembelajaran diturunkan dari profil lulusan dan memenuhi level KKNI'),
(113, 33, 1, 'Capaian pembelajaran diturunkan dari profil lulusan dan tidak memenuhi level KKNI.'),
(114, 34, 4, 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah, serta tidak ada capaian pembe'),
(115, 34, 3, 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas, capaian pembelajaran lulusan dipenuhi oleh seluruh capaian pembelajaran matakuliah'),
(116, 34, 2, 'Struktur kurikulum memuat keterkaitan antara matakuliah dengan capaian pembelajaran lulusan yang digambarkan dalam peta kurikulum yang jelas.'),
(117, 34, 1, 'Struktur kurikulum tidak sesuai dengan capaian pembelajaran lulusan'),
(118, 35, 4, '≥ 75 % DTPS melakukan kegiatan pembelajaran yang sesuai dengan RPS, dan memiliki sifat interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa,'),
(119, 35, 3, '50%≤DTPS < 75% melakukan kegiatan pembelajaran yang sesuai dengan RPS, dan memiliki sifat interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa'),
(120, 35, 2, '25%≤DTPS<50%   melakukan kegiatan pembelajaran yang sesuai dengan RPS, dan  memiliki sifat interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa'),
(121, 35, 1, '<25% DTPS melakukan kegiatan pembelajaran yang sesuai dengan RPS, dan memiliki sifat interaktif, holistik, integratif, saintifik, kontekstual, tematik, efektif, kolaboratif, dan berpusat pada mahasiswa'),
(122, 36, 4, 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa, dilaksanakan secara konsisten'),
(123, 36, 3, 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala serta dapat diakses oleh mahasiswa'),
(124, 36, 2, 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran. RPS ditinjau dan disesuaikan secara berkala.'),
(125, 36, 1, 'Dokumen RPS mencakup target capaian pembelajaran, bahan kajian, metode pembelajaran, waktu dan tahapan, asesmen hasil capaian pembelajaran atau tidak semua matakuliah memiliki RPS.'),
(126, 37, 4, 'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala'),
(127, 37, 3, 'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan'),
(128, 37, 2, 'Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan'),
(129, 37, 1, 'Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan.'),
(130, 38, 4, 'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen,mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on- line dan off-line dalam bentuk audio-visual terdokumentasi.'),
(131, 38, 3, 'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu secara on-line dan off-line.'),
(132, 38, 2, 'Pelaksanaan pembelajaran berlangsung dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu.'),
(133, 38, 1, 'Pelaksanaan pembelajaran berlangsung hanya sebagian dalam bentuk interaksi antara dosen, mahasiswa, dan sumber belajar dalam lingkungan belajar tertentu'),
(134, 39, 4, 'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik dan digunakan un'),
(135, 39, 3, 'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk menjamin kesesuaian dengan RPS dalam rangka menjaga mutu proses pembelajaran. Hasil monev terdokumentasi dengan baik.'),
(136, 39, 2, 'Memiliki bukti sahih adanya sistem dan pelaksanaan pemantauan proses pembelajaran yang dilaksanakan secara periodik untuk mengukur kesesuaian terhadap RPS'),
(137, 39, 1, 'Memiliki bukti sahih adanya sistem pemantauan proses pembelajaran namun tidak dilaksanakan secara konsisten'),
(138, 40, 4, 'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan, serta ditinjau ulang secara berkala'),
(139, 40, 3, 'Isi materi pembelajaran sesuai dengan RPS, memiliki kedalaman dan keluasan yang relevan untuk mencapai capaian pembelajaran lulusan'),
(140, 40, 2, 'Isi materi pembelajaran memiliki kedalaman dan keluasan sesuai dengan capaian pembelajaran lulusan'),
(141, 40, 1, 'Isi materi pembelajaran memiliki kedalaman dan keluasan namun sebagian tidak sesuai dengan capaian pembelajaran lulusan'),
(142, 41, 4, '≥ 50 % DTPS mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran'),
(143, 41, 3, '30%≤DTPS < 50% mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran'),
(144, 41, 2, '10%≤DTPS < 30% mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran'),
(145, 41, 1, '10%mengintegrasikan hasil penelitian dan/atau PkM dalam pembelajaran'),
(146, 42, 4, 'Terdapat bukti sahih yang menunjukkan  metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 75% s.d. 100% mata kuliah'),
(147, 42, 3, 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 50 s.d. < 75% mata kuliah.'),
(148, 42, 2, 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada 25 s.d. < 50% mata kuliah.'),
(149, 42, 1, 'Terdapat bukti sahih yang menunjukkan metode pembelajaran yang dilaksanakan sesuai dengan capaian pembelajaran yang direncanakan pada < 25% mata kuliah'),
(150, 43, 4, '≥ 75 % DTPS melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap'),
(151, 43, 3, '50%≤DTPS < 75% melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap'),
(152, 43, 2, '25%≤DTPS < 50% melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap.'),
(153, 43, 1, '< 25% melaksanakan penilaian pembelajaran dalam satu semester, yaitu UTS dan UAS, dengan menggunakan teknik penilaian yang beragam dan dilengkapi dengan perangkat yang lengkap'),
(154, 44, 4, 'UPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten dan ditindak lanjuti'),
(155, 44, 3, 'UPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa yang dilaksanakan secara konsisten'),
(156, 44, 2, 'UPS memiliki bukti sahih tentang sistem dan pelaksanaan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa'),
(157, 44, 1, 'UPS telah melaksanakan monitoring dan evaluasi proses pembelajaran mencakup karakteristik, perencanaan, pelaksanaan, proses pembelajaran dan beban belajar mahasiswa namun tidak semua didukung bukti sahih.'),
(158, 45, 4, 'PS melakukan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen dan memenuhi aspek 1 s.d 6.'),
(159, 45, 3, 'PS melakukan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen dan memenuhi aspek 1 s.d 4'),
(160, 45, 2, 'PS melakukan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen dan memenuhi aspek 1 dan 3'),
(161, 45, 1, 'PS tidak melakukan pengukuran kepuasan mahasiswa terhadap kinerja mengajar dosen.'),
(162, 46, 4, 'Kegiatan ilmiah yang terjadwal dilaksanakan setiap bulan'),
(163, 46, 3, 'Kegiatan ilmiah yang terjadwal dilaksanakan dua s.d tiga bulan sekali'),
(164, 46, 2, 'Kegiatan ilmiah yang terjadwal dilaksanakan empat s.d. enam bulan sekali.'),
(165, 46, 1, 'Kegiatan ilmiah yang terjadwal dilaksanakan lebih dari enam bulan sekali'),
(166, 47, 4, 'PA memberikan bimbingan akademik kepada mahasiswa: a. sebanyak ≥ 3 kali dalam satu semester, b. terdokumentasi dengan sangat baik.'),
(167, 47, 3, 'PA memberikan bimbingan akademik kepada mahasiswa: a. sebanyak 2 kali dalam satu semester, b. terdokumentasi dengan baik.'),
(168, 47, 2, 'PA memberikan bimbingan akademik kepada mahasiswa: a. sebanyak 1 kali dalam satu semester, b. terdokumentasi secara baik. '),
(169, 47, 1, 'PA memberikan bimbingan akademik kepada mahasiswa: a. sebanyak 1 kali dalam satu semester, b. tidak terdokumentasi.'),
(170, 48, 4, 'Dosen pembimbing memberikan bimbingan magang kependidikan: a. sebanyak ≥ 3 kali dalam satu kegiatan magang, b. terdokumentasi dengan sangat baik.'),
(171, 48, 3, 'Dosen pembimbing memberikan bimbingan magang kependidikan: a. sebanyak 2 kali dalam satu kegiatan magang, b. terdokumentasi dengan baik.'),
(172, 48, 2, 'Dosen pembimbing memberikan bimbingan magang kependidikan: a. sebanyak 1 kali dalam satu kegiatan magang, b. terdokumentasi dengan baik.'),
(173, 48, 1, 'Dosen pembimbing tidak memberikan bimbingan magang kependidikan, tetapi hanya menguji di akhir masa magang.'),
(174, 49, 4, 'Dosen pembimbing tugas akhir/skripsi memberikan bimbingan kepada mahasiswa: a. sebanyak ≥ 12 kali, b. terdokumentasi dengan sangat baik.'),
(175, 49, 3, 'Dosen pembimbing tugas akhir/skripsi memberikan bimbingan kepada mahasiswa: a. sebanyak 8-11 kali, b. terdokumentasi dengan baik.'),
(176, 49, 2, 'Dosen pembimbing tugas akhir/skripsi memberikan bimbingan kepada mahasiswa: a. sebanyak 4-7 kali, b. terdokumentasi dengan baik.'),
(177, 49, 1, 'Dosen pembimbing tugas akhir/skripsi memberikan bimbingan kepada mahasiswa: a. sebanyak ≤ 5 kali, b. tidak terdokumentasi'),
(178, 50, 4, 'PS memiliki RG dan  RM penelitian dan PkM yang sangat jelas dan sangat relevan dengan VMTS PS.'),
(179, 50, 3, 'PS memiliki RG dan RM penelitian dan PkM yang jelas dan relevan dengan VMTS PS.'),
(180, 50, 2, 'PS memiliki RG atau RM penelitian dan PkM, yang relevan dengan VMTS PS.'),
(181, 50, 1, 'PS tidak memiliki RG dan  RM penelitian dan PkM.'),
(182, 51, 4, 'Jika RI ≥ a, maka Skor = 4'),
(183, 51, 3, 'Jika RI < a dan RN ≥ b, maka Skor = 3 + (RI / a)'),
(184, 51, 2, 'Jika 0 < RI < a dan 0 < RN < b, maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b))'),
(185, 51, 1, 'Jika RI = 0 dan RN = 0 dan RL ≥ c, maka Skor = 2 Jika RI = 0 dan RN = 0 dan RL < c, maka Skor = (2 x RL) / c'),
(186, 52, 4, '≥ 75% penelitian DTPS melibatkan mahasiswa, pada saat TS'),
(187, 52, 3, '51-75% penelitian DTPS melibatkan mahasiswa, pada saat TS'),
(188, 52, 2, '25-50% penelitian DTPS melibatkan mahasiswa, pada saat TS'),
(189, 52, 1, '< 25% penelitian DTPS melibatkan mahasiswa, pada saat TS'),
(190, 53, 4, 'PPkMDM ≥ 25%, maka Skor = 4'),
(191, 53, 3, 'Jika PPkMDM < 25%, maka Skor = 1 + (12 x PPkMDM)'),
(192, 54, 4, '≥ 75% PkM DTPS melibatkan mahasiswa, pada saat TS'),
(193, 54, 3, '51-75% PkM DTPS melibatkan mahasiswa, pada saat TS'),
(194, 54, 1, '25-50% PkM DTPS melibatkan mahasiswa, pada saat TS'),
(195, 54, 1, '< 25% PkM DTPS melibatkan mahasiswa, pada saat TS'),
(196, 55, 4, 'Mahasiswa regular memiliki rerata IPK 3,01 – 4,00.'),
(197, 55, 3, 'Mahasiswa regular memiliki rerata IPK 2,51 – 3,00,'),
(198, 55, 2, 'Mahasiswa regular memiliki rerata IPK 2,00 – 2,50'),
(199, 55, 1, 'Tidak ada Skor 1'),
(200, 56, 4, 'Jika (RI ≥ a dan RN > 0) maka Skor = 4.'),
(201, 56, 3, 'Jika RI ≥ a dan RN = 0 , maka Skor = 3,5'),
(202, 56, 2, 'Jika RI < a dan RN ≥ b , maka Skor = 3 + (RI / a) Jika 0 < RI < a dan 0 < RN < b , maka Skor = 2 + (2 x (RI/a)) + (RN/b) - ((RI x RN)/(a x b)).'),
(203, 56, 1, 'Jika RI = 0 dan RN = 0 dan RW ≥ c , maka Skor = 2. Jika RI = 0 dan RN = 0 dan RW < c , maka Skor = (2 x RW) / c.'),
(204, 57, 4, 'Mahasiswa regular memiliki rerata masa studi < 5 tahun'),
(205, 57, 3, 'Mahasiswa regular memiliki rerata masa studi 5 – 6 tahun'),
(206, 57, 2, 'Mahasiswa regular memiliki rerata masa studi 6 – 7 tahun'),
(207, 57, 1, 'Tidak ada Skor 1'),
(208, 58, 4, 'STW ≥ 40%'),
(209, 58, 3, '20% < STW < 40%'),
(210, 58, 2, '10% < STW < 20%'),
(211, 58, 1, 'STW < 10%'),
(212, 59, 4, 'KSM ≥ 90%'),
(213, 59, 3, '75% < KSM < 90%'),
(214, 59, 2, '50% < KSM < 75%'),
(215, 59, 1, 'KSM < 50%'),
(216, 60, 4, 'Jika PFT ≥ 80%, maka skor = 4'),
(217, 60, 3, 'Jika 20% < PFT< 80%, maka skor = (20 x PFT – 4)/3.'),
(218, 60, 2, 'Jika 20% < PFT< 80%, maka skor = (20 x PFT – 4)/3.'),
(220, 60, 1, 'PFT ≤ 20%, maka skor = 0.'),
(221, 61, 4, 'Jika RI ≥ a atau RN > b, maka Skor = 4'),
(222, 61, 3, 'Jika RI = 0 dan 0 < RN < b , maka Skor = 3 + (RN/b)'),
(223, 61, 2, 'Jika 0 < RI < a dan RN = 0 , maka Skor = 3 + (RI / a)'),
(224, 61, 1, 'Jika 0 < RI < a dan 0 < RN < b , maka Skor = maks[3 + (RI / a), 3 + (RN/b)]. Jika RI = 0 dan RN = 0 dan RL ≥ c, maka Skor = 2. Jika RI = 0 dan RN = 0 dan RL < c, maka Skor = (2 x RL) / c.'),
(225, 62, 4, 'Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa ≥ 50'),
(226, 62, 3, '30  Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa < 50'),
(227, 62, 2, '10 < Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa < 30'),
(228, 62, 1, 'Rerata jumlah sitasi karya ilmiah DTPS dan mahasiswa < 10'),
(229, 63, 4, 'jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat > 10'),
(230, 63, 3, '7 < jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat < 10'),
(231, 63, 2, '4 < jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat < 7'),
(232, 63, 1, 'jumlah karya DTPS dan/atau mahasiswa yang diadopsi oleh masyarakat < 3'),
(233, 64, 4, 'HKI/Paten-DTPS dan/atau mahasiswa ≥ 8'),
(234, 64, 3, '4 < HKI/Paten-DTPS dan/atau mahasiswa < 8'),
(235, 64, 2, '0 < HKI/Paten-DTPS dan/atau mahasiswa < 3'),
(236, 64, 1, 'Tidak ada Skor 1');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `form_link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `role`, `message`, `is_read`, `created_at`, `form_link`) VALUES
(3, 'auditee', 'Form audit Anda untuk standar \'Dokumen analisis SWOT yang relevan\' di Farmasi tahun 2024 telah diterima. Klik link berikut untuk melihat detail: <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi\'>Lihat Form</a>', 1, '2024-12-21 15:26:28', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi'),
(4, 'auditee', 'Form audit Anda untuk standar \'Dokumen analisis SWOT yang relevan\' di Farmasi tahun 2024 telah ditolak. Catatan: kurang. Klik link berikut untuk melihat detail: <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi\'>Lihat Form</a>', 1, '2024-12-22 04:32:30', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi'),
(5, 'auditee', 'Form audit Anda untuk standar \'Dokumen analisis SWOT yang relevan\' di Analisis Kesehatan tahun 2024 telah ditolak. Catatan: aaaa. Klik link berikut untuk melihat detail: <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Analisis Kesehatan\'>Lihat Form</a>', 1, '2024-12-22 04:41:05', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Analisis Kesehatan'),
(6, 'auditee', 'Form audit Anda untuk standar \'Dokumen bukti penilaian untuk semua dokumen yang diaudit\' di Analisis Kesehatan tahun 2024 telah diterima. Klik link berikut untuk melihat detail: <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Analisis Kesehatan\'>Lihat Form</a>', 1, '2024-12-22 04:45:52', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Analisis Kesehatan'),
(7, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"Dokumen analisis SWOT yang relevan\" pada prodi Farmasi tahun . <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=4&tahun=2024&prodi=Farmasi\'>Lihat dokumen</a>', 1, '2024-12-22 04:57:11', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=4&tahun=2024&prodi=Farmasi'),
(8, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 04:59:19', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(9, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 05:01:24', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(10, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 05:02:59', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(11, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 05:03:24', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(12, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 05:04:18', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(13, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"Dokumen bukti penilaian untuk semua dokumen yang diaudit\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 05:07:57', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(14, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"Dokumen analisis SWOT yang relevan\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 05:08:16', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(15, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"Tersedianya dokumen VMTS UPPS/PS yang sangat jelas, sangat realistis dan memiliki pengesahan yang dilengkapi dengan:\" pada prodi Analisis Kesehatan tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan\'>Lihat dokumen</a>', 1, '2024-12-22 05:08:38', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=3&tahun=2024&prodi=Analisis+Kesehatan'),
(16, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"Dokumen bukti penilaian untuk semua dokumen yang diaudit\" pada prodi Farmasi tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=4&tahun=2024&prodi=Farmasi\'>Lihat dokumen</a>', 1, '2024-12-22 05:09:06', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=4&tahun=2024&prodi=Farmasi'),
(17, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"e. Dokumen VMTS UPPS/PS memiliki keselarasan dengan VMTS PT\" pada prodi Farmasi tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=6&tahun=2024&prodi=Farmasi\'>Lihat dokumen</a>', 1, '2024-12-24 02:55:13', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=6&tahun=2024&prodi=Farmasi'),
(18, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"e. Dokumen VMTS UPPS/PS memiliki keselarasan dengan VMTS PT\" pada prodi Farmasi tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=6&tahun=2024&prodi=Farmasi\'>Lihat dokumen</a>', 1, '2024-12-24 02:57:30', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=6&tahun=2024&prodi=Farmasi'),
(19, 'auditee', 'Form audit Anda untuk standar \'e. Dokumen VMTS UPPS/PS memiliki keselarasan dengan VMTS PT\' di Farmasi tahun 2024 telah diterima. Klik link berikut untuk melihat detail: <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi\'>Lihat Form</a>', 1, '2024-12-24 02:58:20', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi'),
(20, 'auditor', 'Auditee telah mengunggah dokumen untuk standar \"a. Dokumen panduan penyusunan VMTS\" pada prodi Farmasi tahun 2024. <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi\'>Lihat dokumen</a>', 1, '2025-01-03 09:46:46', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi'),
(21, 'auditee', 'Form audit Anda untuk standar \'a. Dokumen panduan penyusunan VMTS\' di Farmasi tahun 2024 telah diterima. Klik link berikut untuk melihat detail: <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi\'>Lihat Form</a>', 1, '2025-01-03 09:47:58', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi'),
(22, 'auditee', 'Form audit Anda untuk standar \'Tersedianya dokumen VMTS UPPS/PS yang sangat jelas, sangat realistis dan memiliki pengesahan yang dilengkapi dengan:\' di Farmasi tahun 2024 telah diterima. Klik link berikut untuk melihat detail: <a href=\'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi\'>Lihat Form</a>', 1, '2025-01-04 10:44:52', 'http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=&tahun=2024&prodi=Farmasi');

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaan`
--

CREATE TABLE `pelaksanaan` (
  `id_pelaksanaan` int(11) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `auditor` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Ditutup','Dibuka') DEFAULT 'Ditutup',
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelaksanaan`
--

INSERT INTO `pelaksanaan` (`id_pelaksanaan`, `fakultas`, `prodi`, `auditor`, `keterangan`, `status`, `tahun`) VALUES
(6, 'Ilmu Kesehatan', 'Farmasi', 'Misyanto, M.Pd', 'Baik Sekali', 'Dibuka', 2024),
(7, 'Ilmu Kesehatan', 'Analisis Kesehatan', 'Misyanto, M.Pd', 'Baik', 'Dibuka', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
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
-- Table structure for table `standar`
--

CREATE TABLE `standar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `standar`
--

INSERT INTO `standar` (`id`, `nama`, `tahun`) VALUES
(4, 'standar 4: jurusanm', 2023),
(8, 'Standar 1: Identitas', 2024),
(9, 'Standar 2: Kemahasiswaan', 2024),
(10, 'Standar 3: Sumber Daya Manusia', 2024),
(11, 'Standar 4: Kurikulum', 2024),
(12, 'Standar 5: Penelitian dan Pengabdian kepada Masyarakat', 2024),
(13, 'Standar 6: Luaran dan Capaian Tridharma', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `standar_audit`
--

CREATE TABLE `standar_audit` (
  `id` int(11) NOT NULL,
  `nama_standar` varchar(255) NOT NULL,
  `tahun` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `standar_audit`
--

INSERT INTO `standar_audit` (`id`, `nama_standar`, `tahun`) VALUES
(4, 'Standar 4 Analisis SWOT', 2023),
(10, 'sss', 2021),
(14, 'Standar 1 Identitas ', 2024),
(15, 'Standar 2 Kemahasiswaan', 2024),
(16, 'Standar 3 Sumber Daya Manusia', 2024),
(17, 'Standar 4. Kurikulum', 2024);

-- --------------------------------------------------------

--
-- Table structure for table `sub_standar`
--

CREATE TABLE `sub_standar` (
  `id` int(11) NOT NULL,
  `standar_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_standar`
--

INSERT INTO `sub_standar` (`id`, `standar_id`, `nama`) VALUES
(1, 1, '1. Visi dan Misi'),
(2, 2, '1. Kualitas Inpit'),
(3, 1, '2. Tujuan, Sasaran, dan Strategi'),
(4, 2, '2 Animo Mahasiswa'),
(6, 8, 'Visi dan Misi'),
(7, 8, 'Tujuan, Sasaran, dan Stratgei Pencapaian'),
(8, 9, '1: Kualitas Input'),
(9, 9, '2: Animo Mahasiswa'),
(10, 9, '3: Layanan Kemahasiswaan'),
(11, 10, '1: Kualifikasi DTPS'),
(12, 10, '2: Rasio Dosen'),
(13, 10, '3: Kinerja DTPS'),
(14, 10, '4: pengembangan Kompetensi DTPS'),
(15, 11, '1: Kebijakan Pengembangan Kurikulum'),
(16, 11, '2: Pengembangan Kurikulum'),
(17, 11, '3: Dokumen Kurikulum PS'),
(18, 11, '4: Kesesuaian Pembelajaran dengan RPS'),
(19, 11, '5: Pelaksanaan Proses Pembelajaran'),
(20, 11, '6: Integrasi Hasil Penelitian PkM'),
(21, 11, '7: Penilaian Pembelajaran'),
(22, 11, '8: Monitoring dan Evaluasi Proses Pembelajaran'),
(23, 11, '9: Suasana Akademik'),
(24, 12, '1. Penelitian dan Pengabdian'),
(25, 13, '1: Luaran dan Capaian Tri Dharma');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_dokumen`
--
ALTER TABLE `audit_dokumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `audit_soal`
--
ALTER TABLE `audit_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gkm_ami`
--
ALTER TABLE `gkm_ami`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `indikator`
--
ALTER TABLE `indikator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_ami`
--
ALTER TABLE `jadwal_ami`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_indikator`
--
ALTER TABLE `nilai_indikator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD PRIMARY KEY (`id_pelaksanaan`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `standar`
--
ALTER TABLE `standar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standar_audit`
--
ALTER TABLE `standar_audit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_standar`
--
ALTER TABLE `sub_standar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_dokumen`
--
ALTER TABLE `audit_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `audit_soal`
--
ALTER TABLE `audit_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `indikator`
--
ALTER TABLE `indikator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `jadwal_ami`
--
ALTER TABLE `jadwal_ami`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_indikator`
--
ALTER TABLE `nilai_indikator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  MODIFY `id_pelaksanaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `standar`
--
ALTER TABLE `standar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `standar_audit`
--
ALTER TABLE `standar_audit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sub_standar`
--
ALTER TABLE `sub_standar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
