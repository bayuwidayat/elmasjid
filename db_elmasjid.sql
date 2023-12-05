-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2023 at 02:34 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elmasjid`
--

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(5) NOT NULL,
  `nm_agenda` varchar(150) NOT NULL,
  `agenda_seo` varchar(200) NOT NULL,
  `isi_agenda` text NOT NULL,
  `tempat` varchar(150) NOT NULL,
  `koordinator` varchar(100) NOT NULL,
  `telp_koordinator` varchar(25) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `jam` varchar(25) NOT NULL,
  `dibaca` int(5) NOT NULL,
  `created_by` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agenda`
--

INSERT INTO `agenda` (`id_agenda`, `nm_agenda`, `agenda_seo`, `isi_agenda`, `tempat`, `koordinator`, `telp_koordinator`, `gambar`, `tgl_mulai`, `tgl_selesai`, `jam`, `dibaca`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Daftar Ulang Awal Tahun Ajaran Baru', 'daftar-ulang-awal-tahun-ajaran-baru', '<p>Penjelasan Daftar Ulang Awal Tahu ajaran baru. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua consectetur id. Aenean sit amet massa eu velit commodo cursus fringilla a tellus. Morbi eros urna, mollis porta feugiat non, ornare eu augue. Sed rhoncus est sit amet diam tempus, et tristique est vive, sectur at dapibus id.</p><p>Aenean sit amet massa eu velit commodo cursus fringilla a tellus. Morbi eros urna, mollis porta feugiat non, ornare eu augue. Sed rhoncus est sit amet diam tempus, et tristique est vive, sectur at dapibus id.</p>', 'Ruang Aula Sekolah', 'Bayuwi', '', '', '2022-07-01', '2022-07-01', '09.00 s/d 12.00 WIB', 0, 'bayuwi', '2022-06-29 20:23:58', 'bayuwi', '2022-06-29 20:25:00'),
(2, 'Awalussanah Tahun Ajaran 2022/2023', 'awalussanah-tahun-ajaran-20222023', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua consectetur id. Aenean sit amet massa eu velit commodo cursus fringilla a tellus. Morbi eros urna, mollis porta feugiat non, ornare eu augue. Sed rhoncus est sit amet diam tempus, et tristique est vive, sectur at dapibus id.</p><p>Aenean sit amet massa eu velit commodo cursus fringilla a tellus. Morbi eros urna, mollis porta feugiat non, ornare eu augue. Sed rhoncus est sit amet diam tempus, et tristique est vive, sectur at dapibus id.</p>', 'Ruang Aula Sekolah', 'Bayuwi', '', '', '2022-07-09', '2022-07-09', '08.00 s/d 12.00 WIB', 0, 'bayuwi', '2022-06-29 20:26:26', '', NULL),
(3, 'Masa Pengenalan Lingkungan Sekolah', 'masa-pengenalan-lingkungan-sekolah', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua consectetur id. Aenean sit amet massa eu velit commodo cursus fringilla a tellus. Morbi eros urna, mollis porta feugiat non, ornare eu augue. Sed rhoncus est sit amet diam tempus, et tristique est vive, sectur at dapibus id.</p><p>Aenean sit amet massa eu velit commodo cursus fringilla a tellus. Morbi eros urna, mollis porta feugiat non, ornare eu augue. Sed rhoncus est sit amet diam tempus, et tristique est vive, sectur at dapibus id.</p>', 'Kelas Masing-masing', 'Bayu wi', '', '1658473559_6e59898aafe2da84dc0d.jpg', '2022-07-11', '2022-07-15', '08.00 s/d 12.00 WIB', 0, 'bayuwi', '2022-06-29 20:28:44', 'bayuwi', '2022-07-22 14:11:37');

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(5) NOT NULL,
  `nm_album` varchar(50) NOT NULL,
  `album_seo` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `hits` int(11) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `nm_album`, `album_seo`, `keterangan`, `gambar`, `aktif`, `hits`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Aksi Bela Palestina', 'aksi-bela-palestina', 'Aksi Bela Palestina', 'aksi-bela-palestina---detikcom.jpeg', 'Y', 0, 'admin', '2023-12-05 09:29:23', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(5) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `judul` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `youtube` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `judul_seo` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `headline` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `isi_berita` longtext CHARACTER SET latin1 NOT NULL,
  `keterangan_gambar` text COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tag` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `status` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'Y',
  `tipe` enum('berita','blog','tausiyah') COLLATE latin1_general_ci NOT NULL DEFAULT 'berita',
  `hits` int(11) NOT NULL,
  `created_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id_berita`, `id_kategori`, `judul`, `youtube`, `judul_seo`, `headline`, `aktif`, `isi_berita`, `keterangan_gambar`, `gambar`, `tag`, `status`, `tipe`, `hits`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(25, 6, 'Aliquam finibus imperdiet dolor et tristique', '', 'aliquam-finibus-imperdiet-dolor-et-tristique', 'Y', 'Y', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum at diam feugiat orci luctus commodo et vitae est. Donec ut ante mattis, placerat urna eget, egestas neque. Aliquam euismod interdum arcu id mollis. Phasellus lectus quam, porta quis lacus sed, accumsan luctus nibh. Praesent et risus quam. Etiam pharetra placerat turpis pharetra tempus. Pellentesque lectus tellus, pulvinar sit amet tincidunt nec, pharetra ut tellus. Nullam pretium pretium tellus a rhoncus. Morbi blandit lacus velit, vel luctus nibh pretium eu. Proin sem leo, congue ut tempor quis, ullamcorper at velit. Donec vehicula eget ex non vehicula. Etiam a ante quis erat bibendum mollis in eu ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;</p><p>Vestibulum accumsan maximus nulla, at dignissim mauris malesuada eget. Vestibulum ac velit ut turpis gravida vulputate eu vel nibh. Fusce a suscipit mi. Mauris aliquet, velit vitae accumsan ullamcorper, ipsum ipsum dapibus urna, non elementum magna nunc et nibh. Morbi posuere urna nec nibh consectetur euismod. Praesent tellus eros, malesuada quis ipsum sit amet, ultrices venenatis metus. Ut rutrum bibendum dapibus. Proin odio tellus, efficitur at malesuada quis, dapibus ut ex. Aliquam finibus imperdiet dolor et tristique. Fusce tempor viverra vulputate. Praesent dapibus ipsum quis feugiat congue. Maecenas sit amet sollicitudin sem. Vivamus ac metus iaculis, aliquam ligula vel, rhoncus erat.</p><p>Quisque tincidunt vulputate augue nec malesuada. Nullam efficitur velit in nulla facilisis, vel placerat turpis fermentum. Fusce mattis neque vitae euismod faucibus. Nullam sem tortor, tempor in eros non, laoreet condimentum risus. Mauris eu ipsum nec lorem bibendum pellentesque. Phasellus bibendum mi et dignissim varius. Donec non molestie ex, ac viverra nulla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet fermentum lacus. Praesent nisi nibh, gravida at luctus quis, commodo sed quam. Curabitur vestibulum, velit ut tempus condimentum, nisi sem condimentum tellus, ut condimentum nisi sem ultricies sem. Suspendisse quis magna sapien.</p>', '', '70-1.jpg', 'lorem,ipsum', 'Y', 'berita', 1, 'admin', '2023-09-30 12:59:20', '', '2023-09-30 13:44:31'),
(26, 7, 'Integer sit amet placerat neque. Suspendisse potenti', '', 'integer-sit-amet-placerat-neque-suspendisse-potenti', 'Y', 'Y', '<p>Aliquam sem ante, aliquam at pellentesque a, fermentum vel felis. Morbi mollis risus sed lectus tincidunt ornare. Integer vitae diam enim. Praesent tempor facilisis nisl, sit amet tincidunt odio viverra in. Ut nec blandit dolor. Sed est nibh, vulputate non dictum in, sollicitudin id mi. Cras mattis tellus vel est aliquet, eu viverra tortor rutrum. Ut in placerat nisl, ac condimentum elit. Curabitur et sem vitae sem tincidunt ultricies et vel elit. Phasellus vehicula vel purus in tempus. Integer sed sodales urna.</p><p>Cras rutrum felis ac lacus vulputate, vel pellentesque enim efficitur. Integer lorem mi, sodales sed arcu ac, pharetra bibendum orci. Suspendisse eu interdum quam. Phasellus ipsum sem, sollicitudin faucibus ullamcorper eget, consectetur eu ligula. Ut ultrices arcu eu interdum sagittis. Vivamus lorem justo, tincidunt eu tincidunt ut, ultrices sed est. Phasellus laoreet non eros non dapibus. Vestibulum eget mauris sed odio convallis suscipit quis vitae augue. Nulla posuere felis nisl, at consectetur turpis finibus eu. Sed aliquet id metus quis tempus. Morbi pellentesque odio vel nunc dapibus pretium. In elementum felis purus, sed commodo orci interdum a.</p><p>Integer sit amet placerat neque. Suspendisse potenti. Suspendisse tristique enim imperdiet vestibulum rutrum. Mauris tincidunt nibh lacus, sed aliquet nibh rutrum in. Aenean egestas dolor eu nisi efficitur, non finibus lectus aliquet. In euismod vulputate turpis. Cras tempor leo ac diam accumsan, et sagittis enim lobortis. Cras laoreet gravida quam id pulvinar. Nulla euismod iaculis nulla quis vehicula. Vivamus in mauris congue, porta diam et, vehicula nunc. Vestibulum nec tincidunt quam. Curabitur tempor nisi nec lacinia commodo. Nam augue augue, tempus quis dolor in, ultricies euismod massa.</p>', '', '69-2.jpg', '', 'Y', 'berita', 1, 'admin', '2023-09-30 13:28:41', '', '2023-09-30 13:44:35'),
(27, 8, 'Curabitur placerat massa sit amet dui lobortis cursus', '', 'curabitur-placerat-massa-sit-amet-dui-lobortis-cursus', 'Y', 'Y', '<p>Nam mi dolor, semper eget lorem a, pellentesque egestas sapien. Nullam viverra tristique neque ut viverra. Mauris sagittis purus id scelerisque bibendum. Donec at euismod nisl. Aenean ultrices faucibus odio ac semper. Cras fringilla maximus ligula eu varius. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus bibendum, ligula in dictum euismod, nunc odio ultrices ipsum, ut vehicula erat dui quis eros. Pellentesque vel neque id velit pellentesque ultrices. Mauris blandit ante non tortor efficitur consequat.</p><p>Curabitur id fermentum arcu. Maecenas vel lectus nec dolor condimentum lobortis ac et arcu. Cras nec pulvinar ligula. Nullam risus velit, posuere ac tellus et, pharetra aliquet sapien. Nullam vel aliquam dui, ut consequat eros. Ut laoreet feugiat metus, ut semper diam rutrum nec. Vestibulum feugiat ultrices nibh, non pharetra metus. Morbi non leo id nibh aliquam condimentum. Vivamus volutpat ac ex ac dignissim. Proin sed ex nunc. Vivamus at sodales massa. Cras nec turpis nunc. Proin eleifend quis elit sed rutrum. Curabitur nisi metus, mollis at ligula in, porta scelerisque lectus. Vestibulum maximus dui non lorem consequat, et consectetur sapien ullamcorper. Morbi vestibulum ipsum a condimentum tincidunt.</p><p>Mauris turpis justo, commodo a interdum id, dignissim vitae mi. Curabitur placerat massa sit amet dui lobortis cursus. Maecenas a neque mauris. Sed at nisi lacinia, fringilla eros vitae, lobortis erat. Etiam erat erat, laoreet ut purus commodo, dictum auctor enim. In id felis sed sapien aliquet dapibus a eu purus. Praesent ante tortor, ultrices nec pellentesque vitae, pharetra sit amet ligula. Nam blandit molestie sapien quis suscipit.</p>', '', '12-3.jpg', '', 'Y', 'berita', 1, 'admin', '2023-09-30 13:31:29', '', '2023-09-30 13:44:24'),
(22, 0, 'Lorem ipsum dolor sit amet', '', 'lorem-ipsum-dolor-sit-amet', 'Y', 'Y', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus iure nulla, quibusdam, minima sunt incidunt repellendus tenetur totam culpa aspernatur quasi reprehenderit, at suscipit tempore quo officiis? Blanditiis, sit eligendi!</p><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae neque labore ullam iusto sequi. Voluptatum doloribus perferendis accusamus, cumque possimus excepturi sit dolorum necessitatibus dignissimos? Sapiente accusamus necessitatibus fugit quae!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia expedita temporibus facilis repellendus maxime quidem commodi architecto pariatur, iure exercitationem sapiente beatae, cum quis sit harum! Obcaecati temporibus est ratione.</p>', '', '55-5.jpg', '', 'Y', 'tausiyah', 3, 'admin', '2023-09-17 08:08:08', '', '2023-09-30 13:42:33'),
(23, 0, 'Vitae neque labore ullam iusto sequi', '', 'vitae-neque-labore-ullam-iusto-sequi', 'Y', 'Y', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus iure nulla, quibusdam, minima sunt incidunt repellendus tenetur totam culpa aspernatur quasi reprehenderit, at suscipit tempore quo officiis? Blanditiis, sit eligendi!</p><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae neque labore ullam iusto sequi. Voluptatum doloribus perferendis accusamus, cumque possimus excepturi sit dolorum necessitatibus dignissimos? Sapiente accusamus necessitatibus fugit quae!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia expedita temporibus facilis repellendus maxime quidem commodi architecto pariatur, iure exercitationem sapiente beatae, cum quis sit harum! Obcaecati temporibus est ratione.</p>', '', '68-7.jpg', '', 'Y', 'tausiyah', 16, 'admin', '2023-09-17 08:08:29', '', '2023-09-30 13:42:17'),
(24, 0, 'Mollitia expedita temporibus facilis repellendus minima sunt incidunt', '', 'mollitia-expedita-temporibus-facilis-repellendus-minima-sunt-incidunt', 'Y', 'Y', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus iure nulla, quibusdam, minima sunt incidunt repellendus tenetur totam culpa aspernatur quasi reprehenderit, at suscipit tempore quo officiis? Blanditiis, sit eligendi!</p><p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae neque labore ullam iusto sequi. Voluptatum doloribus perferendis accusamus, cumque possimus excepturi sit dolorum necessitatibus dignissimos? Sapiente accusamus necessitatibus fugit quae!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia expedita temporibus facilis repellendus maxime quidem commodi architecto pariatur, iure exercitationem sapiente beatae, cum quis sit harum! Obcaecati temporibus est ratione.</p>', '', '25-6.jpg', '', 'Y', 'tausiyah', 11, 'admin', '2023-09-17 08:09:06', '', '2023-09-30 13:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(5) NOT NULL,
  `album_id` int(5) NOT NULL,
  `nm_foto` varchar(50) NOT NULL,
  `foto_seo` varchar(100) NOT NULL,
  `ket_foto` text NOT NULL,
  `tagfoto` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id_foto`, `album_id`, `nm_foto`, `foto_seo`, `ket_foto`, `tagfoto`, `gambar`, `hits`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 'Aksi Bela Palestina Ternate', 'aksi-bela-palestina-ternate', 'Sumber gambar : detikcom', 'palestina', 'aksi-bela-palestina---detikcom.jpeg', 0, 'admin', '2023-12-05 09:30:01', 'admin', '2023-12-05 09:30:45'),
(2, 1, 'Aksi Bela Palestina Bekasi', 'aksi-bela-palestina-bekasi', 'Sumber gambar: detikcom', 'palestina', 'aksi-bela-palestina-bekasi---detikcom.jpeg', 0, 'admin', '2023-12-05 09:31:22', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `halaman`
--

CREATE TABLE `halaman` (
  `id_halaman` int(5) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `judul_seo` varchar(150) NOT NULL,
  `ringkasan_halaman` text NOT NULL,
  `isi_halaman` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'Y',
  `gambar` varchar(100) NOT NULL,
  `komentar` enum('Y','N') NOT NULL DEFAULT 'N',
  `kelompok` varchar(100) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `halaman`
--

INSERT INTO `halaman` (`id_halaman`, `judul`, `judul_seo`, `ringkasan_halaman`, `isi_halaman`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`, `gambar`, `komentar`, `kelompok`, `hits`) VALUES
(19, 'Masjid Ramah Musafir', 'masjid-ramah-musafir', 'Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Aonec sodales sagittis magna.', '<div>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. Donec magna.</div><div>Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Aonec sodales sagittis magna.</div><div>Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam Donec sodales sagittis magna.</div><div>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, Adrest gest yae. Donec magna.</div>', '2023-07-31 07:53:56', 'admin', '2023-09-30 13:35:43', 'admin', 'Y', '30-jasa-maintenance-website.jpg', 'N', 'Layanan', 26),
(20, 'Jumat Berkah', 'jumat-berkah', 'Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam Donec sodales sagittis magna.', '<div>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. Donec magna. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Aonec sodales sagittis magna. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam Donec sodales sagittis magna. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, Adrest gest yae. Donec magna.</div><div><br></div><div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sem sem, rhoncus at posuere et, ullamcorper ac turpis. Donec fringilla ante nulla, et luctus odio vestibulum eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec rhoncus sem, ac ullamcorper tortor. Sed vitae metus ac arcu vehicula semper non vitae est. Nullam quis ipsum eget nulla ultricies aliquet eu a augue. Vestibulum magna nisi, maximus at neque quis, imperdiet ornare metus. Vivamus vel turpis cursus, fermentum neque vel, vulputate felis. Nulla in suscipit lorem. Pellentesque risus libero, volutpat fermentum risus sit amet, fermentum maximus arcu. Curabitur ut pharetra nunc, ac viverra diam. Vivamus tempor id nisl nec vulputate. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut sed est sit amet turpis tempus sollicitudin laoreet eu ante. Fusce sodales quis odio at ultrices. Curabitur mattis fringilla felis, vitae facilisis ante finibus sit amet.</div><div><br></div><div>Aliquam massa neque, congue id magna non, consectetur facilisis diam. Fusce sit amet cursus est, vel ornare nulla. Ut at metus nisi. Integer ultricies gravida tempus. Vestibulum aliquam lorem non elementum elementum. In hac habitasse platea dictumst. Praesent massa nunc, lacinia ac metus sed, sollicitudin ullamcorper arcu. Vestibulum quis metus vestibulum, eleifend nunc a, mattis massa. Nunc a iaculis est. Phasellus volutpat scelerisque dui, id imperdiet augue dignissim in. Integer tincidunt ac ante eu rhoncus.</div><div><br></div><div>Curabitur a faucibus massa. Nam tincidunt eros at nunc bibendum, eget convallis mi maximus. Cras ullamcorper, diam at consequat sodales, urna ligula pretium ante, et ultrices nibh dui a quam. Cras fringilla ligula est, eu ultrices risus rutrum sit amet. Nullam ullamcorper elit in turpis consequat blandit. Nunc ac velit quis neque posuere tempus pretium vitae diam. Nam auctor at ipsum ac bibendum. Suspendisse at neque vestibulum, mattis justo a, consectetur neque. Cras at vulputate tellus, ac dignissim metus. Etiam orci felis, molestie et erat eu, venenatis dapibus ligula. Phasellus mi lorem, malesuada sit amet ullamcorper sed, elementum ut mauris.</div><div><br></div><div>In posuere suscipit commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus vitae risus sit amet justo aliquet tempus. Integer consequat felis sem, ornare hendrerit lectus sodales rhoncus. Pellentesque eu accumsan arcu. Pellentesque vel pharetra nunc. Morbi cursus velit justo, vitae gravida urna tempus sit amet. Vestibulum semper rutrum mi sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin at aliquam est, nec elementum sem. Vivamus augue est, maximus quis semper nec, volutpat non orci. Donec placerat at massa quis gravida.</div><div><br></div><div>Ut sit amet massa ultricies, pellentesque purus quis, malesuada ante. Aliquam ut interdum risus. Sed volutpat libero et velit pharetra porttitor. Donec pellentesque velit a eros euismod, elementum interdum nisi ullamcorper. Donec turpis tortor, varius ac felis at, fermentum tincidunt sem. Vestibulum aliquam ornare lectus, vel sollicitudin magna cursus vitae. Nulla vel finibus dolor. Suspendisse sodales risus a iaculis volutpat. Suspendisse egestas, tellus sit amet luctus rutrum, tellus enim ultricies lectus, eget pharetra felis neque a arcu. Aenean ultrices est accumsan euismod mattis. Aliquam pharetra mi urna, vel dignissim nibh aliquam sit amet. Curabitur tempus ut sem a luctus.</div><div><br></div><div>Nulla volutpat augue vitae sem faucibus, feugiat euismod nulla cursus. Praesent fermentum at nisl sed laoreet. Nunc auctor semper turpis, non gravida ex sodales faucibus. Aenean bibendum tortor et mi facilisis feugiat. Quisque scelerisque magna sem, et cursus diam aliquam in. Curabitur sodales gravida mauris at fermentum. Morbi imperdiet finibus pretium. Maecenas pellentesque mi elementum tincidunt ultrices. Nunc egestas ipsum vitae semper posuere. Pellentesque sed rutrum ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum cursus neque non magna fermentum pulvinar. Fusce faucibus, nisl tempus varius gravida, risus nunc mollis lectus, efficitur condimentum nunc nisl non nunc. Ut mattis quam risus, vel maximus sem dignissim id. Cras porta at arcu sed vehicula.</div><div><br></div><div>Proin hendrerit lectus et accumsan sodales. Aenean eu erat accumsan, vestibulum nunc et, tincidunt massa. Quisque gravida metus vitae posuere viverra. Vestibulum nec mollis urna, quis blandit turpis. Vivamus ornare, risus in bibendum placerat, dui quam consectetur urna, ut faucibus sem tortor a tellus. Pellentesque eget nisi imperdiet, blandit nisl sit amet, laoreet lacus. Donec nibh nulla, interdum ac lectus ac, dapibus blandit ante. Ut nec egestas nulla. Vivamus non ipsum faucibus, egestas nulla vel, blandit velit. Quisque scelerisque, tortor ut varius mattis, tellus mi eleifend erat, a commodo ligula turpis ullamcorper quam. Etiam eget elementum tellus. Sed sit amet ipsum lectus. Donec ultrices risus vel tempor tempus.</div><div><br></div><div>Nam ac scelerisque libero. Pellentesque odio urna, blandit et congue non, dignissim ac lacus. Fusce condimentum dignissim mi, non posuere odio mollis non. Donec scelerisque nulla quis vestibulum laoreet. Duis ullamcorper turpis interdum volutpat pellentesque. Curabitur eros enim, blandit et semper at, elementum sit amet sapien. In et mi sit amet ligula hendrerit aliquam eu in augue. Donec blandit dictum urna sed bibendum. In elementum non mi ac pellentesque. Aenean lobortis urna nec mattis tempor.</div><div><br></div><div>Morbi risus tortor, aliquam ac neque vitae, dictum fermentum lacus. Nulla elementum lobortis diam ut ultrices. Fusce eget diam quis odio venenatis feugiat. Fusce vitae imperdiet ipsum. Integer sed risus in quam gravida bibendum sit amet ut purus. Suspendisse sit amet neque odio. Donec scelerisque mauris iaculis lorem ullamcorper, at tincidunt ligula vulputate. Proin enim arcu, efficitur non blandit sed, ornare ut risus. Morbi porta rutrum dui, vel placerat felis pharetra quis. Morbi pretium, dolor sit amet laoreet finibus, sapien odio porttitor felis, eget congue enim urna eget leo.</div><div><br></div><div>Nunc at urna mi. Nam sagittis, urna gravida dapibus vulputate, ipsum erat gravida mi, id mollis orci massa eu enim. Nulla consequat nec nisl quis suscipit. Nullam elementum nisi vel iaculis scelerisque. Mauris est quam, varius sed nulla eget, imperdiet vulputate nulla. Nullam ac sem laoreet, faucibus justo ut, fringilla urna. Nulla eu feugiat ante. Etiam quis arcu quam. Vestibulum consectetur nibh vel velit scelerisque ullamcorper. Fusce at lectus pretium, mollis mi non, sagittis metus. Nullam vel facilisis tortor. Praesent porttitor risus quis est vulputate venenatis. Morbi a tristique felis. Integer vel ultrices velit. Donec maximus laoreet vestibulum.</div><div><br></div><div>Sed pulvinar diam rhoncus, tincidunt lectus eu, facilisis nulla. Nulla eu vehicula tellus. Aliquam erat volutpat. Mauris felis nulla, vestibulum eget nunc non, varius mollis sem. Vestibulum vitae risus eu magna molestie sagittis consectetur sit amet nibh. Integer vitae sem condimentum, sollicitudin mauris id, malesuada enim. Praesent congue nunc et dignissim auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam id blandit massa.</div><div><br></div><div>Quisque imperdiet id lacus eu congue. Nam vulputate enim velit, nec volutpat metus convallis dapibus. Suspendisse vel magna orci. Proin bibendum malesuada tempus. Mauris posuere dignissim dui, viverra eleifend orci laoreet et. Aenean leo erat, pharetra suscipit aliquet a, tempor at nunc. Vivamus imperdiet iaculis sem. Nulla ac tortor maximus, pulvinar erat ut, malesuada ex. Nunc felis justo, convallis sed bibendum ut, egestas ac tellus. Quisque eleifend nulla eget magna ultricies, vel rhoncus dolor ullamcorper. Praesent rhoncus sollicitudin urna quis malesuada. In id blandit lorem. In volutpat at magna eget vulputate. Proin at egestas mauris, eu vestibulum enim.</div><div><br></div><div>Aliquam id accumsan erat. Sed et risus ac massa aliquam venenatis ac sed nunc. Nullam vel libero vel ex commodo rhoncus ullamcorper eget enim. Morbi semper ligula mi, id egestas magna ultricies a. Cras elit erat, rutrum ut molestie sit amet, auctor euismod turpis. Sed mattis augue id dignissim commodo. Quisque vitae ante sagittis, tincidunt sapien vel, ultrices nibh. Donec metus libero, fermentum eget consequat ac, mollis vel ipsum. Quisque at lacus suscipit, feugiat diam in, sodales leo. Fusce vestibulum ullamcorper dolor, et scelerisque est aliquam in. Duis vulputate blandit dolor, in congue lacus bibendum sed. Aenean at enim eu nibh fringilla dapibus ut pretium justo. Quisque rhoncus placerat cursus. Cras aliquet felis sed nulla ultricies, sed pellentesque libero tempus. Curabitur et urna vel nisl lacinia auctor.</div><div><br></div><div>Vestibulum tincidunt maximus sem sed mollis. Mauris magna quam, accumsan nec laoreet vitae, sagittis non risus. Integer vel lacus lorem. Suspendisse nec dui nunc. Pellentesque molestie enim maximus erat venenatis finibus. Duis porttitor ultrices neque, vel porttitor mi condimentum a. Duis sit amet sapien fermentum, ullamcorper turpis quis, aliquet tortor. Curabitur feugiat nulla vitae sagittis fringilla. Quisque auctor convallis neque, aliquam laoreet turpis hendrerit sit amet. Ut non quam in metus semper ornare. Nunc a sodales massa. Integer tempor neque in blandit rutrum. Phasellus imperdiet enim lectus, eget tincidunt mauris commodo vel. Aenean nec tincidunt augue, vitae blandit dui. Aliquam et justo augue. In hac habitasse platea dictumst.</div><div><br></div><div>Vestibulum eu diam orci. Sed mattis quam volutpat, dapibus mi eget, dapibus arcu. Nunc volutpat aliquet sodales. Pellentesque lacinia et est vel iaculis. Phasellus rhoncus congue scelerisque. In accumsan ipsum ut ante tempus, eget molestie nisi fringilla. Mauris in lacus non turpis rutrum pellentesque id nec sapien. Quisque sed elementum dolor, vel posuere risus.</div></div>', '2023-07-31 07:54:50', 'admin', '2023-09-30 13:35:31', 'admin', 'Y', '86-jasa-kursus-privat-website.jpg', 'N', 'Layanan', 21),
(21, 'Taman Pendidikan Al Qur\'an', 'taman-pendidikan-al-quran', 'Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, Adrest gest yae. Donec magna.', '<div>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc. Donec magna.  Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Aonec sodales sagittis magna. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam Donec sodales sagittis magna. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, Adrest gest yae. Donec magna.</div><div><br></div><div><div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sem sem, rhoncus at posuere et, ullamcorper ac turpis. Donec fringilla ante nulla, et luctus odio vestibulum eget. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam nec rhoncus sem, ac ullamcorper tortor. Sed vitae metus ac arcu vehicula semper non vitae est. Nullam quis ipsum eget nulla ultricies aliquet eu a augue. Vestibulum magna nisi, maximus at neque quis, imperdiet ornare metus. Vivamus vel turpis cursus, fermentum neque vel, vulputate felis. Nulla in suscipit lorem. Pellentesque risus libero, volutpat fermentum risus sit amet, fermentum maximus arcu. Curabitur ut pharetra nunc, ac viverra diam. Vivamus tempor id nisl nec vulputate. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut sed est sit amet turpis tempus sollicitudin laoreet eu ante. Fusce sodales quis odio at ultrices. Curabitur mattis fringilla felis, vitae facilisis ante finibus sit amet.</div><div><br></div><div>Aliquam massa neque, congue id magna non, consectetur facilisis diam. Fusce sit amet cursus est, vel ornare nulla. Ut at metus nisi. Integer ultricies gravida tempus. Vestibulum aliquam lorem non elementum elementum. In hac habitasse platea dictumst. Praesent massa nunc, lacinia ac metus sed, sollicitudin ullamcorper arcu. Vestibulum quis metus vestibulum, eleifend nunc a, mattis massa. Nunc a iaculis est. Phasellus volutpat scelerisque dui, id imperdiet augue dignissim in. Integer tincidunt ac ante eu rhoncus.</div><div><br></div><div>Curabitur a faucibus massa. Nam tincidunt eros at nunc bibendum, eget convallis mi maximus. Cras ullamcorper, diam at consequat sodales, urna ligula pretium ante, et ultrices nibh dui a quam. Cras fringilla ligula est, eu ultrices risus rutrum sit amet. Nullam ullamcorper elit in turpis consequat blandit. Nunc ac velit quis neque posuere tempus pretium vitae diam. Nam auctor at ipsum ac bibendum. Suspendisse at neque vestibulum, mattis justo a, consectetur neque. Cras at vulputate tellus, ac dignissim metus. Etiam orci felis, molestie et erat eu, venenatis dapibus ligula. Phasellus mi lorem, malesuada sit amet ullamcorper sed, elementum ut mauris.</div><div><br></div><div>In posuere suscipit commodo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus vitae risus sit amet justo aliquet tempus. Integer consequat felis sem, ornare hendrerit lectus sodales rhoncus. Pellentesque eu accumsan arcu. Pellentesque vel pharetra nunc. Morbi cursus velit justo, vitae gravida urna tempus sit amet. Vestibulum semper rutrum mi sed aliquam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Proin at aliquam est, nec elementum sem. Vivamus augue est, maximus quis semper nec, volutpat non orci. Donec placerat at massa quis gravida.</div><div><br></div><div>Ut sit amet massa ultricies, pellentesque purus quis, malesuada ante. Aliquam ut interdum risus. Sed volutpat libero et velit pharetra porttitor. Donec pellentesque velit a eros euismod, elementum interdum nisi ullamcorper. Donec turpis tortor, varius ac felis at, fermentum tincidunt sem. Vestibulum aliquam ornare lectus, vel sollicitudin magna cursus vitae. Nulla vel finibus dolor. Suspendisse sodales risus a iaculis volutpat. Suspendisse egestas, tellus sit amet luctus rutrum, tellus enim ultricies lectus, eget pharetra felis neque a arcu. Aenean ultrices est accumsan euismod mattis. Aliquam pharetra mi urna, vel dignissim nibh aliquam sit amet. Curabitur tempus ut sem a luctus.</div><div><br></div><div>Nulla volutpat augue vitae sem faucibus, feugiat euismod nulla cursus. Praesent fermentum at nisl sed laoreet. Nunc auctor semper turpis, non gravida ex sodales faucibus. Aenean bibendum tortor et mi facilisis feugiat. Quisque scelerisque magna sem, et cursus diam aliquam in. Curabitur sodales gravida mauris at fermentum. Morbi imperdiet finibus pretium. Maecenas pellentesque mi elementum tincidunt ultrices. Nunc egestas ipsum vitae semper posuere. Pellentesque sed rutrum ipsum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum cursus neque non magna fermentum pulvinar. Fusce faucibus, nisl tempus varius gravida, risus nunc mollis lectus, efficitur condimentum nunc nisl non nunc. Ut mattis quam risus, vel maximus sem dignissim id. Cras porta at arcu sed vehicula.</div><div><br></div><div>Proin hendrerit lectus et accumsan sodales. Aenean eu erat accumsan, vestibulum nunc et, tincidunt massa. Quisque gravida metus vitae posuere viverra. Vestibulum nec mollis urna, quis blandit turpis. Vivamus ornare, risus in bibendum placerat, dui quam consectetur urna, ut faucibus sem tortor a tellus. Pellentesque eget nisi imperdiet, blandit nisl sit amet, laoreet lacus. Donec nibh nulla, interdum ac lectus ac, dapibus blandit ante. Ut nec egestas nulla. Vivamus non ipsum faucibus, egestas nulla vel, blandit velit. Quisque scelerisque, tortor ut varius mattis, tellus mi eleifend erat, a commodo ligula turpis ullamcorper quam. Etiam eget elementum tellus. Sed sit amet ipsum lectus. Donec ultrices risus vel tempor tempus.</div><div><br></div><div>Nam ac scelerisque libero. Pellentesque odio urna, blandit et congue non, dignissim ac lacus. Fusce condimentum dignissim mi, non posuere odio mollis non. Donec scelerisque nulla quis vestibulum laoreet. Duis ullamcorper turpis interdum volutpat pellentesque. Curabitur eros enim, blandit et semper at, elementum sit amet sapien. In et mi sit amet ligula hendrerit aliquam eu in augue. Donec blandit dictum urna sed bibendum. In elementum non mi ac pellentesque. Aenean lobortis urna nec mattis tempor.</div><div><br></div><div>Morbi risus tortor, aliquam ac neque vitae, dictum fermentum lacus. Nulla elementum lobortis diam ut ultrices. Fusce eget diam quis odio venenatis feugiat. Fusce vitae imperdiet ipsum. Integer sed risus in quam gravida bibendum sit amet ut purus. Suspendisse sit amet neque odio. Donec scelerisque mauris iaculis lorem ullamcorper, at tincidunt ligula vulputate. Proin enim arcu, efficitur non blandit sed, ornare ut risus. Morbi porta rutrum dui, vel placerat felis pharetra quis. Morbi pretium, dolor sit amet laoreet finibus, sapien odio porttitor felis, eget congue enim urna eget leo.</div><div><br></div><div>Nunc at urna mi. Nam sagittis, urna gravida dapibus vulputate, ipsum erat gravida mi, id mollis orci massa eu enim. Nulla consequat nec nisl quis suscipit. Nullam elementum nisi vel iaculis scelerisque. Mauris est quam, varius sed nulla eget, imperdiet vulputate nulla. Nullam ac sem laoreet, faucibus justo ut, fringilla urna. Nulla eu feugiat ante. Etiam quis arcu quam. Vestibulum consectetur nibh vel velit scelerisque ullamcorper. Fusce at lectus pretium, mollis mi non, sagittis metus. Nullam vel facilisis tortor. Praesent porttitor risus quis est vulputate venenatis. Morbi a tristique felis. Integer vel ultrices velit. Donec maximus laoreet vestibulum.</div><div><br></div><div>Sed pulvinar diam rhoncus, tincidunt lectus eu, facilisis nulla. Nulla eu vehicula tellus. Aliquam erat volutpat. Mauris felis nulla, vestibulum eget nunc non, varius mollis sem. Vestibulum vitae risus eu magna molestie sagittis consectetur sit amet nibh. Integer vitae sem condimentum, sollicitudin mauris id, malesuada enim. Praesent congue nunc et dignissim auctor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam id blandit massa.</div><div><br></div><div>Quisque imperdiet id lacus eu congue. Nam vulputate enim velit, nec volutpat metus convallis dapibus. Suspendisse vel magna orci. Proin bibendum malesuada tempus. Mauris posuere dignissim dui, viverra eleifend orci laoreet et. Aenean leo erat, pharetra suscipit aliquet a, tempor at nunc. Vivamus imperdiet iaculis sem. Nulla ac tortor maximus, pulvinar erat ut, malesuada ex. Nunc felis justo, convallis sed bibendum ut, egestas ac tellus. Quisque eleifend nulla eget magna ultricies, vel rhoncus dolor ullamcorper. Praesent rhoncus sollicitudin urna quis malesuada. In id blandit lorem. In volutpat at magna eget vulputate. Proin at egestas mauris, eu vestibulum enim.</div><div><br></div><div>Aliquam id accumsan erat. Sed et risus ac massa aliquam venenatis ac sed nunc. Nullam vel libero vel ex commodo rhoncus ullamcorper eget enim. Morbi semper ligula mi, id egestas magna ultricies a. Cras elit erat, rutrum ut molestie sit amet, auctor euismod turpis. Sed mattis augue id dignissim commodo. Quisque vitae ante sagittis, tincidunt sapien vel, ultrices nibh. Donec metus libero, fermentum eget consequat ac, mollis vel ipsum. Quisque at lacus suscipit, feugiat diam in, sodales leo. Fusce vestibulum ullamcorper dolor, et scelerisque est aliquam in. Duis vulputate blandit dolor, in congue lacus bibendum sed. Aenean at enim eu nibh fringilla dapibus ut pretium justo. Quisque rhoncus placerat cursus. Cras aliquet felis sed nulla ultricies, sed pellentesque libero tempus. Curabitur et urna vel nisl lacinia auctor.</div><div><br></div><div>Vestibulum tincidunt maximus sem sed mollis. Mauris magna quam, accumsan nec laoreet vitae, sagittis non risus. Integer vel lacus lorem. Suspendisse nec dui nunc. Pellentesque molestie enim maximus erat venenatis finibus. Duis porttitor ultrices neque, vel porttitor mi condimentum a. Duis sit amet sapien fermentum, ullamcorper turpis quis, aliquet tortor. Curabitur feugiat nulla vitae sagittis fringilla. Quisque auctor convallis neque, aliquam laoreet turpis hendrerit sit amet. Ut non quam in metus semper ornare. Nunc a sodales massa. Integer tempor neque in blandit rutrum. Phasellus imperdiet enim lectus, eget tincidunt mauris commodo vel. Aenean nec tincidunt augue, vitae blandit dui. Aliquam et justo augue. In hac habitasse platea dictumst.</div><div><br></div><div>Vestibulum eu diam orci. Sed mattis quam volutpat, dapibus mi eget, dapibus arcu. Nunc volutpat aliquet sodales. Pellentesque lacinia et est vel iaculis. Phasellus rhoncus congue scelerisque. In accumsan ipsum ut ante tempus, eget molestie nisi fringilla. Mauris in lacus non turpis rutrum pellentesque id nec sapien. Quisque sed elementum dolor, vel posuere risus.</div></div>', '2023-07-31 07:57:08', 'admin', '2023-09-30 13:36:21', 'admin', 'Y', '90-seo-optimazation.jpg', 'N', 'Layanan', 12);

-- --------------------------------------------------------

--
-- Table structure for table `infaq`
--

CREATE TABLE `infaq` (
  `id_infaq` int(11) NOT NULL,
  `jenis` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `keterangan` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `jml_dana` int(11) NOT NULL,
  `created_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `infaq`
--

INSERT INTO `infaq` (`id_infaq`, `jenis`, `keterangan`, `tanggal`, `jml_dana`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(4, 'Dana Masuk', 'Surtinah', '2023-09-06', 50000, 'admin', '2023-09-06 05:03:07', '', NULL),
(5, 'Dana Masuk', 'Bpk. Joko', '2023-09-05', 80000, 'admin', '2023-09-06 05:03:36', '', NULL),
(6, 'Dana Keluar', 'Bayar Listrik', '2023-09-06', 100000, 'admin', '2023-09-06 05:04:06', '', NULL),
(7, 'Dana Keluar', 'Beli bensin', '2023-09-06', 50000, 'admin', '2023-09-06 09:03:21', '', NULL),
(8, 'Dana Masuk', 'Ibu Wiji', '2023-09-06', 50000, 'admin', '2023-09-06 09:04:41', '', NULL),
(10, 'Dana Masuk', 'Ibu Sidiq', '2023-09-06', 800000, 'admin', '2023-09-06 09:06:14', '', '2023-09-17 08:54:52'),
(11, 'Dana Keluar', 'konsumsi gotong royong', '2023-09-05', 250000, 'admin', '2023-09-06 09:06:40', '', NULL),
(14, 'Dana Masuk', 'dfsfdsf', '2023-09-12', 56780, 'admin', '2023-09-06 10:42:40', 'admin', '2023-09-26 15:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(5) NOT NULL,
  `tipe` enum('tanggal','pasar') COLLATE latin1_general_ci NOT NULL DEFAULT 'tanggal',
  `nm_jadwal` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `imam` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `khatib` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `muadzin` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `bilal` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `tipe`, `nm_jadwal`, `tanggal`, `imam`, `khatib`, `muadzin`, `bilal`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 'pasar', 'Jumat Pon', '0000-00-00', 'Amam', 'Basuki', 'Doni', 'Eka', 'admin', '2023-09-05 14:00:32', '', NULL),
(4, 'pasar', 'Jumat Kliwon', '0000-00-00', 'Faris', 'Ghoni', 'Hari', 'Iko', 'admin', '2023-09-05 14:01:02', '', NULL),
(5, 'pasar', 'Jumat Pahing', '0000-00-00', 'Joko', 'Karmin', 'Leo', 'Mamad', 'admin', '2023-09-05 14:01:26', 'admin', '2023-09-05 14:04:01'),
(6, 'pasar', 'Jumat Wage', '0000-00-00', 'Nanang', 'Otang', 'Parjo', 'Qurnia', 'admin', '2023-09-05 14:02:10', '', NULL),
(7, 'pasar', 'Jumat Legi', '0000-00-00', 'Roni', 'Setia', 'Totok', 'Usman', 'admin', '2023-09-05 14:02:38', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `nm_kategori` varchar(100) NOT NULL,
  `kategori_seo` varchar(150) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nm_kategori`, `kategori_seo`, `aktif`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(6, 'Daerah', 'daerah', 'Y', '2023-09-30 13:01:38', 'admin', NULL, ''),
(7, 'Nasional', 'nasional', 'Y', '2023-09-30 13:01:43', 'admin', NULL, ''),
(8, 'Internasional', 'internasional', 'Y', '2023-09-30 13:02:03', 'admin', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id_menus` int(5) NOT NULL,
  `nm_menus` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `target` enum('_blank','_self') NOT NULL DEFAULT '_self',
  `parent_id` int(5) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `urutan` int(5) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id_menus`, `nm_menus`, `url`, `target`, `parent_id`, `tipe`, `aktif`, `urutan`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(51, 'Home', 'http://elmasjid.test', '_self', 0, 'links', 'Y', 1, 'admin', '2023-09-29 04:45:18', 'admin', '2023-09-30 10:49:15'),
(52, 'Profil', 'profil', '_self', 0, 'halaman_custom', 'Y', 2, 'admin', '2023-09-29 04:46:58', '', NULL),
(53, 'Berita', 'berita', '_self', 0, 'halaman_custom', 'Y', 3, 'admin', '2023-09-29 04:50:14', 'admin', '2023-09-29 04:52:35'),
(54, 'Galeri', '#', '_self', 0, 'links', 'Y', 4, 'admin', '2023-09-29 04:53:39', 'admin', '2023-09-29 05:01:39'),
(55, 'Infaq', 'laporan-infaq', '_self', 0, 'halaman_custom', 'Y', 5, 'admin', '2023-09-29 04:53:55', '', NULL),
(56, 'Jadwal Jumat', 'jadwal-jumat', '_self', 0, 'halaman_custom', 'Y', 6, 'admin', '2023-09-29 04:55:06', '', NULL),
(57, 'Lainnya', '#', '_self', 0, 'links', 'Y', 7, 'admin', '2023-09-29 05:01:57', 'admin', '2023-09-29 05:03:07'),
(58, 'Galeri Foto', 'galeri-foto', '_self', 54, 'halaman_custom', 'Y', 1, 'admin', '2023-09-29 05:02:25', '', NULL),
(59, 'Galeri Video', 'video', '_self', 54, 'halaman_custom', 'Y', 2, 'admin', '2023-09-29 05:02:46', '', NULL),
(60, 'Kontak', 'kontak', '_self', 0, 'halaman_custom', 'Y', 8, 'admin', '2023-09-29 05:03:18', '', NULL),
(61, 'Agenda', 'agenda', '_self', 57, 'halaman_custom', 'Y', 1, 'admin', '2023-09-29 05:03:35', '', NULL),
(62, 'Pengumuman', 'pengumuman', '_self', 57, 'halaman_custom', 'Y', 2, 'admin', '2023-09-29 05:03:52', '', NULL),
(63, 'Layanan', 'layanan', '_self', 0, 'halaman_custom', 'Y', 3, 'admin', '2023-09-29 05:05:40', 'admin', '2023-09-29 05:06:57'),
(64, 'Takmir', 'takmir', '_self', 57, 'halaman_custom', 'Y', 4, 'admin', '2023-09-29 05:05:51', '', NULL),
(65, 'Tausiyah', 'tausiyah', '_self', 57, 'halaman_custom', 'Y', 5, 'admin', '2023-09-29 05:06:07', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(5) NOT NULL,
  `nm_modul` varchar(50) NOT NULL,
  `links` varchar(50) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `nm_modul`, `links`, `aktif`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(3, 'Berita', 'berita', 'Y', 'admin', '2022-06-22 14:36:25', 'admin', '2022-06-22 14:39:20'),
(4, 'Halaman', 'halaman', 'Y', 'admin', '2022-06-22 14:40:30', 'admin', '2022-06-22 14:40:35'),
(8, 'Kategori Berita', 'kategori', 'Y', 'admin', '2022-06-22 14:41:48', '', NULL),
(15, 'Menu Website', 'menus', 'Y', 'admin', '2022-06-22 14:43:25', '', NULL),
(17, 'Setting Umum', 'setting', 'Y', 'admin', '2022-06-22 14:44:41', '', NULL),
(19, 'Manajemen Users', 'users', 'Y', 'admin', '2022-06-22 14:45:09', '', NULL),
(20, 'Staff', 'staff', 'Y', 'admin', '2023-08-05 13:04:51', '', NULL),
(21, 'Kategori Staff', 'kategori_staff', 'Y', 'admin', '2023-08-05 13:30:05', '', NULL),
(23, 'Album Foto', 'album', 'Y', 'admin', '2023-08-05 14:51:19', '', NULL),
(24, 'Galeri Foto', 'foto', 'Y', 'admin', '2023-08-05 14:51:36', '', NULL),
(25, 'Playlist', 'playlist', 'Y', 'admin', '2023-08-05 15:54:56', '', NULL),
(26, 'Galeri Video', 'video', 'Y', 'admin', '2023-08-05 15:55:14', '', NULL),
(27, 'Client', 'client', 'Y', 'admin', '2023-08-05 18:21:15', '', NULL),
(28, 'Slider', 'slider', 'Y', 'admin', '2023-08-05 18:55:24', '', NULL),
(29, 'Pesan Masuk', 'hubungi', 'Y', 'admin', '2023-08-05 19:03:17', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int(5) NOT NULL,
  `nm_pengumuman` varchar(150) NOT NULL,
  `pengumuman_seo` varchar(200) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `file_pengumuman` varchar(150) NOT NULL,
  `dibaca` int(5) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `nm_pengumuman`, `pengumuman_seo`, `isi_pengumuman`, `file_pengumuman`, `dibaca`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Pengumuman Penerimaan Siswa Baru', 'pengumuman-penerimaan-siswa-baru', '<p>penjelasan atau keterangan dari pengumuman</p>', '1655937270_3f5fb07fffc24ce68032.docx', 0, 'admin', '2022-06-23 05:34:31', 'admin', '2023-09-05 08:19:32'),
(2, 'Pendaftaran Penerimaan Siswa Baru', 'pendaftaran-penerimaan-siswa-baru', '<p>penjelasan atau keterangan dri pengumuman<br></p>', '', 0, 'admin', '2022-06-29 08:44:08', '', '2023-09-05 08:19:25'),
(3, 'Jadwal Masuk Tahun Ajaran Baru', 'jadwal-masuk-tahun-ajaran-baru', '<p>penjelasan atau keterangan dri pengumuman<br></p>', '', 0, 'admin', '2022-06-29 08:48:44', '', '2023-09-05 08:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id_playlist` int(5) NOT NULL,
  `nm_playlist` varchar(50) NOT NULL,
  `playlist_seo` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `hits` int(11) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id_playlist`, `nm_playlist`, `playlist_seo`, `keterangan`, `gambar`, `aktif`, `hits`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(4, 'Sholawat', 'sholawat', 'kupulan video sholawat', 'weather.png', 'Y', 0, 'admin', '2023-07-26 20:16:30', 'admin', '2023-08-01 09:11:58'),
(5, 'Aplikasi', 'aplikasi', 'Video tentang Program jam digital masjid', 'ibooks.png', 'Y', 0, 'admin', '2023-07-26 20:16:48', 'admin', '2023-09-30 17:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `sekilasinfo`
--

CREATE TABLE `sekilasinfo` (
  `id_sekilasinfo` int(5) NOT NULL,
  `info` text NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekilasinfo`
--

INSERT INTO `sekilasinfo` (`id_sekilasinfo`, `info`, `aktif`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Selamat datang di website eL Masjid', 'Y', 'bayuwi', '2022-07-21 05:52:38', 'admin', '2023-09-30 17:04:08'),
(2, 'Sesungguhnya Sholat itu fardhu yang telah ditentukan waktunya atas orang-orang yang beriman', 'Y', 'bayuwi', '2022-07-21 05:52:47', 'admin', '2023-09-30 17:10:29'),
(4, 'Sholat berjamaah lebih utama daripada sholat sendirian sebanyak 27 derajat', 'Y', 'admin', '2023-09-30 17:10:53', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(5) NOT NULL,
  `maintenance` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `nm_website` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `singkatan` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `slogan` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `meta_deskripsi` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `meta_keyword` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `favicon` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `logo_website` varchar(150) NOT NULL,
  `tentang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `website` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` varchar(25) NOT NULL,
  `no_wa` varchar(25) NOT NULL,
  `btn_wa` enum('Y','N') NOT NULL DEFAULT 'Y',
  `pesan_wa` varchar(255) NOT NULL,
  `letak_wa` enum('kanan','kiri') NOT NULL DEFAULT 'kanan',
  `google_map` text NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `instagram` varchar(100) NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `tiktok` varchar(100) NOT NULL,
  `kota_id` varchar(25) NOT NULL,
  `cdx_header` text NOT NULL,
  `cdx_footer` text NOT NULL,
  `created_by` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `maintenance`, `nm_website`, `singkatan`, `slogan`, `meta_deskripsi`, `meta_keyword`, `favicon`, `logo_website`, `tentang`, `deskripsi`, `website`, `email`, `alamat`, `no_telp`, `no_wa`, `btn_wa`, `pesan_wa`, `letak_wa`, `google_map`, `facebook`, `twitter`, `instagram`, `youtube`, `linkedin`, `tiktok`, `kota_id`, `cdx_header`, `cdx_footer`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(2, 'N', 'eL Masjid', 'LM', 'Website Masjid Gratis dari Lintang Digital', 'eL Masjid adalah Content Management System bikin website semudah mungkin', 'eL Masjid, Website Masjid Gratis, Cara Membuat Website Masjid, membuat web masjid, contoh website Masjid, fitur website Masjid, CMS Masjid, Web Masjid, Website Masjid Gratis, Website Masjid', 'elmasjid-favicon.png', 'elmasjid-logo-new.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean non dapibus nisi. Aenean ut dictum lectus. Nulla arcu mauris, sagittis a lacus eu, lobortis vehicula nibh. Mauris at nunc eget nisl finibus hendrerit a vitae elit. Cras ullamcorper erat a ipsum elementum, et consectetur enim efficitur. Sed et finibus purus. Morbi rutrum eros consectetur interdum pretium. </p><p>Fusce ac nisl a felis commodo gravida quis ut lorem. Cras varius eleifend nisl, nec tempor erat. Donec non nisl id risus scelerisque congue pellentesque at felis. Sed gravida felis vel consequat vestibulum. Cras ornare varius lacus, at tempor nisl pretium vel. Mauris dapibus vestibulum orci, quis aliquet quam efficitur et. </p><p>Sed dictum tortor sit amet eros luctus, ac malesuada purus ornare. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed non elit vitae enim finibus imperdiet.</p>', 'Fusce ac nisl a felis commodo gravida quis ut lorem. Cras varius eleifend nisl, nec tempor erat', 'https://lintangdigital.com', 'lintangdigital22@gmail.com', 'Jl. Cokro-Delanggu, Beku, Wangen, Polanharjo, Klaten, Jawa Tengah', '0272 3481232', '6285954298999', 'Y', 'Hai Admin Lintang Digital, saya mau website elMasjid', 'kanan', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6650.993213873765!2d110.65723088598794!3d-7.60712999816198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a6a6343b5845d%3A0x59e68ae69aecdf4f!2sDigital%20Clock%20Shop%20Mosque!5e0!3m2!1sen!2sid!4v1690870176772!5m2!1sen!2sid\" width=\"100%\" height=\"400\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', 'https://youtube.com', 'https://linkedin.com', 'https://tiktok.com', '1639900', '', '', 'admin', '2022-06-17 15:45:57', 'admin', '2023-09-30 10:55:44');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(5) NOT NULL,
  `nm_slider` varchar(100) NOT NULL,
  `slider_seo` varchar(150) NOT NULL,
  `ket_slider` varchar(200) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `link` varchar(100) NOT NULL,
  `text_link` varchar(25) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id_slider`, `nm_slider`, `slider_seo`, `ket_slider`, `gambar`, `aktif`, `link`, `text_link`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(6, '', '', '', 'masjid-3.jpg', 'Y', '', '', 'admin', '2023-09-30 11:04:19', '', NULL),
(7, '', '', '', 'masjid-2.jpg', 'Y', '', '', 'admin', '2023-09-30 11:04:31', '', NULL),
(8, 'Selamat Datang di eL Masjid', 'selamat-datang-di-el-masjid', '', 'masjid-1.jpg', 'Y', '', '', 'admin', '2023-09-30 11:04:41', 'admin', '2023-09-30 11:05:59');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE `statistik` (
  `ip` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(11) NOT NULL,
  `online` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `time` datetime NOT NULL,
  `last_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`ip`, `tanggal`, `hits`, `online`, `time`, `last_time`) VALUES
('127.0.0.1', '2023-08-17', 23, '1692258366', '2023-08-17 08:57:08', '2023-08-17 14:46:06'),
('192.0.0.34', '2023-08-17', 1, '1692938366', '2023-08-17 15:07:36', NULL),
('127.0.0.1', '2023-08-18', 138, '1692366646', '2023-08-18 05:11:39', '2023-08-18 20:50:46'),
('127.0.0.1', '2023-08-19', 52, '1692454420', '2023-08-19 04:23:25', '2023-08-19 21:13:40'),
('127.0.0.1', '2023-08-20', 1, '1692482929', '2023-08-20 05:08:49', NULL),
('127.0.0.1', '2023-08-22', 54, '1692685742', '2023-08-22 08:04:15', '2023-08-22 13:29:02'),
('127.0.0.1', '2023-08-23', 15, '1692808408', '2023-08-23 08:44:09', '2023-08-23 23:33:28'),
('127.0.0.1', '2023-08-25', 1, '1692941518', '2023-08-25 12:31:58', NULL),
('127.0.0.1', '2023-09-28', 13, '1695854157', '2023-09-28 05:06:25', '2023-09-28 05:35:57'),
('127.0.0.1', '2023-09-29', 54, '1695997425', '2023-09-29 03:20:32', '2023-09-29 21:23:45'),
('127.0.0.1', '2023-09-30', 78, '1696082451', '2023-09-30 04:53:27', '2023-09-30 21:00:51'),
('127.0.0.1', '2023-12-05', 16, '1701743546', '2023-12-05 09:15:08', '2023-12-05 09:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `takmir`
--

CREATE TABLE `takmir` (
  `id_takmir` int(5) NOT NULL,
  `nm_takmir` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `takmir_seo` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `ket_takmir` text COLLATE latin1_general_ci NOT NULL,
  `jbtn_takmir` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `gambar` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `created_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `takmir`
--

INSERT INTO `takmir` (`id_takmir`, `nm_takmir`, `takmir_seo`, `ket_takmir`, `jbtn_takmir`, `gambar`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Basuki Wijaya', 'basuki-wijaya', 'asasas sds kfsd', 'Ketua', '16-team-1.jpg', 'admin', '2023-09-05 10:55:31', 'admin', '2023-09-24 03:58:54'),
(2, 'Achmad Farusi', 'achmad-farusi', 'sadsad', 'Sekretaris', '42-person10.jpg', 'admin', '2023-09-05 11:09:28', 'admin', '2023-09-24 03:59:04'),
(3, 'Doni Pratama', 'doni-pratama', '', 'Bendahara', '16-person2.jpg', 'admin', '2023-09-23 11:33:50', 'admin', '2023-09-24 03:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id_templates` int(5) NOT NULL,
  `nm_templates` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `warna_templates` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `pembuat` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `folder` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `aktif` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `created_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id_templates`, `nm_templates`, `warna_templates`, `pembuat`, `folder`, `aktif`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(33, 'El Masjid', 'orange', 'Bayu Widayat', 'elmasjid', 'Y', 'admin', '2023-07-30 05:22:47', 'admin', '2023-09-08 09:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `nama_lengkap` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `no_telp` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `kelas` int(1) NOT NULL,
  `foto` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `level` enum('admin','user') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  `blokir` enum('Y','N') CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id_session` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `access_data` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `nama_lengkap`, `email`, `no_telp`, `kelas`, `foto`, `level`, `blokir`, `keterangan`, `id_session`, `created_at`, `updated_at`, `updated_by`, `access_data`) VALUES
('admin', 'edbd881f1ee2f76ba0bd70fd184f87711be991a0401fd07ccd4b199665f00761afc91731d8d8ba6cbb188b2ed5bfb465b9f3d30231eb0430b9f90fe91d136648', 'Bayu Widayat', 'bayuwidayat22@gmail.com', '', 0, '1693751020_5723420ed6e023a7c56a.jpg', 'admin', 'N', 'Vestibulum condimentum massa sit amet odio tempus, at pharetra ex sagittis. Donec vel purus ut nulla egestas volutpat. Nam aliquam leo a risus rutrum, id laoreet nibh tincidunt.', 'c44a471bd78cc6c2fea32b9fe028d30a', '2021-09-07 17:17:33', '2023-09-03 21:23:53', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `usersmodul`
--

CREATE TABLE `usersmodul` (
  `id_usersmodul` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `modul_id` int(5) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id_video` int(5) NOT NULL,
  `playlist_id` int(5) NOT NULL,
  `nm_video` varchar(50) NOT NULL,
  `video_seo` varchar(100) NOT NULL,
  `ket_video` text NOT NULL,
  `youtube` varchar(100) NOT NULL,
  `tagvid` varchar(100) NOT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `hits` int(11) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(25) NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `playlist_id`, `nm_video`, `video_seo`, `ket_video`, `youtube`, `tagvid`, `aktif`, `hits`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(7, 4, 'Sholawat Arzaq', 'sholawat-arzaq', 'Yuk lantunkan sholawat arzaq', 'https://www.youtube.com/watch?v=11uGoufJ9n8', 'sholawat,rezeki', 'Y', 0, 'admin', '2023-08-01 08:53:50', 'admin', '2023-08-01 09:10:04'),
(8, 4, 'Suaramu Syairku', 'suaramu-syairku', '', 'https://www.youtube.com/watch?v=1qYlCiOMy9w', '', 'Y', 0, 'admin', '2023-09-17 09:47:05', '', NULL),
(9, 5, 'Jam Digital Masjid TV', 'jam-digital-masjid-tv', '', 'https://www.youtube.com/watch?v=Q-nKU1d7zRI', '', 'Y', 0, 'admin', '2023-09-17 09:49:02', 'admin', '2023-09-17 09:49:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`);

--
-- Indexes for table `halaman`
--
ALTER TABLE `halaman`
  ADD PRIMARY KEY (`id_halaman`);

--
-- Indexes for table `infaq`
--
ALTER TABLE `infaq`
  ADD PRIMARY KEY (`id_infaq`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id_menus`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id_playlist`);

--
-- Indexes for table `sekilasinfo`
--
ALTER TABLE `sekilasinfo`
  ADD PRIMARY KEY (`id_sekilasinfo`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indexes for table `takmir`
--
ALTER TABLE `takmir`
  ADD PRIMARY KEY (`id_takmir`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id_templates`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `usersmodul`
--
ALTER TABLE `usersmodul`
  ADD PRIMARY KEY (`id_usersmodul`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `halaman`
--
ALTER TABLE `halaman`
  MODIFY `id_halaman` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `infaq`
--
ALTER TABLE `infaq`
  MODIFY `id_infaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id_menus` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id_playlist` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sekilasinfo`
--
ALTER TABLE `sekilasinfo`
  MODIFY `id_sekilasinfo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `takmir`
--
ALTER TABLE `takmir`
  MODIFY `id_takmir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id_templates` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `usersmodul`
--
ALTER TABLE `usersmodul`
  MODIFY `id_usersmodul` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
