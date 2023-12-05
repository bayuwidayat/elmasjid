<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
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

        $data['title'] = 'Kategori Berita';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table_kategori()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/kategori', $data);
    }

    // --- kategori -----
    public function ajax_list()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $list = $this->KategoriModel->get_kategori();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = $p->nm_kategori;
            $row[] = $p->kategori_seo;
            if (session()->get('level') == 'admin') {
                $row[] = '<center><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_kategori . "'" . ')" class="btn btn-sm btn-primary" title="Edit Kategori"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_kategori(' . "'" . $p->id_kategori . "'" . ')" title="Hapus Kategori"><i class="fas fa-times fa-sm"></i></a></div></center>';
            } else {
                if ($p->created_by == session()->get('uname')) {
                    $row[] = '<center><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_kategori . "'" . ')" class="btn btn-sm btn-primary" title="Edit Kategori"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_kategori(' . "'" . $p->id_kategori . "'" . ')" title="Hapus Kategori"><i class="fas fa-times fa-sm"></i></a></div></center>';
                } else {
                    $row[] = '<center><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_kategori . "'" . ')" class="btn btn-sm btn-primary" title="Edit Kategori"><i class="fas fa-pen fa-sm"></i></a></center>';
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

        $data['nm_kategori'] = $this->request->getPost('nm_kategori');
        $data['kategori_seo'] = url_title($this->request->getPost('nm_kategori'), '-', true);
        $data['created_by'] = session()->get('uname');

        $tambah = $this->KategoriModel->save_kategori($data);

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

        $data = $this->KategoriModel->get_kategori_by_id($id);
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

        $data['nm_kategori'] = $this->request->getPost('nm_kategori');
        $data['kategori_seo'] = url_title($this->request->getPost('nm_kategori'), '-', true);
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_kategori');

        $update = $this->KategoriModel->update_kategori($data, $id);
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

        $delete = $this->KategoriModel->delete_kategori($id);
        echo json_encode(array("status" => true));
    }
}
