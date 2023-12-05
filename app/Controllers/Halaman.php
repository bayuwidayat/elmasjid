<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HalamanModel;

class Halaman extends BaseController
{
    public function __construct()
    {
        $this->HalamanModel = new HalamanModel();
    }

    public function layanan()
    {
        $data['title'] = 'Layanan';
        $data['layanan'] = $this->HalamanModel->where('kelompok', 'Layanan')->orderBy('id_halaman', 'DESC')->paginate(12);
        $data['pager'] = $this->HalamanModel->pager;
        $data['jLayanan'] = count($data['layanan']);
        return view('frontend/' . templates()->folder . '/layanan', $data);
    }

    public function halaman_detail($id, $slug)
    {
        $data['halaman'] = $this->HalamanModel->get_halaman_where(['id_halaman' => $id, 'judul_seo' => $slug, 'status' => 'Y']);
        $jHalaman = count($data['halaman']);
        // Jika Ada haalaman ditemukan
        if ($jHalaman > 0) {
            $data['title'] = $data['halaman'][0]->judul;
            $data['keyword'] = substr(strip_tags($data['halaman'][0]->isi_halaman), 0, 100);
            $data['deskripsi'] = substr(strip_tags($data['halaman'][0]->isi_halaman), 0, 160);

            if (!empty($data['halaman'][0]->gambar)) {
                $data['gambar'] = base_url() . 'assets/images/halaman/' . $data['halaman'][0]->gambar;
            }

            $datau['hits'] = $data['halaman'][0]->hits + 1;
            // update data hits
            $this->HalamanModel->update_halaman($datau, $data['halaman'][0]->id_halaman);
            return view('frontend/' . templates()->folder . '/halaman', $data);
        } else {
            return redirect()->to(base_url());
        }
    }
}
