<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\PlaylistModel;
use App\Models\VideoModel;

class Video extends BaseController
{
    public function __construct()
    {
        $this->PlaylistModel = new PlaylistModel();
        $this->VideoModel = new VideoModel();
    }

    public function index()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $data['title'] = 'Galeri Video';
        $data['get_all_combobox_playlist'] = $this->PlaylistModel->get_all_combobox_playlist();
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="#" class="btn btn-sm btn-warning" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/video', $data);
    }

    // --- video -----
    public function ajax_list_video()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        if (session()->get('level') == 'admin') {
            $list = $this->VideoModel->get_video();
        } else {
            $list = $this->VideoModel->get_video_where(['video.created_by' => session()->get('uname')]);
        }

        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $video = str_replace('watch?v=', 'embed/', $p->youtube);
            $row = array();
            $row[] = $i;
            $row[] = '<div class="embed-responsive embed-responsive-16by9">
            <iframe  class="embed-responsive-item" src="' . $video . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>';
            $row[] = $p->nm_video;
            $row[] = $p->nm_playlist;
            $row[] = $p->created_by;
            $row[] = tgl_indo($p->created_at);
            $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_video . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_video(' . "'" . $p->id_video . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
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

        $data = $this->VideoModel->get_video_by_id($id);
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

        $data['nm_video'] = $this->request->getPost('nm_video');
        $data['video_seo'] = url_title($this->request->getPost('nm_video'), '-', true);
        $data['playlist_id'] = $this->request->getPost('playlist');
        $data['ket_video'] = $this->request->getPost('ket_video');
        $data['youtube'] = $this->request->getPost('youtube');
        $data['tagvid'] = $this->request->getPost('tagvid');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->VideoModel->save_video($data);
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

        $data['nm_video'] = $this->request->getPost('nm_video');
        $data['video_seo'] = url_title($this->request->getPost('nm_video'), '-', true);
        $data['playlist_id'] = $this->request->getPost('playlist');
        $data['ket_video'] = $this->request->getPost('ket_video');
        $data['youtube'] = $this->request->getPost('youtube');
        $data['tagvid'] = $this->request->getPost('tagvid');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_video');

        $update = $this->VideoModel->update_video($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete_video($id)
    {
        ceklogin();
        $delete = $this->VideoModel->delete_video($id);
        echo json_encode(array("status" => true));
    }
}
