<?php
$uri = service('uri')->getSegments();
$uri1 = $uri[1] ?? 'dashboard';
$uri2 = $uri[2] ?? '';
$uri3 = $uri[3] ?? '';
?>

<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/dashboard" class="nav-link <?= ($uri1 == 'dashboard') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item <?= ($uri1 == 'berita' or $uri1 == 'kategori') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= ($uri1 == 'berita' or $uri1 == 'kategori') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-newspaper"></i>
                    <p>Berita<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/berita" class="nav-link <?= ($uri1 == 'berita' and $uri2 == '') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/berita/tambah" class="nav-link <?= ($uri1 == 'berita' and $uri2 == 'tambah') ? 'active' : '' ?>">
                            <i class=" far fa-circle nav-icon"></i>
                            <p>Tambah Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/kategori" class="nav-link <?= ($uri1 == 'kategori') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Kategori Berita</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= ($uri1 == 'halaman') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= ($uri1 == 'halaman') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>Halaman<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/halaman" class="nav-link <?= ($uri1 == 'halaman' and $uri2 == '') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Halaman</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/halaman/tambah" class="nav-link <?= ($uri1 == 'halaman' and $uri2 == 'tambah') ? 'active' : '' ?>">
                            <i class=" far fa-circle nav-icon"></i>
                            <p>Tambah Halaman</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= ($uri1 == 'templates' or $uri1 == 'menus') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= ($uri1 == 'templates' or $uri1 == 'menus') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-palette"></i>
                    <p>Tampilan<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/templates" class="nav-link <?= ($uri1 == 'templates') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Templates</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/menus" class="nav-link <?= ($uri1 == 'menus') ? 'active' : '' ?>">
                            <i class=" far fa-circle nav-icon"></i>
                            <p>Menus</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= ($uri1 == 'foto' or $uri1 == 'album') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= ($uri1 == 'foto' or $uri1 == 'album') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-image"></i>
                    <p>Galeri Foto<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/foto" class="nav-link <?= ($uri1 == 'foto') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Foto</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/album" class="nav-link <?= ($uri1 == 'album') ? 'active' : '' ?>">
                            <i class=" far fa-circle nav-icon"></i>
                            <p>Album</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= ($uri1 == 'video' or $uri1 == 'playlist') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= ($uri1 == 'video' or $uri1 == 'playlist') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-video"></i>
                    <p>Galeri Video<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/video" class="nav-link <?= ($uri1 == 'video') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Video</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/playlist" class="nav-link <?= ($uri1 == 'playlist') ? 'active' : '' ?>">
                            <i class=" far fa-circle nav-icon"></i>
                            <p>Playlist</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= ($uri1 == 'users' or $uri1 == 'modul') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= ($uri1 == 'users' or $uri1 == 'modul') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Manajemen User<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/users" class="nav-link <?= ($uri1 == 'users') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/modul" class="nav-link <?= ($uri1 == 'modul') ? 'active' : '' ?>">
                            <i class=" far fa-circle nav-icon"></i>
                            <p>Modul</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item <?= ($uri1 == 'setting') ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= ($uri1 == 'setting') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>Setting<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/setting" class="nav-link <?= ($uri1 == 'setting' and $uri2 == '') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Setting Umum</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/setting/logo" class="nav-link <?= ($uri1 == 'setting' and $uri2 == 'logo') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Logo Website</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>ladmin/setting/codex" class="nav-link <?= ($uri1 == 'setting' and $uri2 == 'codex') ? 'active' : '' ?>">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Header Footer</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/slider" class="nav-link <?= ($uri1 == 'slider') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-images"></i>
                    <p>Slide Gambar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/agenda" class="nav-link <?= ($uri1 == 'agenda') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Agenda</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/pengumuman" class="nav-link <?= ($uri1 == 'pengumuman') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>Pengumuman</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/sekilasinfo" class="nav-link <?= ($uri1 == 'sekilasinfo') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Sekilas Info</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/takmir" class="nav-link <?= ($uri1 == 'takmir') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-stream"></i>
                    <p>Takmir Masjid</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/jadwal" class="nav-link <?= ($uri1 == 'jadwal') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>Jadwal Jumat</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/infaq" class="nav-link <?= ($uri1 == 'infaq') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-donate"></i>
                    <p>Laporan Infaq</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>ladmin/tausiyah" class="nav-link <?= ($uri1 == 'tausiyah') ? 'active' : '' ?>">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>Tausiyah</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url() ?>logout" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>