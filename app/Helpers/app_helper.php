<?php

use \App\Models\HubungiModel;
use \App\Models\SettingModel;
use \App\Models\SmtpModel;
use \App\Models\TemplatesModel;

function setting()
{
    $model = new SettingModel();
    $setting = $model->get_setting();
    return $setting;
}

function templates()
{
    $model = new TemplatesModel();
    $template = $model->get_templates_aktif();
    if (!empty($template->id_templates)) {
        return $template;
    } else {
        return "Error";
    }
}

function pesan_baru()
{
    $model = new HubungiModel();
    $hubungi = $model->get_hubungi('N');
    return $hubungi;
}

function smtp()
{
    $model = new SmtpModel();
    $smtp_reg = $model->get_smtp();
    return $smtp_reg;
}

function ceklogin()
{
    $session = \Config\Services::session();
    if ($session->get('uname') === '' || $session->get('uname') === null) {
        echo '<script>';
        echo 'window.location.href = "' . base_url('login') . '";';
        echo '</script>';
    }
}

function cekadmin()
{
    $session = \Config\Services::session();
    if ($session->get('level') != 'admin') {
        echo '<script>';
        echo 'window.location.href = "' . base_url('ladmin/dashboard') . '";';
        echo '</script>';
    }
}

function cek_hak_akses($link, $username)
{
    $um = new \App\Models\UsersmodulModel;
    $usersmodul = $um->get_hak_akses($link, $username);
    return $usersmodul;
}

function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function tgl_indo2($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = substr(getBulan(substr($tgl, 5, 2)), 0, 3);
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}


function sendEmail($to, $subjek, $pesan, $lampiran)
{
    $email = \Config\Services::email();

    // --- setting smtp ---
    $config['SMTPPort'] = smtp()->smtp_port;
    $config['protocol'] = smtp()->smtp_protocol;
    $config['SMTPHost'] = smtp()->smtp_host;
    $config['SMTPUser'] = smtp()->smtp_user;
    $config['SMTPPass'] = smtp()->smtp_pass;
    $config['SMTPCrypto'] = smtp()->smtp_crypto;
    $config['SMTPTimeout'] = smtp()->smtp_timeout;
    $config['mailType'] = 'html';

    $email->initialize($config);

    $email->setFrom(smtp()->smtp_user, smtp()->nm_pengirim);
    $email->setTo($to);

    if ($lampiran != '') {
        $email->attach($lampiran);
    }

    $email->setSubject($subjek);
    $email->setMessage($pesan);

    if (!$email->send()) {
        return false;
    } else {
        return true;
    }
}

function format_rupiah($angka)
{
    $rupiah = number_format($angka, 0, ',', '.');
    $harga = $rupiah . ',-';
    return $harga;
}

function social_share($title, $url)
{
    $text = '<a class="btn btn-primary btn-square me-2" href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" title="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>';
    $text .= '<a class="btn btn-primary btn-square me-2" href="https://twitter.com/intent/tweet?text=' . $title . '&url=' . $url . '" title="X" target="_blank"><svg width="100%" height="100%" style="display:block;border-radius:999px;" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
            <path fill="#fff" d="M21.751 7h3.067l-6.7 7.658L26 25.078h-6.172l-4.833-6.32-5.531 6.32h-3.07l7.167-8.19L6 7h6.328l4.37 5.777L21.75 7Zm-1.076 16.242h1.7L11.404 8.74H9.58l11.094 14.503Z"></path>
        </svg></a>';
    $text .= '<a class="btn btn-primary btn-square me-2" href="https://api.whatsapp.com/send?text=' . $title . '%20' . $url . '" title="Whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>';
    $text .= '<a class="btn btn-primary btn-square me-2" href="http://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '" title="Linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>';
    $text .= '<a class="btn btn-primary btn-square me-2" href="https://t.me/share/url?url=' . $url . '&text=' . $title . '" title="Telegram" target="_blank"><i class="fab fa-telegram-plane"></i></a>';

    return $text;
}
