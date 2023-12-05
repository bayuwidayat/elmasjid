<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\InfaqModel;

class Infaq extends BaseController
{
    public function __construct()
    {
        $this->InfaqModel = new InfaqModel();
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

        $data['title'] = 'Daftar Infaq';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table_infaq()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/infaq', $data);
    }

    // --- infaq -----
    public function ajax_list()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $list = $this->InfaqModel->get_infaq();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = tgl_indo($p->tanggal);
            $row[] = $p->keterangan;
            $row[] = '<div class="text-right">' . format_rupiah($p->jml_dana) . '</div>';
            $row[] = $p->jenis;
            if (session()->get('level') == 'admin') {
                $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_infaq . "'" . ')" class="btn btn-sm btn-primary" title="Edit Infaq"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_infaq(' . "'" . $p->id_infaq . "'" . ')" title="Hapus Infaq"><i class="fas fa-times fa-sm"></i></a></div></div>';
            } else {
                if ($p->created_by == session()->get('uname')) {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_infaq . "'" . ')" class="btn btn-sm btn-primary" title="Edit Infaq"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_infaq(' . "'" . $p->id_infaq . "'" . ')" title="Hapus Infaq"><i class="fas fa-times fa-sm"></i></a></div></div>';
                } else {
                    $row[] = '<div class="text-center"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_infaq . "'" . ')" class="btn btn-sm btn-primary" title="Edit Infaq"><i class="fas fa-pen fa-sm"></i></a></div>';
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

    public function ajax_saldo()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }
        $danaMasuk = $this->InfaqModel->get_infaq_total(['jenis' => 'Dana Masuk'])->jml;
        $danaKeluar = $this->InfaqModel->get_infaq_total(['jenis' => 'Dana Keluar'])->jml;
        $saldo = $danaMasuk - $danaKeluar;
        echo '<div class="row">
                <div class="col-md-4">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Rp. ' . format_rupiah($danaMasuk) . '</h3>
                            <p>Total Dana Masuk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chevron-circle-down"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Rp. ' . format_rupiah($danaKeluar) . '</h3>
                            <p>Total Dana Keluar</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chevron-circle-up"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Rp. ' . format_rupiah($saldo) . '</h3>
                            <p>Total SALDO</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dot-circle"></i>
                        </div>
                    </div>
                </div>
            </div>';
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

        $data['tanggal'] = $this->request->getPost('tanggal');
        $data['jenis'] = $this->request->getPost('jenis');
        $data['keterangan'] = $this->request->getPost('keterangan');
        $data['jml_dana'] = $this->request->getPost('jml_dana');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->InfaqModel->save_infaq($data);

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

        $data = $this->InfaqModel->get_infaq_by_id($id);
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

        $data['tanggal'] = $this->request->getPost('tanggal');
        $data['jenis'] = $this->request->getPost('jenis');
        $data['keterangan'] = $this->request->getPost('keterangan');
        $data['jml_dana'] = $this->request->getPost('jml_dana');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_infaq');

        $update = $this->InfaqModel->update_infaq($data, $id);
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

        $delete = $this->InfaqModel->delete_infaq($id);
        echo json_encode(array("status" => true));
    }
}
