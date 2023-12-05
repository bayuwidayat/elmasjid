<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/profil', 'Home::profil');
$routes->get('/jadwal-jumat', 'Home::jadwal_jumat');

$routes->get('/login', 'Auth::index');
$routes->post('/auth/do_login', 'Auth::login_do');
$routes->get('/logout', 'Auth::logout_do');

$routes->get('/halaman/(:num)/(:any)', 'Halaman::halaman_detail/$1/$2');
$routes->get('/layanan', 'Halaman::layanan');

$routes->get('/berita', 'Berita::index');
$routes->get('/berita/(:num)/(:any)', 'Berita::berita_detail/$1/$2');
$routes->get('/tag/(:any)', 'Berita::tag/$1');
$routes->get('/kategori/(:any)', 'Berita::kategori/$1');
$routes->get('/author/(:any)', 'Berita::author/$1');

$routes->get('/tausiyah', 'Berita::tausiyah');
$routes->get('/tausiyah/(:num)/(:any)', 'Berita::tausiyah_detail/$1/$2');

$routes->get('/agenda', 'Agenda::index');
$routes->get('/agenda/(:num)/(:any)', 'Agenda::detail/$1/$2'); // agenda detail

$routes->get('/pengumuman', 'Pengumuman::index');
$routes->get('/pengumuman/(:num)/(:any)', 'Pengumuman::detail/$1/$2'); // pengumuman detail
$routes->get('/download/pengumuman/(:any)/(:num)', 'Pengumuman::download/$1/$2'); // download file pengumuman 

$routes->get('/takmir', 'Takmir::index');
$routes->get('/takmir/(:num)/(:any)', 'Takmir::detail/$1/$2'); // takmir detail

$routes->get('/laporan-infaq', 'Infaq::index'); // Laporan Infaq

$routes->get('/galeri-foto', 'Galeri::index'); // Album Foto
$routes->get('/galeri-foto/(:num)/(:any)', 'Galeri::album_detail/$1/$2'); // Album detail

$routes->get('/video', 'Galeri::playlist'); // Playlist Video
$routes->get('/video/(:num)/(:any)', 'Galeri::playlist_detail/$1/$2'); // Video

$routes->get('/kontak', 'Home::kontak'); // Kontak

$routes->get('/s', 'Home::search'); // Searching
$routes->get('/maintenance', 'Home::maintenance_mode'); // maintenance mode

$routes->get('/ladmin', 'Ladmin\Dashboard::index');
$routes->get('/ladmin/dashboard', 'Ladmin\Dashboard::index');

$routes->get('/ladmin/berita', 'Ladmin\Berita::index');
$routes->get('/ladmin/berita/tambah', 'Ladmin\Berita::tambah');
$routes->post('/ladmin/berita/ajax_save', 'Ladmin\Berita::ajax_save');
$routes->get('/ladmin/berita/edit/(:num)', 'Ladmin\Berita::edit/$1');
$routes->post('/ladmin/berita/ajax_update', 'Ladmin\Berita::ajax_update');
$routes->post('/ladmin/berita/upload_image', 'Ladmin\Berita::upload_image');
$routes->post('/ladmin/berita/delete_image', 'Ladmin\Berita::delete_image');
$routes->get('/ladmin/berita/ajax_delete_berita/(:any)', 'Ladmin\Berita::ajax_delete/$1');
$routes->post('/ladmin/berita/delete_gambar/(:any)', 'Ladmin\Berita::ajax_delete_gambar/$1');

$routes->get('/ladmin/kategori', 'Ladmin\Kategori::index');
$routes->post('/ladmin/kategori/ajax_list', 'Ladmin\Kategori::ajax_list');
$routes->post('/ladmin/kategori/ajax_save', 'Ladmin\Kategori::ajax_save');
$routes->post('/ladmin/kategori/ajax_edit/(:any)', 'Ladmin\Kategori::ajax_edit/$1');
$routes->post('/ladmin/kategori/ajax_update', 'Ladmin\Kategori::ajax_update');
$routes->post('/ladmin/kategori/ajax_delete/(:any)', 'Ladmin\Kategori::ajax_delete/$1');

$routes->get('/ladmin/halaman', 'Ladmin\Halaman::index');
$routes->get('/ladmin/halaman/tambah', 'Ladmin\Halaman::tambah');
$routes->post('/ladmin/halaman/ajax_save', 'Ladmin\Halaman::ajax_save');
$routes->get('/ladmin/halaman/edit/(:num)', 'Ladmin\Halaman::edit/$1');
$routes->post('/ladmin/halaman/ajax_update', 'Ladmin\Halaman::ajax_update');
$routes->post('/ladmin/halaman/upload_image', 'Ladmin\Halaman::upload_image');
$routes->post('/ladmin/halaman/delete_image', 'Ladmin\Halaman::delete_image');
$routes->get('/ladmin/halaman/ajax_delete_halaman/(:any)', 'Ladmin\Halaman::ajax_delete_halaman/$1');
$routes->post('/ladmin/halaman/delete_gambar/(:any)', 'Ladmin\Halaman::ajax_delete_gambar/$1');
$routes->get('/ladmin/halaman/pilih_halaman/(:any)', 'Ladmin\Halaman::pilih_halaman/$1');

$routes->get('/ladmin/users', 'Ladmin\Users::index');
$routes->get('/ladmin/profile', 'Ladmin\Users::profile');
$routes->post('/ladmin/users/ajax_update_profile', 'Ladmin\Users::ajax_update_profile');
$routes->post('/ladmin/users/ajax_list', 'Ladmin\Users::ajax_list');
$routes->post('/ladmin/users/ajax_save', 'Ladmin\Users::ajax_save');
$routes->post('/ladmin/users/ajax_edit/(:any)', 'Ladmin\Users::ajax_edit/$1');
$routes->post('/ladmin/users/ajax_update', 'Ladmin\Users::ajax_update');
$routes->post('/ladmin/users/ajax_delete/(:any)', 'Ladmin\Users::ajax_delete/$1');
$routes->get('/ladmin/users/ajax_usersmodul/(:any)', 'Ladmin\Users::ajax_usersmodul/$1');

$routes->get('/ladmin/modul', 'Ladmin\Modul::index');
$routes->post('/ladmin/modul/ajax_list', 'Ladmin\Modul::ajax_list');
$routes->post('/ladmin/modul/ajax_save', 'Ladmin\Modul::ajax_save');
$routes->post('/ladmin/modul/ajax_edit/(:any)', 'Ladmin\Modul::ajax_edit/$1');
$routes->post('/ladmin/modul/ajax_update', 'Ladmin\Modul::ajax_update');
$routes->post('/ladmin/modul/ajax_delete/(:any)', 'Ladmin\Modul::ajax_delete/$1');

$routes->get('/ladmin/setting', 'Ladmin\Setting::index');
$routes->post('/ladmin/setting/ajax_update', 'Ladmin\Setting::ajax_update');
$routes->get('/ladmin/setting/logo', 'Ladmin\Setting::logo_website');
$routes->post('/ladmin/setting/update_logo', 'Ladmin\Setting::update_logo');
$routes->get('/ladmin/setting/codex', 'Ladmin\Setting::codex');
$routes->post('/ladmin/setting/update_codex', 'Ladmin\Setting::update_codex');

$routes->get('/ladmin/slider', 'Ladmin\Slider::index');
$routes->post('/ladmin/slider/ajax_list_slider', 'Ladmin\Slider::ajax_list');
$routes->post('/ladmin/slider/ajax_save', 'Ladmin\Slider::ajax_save');
$routes->post('/ladmin/slider/edit/(:num)', 'Ladmin\Slider::ajax_edit/$1');
$routes->post('/ladmin/slider/ajax_update', 'Ladmin\Slider::ajax_update');
$routes->post('/ladmin/slider/ajax_delete_slider/(:any)', 'Ladmin\Slider::ajax_delete_slider/$1');

$routes->get('/ladmin/templates', 'Ladmin\Templates::index');
$routes->post('/ladmin/templates/ajax_list', 'Ladmin\Templates::ajax_list_templates');
$routes->post('/ladmin/templates/ajax_save', 'Ladmin\Templates::ajax_save');
$routes->post('/ladmin/templates/ajax_edit/(:any)', 'Ladmin\Templates::ajax_edit/$1');
$routes->post('/ladmin/templates/ajax_update', 'Ladmin\Templates::ajax_update');
$routes->post('/ladmin/templates/ajax_delete/(:any)', 'Ladmin\Templates::ajax_delete_templates/$1');
$routes->post('/ladmin/templates/ajax_aktif/(:any)', 'Ladmin\Templates::ajax_aktif_templates/$1');

$routes->get('/ladmin/menus', 'Ladmin\Menus::index');
$routes->post('/ladmin/menus/ajax_list', 'Ladmin\Menus::ajax_list');
$routes->post('/ladmin/menus/ajax_save', 'Ladmin\Menus::ajax_save');
$routes->post('/ladmin/menus/ajax_detail/(:any)', 'Ladmin\Menus::ajax_detail/$1');
$routes->post('/ladmin/menus/ajax_edit/(:any)', 'Ladmin\Menus::ajax_edit/$1');
$routes->post('/ladmin/menus/ajax_update', 'Ladmin\Menus::ajax_update');
$routes->post('/ladmin/menus/ajax_delete/(:any)', 'Ladmin\Menus::ajax_delete/$1');

$routes->get('/ladmin/album', 'Ladmin\Album::index');
$routes->post('/ladmin/album/ajax_list_album', 'Ladmin\Album::ajax_list_album');
$routes->post('/ladmin/album/ajax_save', 'Ladmin\Album::ajax_save');
$routes->post('/ladmin/album/edit/(:num)', 'Ladmin\Album::ajax_edit/$1');
$routes->post('/ladmin/album/ajax_update', 'Ladmin\Album::ajax_update');
$routes->post('/ladmin/album/ajax_delete/(:any)', 'Ladmin\Album::ajax_delete_album/$1');
$routes->get('/ladmin/album/pilih_album/(:any)', 'Ladmin\Album::pilih_album/$1');

$routes->get('/ladmin/foto', 'Ladmin\Foto::index');
$routes->post('/ladmin/foto/ajax_list_foto', 'Ladmin\Foto::ajax_list_foto');
$routes->post('/ladmin/foto/ajax_save', 'Ladmin\Foto::ajax_save');
$routes->post('/ladmin/foto/edit/(:num)', 'Ladmin\Foto::ajax_edit/$1');
$routes->post('/ladmin/foto/ajax_update', 'Ladmin\Foto::ajax_update');
$routes->post('/ladmin/foto/ajax_delete_foto/(:any)', 'Ladmin\Foto::ajax_delete_foto/$1');

$routes->get('/ladmin/playlist', 'Ladmin\Playlist::index');
$routes->post('/ladmin/playlist/ajax_list_playlist', 'Ladmin\Playlist::ajax_list_playlist');
$routes->post('/ladmin/playlist/ajax_save', 'Ladmin\Playlist::ajax_save');
$routes->post('/ladmin/playlist/edit/(:num)', 'Ladmin\Playlist::ajax_edit/$1');
$routes->post('/ladmin/playlist/ajax_update', 'Ladmin\Playlist::ajax_update');
$routes->post('/ladmin/playlist/ajax_delete/(:any)', 'Ladmin\Playlist::ajax_delete_playlist/$1');
$routes->get('/ladmin/playlist/pilih_playlist/(:any)', 'Ladmin\Playlist::pilih_playlist/$1');

$routes->get('/ladmin/video', 'Ladmin\Video::index');
$routes->post('/ladmin/video/ajax_list_video', 'Ladmin\Video::ajax_list_video');
$routes->post('/ladmin/video/ajax_save', 'Ladmin\Video::ajax_save');
$routes->post('/ladmin/video/edit/(:num)', 'Ladmin\Video::ajax_edit/$1');
$routes->post('/ladmin/video/ajax_update', 'Ladmin\Video::ajax_update');
$routes->post('/ladmin/video/ajax_delete_video/(:any)', 'Ladmin\Video::ajax_delete_video/$1');

$routes->get('/ladmin/agenda', 'Ladmin\Agenda::index');
$routes->post('/ladmin/agenda/ajax_list_agenda', 'Ladmin\Agenda::ajax_list');
$routes->get('/ladmin/agenda/tambah', 'Ladmin\Agenda::tambah');
$routes->post('/ladmin/agenda/ajax_save', 'Ladmin\Agenda::ajax_save');
$routes->get('/ladmin/agenda/edit/(:num)', 'Ladmin\Agenda::edit/$1');
$routes->post('/ladmin/agenda/ajax_update', 'Ladmin\Agenda::ajax_update');
$routes->post('/ladmin/agenda/upload_image', 'Ladmin\Agenda::upload_image');
$routes->post('/ladmin/agenda/delete_image', 'Ladmin\Agenda::delete_image');
$routes->post('/ladmin/agenda/ajax_delete_agenda/(:any)', 'Ladmin\Agenda::ajax_delete_agenda/$1');
$routes->post('/ladmin/agenda/delete_gambar/(:any)', 'Ladmin\Agenda::ajax_delete_gambar/$1');

$routes->get('/ladmin/pengumuman', 'Ladmin\Pengumuman::index');
$routes->post('/ladmin/pengumuman/ajax_list_pengumuman', 'Ladmin\Pengumuman::ajax_list');
$routes->get('/ladmin/pengumuman/tambah', 'Ladmin\Pengumuman::tambah');
$routes->post('/ladmin/pengumuman/ajax_save', 'Ladmin\Pengumuman::ajax_save');
$routes->get('/ladmin/pengumuman/edit/(:num)', 'Ladmin\Pengumuman::edit/$1');
$routes->post('/ladmin/pengumuman/ajax_update', 'Ladmin\Pengumuman::ajax_update');
$routes->post('/ladmin/pengumuman/upload_image', 'Ladmin\Pengumuman::upload_image');
$routes->post('/ladmin/pengumuman/delete_image', 'Ladmin\Pengumuman::delete_image');
$routes->post('/ladmin/pengumuman/ajax_delete_pengumuman/(:any)', 'Ladmin\Pengumuman::ajax_delete_pengumuman/$1');
$routes->post('/ladmin/pengumuman/delete_gambar/(:any)', 'Ladmin\Pengumuman::ajax_delete_gambar/$1');

$routes->get('/ladmin/takmir', 'Ladmin\Takmir::index');
$routes->post('/ladmin/takmir/ajax_list', 'Ladmin\Takmir::ajax_list');
$routes->post('/ladmin/takmir/ajax_save', 'Ladmin\Takmir::ajax_save');
$routes->post('/ladmin/takmir/ajax_edit/(:any)', 'Ladmin\Takmir::ajax_edit/$1');
$routes->post('/ladmin/takmir/ajax_update', 'Ladmin\Takmir::ajax_update');
$routes->post('/ladmin/takmir/ajax_delete/(:any)', 'Ladmin\Takmir::ajax_delete/$1');

$routes->get('/ladmin/jadwal', 'Ladmin\Jadwal::index');
$routes->post('/ladmin/jadwal/ajax_list', 'Ladmin\Jadwal::ajax_list');
$routes->post('/ladmin/jadwal/ajax_save', 'Ladmin\Jadwal::ajax_save');
$routes->post('/ladmin/jadwal/ajax_edit/(:any)', 'Ladmin\Jadwal::ajax_edit/$1');
$routes->post('/ladmin/jadwal/ajax_update', 'Ladmin\Jadwal::ajax_update');
$routes->post('/ladmin/jadwal/ajax_delete/(:any)', 'Ladmin\Jadwal::ajax_delete/$1');

$routes->get('/ladmin/sekilasinfo', 'Ladmin\Sekilasinfo::index');
$routes->post('/ladmin/sekilasinfo/ajax_list', 'Ladmin\Sekilasinfo::ajax_list');
$routes->post('/ladmin/sekilasinfo/ajax_save', 'Ladmin\Sekilasinfo::ajax_save');
$routes->post('/ladmin/sekilasinfo/ajax_edit/(:any)', 'Ladmin\Sekilasinfo::ajax_edit/$1');
$routes->post('/ladmin/sekilasinfo/ajax_update', 'Ladmin\Sekilasinfo::ajax_update');
$routes->post('/ladmin/sekilasinfo/ajax_delete/(:any)', 'Ladmin\Sekilasinfo::ajax_delete/$1');

$routes->get('/ladmin/infaq', 'Ladmin\Infaq::index');
$routes->post('/ladmin/infaq/ajax_list', 'Ladmin\Infaq::ajax_list');
$routes->post('/ladmin/infaq/ajax_save', 'Ladmin\Infaq::ajax_save');
$routes->post('/ladmin/infaq/ajax_edit/(:any)', 'Ladmin\Infaq::ajax_edit/$1');
$routes->post('/ladmin/infaq/ajax_update', 'Ladmin\Infaq::ajax_update');
$routes->post('/ladmin/infaq/ajax_delete/(:any)', 'Ladmin\Infaq::ajax_delete/$1');
$routes->get('/ladmin/infaq/ajax_saldo', 'Ladmin\Infaq::ajax_saldo');

$routes->get('/ladmin/tausiyah', 'Ladmin\Tausiyah::index');
$routes->get('/ladmin/tausiyah/tambah', 'Ladmin\Tausiyah::tambah');
$routes->post('/ladmin/tausiyah/ajax_save', 'Ladmin\Tausiyah::ajax_save');
$routes->get('/ladmin/tausiyah/edit/(:num)', 'Ladmin\Tausiyah::edit/$1');
$routes->post('/ladmin/tausiyah/ajax_update', 'Ladmin\Tausiyah::ajax_update');
$routes->post('/ladmin/tausiyah/upload_image', 'Ladmin\Tausiyah::upload_image');
$routes->post('/ladmin/tausiyah/delete_image', 'Ladmin\Tausiyah::delete_image');
$routes->get('/ladmin/tausiyah/ajax_delete_tausiyah/(:any)', 'Ladmin\Tausiyah::ajax_delete/$1');
$routes->post('/ladmin/tausiyah/delete_gambar/(:any)', 'Ladmin\Tausiyah::ajax_delete_gambar/$1');
