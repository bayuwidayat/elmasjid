<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\HalamanModel;
use App\Models\KategoriModel;
use App\Models\MenusModel;

class Menus extends BaseController
{
    public function __construct()
    {
        $this->HalamanModel = new HalamanModel();
        $this->KategoriModel = new KategoriModel();
        $this->MenusModel = new MenusModel();
    }

    public function index()
    {
        ceklogin();
        cekadmin();

        $data['title'] = 'Daftar Menu';
        $data['get_all_combobox_halaman'] = $this->HalamanModel->get_all_combobox_halaman();
        $data['get_all_combobox_kategori'] = $this->KategoriModel->get_all_combobox_kategori_seo();
        $data['add'] = '<a href="#" class="btn btn-sm btn-success btn-round ml-4" onclick="tambah()"><i class="fas fa-plus"></i> Add</a> <a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="reload_table_menus()"><i class="fas fa-sync-alt"></i> Reload</a>';
        return view('backend/menus', $data);
    }

    // --- menus -----
    public function ajax_list()
    {
        ceklogin();
        cekadmin();

        $list = $this->MenusModel->get_menus();
        $data = array();
        $i = $this->request->getPost('start');
        foreach ($list as $p) :
            $i++;
            $pm = $this->MenusModel->get_menus_by_id($p->parent_id);
            $row = array();
            $row[] = $i;
            $row[] = $p->nm_menus;
            if ($p->tipe == 'links') {
                $row[] = '<a href="' . $p->url . '" target="_blank">' . $p->url . '</a>';;
            } else {
                $row[] = '<a href="' . base_url() . $p->url . '" target="_blank">' . $p->url . '</a>';
            }
            if (!empty($pm->nm_menus)) {
                $row[] = $pm->nm_menus;
            } else {
                $row[] = '';
            }
            $row[] = '<center>' . $p->urutan . '</center>';
            if ($p->aktif == 'Y') {
                $row[] = '<span class="badge badge-success">Ya</span>';
            } else if ($p->aktif == 'N') {
                $row[] = '<span class="badge badge-danger">Tidak</span>';
            }
            $row[] = '<div class="text-center"><div class="btn-group"><a href="javascript:void(0)" onclick="edit(' . "'" . $p->id_menus . "'" . ')" class="btn btn-sm btn-primary"><i class="fas fa-pen fa-sm"></i></a> <a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="hapus_menus(' . "'" . $p->id_menus . "'" . ')"><i class="fas fa-times fa-sm"></i></a></div></div>';
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
        cekadmin();

        $tipe = $this->request->getPost('tipe');
        $halaman = $this->request->getPost('halaman');
        $halaman_custom = $this->request->getPost('halaman_custom');
        $link_custom = $this->request->getPost('link_custom');
        $kategori = $this->request->getPost('kategori');

        if ($tipe == 'halaman') {
            $data['url'] = 'halaman/' . $halaman;
            $data['tipe'] = 'halaman';
        } elseif ($tipe == 'halaman_custom') {
            $data['url'] = $halaman_custom;
            $data['tipe'] = 'halaman_custom';
        } elseif ($tipe == 'links') {
            $data['url'] = $link_custom;
            $data['tipe'] = 'links';
        } elseif ($tipe == 'kategori_berita') {
            $data['url'] = 'kategori/' . $kategori;
            $data['tipe'] = 'kategori_berita';
        }
        $data['nm_menus'] = $this->request->getPost('nm_menus');
        $data['target'] = $this->request->getPost('target');
        $data['parent_id'] = $this->request->getPost('parent_id');
        $data['urutan'] = $this->request->getPost('urutan');
        $data['aktif'] = $this->request->getPost('aktif');
        $data['created_by'] = session()->get('uname');

        $tambah = $this->MenusModel->save_menus($data);

        echo json_encode(array("status" => true));
    }

    public function ajax_edit($id)
    {
        ceklogin();
        cekadmin();

        $data = $this->MenusModel->get_menus_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        ceklogin();
        cekadmin();

        $tipe = $this->request->getPost('tipe');
        $halaman = $this->request->getPost('halaman');
        $halaman_custom = $this->request->getPost('halaman_custom');
        $link_custom = $this->request->getPost('link_custom');
        $kategori = $this->request->getPost('kategori');

        if ($tipe == 'halaman') {
            $data['url'] = 'halaman/' . $halaman;
            $data['tipe'] = 'halaman';
        } elseif ($tipe == 'halaman_custom') {
            $data['url'] = $halaman_custom;
            $data['tipe'] = 'halaman_custom';
        } elseif ($tipe == 'links') {
            $data['url'] = $link_custom;
            $data['tipe'] = 'links';
        } elseif ($tipe == 'kategori_berita') {
            $data['url'] = 'kategori/' . $kategori;
            $data['tipe'] = 'kategori_berita';
        }
        $data['nm_menus'] = $this->request->getPost('nm_menus');
        $data['target'] = $this->request->getPost('target');
        $data['parent_id'] = $this->request->getPost('parent_id');
        $data['urutan'] = $this->request->getPost('urutan');
        $data['aktif'] = $this->request->getPost('aktif');
        $data['updated_by'] = session()->get('uname');
        $id = $this->request->getPost('id_menus');

        $update = $this->MenusModel->update_menus($data, $id);
        echo json_encode(array("status" => true));
    }

    public function ajax_delete($id)
    {
        ceklogin();
        cekadmin();

        $delete_menu = $this->MenusModel->delete_menus($id);
        echo json_encode(array("status" => true));
    }
}
