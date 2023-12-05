<?php

namespace App\Controllers;

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
        $data['title'] = 'Pengumuman';
        $data['pengumuman'] = $this->PengumumanModel->orderBy('id_pengumuman', 'DESC')->paginate(12);
        $data['pager'] = $this->PengumumanModel->pager;
        $data['jPengumuman'] = count($data['pengumuman']);
        return view('frontend/' . templates()->folder . '/pengumuman/index', $data);
    }

    public function detail($a, $b)
    {
        $data['pengumuman'] = $this->PengumumanModel->get_pengumuman_where(array('id_pengumuman' => $a, 'pengumuman_seo' => $b));
        if (!empty($data['pengumuman']->id_pengumuman)) {
            $data['title'] = $data['pengumuman']->nm_pengumuman;
            return view('frontend/' . templates()->folder . '/pengumuman/pengumuman_detail', $data);
        } else {
            return redirect()->to(base_url());
        }
    }

    public function download($a, $b)
    {
        $data = array('pengumuman_seo' => $a, 'id_pengumuman' => $b);
        $pengumuman = $this->PengumumanModel->get_pengumuman_where($data);

        $file = 'assets/uploads/pengumuman/' . $pengumuman->file_pengumuman;
        if (file_exists($file)) {
            return $this->response->download($file, null);
        } else {
            return redirect()->to(base_url());
        }
    }
}
