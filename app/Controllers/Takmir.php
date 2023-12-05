<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TakmirModel;

class Takmir extends BaseController
{
    public function __construct()
    {
        $this->TakmirModel = new TakmirModel();
    }

    public function index()
    {
        $data['title'] = 'Takmir';
        $data['takmir'] = $this->TakmirModel->orderBy('id_takmir', 'ASC')->paginate(12);
        $data['pager'] = $this->TakmirModel->pager;
        $data['jTakmir'] = count($data['takmir']);
        return view('frontend/' . templates()->folder . '/takmir/index', $data);
    }

    public function detail($a, $b)
    {
        $data['takmir'] = $this->TakmirModel->get_takmir_where(array('id_takmir' => $a, 'takmir_seo' => $b));
        if (!empty($data['takmir']->id_takmir)) {
            $data['title'] = 'Takmir';
            return view('frontend/' . templates()->folder . '/takmir/takmir_detail', $data);
        } else {
            return redirect()->to(base_url());
        }
    }
}
