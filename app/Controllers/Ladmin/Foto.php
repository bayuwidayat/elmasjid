<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\AlbumModel;
use App\Models\FotoModel;

class Foto extends BaseController
{
    public function __construct()
    {
        $this->AlbumModel = new AlbumModel();
        $this->FotoModel = new FotoModel();
    }

    public function index()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $data['title'] = 'Galeri Foto';
        $data['get_all_combobox_album'] = $this->AlbumModel->get_all_combobox_album();
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/foto', $data);
    }

    // --- foto -----
    public function ajax_list_foto()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        if (session()->get('level') == 'admin') {
            $list = $this->FotoModel->get_foto();
        } else {
            $list = $this->FotoModel->get_foto_where(['foto.created_by' => session()->get('uname')]);
        }

        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            if (!empty($p->gambar)) {
                $row[] = '<img src="' . base_url() . '/assets/images/foto/' . $p->gambar . '" style="height:40px" >';
            } else {
                $row[] = '';
            }
            $row[] = $p->nm_foto;
            $row[] = $p->nm_album;
            $row[] = $p->created_by;
            $row[] = tgl_indo($p->created_at);
            $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_foto . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_foto(' . "'" . $p->id_foto . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
            $data[] = $row;
        endforeach;

        $output = array(
            "draw" => $this->request->getPost('draw'),
            "data" => $data,
        );
        echo json_encode($output);
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

        $data = $this->FotoModel->get_foto_by_id($id);
        echo json_encode($data);
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
            $gambar->move('assets/images/foto', $namaSampul);

            $data['gambar'] = $namaSampul;
        }

        $data['nm_foto'] = $this->request->getPost('nm_foto');
        $data['foto_seo'] = url_title($this->request->getPost('nm_foto'), '-', true);
        $data['album_id'] = $this->request->getPost('album');
        $data['ket_foto'] = $this->request->getPost('ket_foto');
        $data['tagfoto'] = $this->request->getPost('tagfoto');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->FotoModel->save_foto($data);
        echo json_encode(array("status" => true));
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
            $namaSampul = str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/foto', $namaSampul);

            $data['gambar'] = $namaSampul;

            // gambar lama
            $gambar_l = $this->request->getPost('foto_lm');
            if ($gambar_l != '') {
                $file_name = 'assets/images/foto/' . $gambar_l;
                unlink($file_name);
            }
        }

        $data['nm_foto'] = $this->request->getPost('nm_foto');
        $data['foto_seo'] = url_title($this->request->getPost('nm_foto'), '-', true);
        $data['album_id'] = $this->request->getPost('album');
        $data['ket_foto'] = $this->request->getPost('ket_foto');
        $data['tagfoto'] = $this->request->getPost('tagfoto');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_foto');

        $tambah = $this->FotoModel->update_foto($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete_foto($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $foto = $this->FotoModel->get_foto_by_id($id);
        if (!empty($foto->gambar)) {
            $file = 'assets/images/foto/' . $foto->gambar;
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $delete = $this->FotoModel->delete_foto($id);
        echo json_encode(array("status" => true));
    }
}
