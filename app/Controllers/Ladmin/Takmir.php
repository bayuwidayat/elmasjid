<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\TakmirModel;

class Takmir extends BaseController
{
    public function __construct()
    {
        $this->TakmirModel = new TakmirModel();
    }

    public function index()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $data['title'] = 'Data Takmir Masjid';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/takmir', $data);
    }

    public function ajax_list()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $list = $this->TakmirModel->get_takmir();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = !empty($p->gambar) ? '<img src="' . base_url() . 'assets/images/takmir/' . $p->gambar . '" style="max-height:50px;"/>' : '';
            $row[] = $p->nm_takmir;
            $row[] = $p->jbtn_takmir;
            if (session()->get('level') == 'admin') {
                $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_takmir . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus(' . "'" . $p->id_takmir . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
            } else {
                if ($p->created_by == session()->get('uname')) {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_takmir . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus(' . "'" . $p->id_takmir . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
                } else {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_takmir . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a></div></div>';
                }
            }
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

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama baru
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/takmir', $namaSampul);

            $data['gambar'] = $namaSampul;
        }

        $data['nm_takmir'] = $this->request->getPost('nm_takmir');
        $data['takmir_seo'] = url_title($this->request->getPost('nm_takmir'), '-', true);
        $data['jbtn_takmir'] = $this->request->getPost('jbtn_takmir');
        $data['ket_takmir'] = $this->request->getPost('ket_takmir');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->TakmirModel->save_takmir($data);
        echo json_encode(array("status" => true));
    }

    public function ajax_edit($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $data = $this->TakmirModel->get_takmir_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama baru
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/takmir', $namaSampul);

            $data['gambar'] = $namaSampul;

            // gambar lama
            $gambar_l = $this->request->getPost('foto_lm');
            if ($gambar_l != '') {
                $file_name = 'assets/images/takmir/' . $gambar_l;
                unlink($file_name);
            }
        }

        $data['nm_takmir'] = $this->request->getPost('nm_takmir');
        $data['takmir_seo'] = url_title($this->request->getPost('nm_takmir'), '-', true);
        $data['jbtn_takmir'] = $this->request->getPost('jbtn_takmir');
        $data['ket_takmir'] = $this->request->getPost('ket_takmir');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_takmir');

        $ubah = $this->TakmirModel->update_takmir($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $takmir = $this->TakmirModel->get_takmir_by_id($id);
        if (!empty($takmir->gambar)) {
            $file = 'assets/images/takmir/' . $takmir->gambar;
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $delete = $this->TakmirModel->delete_foto($id);
        echo json_encode(array("status" => true));
    }
}
