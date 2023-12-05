# eL Masjid

## Apa itu eL Masjid?

el Masjid adalah source code company profile website masjid dengan Codeigniter 4

Anda dapat membaca pandunan penggunaan website melalui link berikut ini https://lintangdigital.com/. Adapun demo dapat Anda akses di http://elmasjid.lintangdemo.my.id/.

Semoga bermanfaat. Spesifikasi Teknis Source Code Website ini dikembangkan dengan beberapa spesifikasi:

1. Dikembangkan dengan Codeigniter 4. Pastikan teman-teman membaca Server Requirements dari CI4.
2. Template Admin menggunakan AdminLTE 3.1.0. Bisa diakses di https://adminlte.io/
3. Template front end menggunakan Startup2 1.0.0 dari https://htmlcodex.com/startup-website-template/

# Fitur-fitur Website meliputi:
## HALAMAN FRONT END:
1. Halaman Beranda/Homepage
2. Banner slider
3. Jadwal Shalat
4. Sekilas Info (running text)
5. Halaman berita dan detailnya
6. Halaman profile
7. Halaman layanan
8. Halaman takmir
9. Halaman galeri gambar
10. Halaman galeri video
11. Halaman Jadwal Jumat
12. Halaman Laporan Infaq
13. Halaman Agenda
14. Halaman Pengumuman
15. Halaman Tausiyah
16. Halaman kontak
17. Tombol Whatsapp
    
## HALAMAN BACK END:
1. Login dan logout
2. Halaman update profile dan ganti password
3. Halaman Dashboard
4. Halaman kelola berita dan kategorinya
5. Halaman kelola layanan dan profil
6. Halaman kelola takmir masjid
7. Halaman kelola agenda
8. Halaman kelola pengumuman
9. Halaman kelola galeri gambar dan albumnya
10. Halaman kelola galeri video dan kategorinya
11. Halaman kelola user
12. Halaman kelola konfigurasi website, logo
13. Halaman kelola infaq
14. Halaman kelola Jadwal Jumat
15. Dan fitur lainnya

## Mengakses Halaman Website dan Login ke Admin
1. Buka browser Anda
2. Ketik alamat https://websitenda.com
3. Untuk Login ke halaman Back End, silakan buka https://websitenda.com/login
4. Username: admin
5. Password: admin


# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](https://codeigniter.com).

This repository holds the distributable version of the framework.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [CodeIgniter 4](https://forum.codeigniter.com/forumdisplay.php?fid=28) on the forums.

The user guide corresponding to the latest version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [*Contributing to CodeIgniter*](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
