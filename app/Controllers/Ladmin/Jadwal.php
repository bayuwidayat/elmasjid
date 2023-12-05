<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\JadwalModel;

class Jadwal extends BaseController
{
    public function __construct()
    {
        $this->JadwalModel = new JadwalModel();
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

        $data['title'] = 'Jadwal Jumat';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table_jadwal()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/jadwal', $data);
    }

    // --- jadwal -----
    public function ajax_list()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $list = $this->JadwalModel->get_jadwal();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = ($p->tipe == 'tanggal') ? $p->tanggal : $p->nm_jadwal;
            $row[] = $p->imam;
            $row[] = $p->khatib;
            $row[] = $p->muadzin;
            $row[] = $p->bilal;
            if (session()->get('level') == 'admin') {
                $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_jadwal . "'" . ')" class="btn btn-sm btn-primary" title="Edit jadwal jumat"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_jadwal(' . "'" . $p->id_jadwal . "'" . ')" title="Hapus Jadwal Jumat"><i class="fas fa-times fa-sm"></i></a></div></div>';
            } else {
                if ($p->created_by == session()->get('uname')) {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_jadwal . "'" . ')" class="btn btn-sm btn-primary" title="Edit jadwal jumat"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_jadwal(' . "'" . $p->id_jadwal . "'" . ')" title="Hapus Jadwal Jumat"><i class="fas fa-times fa-sm"></i></a></div></div>';
                } else {
                    $row[] = '<div class="text-center"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_jadwal . "'" . ')" class="btn btn-sm btn-primary" title="Edit jadwal jumat"><i class="fas fa-pen fa-sm"></i></a></div>';
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

        $data['tipe'] = $this->request->getPost('tipe');
        $data['nm_jadwal'] = $this->request->getPost('nm_jadwal');
        $data['tanggal'] = $this->request->getPost('tanggal');
        $data['imam'] = $this->request->getPost('imam');
        $data['khatib'] = $this->request->getPost('khatib');
        $data['muadzin'] = $this->request->getPost('muadzin');
        $data['bilal'] = $this->request->getPost('bilal');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->JadwalModel->save_jadwal($data);

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

        $data = $this->JadwalModel->get_jadwal_by_id($id);
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

        $data['tipe'] = $this->request->getPost('tipe');
        $data['nm_jadwal'] = $this->request->getPost('nm_jadwal');
        $data['tanggal'] = $this->request->getPost('tanggal');
        $data['imam'] = $this->request->getPost('imam');
        $data['khatib'] = $this->request->getPost('khatib');
        $data['muadzin'] = $this->request->getPost('muadzin');
        $data['bilal'] = $this->request->getPost('bilal');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_jadwal');

        $update = $this->JadwalModel->update_jadwal($data, $id);
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

        $delete = $this->JadwalModel->delete_jadwal($id);
        echo json_encode(array("status" => true));
    }
}
