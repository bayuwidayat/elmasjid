<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class Tausiyah extends BaseController
{
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
    }

    public function index()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
        $jPost = 10; // jumlah post per halaaman

        $keyword = $this->request->getVar('s');

        $data['title'] = 'Tausiyah';
        $data['add'] = '<a href="' . base_url() . 'ladmin/tausiyah/tambah" class="btn btn-sm btn-success ms-3 me-1"><i class="fas fa-plus"></i> Add</a> <a href="' . base_url() . 'ladmin/tausiyah" class="btn btn-sm btn-warning"><i class="fas fa-sync"></i> Reload</a></h5>';

        if (session()->get('level') == 'admin') {
            $data['tausiyah'] = $this->BeritaModel->get_all_berita('tausiyah', $jPost, NULL, ($keyword) ? $keyword : NULL);
        } else {
            $data['tausiyah'] = $this->BeritaModel->get_all_berita('tausiyah', $jPost, session()->get('uname'), ($keyword) ? $keyword : NULL);
        }

        $data['pager'] = $this->BeritaModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;
        return view('backend/tausiyah/index', $data);
    }

    public function tambah()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $data['title'] = 'Tambah Tausiyah';
        return view('backend/tausiyah/tausiyah_add', $data);
    }

    public function ajax_save()
    {
        ceklogin();

        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $gambar = $this->request->getFile('foto');
        if ($gambar != '') {
            // generate nama baru
            $namaSampul = rand(10, 99) . '-' . str_replace(' ', '-', $gambar->getName());
            // pindahkan file ke img
            $gambar->move('assets/images/tausiyah', $namaSampul);

            $data['gambar'] = $namaSampul;
        }

        $data['judul'] = $this->request->getPost('judul');
        $data['judul_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['isi_berita'] = $this->request->getPost('isi_berita');
        $data['tipe'] = 'tausiyah';
        $data['tag'] = $this->request->getPost('tag');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->BeritaModel->save_berita($data);
        return redirect()->to(base_url('ladmin/tausiyah'));
    }

    public function edit($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        // jika Admin
        if (session()->get('level') == 'admin') {
            $data['tausiyah'] = $this->BeritaModel->get_berita_by_id($id);
            // jika data ditemukan
            if (!empty($data['tausiyah']->id_berita)) {
                $data['title'] = 'Edit Data Tausiyah';
                return view('backend/tausiyah/tausiyah_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan</div>');
                return redirect()->to(base_url('ladmin/tausiyah'));
            }
        } else if (session()->get('level') == 'user') {
            $data['tausiyah'] = $this->BeritaModel->get_berita_by_id($id, session()->get('uname'));
            if (!empty($data['tausiyah']->id_berita)) {
                $data['title'] = 'Edit Data Tausiyah';
                return view('backend/tausiyah/tausiyah_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan atau Anda tidak mempunyai hak akses terhadap data tersebut.</div>');
                return redirect()->to(base_url('ladmin/tausiyah'));
            }
        }
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
            $gambar->move('assets/images/tausiyah', $namaSampul);

            $data['gambar'] = $namaSampul;

            // gambar lama
            $gambar_l = $this->request->getPost('gambar');
            if ($gambar_l != '') {
                $file_name = 'assets/images/tausiyah/' . $gambar_l;
                unlink($file_name);
            }
        }

        $data['judul'] = $this->request->getPost('judul');
        $data['judul_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['isi_berita'] = $this->request->getPost('isi_berita');
        $data['tag'] = $this->request->getPost('tag');
        $data['status'] = $this->request->getPost('status');
        $data['created_by'] = session()->get('uname');
        $id = $this->request->getPost('id_berita');

        $tambah = $this->BeritaModel->update_berita($data, $id);
        return redirect()->to(base_url('ladmin/tausiyah'));
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

        $berita = $this->BeritaModel->get_berita_by_id($id);
        if (!empty($berita->gambar)) {
            if ($berita->gambar != 'default.jpg') {
                $file = 'assets/images/tausiyah/' . $berita->gambar;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }
        if (session()->get('level') == 'admin') {
            $delete = $this->BeritaModel->delete_berita($id);
        } else {
            $delete = $this->BeritaModel->delete_berita_by_user($id, session()->get('uname'));
        }

        return redirect()->to(base_url('ladmin/tausiyah'));
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
            $gambar->move('assets/images/tausiyah', $namaSampul);
            echo base_url() . '/assets/images/tausiyah/' . $namaSampul;
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

        $berita = $this->BeritaModel->get_berita_by_id($id);
        if (!empty($berita->gambar)) {
            $file = 'assets/images/tausiyah/' . $berita->gambar;
            if (file_exists($file)) {
                unlink($file);
                $data['gambar'] = '';
                $this->BeritaModel->update_berita($data, $id);
            }
        }

        echo json_encode(array("status" => true));
    }
}
