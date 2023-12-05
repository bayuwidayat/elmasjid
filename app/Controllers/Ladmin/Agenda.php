<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\AgendaModel;

class Agenda extends BaseController
{
    public function __construct()
    {
        $this->AgendaModel = new AgendaModel();
    }

    public function index()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('/ladmin/dashboard'));
        }

        $data['title'] = 'Agenda';
        $data['add'] = '<a href="' . base_url() . 'ladmin/agenda/tambah" class="btn btn-sm btn-success"> <i class="fas fa-plus"></i> Add</a> &nbsp; <a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="reload_table_agenda()"><i class="fas fa-sync-alt"></i> Reload</a></h5>';
        return view('backend/agenda/index', $data);
    }

    // --- agenda -----
    public function ajax_list()
    {
        ceklogin();
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('/ladmin/dashboard'));
        }

        $list = $this->AgendaModel->get_agenda();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = '<a href="' . base_url() . 'agenda/' . $p->id_agenda . '/' . $p->agenda_seo . '" target="_blank">' . $p->nm_agenda . '</a>';
            $row[] = tgl_indo($p->tgl_mulai);
            $row[] = tgl_indo($p->tgl_selesai);
            $row[] = $p->jam;
            $row[] = '<div class="text-center"><div class="btn-group"><a href="' . base_url() . '/ladmin/agenda/edit/' . $p->id_agenda . '" class="btn btn-sm btn-primary" title="Edit Agenda"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_agenda(' . "'" . $p->id_agenda . "'" . ')" title="Hapus Agenda"><i class="fas fa-times fa-sm"></i></a></div></div>';
            $data[] = $row;
        endforeach;

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function tambah()
    {
        if (!session()->has('masukMember')) {
            return redirect()->to(base_url());
        }

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('/ladmin/dashboard'));
        }

        $data['title'] = 'Tambah Agenda';
        return view('backend/agenda/agenda_add', $data);
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
            // generate nama sampul random
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/agenda', $namaSampul);

            $data['gambar'] = $namaSampul;
        }

        $data['nm_agenda'] = $this->request->getPost('judul');
        $data['agenda_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['isi_agenda'] = $this->request->getPost('isi_agenda');
        $data['tempat'] = $this->request->getPost('tempat');
        $data['koordinator'] = $this->request->getPost('koordinator');
        $data['telp_koordinator'] = $this->request->getPost('telp_koordinator');
        $data['tgl_mulai'] = $this->request->getPost('tgl_mulai');
        $data['tgl_selesai'] = $this->request->getPost('tgl_selesai');
        $data['jam'] = $this->request->getPost('jam');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->AgendaModel->save_agenda($data);
        return redirect()->to(base_url('/ladmin/agenda'));
    }

    public function edit($id)
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('/ladmin/dashboard'));
        }

        // jika Admin
        if (session()->get('level') == 'admin') {
            $data['agenda'] = $this->AgendaModel->get_agenda_by_id($id);
            // jika data ditemukan
            if (!empty($data['agenda']->id_agenda)) {
                $data['title'] = 'Edit Data Agenda';
                return view('backend/agenda/agenda_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan</div>');
                return redirect()->to(base_url('ladmin/agenda'));
            }
        } else if (session()->get('level') == 'user') {
            $data['agenda'] = $this->AgendaModel->get_agenda_by_id($id, session()->get('uname'));
            if (!empty($data['agenda']->id_agenda)) {
                $data['title'] = 'Edit Data Agenda';
                return view('backend/agenda/agenda_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan atau Anda tidak mempunyai hak akses terhadap data tersebut.</div>');
                return redirect()->to(base_url('ladmin/agenda'));
            }
        }

        $data['agenda'] = $this->AgendaModel->get_agenda_by_id($id);
        $data['title'] = 'Edit Data Agenda';
        return view('backend/agenda/agenda_edit', $data);
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
            // generate nama sampul random
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/agenda', $namaSampul);

            $data['gambar'] = $namaSampul;

            // gambar lama
            $gambar_l = $this->request->getPost('gambar');
            if ($gambar_l != '') {
                $file_name = 'assets/images/agenda/' . $gambar_l;
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
            }
        }

        $data['nm_agenda'] = $this->request->getPost('judul');
        $data['agenda_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['isi_agenda'] = $this->request->getPost('isi_agenda');
        $data['tempat'] = $this->request->getPost('tempat');
        $data['koordinator'] = $this->request->getPost('koordinator');
        $data['telp_koordinator'] = $this->request->getPost('telp_koordinator');
        $data['tgl_mulai'] = $this->request->getPost('tgl_mulai');
        $data['tgl_selesai'] = $this->request->getPost('tgl_selesai');
        $data['jam'] = $this->request->getPost('jam');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_agenda');

        $tambah = $this->AgendaModel->update_agenda($data, $id);
        return redirect()->to(base_url('/ladmin/agenda'));
    }

    public function ajax_delete_agenda($id)
    {
        ceklogin();

        $agenda = $this->AgendaModel->get_agenda_by_id($id);
        if (!empty($agenda->gambar)) {
            $file = 'assets/images/agenda/' . $agenda->gambar;
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $delete = $this->AgendaModel->delete_agenda($id);
        echo json_encode(array("status" => true));
    }

    //Upload image summernote
    function upload_image()
    {
        $gambar = $this->request->getFile('image');

        if ($gambar->getError() == 4) {
            echo '';
        } else {
            // generate nama sampul random
            $namaSampul = $gambar->getRandomName();
            // pindahkan file ke img
            $gambar->move('assets/images/agenda', $namaSampul);
            echo base_url() . '/assets/images/agenda/' . $namaSampul;
        }
    }

    //Delete image summernote
    function delete_image()
    {
        $src = $this->request->getPost('src');
        $file_name = str_replace(base_url() . '/', '', $src);
        if (unlink($file_name)) {
            echo 'File Delete Successfully';
        }
    }

    public function ajax_delete_gambar($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $agenda = $this->AgendaModel->get_agenda_by_id($id);
        if (!empty($agenda->gambar)) {
            $file = 'assets/images/agenda/' . $agenda->gambar;
            if (file_exists($file)) {
                unlink($file);
                $data['gambar'] = '';
                $this->AgendaModel->update_agenda($data, $id);
            }
        }

        echo json_encode(array("status" => true));
    }
}
