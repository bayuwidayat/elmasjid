<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\ModulModel;

class Modul extends BaseController
{
    public function __construct()
    {
        $this->ModulModel = new ModulModel();
    }

    public function index()
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data['title'] = 'Modul';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-2" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table_modul()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/modul', $data);
    }

    // --- modul -----
    public function ajax_list()
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $list = $this->ModulModel->get_modul();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = $p->nm_modul;
            $row[] = $p->links;
            if ($p->aktif == 'Y') {
                $row[] = '<div class="text-center"><span class="badge bg-primary rounded-pill">Ya</span></div>';
            } else if ($p->aktif == 'N') {
                $row[] = '<div class="text-center"><span class="badge bg-danger rounded-pill">Tidak</span></div>';
            }
            $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_modul . "'" . ')" class="btn btn-sm btn-primary" title="Edit Modul"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_modul(' . "'" . $p->id_modul . "'" . ')" title="Hapus Modul"><i class="fas fa-times fa-sm"></i></a></div></div>';
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

        $data['nm_modul'] = $this->request->getPost('nm_modul');
        $data['links'] = $this->request->getPost('links');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->ModulModel->save_modul($data);

        echo json_encode(array("status" => true));
    }

    public function ajax_edit($id)
    {
        cekadmin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data = $this->ModulModel->get_modul_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        cekadmin();
        cekadmin(); // hanya boleh diakses oleh admin

        $data['nm_modul'] = $this->request->getPost('nm_modul');
        $data['links'] = $this->request->getPost('links');
        $data['aktif'] = $this->request->getPost('aktif');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_modul');

        $update = $this->ModulModel->update_modul($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete($id)
    {
        ceklogin();
        cekadmin(); // hanya boleh diakses oleh admin

        $delete = $this->ModulModel->delete_modul($id);
        echo json_encode(array("status" => true));
    }
}
