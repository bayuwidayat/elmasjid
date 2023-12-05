<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\HalamanModel;
use App\Models\MenusModel;

class Halaman extends BaseController
{
    public function __construct()
    {
        $this->MenusModel = new MenusModel();
        $this->HalamanModel = new HalamanModel();
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

        $data['title'] = 'Halaman';
        $data['add'] = '<a href="' . base_url() . 'ladmin/halaman/tambah" class="btn btn-sm btn-success ms-3 me-1"><i class="fas fa-plus"></i> Add</a> <a href="' . base_url() . 'ladmin/halaman" class="btn btn-sm btn-warning"><i class="fas fa-sync"></i> Reload</a></h5>';
        if (session()->get('level') == 'admin') {
            $data['halaman'] = $this->HalamanModel->get_all_halaman(NULL, $jPost, NULL, ($keyword) ? $keyword : NULL);
        } else {
            $data['halaman'] = $this->HalamanModel->get_all_halaman(NULL, $jPost, session()->get('uname'), ($keyword) ? $keyword : NULL);
        }

        $data['pager'] = $this->HalamanModel->pager;
        $data['jPost'] = $jPost;
        $data['currentPage'] = $currentPage;

        return view('backend/halaman/index', $data);
    }

    public function tambah()
    {
        if (!session()->has('masukMember')) {
            return redirect()->to(base_url());
        }

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $data['title'] = 'Tambah Halaman';
        return view('backend/halaman/halaman_add', $data);
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
            $gambar->move('assets/images/halaman', $namaSampul);

            $data['gambar'] = $namaSampul;
        }

        $data['judul'] = $this->request->getPost('judul');
        $data['judul_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['ringkasan_halaman'] = $this->request->getPost('ringkasan_halaman');
        $data['isi_halaman'] = $this->request->getPost('isi_halaman');
        $data['kelompok'] = $this->request->getPost('kelompok');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->HalamanModel->save_halaman($data);
        return redirect()->to(base_url('ladmin/halaman'));
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
            $data['halaman'] = $this->HalamanModel->get_halaman_by_id($id);
            // jika data ditemukan
            if (!empty($data['halaman']->id_halaman)) {
                $data['title'] = 'Edit Data Halaman';
                return view('backend/halaman/halaman_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan</div>');
                return redirect()->to(base_url('ladmin/halaman'));
            }
        } else if (session()->get('level') == 'user') {
            $data['halaman'] = $this->HalamanModel->get_halaman_by_id($id, session()->get('uname'));
            if (!empty($data['halaman']->id_halaman)) {
                $data['title'] = 'Edit Data Halaman';
                return view('backend/halaman/halaman_edit', $data);
            } else {
                $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data yang anda maksud tidak ditemukan atau Anda tidak mempunyai hak akses terhadap data tersebut.</div>');
                return redirect()->to(base_url('ladmin/halaman'));
            }
        }

        // $data['halaman'] = $this->HalamanModel->get_halaman_by_id($id);
        // $data['title'] = 'Edit Data Halaman';
        // return view('backend/halaman/halaman_edit', $data);
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
            $gambar->move('assets/images/halaman', $namaSampul);

            $data['gambar'] = $namaSampul;

            // gambar lama
            $gambar_l = $this->request->getPost('gambar');
            if ($gambar_l != '') {
                $file_name = 'assets/images/halaman/' . $gambar_l;
                if (file_exists($file_name)) {
                    unlink($file_name);
                }
            }
        }

        $data['judul'] = $this->request->getPost('judul');
        $data['judul_seo'] = url_title($this->request->getPost('judul'), '-', true);
        $data['ringkasan_halaman'] = $this->request->getPost('ringkasan_halaman');
        $data['isi_halaman'] = $this->request->getPost('isi_halaman');
        $data['kelompok'] = $this->request->getPost('kelompok');
        $data['status'] = $this->request->getPost('status');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_halaman');

        $tambah = $this->HalamanModel->update_halaman($data, $id);

        // update data menu
        $pre_link = 'halaman/' . $id;
        $menu = $this->MenusModel->get_menus_by_like(['url' => $pre_link]);
        $jMenu = count($menu);
        if ($jMenu > 0) {
            foreach ($menu as $m) {
                $link_baru = 'halaman/' . $id . '/' . $data['judul_seo'];
                $this->MenusModel->update_menus(['url' => $link_baru], $m->id_menus);
            }
        }
        return redirect()->to(base_url('ladmin/halaman'));
    }

    public function ajax_delete_halaman($id)
    {
        ceklogin();

        // cek hak akses
        $cha = cek_hak_akses($this->uri->getSegment(2), session()->get('uname'));
        if ($cha == 0 and session()->get('level') != 'admin') {
            $this->session->setFlashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda tidak diizinkan mengakses modul yang dimaksud.</div>');
            return redirect()->to(base_url('ladmin/dashboard'));
        }

        $halaman = $this->HalamanModel->get_halaman_by_id($id);
        if (!empty($halaman->gambar)) {
            if ($halaman->gambar != 'default.jpg') {
                $file = 'assets/images/halaman/' . $halaman->gambar;
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        }

        if (session()->get('level') == 'admin') {
            $delete = $this->HalamanModel->delete_halaman($id);
        } else {
            $delete = $this->HalamanModel->delete_halaman_by_user($id, session()->get('uname'));
        }

        $delete = $this->HalamanModel->delete_halaman($id);

        return redirect()->to(base_url('ladmin/halaman'));
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
            $gambar->move('assets/images/halaman', $namaSampul);
            echo base_url() . '/assets/images/halaman/' . $namaSampul;
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

        $halaman = $this->HalamanModel->get_halaman_by_id($id);
        if (!empty($halaman->gambar)) {
            $file = 'assets/images/halaman/' . $halaman->gambar;
            if (file_exists($file)) {
                unlink($file);
                $data['gambar'] = '';
                $this->HalamanModel->update_halaman($data, $id);
            }
        }

        echo json_encode(array("status" => true));
    }

    public function pilih_halaman($id)
    {
        $data['id'] = $id;
        $data['get_all_combobox_menus'] = $this->MenusModel->get_all_combobox_menus();
        return view('backend/halaman/halaman_v', $data);
    }
}
