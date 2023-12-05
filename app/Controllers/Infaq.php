<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InfaqModel;

class Infaq extends BaseController
{
    public function __construct()
    {
        $this->InfaqModel = new InfaqModel();
    }

    public function index()
    {
        $data['title'] = 'Laporan Infaq';
        $data['infaq'] = $this->InfaqModel->orderBy('id_infaq', 'DESC')->paginate(10);
        $data['pager'] = $this->InfaqModel->pager;
        $data['jInfaq'] = count($data['infaq']);
        return view('frontend/' . templates()->folder . '/infaq', $data);
    }
}
