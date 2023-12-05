<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $db  = \Config\Database::connect();
        $this->jadwal = $db->table('jadwal');
    }

    // --- jadwal ---
    public function get_jadwal()
    {
        $builder = $this->jadwal;
        $builder->select('*');
        $builder->orderBy('id_jadwal', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_jadwal_by_id($id)
    {
        $builder = $this->jadwal;
        $builder->select('*');
        $builder->where('id_jadwal', $id);
        $query = $builder->get();
        return $query->getFirstRow();
    }

    public function save_jadwal($data)
    {
        return $this->jadwal->insert($data);
    }

    public function update_jadwal($data, $id)
    {
        $builder = $this->jadwal;
        $builder->where('id_jadwal', $id);
        return $builder->update($data);
    }

    public function delete_jadwal($id)
    {
        $builder = $this->jadwal;
        $builder->where('id_jadwal', $id);
        return $builder->delete();
    }
}
