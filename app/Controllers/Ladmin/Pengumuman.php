<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\PengumumanModel;

class Pengumuman extends BaseController
{
    public function __construct()
    {
        $this->PengumumanModel = new PengumumanModel();
    }

    public function index()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('/ladmin/dashboard'));
        }

        $data['title'] = 'Pengumuman';
        $data['add'] = '<a href="' . base_url() . 'ladmin/pengumuman/tambah" class="btn btn-sm btn-success"> <i class="fas fa-plus"></i> Add</a> &nbsp; <a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="reload_table_pengumuman()"><i class="fas fa-sync-alt"></i> Reload</a></h5>';
        return view('backend/pengumuman/index', $data);
    }

    // --- pengumuman -----
    public function ajax_list()
    {
        ceklogin();
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));

        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('/ladmin/dashboard'));
        }

        $list = $this->PengumumanModel->get_pengumuman();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = '<a href="' . base_url() . 'pengumuman/' . $p->id_pengumuman . '/' . $p->pengumuman_seo . '" target="_blank">' . $p->nm_pengumuman . '</a>';
            if (empty($p->file_pengumuman)) {
                $row[] = '<span class="badge badge-danger">Tidak Ada File</span>';
            } else {
                $row[] = '<a href="' . base_url() . 'download/pengumuman/' . $p->pengumuman_seo . '/' . $p->id_pengumuman . '"><span class="badge badge-success">Download File</span></a>';
            }
            $row[] = $p->dibaca;
            $row[] = tgl_indo($p->created_at);
            $row[] = '<div class="text-center"><div class="btn-group"><a href="' . base_url() . '/ladmin/pengumuman/edit/' . $p->id_pengumuman . '" class="btn btn-sm btn-primary" title="Edit Pengumuman"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_pengumuman(' . "'" . $p->id_pengumuman . "'" . ')" title="Hapus Pengumuman"><i class="fas fa-times fa-sm"></i></a></div></div>';
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

        $data['title'] = 'Tambah Pengumuman';
        return view('backend/pengumuman/pengumuman_add', $data);
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

        $gambar = $this->request->getFile('file_pengumuman');
        if ($gambar != '') {
            // generate nama sampul random
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/uploads/pengumuman', $namaSampul);

            $data['file_pengumuman'] = $namaSampul;
        }

        $data['nm_pengumuman'] = $this->request->getPost('judul');
        $data['pengumuman_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['isi_pengumuman'] = $this->request->getPost('isi_pengumuman');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->PengumumanModel->save_pengumuman($data);
        return redirect()->to(base_url('ladmin/pengumuman'));
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
            $data['pengumuman'] = $this->PengumumanModel->get_pengumuman_by_id($id);
            // jika data ditemukan
            if (!empty($data['pengumuman']->id_pengumuman)) {
                $data['title'] = 'Edit Data Pengumuman';
                return view('backend/pengumuman/pengumuman_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan</div>');
                return redirect()->to(base_url('ladmin/pengumuman'));
            }
        } else if (session()->get('level') == 'user') {
            $data['pengumuman'] = $this->PengumumanModel->get_pengumuman_by_id($id, session()->get('uname'));
            if (!empty($data['pengumuman']->id_pengumuman)) {
                $data['title'] = 'Edit Data Pengumuman';
                return view('backend/pengumuman/pengumuman_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan atau Anda tidak mempunyai hak akses terhadap data tersebut.</div>');
                return redirect()->to(base_url('ladmin/pengumuman'));
            }
        }

        $data['pengumuman'] = $this->PengumumanModel->get_pengumuman_by_id($id);
        $data['title'] = 'Edit Data Pengumuman';
        return view('backend/pengumuman/pengumuman_edit', $data);
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

        $gambar = $this->request->getFile('file_pengumuman');
        if ($gambar != '') {
            // generate nama sampul random
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/uploads/pengumuman', $namaSampul);

            $data['file_pengumuman'] = $namaSampul;

            // gambar lama
            $gambar_l = $this->request->getPost('gambar');
            if ($gambar_l != '') {
                $file_name = 'assets/uploads/pengumuman/' . $gambar_l;
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
            }
        }

        $data['nm_pengumuman'] = $this->request->getPost('judul');
        $data['pengumuman_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['isi_pengumuman'] = $this->request->getPost('isi_pengumuman');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_pengumuman');

        $tambah = $this->PengumumanModel->update_pengumuman($data, $id);
        return redirect()->to(base_url('ladmin/pengumuman'));
    }

    public function ajax_delete_pengumuman($id)
    {
        ceklogin();

        $pengumuman = $this->PengumumanModel->get_pengumuman_by_id($id);
        if (!empty($pengumuman->file_pengumuman)) {
            $file = 'assets/uploads/pengumuman/' . $pengumuman->file_pengumuman;
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $delete = $this->PengumumanModel->delete_pengumuman($id);
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
            $gambar->move('assets/images/pengumuman', $namaSampul);
            echo base_url() . '/assets/images/pengumuman/' . $namaSampul;
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
}
