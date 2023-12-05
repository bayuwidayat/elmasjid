<?php

namespace App\Controllers;

use App\Models\AgendaModel;
use App\Models\BeritaModel;
use App\Models\FotoModel;
use App\Models\HalamanModel;
use App\Models\InfaqModel;
use App\Models\JadwalModel;
use App\Models\MenusModel;
use App\Models\PengumumanModel;
use App\Models\SliderModel;
use App\Models\TakmirModel;
use App\Models\VideoModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->AgendaModel = new AgendaModel();
        $this->BeritaModel = new BeritaModel();
        $this->FotoModel = new FotoModel();
        $this->HalamanModel = new HalamanModel();
        $this->InfaqModel = new InfaqModel();
        $this->JadwalModel = new JadwalModel();
        $this->MenusModel = new MenusModel();
        $this->PengumumanModel = new PengumumanModel();
        $this->SliderModel = new SliderModel();
        $this->TakmirModel = new TakmirModel();
        $this->VideoModel = new VideoModel();
    }

    public function index()
    {
        $data['title'] = setting()->slogan;
        $data['keyword'] = setting()->meta_keyword;
        $data['deskripsi'] = setting()->meta_deskripsi;
        $data['slider'] = $this->SliderModel->get_slider_home('3');
        $data['layanan'] = $this->HalamanModel->get_halaman_where(['kelompok' => 'Layanan', 'status' => 'Y'], '3');
        $data['berita'] = $this->BeritaModel->get_berita('berita', '3', 'Y');
        $data['pengumuman'] = $this->PengumumanModel->get_pengumuman(3);
        $data['agenda'] = $this->AgendaModel->get_agenda(4);
        $data['tausiyah'] = $this->BeritaModel->get_berita('tausiyah', '3', 'Y');
        $data['infaq'] = $this->InfaqModel->get_infaq('Dana Masuk', 7);
        $danaMasuk = $this->InfaqModel->get_infaq_total(['jenis' => 'Dana Masuk'])->jml;
        $danaKeluar = $this->InfaqModel->get_infaq_total(['jenis' => 'Dana Keluar'])->jml;
        $data['infaq_saldo'] = $danaMasuk - $danaKeluar;
        $data['foto'] = $this->FotoModel->get_foto('random', 9, NULL, 'Y');
        $data['video'] = $this->VideoModel->get_video('random', 4, NULL);

        if (templates() == 'Error') {
            echo 'Error Template gan. Silahkan hubungi Webmaster';
        } else {
            return view('frontend/' . templates()->folder . '/index', $data);
        }
    }

    public function profil()
    {
        $data['title'] = 'Profil ' . setting()->nm_website;
        $data['takmir'] = $this->TakmirModel->get_takmir('random', 3);
        $data['jTakmir'] = count($data['takmir']);
        return view('frontend/' . templates()->folder . '/profil', $data);
    }

    public function kontak()
    {
        $data['title'] = 'Kontak Kami';
        return view('frontend/' . templates()->folder . '/kontak', $data);
    }

    public function jadwal_jumat()
    {
        $data['title'] = 'Jadwal Jumat';
        $data['jadwal'] = $this->JadwalModel->get_jadwal();
        $data['jJadwal'] = count($data['jadwal']);
        return view('frontend/' . templates()->folder . '/jadwal', $data);
    }

    public function search()
    {
        $s = $this->request->getVar('s') ? $this->request->getVar('s') : '';
        $data['title'] = 'Hasil Pencarian : ' . $s;
        $data['berita'] = $this->BeritaModel->like('judul', $s)->orlike('isi_berita', $s)->where('status', 'Y')->orderBy('id_berita', 'DESC')->paginate(12);
        $data['pager'] = $this->BeritaModel->pager;
        $data['jBerita'] = count($data['berita']);
        return view('frontend/' . templates()->folder . '/hasil_pencarian', $data);
    }

    public function maintenance_mode()
    {
        $data['title'] = 'Maintenance';
        if (setting()->maintenance == 'Y') {
            return view('frontend/' . templates()->folder . '/maintenance', $data);
        } else {
            return redirect()->to(base_url());
        }
    }
}
