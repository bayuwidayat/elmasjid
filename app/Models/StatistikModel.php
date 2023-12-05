<?php

namespace App\Models;

use CodeIgniter\Model;

class StatistikModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->statistik = $db->table('statistik');
    }

    // --- statistik ---
    public function get_statistik($data = NULL, $group = NULL)
    {
        $builder = $this->statistik;
        $builder->select('*');
        if ($data != NUll) {
            $builder->where($data);
        }
        if ($group != NUll) {
            $builder->groupBy($group);
        }
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_pengunjung_hari_ini($date)
    {
        $builder = $this->statistik;
        $builder->select('count(*) as jumlah');
        $builder->where('tanggal', $date);
        // $builder->groupBy('ip');
        $query = $builder->get();
        return $query->getFirstRow();
    }

    function grafik_kunjungan()
    {
        $builder = $this->statistik;
        $builder->select('count(*) as jumlah, tanggal');
        $builder->groupBy('tanggal');
        // $builder->orderBy('tanggal');
        $builder->limit(10);
        $query = $builder->get();
        return $query->getResult();
    }

    public function save_statistik($data)
    {
        return $this->statistik->insert($data);
    }

    public function update_statistik($data, $w)
    {
        $builder = $this->statistik;
        $builder->where($w);
        return $builder->update($data);
    }
}
