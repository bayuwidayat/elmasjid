<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\ModulModel;
use App\Models\UsersModel;
use App\Models\UsersmodulModel;

class Users extends BaseController
{
    public function __construct()
    {
        $this->ModulModel = new ModulModel();
        $this->UsersModel = new UsersModel();
        $this->UsersmodulModel = new UsersmodulModel();
    }

    public function index()
    {
        ceklogin();
        cekadmin();

        $data['title'] = 'Data Users';
        $data['get_all_combobox_modul'] = $this->ModulModel->get_all_combobox_modul();
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/users/index', $data);
    }

    public function ajax_list()
    {
        ceklogin();
        cekadmin();

        $list = $this->UsersModel->get_all_users();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = $p->username;
            $row[] = $p->nama_lengkap;
            $row[] = $p->level;
            $datau = $this->UsersmodulModel->get_usersmodul_by_username($p->username);
            $modul_v = '';
            foreach ($datau as $d) {
                $modul_v .= '<span class="badge badge-success">' . $d->nm_modul . '</span> ';
                // $modul_v .= $d->nm_modul . ', ';
            }
            $row[] = $modul_v;
            if ($p->blokir == 'Y') {
                $row[] = '<span class="badge badge-danger">Ya</span>';
            } else if ($p->blokir == 'N') {
                $row[] = '<span class="badge badge-success">Tidak</span>';
            }
            $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_session . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a>
                <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus(' . "'" . $p->id_session . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
            $data[] = $row;
        endforeach;

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_save()
    {
        ceklogin();
        cekadmin();

        // --- password ----
        if (empty($this->request->getPost('password'))) {
            $passwd = md5('asdfghjkl');
        } else {
            $passwd = md5($this->request->getPost('password'));
        }

        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama sampul random
            $namaSampul = $gambar->getRandomName();
            // pindahkan file ke img
            $gambar->move('assets/images/users', $namaSampul);

            $data['foto'] = $namaSampul;
        }

        $data['username'] = $this->request->getPost('username');
        $data['password'] = hash("sha512", $passwd);
        $data['nama_lengkap'] = $this->request->getPost('nama_lengkap');
        $data['email'] = $this->request->getPost('email');

        if (!empty($this->request->getPost('level'))) {
            $data['level'] = $this->request->getPost('level');
        }

        if (!empty($this->request->getPost('blokir'))) {
            $data['blokir'] = $this->request->getPost('blokir');
        }

        $id_session = md5($this->request->getPost('username')) . date('YmdHis');
        $data['id_session'] = $id_session;

        // simpan data users
        $tambah = $this->UsersModel->save_users($data);

        $modul = explode(';', $this->request->getPost('modul'));
        $jmodul = count($modul);
        if ($jmodul > 0) {
            for ($i = 0; $i < $jmodul; $i++) {
                $data_uda['modul_id'] = $modul[$i];
                $data_uda['username'] = $this->request->getPost('username');
                $data_uda['created_by'] = session()->get('uname');
                $tambah_uda = $this->UsersmodulModel->save_usersmodul($data_uda);
            }
        }

        echo json_encode(array("status" => true));
    }

    public function ajax_edit($id)
    {
        ceklogin();
        cekadmin();

        $data = $this->UsersModel->get_users_by_session($id);

        echo json_encode($data);
    }

    public function ajax_usersmodul($username)
    {
        $datau = $this->UsersmodulModel->get_usersmodul_by_username($username);
        foreach ($datau as $d) {
            echo '<span class="badge badge-success">' . $d->nm_modul . '</span> ';
        }
    }

    public function ajax_update()
    {
        ceklogin();
        cekadmin();

        // --- password ----
        if (!empty($this->request->getPost('password'))) {
            $passwd = md5($this->request->getPost('password'));
            $data['password'] = hash("sha512", $passwd);
        }

        // --- foto ---
        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama sampul random
            $namaSampul = $gambar->getRandomName();
            // pindahkan file ke img
            $gambar->move('assets/images/users', $namaSampul);

            $data['foto'] = $namaSampul;

            $foto_lm = $this->request->getPost('foto_lm');
            if ($foto_lm != "") {
                $files = 'assets/images/users/' . $foto_lm;
                if (file_exists($files))
                    unlink($files);
            }
        }

        $username = $this->request->getPost('username');
        $data['nama_lengkap'] = $this->request->getPost('nama_lengkap');
        $data['email'] = $this->request->getPost('email');

        if (!empty($this->request->getPost('level'))) {
            $data['level'] = $this->request->getPost('level');
        }

        if (!empty($this->request->getPost('blokir'))) {
            $data['blokir'] = $this->request->getPost('blokir');
        }

        $id_session = $this->request->getPost('id_session');

        $update = $this->UsersModel->update_users($data, $id_session);

        // hak akses modul
        if (!empty($this->request->getPost('modul'))) {
            $delele_usersmodul = $this->UsersmodulModel->delete_by_username($username);

            $modul = explode(';', $this->request->getPost('modul'));
            $jmodul = count($modul);
            if ($jmodul > 0) {
                for ($i = 0; $i < $jmodul; $i++) {
                    $data_uda['modul_id'] = $modul[$i];
                    $data_uda['username'] = $username;
                    $data_uda['created_by'] = session()->get('uname');
                    $tambah_uda = $this->UsersmodulModel->save_usersmodul($data_uda);
                }
            }
        }
        echo json_encode(array("status" => true));
    }

    public function ajax_delete($id)
    {
        ceklogin();
        cekadmin();

        $user = $this->UsersModel->get_users_by_session($id);

        // --- hapus foto ---
        if (!empty($user->foto)) {
            $file_foto = 'assets/images/users/' . $user->foto;
            if (file_exists($file_foto)) {
                unlink($file_foto);
            }
        }

        $deleteUsers = $this->UsersModel->delete_users($id);
        $delete_uda = $this->UsersmodulModel->delete_by_username($user->username);

        echo json_encode(array("status" => true));
    }

    public function profile()
    {
        ceklogin();

        $datap['username'] = session()->get('uname');
        $datap['id_session'] = session()->get('id_session');
        $data['user'] = $this->UsersModel->get_users($datap);
        $data['title'] = 'Update Profile';
        return view('backend/users/profile', $data);
    }

    // update profile guest, user, admin
    public function ajax_update_profile()
    {
        ceklogin();

        // --- password ----
        if (!empty($this->request->getPost('password'))) {
            $passwd = md5($this->request->getPost('password'));
            $data['password'] = hash("sha512", $passwd);
        }

        // --- foto ---
        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama sampul random
            $namaSampul = $gambar->getRandomName();
            // pindahkan file ke img
            $gambar->move('assets/images/users', $namaSampul);

            $data['foto'] = $namaSampul;

            $foto_lm = $this->request->getPost('foto_lm');
            if ($foto_lm != "") {
                $files = 'assets/images/users/' . $foto_lm;
                if (file_exists($files))
                    unlink($files);
            }
        }

        $data['nama_lengkap'] = $this->request->getPost('nama_lengkap');
        $data['email'] = $this->request->getPost('email');
        $username = session()->get('uname');
        $id_session = session()->get('id_session');

        $update = $this->UsersModel->update_users_profile($data, $id_session, $username);

        if ($update) {
            $this->session->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil diperbaharui</div>');
        } else {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal diperbaharui</div>');
        }

        return redirect()->to(base_url('ladmin/profile'));
    }
}
