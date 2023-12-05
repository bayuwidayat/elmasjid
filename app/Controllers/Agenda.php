<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgendaModel;

class Agenda extends BaseController
{
    public function __construct()
    {
        $this->AgendaModel = new AgendaModel();
    }

    public function index()
    {
        $data['title'] = 'Agenda';
        $data['agenda'] = $this->AgendaModel->orderBy('id_agenda', 'DESC')->paginate(12);
        $data['pager'] = $this->AgendaModel->pager;
        $data['jAgenda'] = count($data['agenda']);
        return view('frontend/' . templates()->folder . '/agenda/index', $data);
    }

    public function detail($a, $b)
    {
        $data['agenda'] = $this->AgendaModel->get_agenda_detail(array('agenda.id_agenda' => $a, 'agenda.agenda_seo' => $b));
        if (!empty($data['agenda']->id_agenda)) {
            $data['title'] = $data['agenda']->nm_agenda;
            return view('frontend/' . templates()->folder . '/agenda/agenda_detail', $data);
        } else {
            return redirect()->to(base_url());
        }
    }
}
