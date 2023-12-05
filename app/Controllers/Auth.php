<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        if (session()->has('masukMember')) {
            return redirect()->to(base_url() . 'ladmin/dashboard');
        }

        $data['title'] = 'Login Dashboard';
        return view('auth/index', $data);
    }

    public function login_do()
    {
        $data['username'] = $this->request->getPost('username');
        $passwd = md5($this->request->getPost('password'));
        $data['password'] = hash("sha512", $passwd);
        $data['blokir'] = 'N';
        $hasil = $this->UsersModel->get_users($data);

        if (count($hasil) == 1) {
            // set session
            $sess_data = array(
                'masukMember' => TRUE,
                'uname' => $hasil[0]->username,
                'nama_lengkap' => $hasil[0]->nama_lengkap,
                'foto' => $hasil[0]->foto,
                'level' => $hasil[0]->level,
                'id_session' => $hasil[0]->id_session,
            );
            $this->session->set($sess_data);

            return redirect()->to(base_url('ladmin/dashboard'));

            exit();
        } else {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger color-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Username atau Password Salah</div>');
            return redirect()->to(base_url('login'));
        }
    }

    public function logout_do()
    {
        $this->session->destroy();
        $this->session->setFlashdata('pesan', '<div class="alert alert-info alert-dismissible"><<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Anda berhasil Logout</div>');
        return redirect()->to(base_url('login'));
    }
}
