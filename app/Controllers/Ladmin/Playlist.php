<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\PlaylistModel;

class Playlist extends BaseController
{
    public function __construct()
    {
        $this->PlaylistModel = new PlaylistModel();
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

        $data['title'] = 'Playlist ';
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/playlist/index', $data);
    }

    // --- playlist -----
    public function ajax_list_playlist()
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $list = $this->PlaylistModel->get_playlist();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            if (!empty($p->gambar)) {
                $row[] = '<img src="' . base_url() . '/assets/images/playlist/' . $p->gambar . '" style="height:40px" >';
            } else {
                $row[] = '';
            }
            $row[] = $p->nm_playlist;
            if ($p->aktif == 'Y') {
                $row[] = '<center><span class="badge badge-success">Ya</span></center>';
            } else if ($p->aktif == 'N') {
                $row[] = '<center><span class="badge badge-danger">Tidak</span></center>';
            }
            if (session()->get('level') == 'admin') {
                $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_playlist . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_playlist(' . "'" . $p->id_playlist . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
            } else {
                if ($p->created_by == session()->get('uname')) {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_playlist . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_playlist(' . "'" . $p->id_playlist . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
                } else {
                    $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_playlist . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a></div></div>';
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
            $gambar->move('assets/images/playlist', $namaSampul);

            $data['gambar'] = $namaSampul;
        }

        $data['nm_playlist'] = $this->request->getPost('nm_playlist');
        $data['playlist_seo'] = url_title($this->request->getPost('nm_playlist'), '-', true);
        $data['keterangan'] = $this->request->getPost('keterangan');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->PlaylistModel->save_playlist($data);

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

        $data = $this->PlaylistModel->get_playlist_by_id($id);
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
            $gambar->move('assets/images/playlist', $namaSampul);

            $data['gambar'] = $namaSampul;

            $foto_lm = $this->request->getPost('foto_lm');
            if ($foto_lm != "") {
                $files = 'assets/images/playlist/' . $foto_lm;
                if (file_exists($files))
                    unlink($files);
            }
        }

        $data['nm_playlist'] = $this->request->getPost('nm_playlist');
        $data['playlist_seo'] = url_title($this->request->getPost('nm_playlist'), '-', true);
        $data['keterangan'] = $this->request->getPost('keterangan');
        $data['aktif'] = $this->request->getPost('aktif');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_playlist');

        $update = $this->PlaylistModel->update_playlist($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete_playlist($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $playlist = $this->PlaylistModel->get_playlist_by_id($id);

        // --- hapus foto ---
        if (!empty($playlist->gambar)) {
            $file_foto = 'assets/images/playlist/' . $playlist->gambar;
            if (file_exists($file_foto)) {
                unlink($file_foto);
            }
        }

        $delete = $this->PlaylistModel->delete_playlist($id);
        echo json_encode(array("status" => true));
    }

    public function pilih_playlist($id)
    {
        $data['id'] = $id;
        $data['get_all_combobox_playlist'] = $this->PlaylistModel->get_all_combobox_playlist();
        return view('backend/playlist/playlist_v', $data);
    }
}
