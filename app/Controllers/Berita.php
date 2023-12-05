<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BeritaModel;

class Berita extends BaseController
{
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
    }

    public function index()
    {
        $data['title'] = 'Arsip Berita';
        $data['keyword'] = setting()->meta_keyword;
        $data['deskripsi'] = setting()->meta_deskripsi;
        $data['berita'] = $this->BeritaModel->where('tipe', 'berita')->where('status', 'Y')->orderBy('id_berita', 'DESC')->paginate(10);
        $data['pager'] = $this->BeritaModel->pager;
        $data['jBerita'] = count($data['berita']);
        return view('frontend/' . templates()->folder . '/berita/index', $data);
    }

    public function berita_detail($id, $slug)
    {
        $data['berita'] = $this->BeritaModel->get_berita_where(['id_berita' => $id, 'judul_seo' => $slug]);
        $jBerita = count($data['berita']);
        // Jika Ada berita ditemukan
        if ($jBerita > 0) {
            $data['title'] = $data['berita'][0]->judul;
            $data['keyword'] = $data['berita'][0]->tag;
            $data['deskripsi'] = substr(strip_tags($data['berita'][0]->isi_berita), 0, 160);
            if (!empty($data['berita'][0]->gambar)) {
                $data['gambar'] = base_url() . 'assets/images/berita/' . $data['berita'][0]->gambar;
            }

            $datau['hits'] = $data['berita'][0]->hits + 1;
            // update data hits
            $this->BeritaModel->update_berita($datau, $data['berita'][0]->id_berita);
            return view('frontend/' . templates()->folder . '/berita/berita_detail', $data);
        } else {
            return redirect()->to(base_url());
        }
    }

    public function tag($slug)
    {
        $data['berita'] = $this->BeritaModel->get_berita_by_tag($slug, 10);
        $data['pager'] = $this->BeritaModel->pager;
        $data['jBerita'] = count($data['berita']);
        // Jika Ada berita ditemukan
        if ($data['jBerita'] > 0) {
            $data['title'] = 'Arsip Tag : ' . $slug;
            $data['keyword'] = $data['berita'][0]['tag'];
            $data['deskripsi'] = substr(strip_tags($data['berita'][0]['isi_berita']), 0, 160);
        } else {
            $data['title'] = 'Arsip Tag : ' . $slug;
            $data['keyword'] = 'Arsip Tag : ' . $slug;
            $data['deskripsi'] = 'Arsip Tag : ' . $slug;
        }
        return view('frontend/' . templates()->folder . '/berita/index', $data);
    }

    public function kategori($slug)
    {
        $data['berita'] = $this->BeritaModel->get_berita_by_kategori($slug, 10);
        $data['pager'] = $this->BeritaModel->pager;
        $data['jBerita'] = count($data['berita']);
        // Jika Ada berita ditemukan
        if ($data['jBerita'] > 0) {
            $data['title'] = 'Arsip Kategori : ' . $data['berita'][0]['nm_kategori'];
            $data['keyword'] = $data['berita'][0]['nm_kategori'];
            $data['deskripsi'] = substr(strip_tags($data['berita'][0]['isi_berita']), 0, 160);
        } else {
            $data['title'] = 'Arsip Kategori : ' . $slug;
            $data['keyword'] = 'Arsip Kategori : ' . $slug;
            $data['deskripsi'] = 'Arsip Kategori : ' . $slug;
        }
        return view('frontend/' . templates()->folder . '/berita/index', $data);
    }

    public function author($slug)
    {
        $data['berita'] = $this->BeritaModel->get_berita_by_author($slug, 10);
        $data['pager'] = $this->BeritaModel->pager;
        $data['jBerita'] = count($data['berita']);
        // Jika Ada berita ditemukan
        if ($data['jBerita'] > 0) {
            $data['title'] = 'Author : ' . $data['berita'][0]['created_by'];
            $data['keyword'] = $data['berita'][0]['created_by'];
            $data['deskripsi'] = substr(strip_tags($data['berita'][0]['isi_berita']), 0, 160);
        } else {
            $data['title'] = 'Author : ' . $slug;
            $data['keyword'] = 'Author : ' . $slug;
            $data['deskripsi'] = 'Author : ' . $slug;
        }
        return view('frontend/' . templates()->folder . '/berita/index', $data);
    }

    // Tausiyah
    public function tausiyah()
    {
        $data['title'] = 'Arsip Tausiyah';
        $data['keyword'] = setting()->meta_keyword;
        $data['deskripsi'] = setting()->meta_deskripsi;
        $data['berita'] = $this->BeritaModel->where('tipe', 'tausiyah')->where('status', 'Y')->orderBy('id_berita', 'DESC')->paginate(10);
        $data['pager'] = $this->BeritaModel->pager;
        $data['jBerita'] = count($data['berita']);
        return view('frontend/' . templates()->folder . '/berita/tausiyah', $data);
    }

    public function tausiyah_detail($id, $slug)
    {
        $data['berita'] = $this->BeritaModel->get_berita_where(['id_berita' => $id, 'judul_seo' => $slug]);
        $jBerita = count($data['berita']);
        // Jika Ada berita ditemukan
        if ($jBerita > 0) {
            $data['title'] = $data['berita'][0]->judul;
            $data['keyword'] = $data['berita'][0]->tag;
            $data['deskripsi'] = substr(strip_tags($data['berita'][0]->isi_berita), 0, 160);
            if (!empty($data['berita'][0]->gambar)) {
                $data['gambar'] = base_url() . 'assets/images/berita/' . $data['berita'][0]->gambar;
            }

            $datau['hits'] = $data['berita'][0]->hits + 1;
            // update data hits
            $this->BeritaModel->update_berita($datau, $data['berita'][0]->id_berita);
            return view('frontend/' . templates()->folder . '/berita/tausiyah_detail', $data);
        } else {
            return redirect()->to(base_url());
        }
    }
}
