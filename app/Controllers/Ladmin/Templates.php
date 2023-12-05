<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\TemplatesModel;

class Templates extends BaseController
{
    public function __construct()
    {
        $this->TemplatesModel = new TemplatesModel();
    }

    public function index()
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data['title'] = 'Templates';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table_templates()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/templates', $data);
    }

    // --- templates -----
    public function ajax_list_templates()
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $list = $this->TemplatesModel->get_templates();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = $p->nm_templates;
            $row[] = '<a href="' . base_url() . 'ladmin/templates/warna">' . ((!empty($p->warna_templates)) ? $p->warna_templates : 'Pilih Warna') . '</a>';
            $row[] = $p->pembuat;
            $row[] = $p->folder;
            if ($p->aktif == 'Y') {
                $row[] = '<center><span class="badge badge-success">Ya</span></center>';
            } else if ($p->aktif == 'N') {
                $row[] = '<center><span class="badge badge-danger">Tidak</span></center>';
            }
            $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" class="btn btn-sm btn-success" onclick="aktif_templates(' . "'" . $p->id_templates . "'" . ')"><i class="fas fa-check fa-sm"></i></a> <a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_templates . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_templates(' . "'" . $p->id_templates . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
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
        cekadmin(); // hanya boleh diakses oleh admin

        $data['nm_templates'] = $this->request->getPost('nm_templates');
        $data['folder'] = $this->request->getPost('folder');
        $data['pembuat'] = $this->request->getPost('pembuat');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->TemplatesModel->save_templates($data);

        echo json_encode(array("status" => true));
    }

    public function ajax_edit($id)
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data = $this->TemplatesModel->get_templates_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data['nm_templates'] = $this->request->getPost('nm_templates');
        $data['folder'] = $this->request->getPost('folder');
        $data['pembuat'] = $this->request->getPost('pembuat');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_templates');

        $update = $this->TemplatesModel->update_templates($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete_templates($id)
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $delete = $this->TemplatesModel->delete_templates($id);
        echo json_encode(array("status" => true));
    }

    public function ajax_aktif_templates($id)
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin
        // aktifkan template yg dipilih
        $aktifkan = $this->TemplatesModel->update_templates(array('aktif' => 'Y'), $id);

        // nonaktifkan template yang lainnya
        $nonaktifkan = $this->TemplatesModel->nonaktifkan_templates(array('aktif' => 'N'), $id);
        echo json_encode(array("status" => true));
    }

    public function warna()
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data['title'] = 'Skema Warna';
        $data['templates'] = $this->TemplatesModel->get_templates_aktif();
        return view('backend/warna', $data);
    }

    public function update_warna()
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data['warna_templates'] = $this->request->getPost('warna_templates');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_templates');

        $update = $this->TemplatesModel->update_templates($data, $id);
        if ($update) {
            $this->session->setFlashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil diperbaharui</div>');
        } else {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Gagal diperbaharui</div>');
        }
        return redirect()->to(base_url('ladmin/templates/warna'));
    }
}
