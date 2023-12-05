<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\SettingModel;

class Setting extends BaseController
{
    public function __construct()
    {
        $this->SettingModel = new SettingModel();
    }

    public function index()
    {
        ceklogin();
        cekadmin();

        $data['title'] = 'Setting Website';
        $data['setting'] = $this->SettingModel->get_setting();
        return view('backend/setting/index', $data);
    }

    public function ajax_update()
    {
        ceklogin();
        cekadmin();

        $data['maintenance'] = $this->request->getPost('maintenance');
        $data['nm_website'] = $this->request->getPost('nm_website');
        $data['singkatan'] = $this->request->getPost('singkatan');
        $data['slogan'] = $this->request->getPost('slogan');
        $data['meta_deskripsi'] = $this->request->getPost('meta_deskripsi');
        $data['meta_keyword'] = $this->request->getPost('meta_keyword');
        $data['tentang'] = $this->request->getPost('tentang');
        $data['deskripsi'] = $this->request->getPost('deskripsi');
        $data['email'] = $this->request->getPost('email');
        $data['no_telp'] = $this->request->getPost('no_telp');
        $data['no_wa'] = $this->request->getPost('no_wa');
        $data['btn_wa'] = $this->request->getPost('btn_wa');
        $data['pesan_wa'] = $this->request->getPost('pesan_wa');
        $data['letak_wa'] = $this->request->getPost('letak_wa');
        $data['alamat'] = $this->request->getPost('alamat');
        $data['google_map'] = $this->request->getPost('google_map');
        $data['facebook'] = $this->request->getPost('facebook');
        $data['instagram'] = $this->request->getPost('instagram');
        $data['twitter'] = $this->request->getPost('twitter');
        $data['youtube'] = $this->request->getPost('youtube');
        $data['linkedin'] = $this->request->getPost('linkedin');
        $data['tiktok'] = $this->request->getPost('tiktok');
        $data['kota_id'] = $this->request->getPost('kota_id');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_setting');

        $update = $this->SettingModel->update_setting($data, $id);

        $this->session->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil diperbaharui</div>');

        return redirect()->to(base_url('ladmin/setting'));
    }

    public function logo_website()
    {
        ceklogin();
        cekadmin();

        $data['title'] = 'Update Logo Website';
        $data['setting'] = $this->SettingModel->get_setting();
        return view('backend/setting/logo', $data);
    }

    public function update_logo()
    {
        // favicon
        $gambar_fav = $this->request->getFile('foto_fav');
        if ($gambar_fav != '') {
            // generate nama baru
            $namaSampul_fav = str_replace(' ', '-', $gambar_fav->getName());
            // pindahkan file ke img
            $gambar_fav->move('assets/images', $namaSampul_fav);

            $data['favicon'] = $namaSampul_fav;

            // gambar lama
            $gambar_fav_l = $this->request->getPost('fav_lm');
            if ($gambar_fav_l != '') {
                $file_name_fav = 'assets/images/' . $gambar_fav_l;
                if (file_exists($file_name_fav)) {
                    unlink($file_name_fav);
                }
            }
        }

        // logo website
        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama baru
            $namaSampul = str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images', $namaSampul);

            $data['logo_website'] = $namaSampul;

            // gambar lama
            $gambar_l = $this->request->getPost('foto_lm');
            if ($gambar_l != '') {
                $file_name = 'assets/images/' . $gambar_l;
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
            }
        }

        $id = $this->request->getPost('id_setting');

        if ($gambar_fav != '' or $gambar != '') {
            $update = $this->SettingModel->update_setting($data, $id);
        }

        $this->session->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil diperbaharui</div>');

        return redirect()->to(base_url('ladmin/setting/logo'));
    }

    public function codex()
    {
        ceklogin();
        cekadmin();

        $data['title'] = 'Code Header Footer';
        $data['setting'] = $this->SettingModel->get_setting();
        return view('backend/setting/codex', $data);
    }

    public function update_codex()
    {
        ceklogin();
        cekadmin();

        $data['cdx_header'] = $this->request->getPost('cdx_header');
        $data['cdx_footer'] = $this->request->getPost('cdx_footer');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_setting');

        $update = $this->SettingModel->update_setting($data, $id);

        $this->session->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil diperbaharui</div>');

        return redirect()->to(base_url('ladmin/setting/codex'));
    }
}
