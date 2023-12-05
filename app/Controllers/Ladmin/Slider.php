<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\SliderModel;

class Slider extends BaseController
{
    public function __construct()
    {
        $this->SliderModel = new SliderModel();
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

        $data['title'] = 'Slide Gambar';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/slider', $data);
    }

    // --- slider -----
    public function ajax_list()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $list = $this->SliderModel->get_slider();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            if (!empty($p->gambar)) {
                $row[] = '<img src="' . base_url() . 'assets/images/slider/' . $p->gambar . '" style="height:40px" >';
            } else {
                $row[] = '';
            }
            $row[] = $p->nm_slider;
            if ($p->aktif == 'Y') {
                $row[] = '<center><span class="badge badge-success">Ya</span></center>';
            } else if ($p->aktif == 'N') {
                $row[] = '<center><span class="badge badge-danger">Tidak</span></center>';
            }
            $row[] = $p->created_by;

            if (session()->get('level') == 'admin') {
                $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_slider . "'" . ')" class="btn btn-sm btn-primary" title="Edit Slider"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_slider(' . "'" . $p->id_slider . "'" . ')" title="Hapus Slider"><i class="fas fa-times fa-sm"></i></a></div></div>';
            } else {
                if ($p->created_by == session()->get('uname')) {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_slider . "'" . ')" class="btn btn-sm btn-primary" title="Edit Slider"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_slider(' . "'" . $p->id_slider . "'" . ')" title="Hapus Slider"><i class="fas fa-times fa-sm"></i></a></div></div>';
                } else {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_slider . "'" . ')" class="btn btn-sm btn-primary" title="Edit Slider"><i class="fas fa-pen fa-sm"></i></a></div></div>';
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
            $namaSampul = str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/slider', $namaSampul);

            $data['gambar'] = $namaSampul;
        }

        $data['nm_slider'] = $this->request->getPost('nm_slider');
        $data['slider_seo'] = url_title($this->request->getPost('nm_slider'), '-', true);
        $data['ket_slider'] = $this->request->getPost('ket_slider');
        $data['link'] = $this->request->getPost('link');
        $data['text_link'] = $this->request->getPost('text_link');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->SliderModel->save_slider($data);

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

        $data = $this->SliderModel->get_slider_by_id($id);
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

        // --- foto ---
        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama baru
            $namaSampul = str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/slider', $namaSampul);

            $data['gambar'] = $namaSampul;

            $foto_lm = $this->request->getPost('foto_lm');
            if ($foto_lm != "") {
                $files = 'assets/images/slider/' . $foto_lm;
                if (file_exists($files))
                    unlink($files);
            }
        }

        $data['nm_slider'] = $this->request->getPost('nm_slider');
        $data['slider_seo'] = url_title($this->request->getPost('nm_slider'), '-', true);
        $data['ket_slider'] = $this->request->getPost('ket_slider');
        $data['link'] = $this->request->getPost('link');
        $data['text_link'] = $this->request->getPost('text_link');
        $data['aktif'] = $this->request->getPost('aktif');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_slider');

        $update = $this->SliderModel->update_slider($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete_slider($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $foto = $this->SliderModel->get_slider_by_id($id);
        if (!empty($foto->gambar)) {
            $file = 'assets/images/slider/' . $foto->gambar;
            if (file_exists($file)) {
                unlink($file);
            }
        }

        $delete = $this->SliderModel->delete_slider($id);
        echo json_encode(array("status" => true));
    }

    public function pilih_slider($id)
    {
        $data['id'] = $id;
        $data['get_all_combobox_slider'] = $this->SliderModel->get_all_combobox_slider();
        return view('backend/slider/slider_v', $data);
    }
}
