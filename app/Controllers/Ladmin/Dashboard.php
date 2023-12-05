<?php

namespace App\Controllers\Ladmin;

use App\Controllers\BaseController;
use App\Models\BeritaModel;
use App\Models\HalamanModel;
use App\Models\InfaqModel;
use App\Models\StatistikModel;
use App\Models\UsersModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->BeritaModel = new BeritaModel();
        $this->HalamanModel = new HalamanModel();
        $this->InfaqModel = new InfaqModel();
        $this->StatistikModel = new StatistikModel();
        $this->UsersModel = new UsersModel();
    }

    public function index()
    {
        ceklogin();

        $data['title'] = 'Dashboard';
        $data['berita'] = count($this->BeritaModel->get_berita());
        $data['halaman'] = count($this->HalamanModel->get_halaman());
        $data['users'] = count($this->UsersModel->get_all_users());
        $data['grafik'] = $this->StatistikModel->grafik_kunjungan();
        $data['pengunjung_hari_ini'] = $this->StatistikModel->get_pengunjung_hari_ini(date('Y-m-d'));
        $stat = $this->StatistikModel->get_statistik();
        $j_stat = count($stat);
        $data['total_pengunjung'] = isset($j_stat) ? $j_stat : 0; //hitung total pengunjung
        $bataswaktu = time() - 300;
        $data['pengunjung_online'] = count($this->StatistikModel->get_statistik(['online < ' => $bataswaktu, 'tanggal' => date('Y-m-d')]));
        // infak
        $danaMasuk = $this->InfaqModel->get_infaq_total(['jenis' => 'Dana Masuk'])->jml;
        $danaKeluar = $this->InfaqModel->get_infaq_total(['jenis' => 'Dana Keluar'])->jml;
        $data['saldo'] = $danaMasuk - $danaKeluar;
        return view('backend/index', $data);
    }
}
